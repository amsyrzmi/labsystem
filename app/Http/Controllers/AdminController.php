<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\LabRequest;
use App\Models\DefaultMaterial;
use App\Models\DefaultApparatus;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Experiment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        // Get counts for dashboard
        $stats = [
            'total_users' => User::count(),
            'pending_approvals' => User::pending()->count(),
            'teachers' => User::byRole('teacher')->approved()->count(),
            'lab_assistants' => User::byRole('lab_assistant')->approved()->count(),
            // NEW: Request stats
            'pending_requests' => LabRequest::where('status', 'pending')->count(),
            'upcoming_sessions' => LabRequest::where('status', 'approved')
                ->where('approved_date', '>=', now())
                ->count(),
        ];

        return view('admin.index', compact('stats'));
    }
    public function manageUsersMain()
    {
        // Get counts for dashboard
        $stats = [
            'total_users' => User::count(),
            'pending_approvals' => User::pending()->count(),
            'teachers' => User::byRole('teacher')->approved()->count(),
            'lab_assistants' => User::byRole('lab_assistant')->approved()->count(),
        ];

        return view('admin.manageusers', compact('stats'));
    }

    public function manageUsers(Request $request)
    {
        $query = User::query();

        // Filter by status
        $status = $request->get('status', 'all');
        if ($status === 'pending') {
            $query->pending();
        } elseif ($status === 'approved') {
            $query->approved();
        }

        // Filter by role
        $role = $request->get('role');
        if ($role && in_array($role, ['teacher', 'lab_assistant', 'admin'])) {
            $query->byRole($role);
        }

        // Search
        $search = $request->get('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Exclude current admin from the list
        $query->where('id', '!=', Auth::id());

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users', compact('users', 'status', 'role', 'search'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->is_approved) {
            return back()->with('info', 'User is already approved.');
        }

        $user->approve(Auth::id());

        return back()->with('success', "User {$user->name} has been approved and notified via email.");
    }

    public function rejectUser($id)
    {
        $user = User::findOrFail($id);

        $user->reject();

        return back()->with('success', "User {$user->name} has been rejected.");
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent admin from deleting themselves
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $userName = $user->name;
        $user->delete();

        return back()->with('success', "User {$userName} has been deleted.");
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function sendPasswordReset($id)
    {
        $user = User::findOrFail($id);
        
        // Generate a password reset token
        $token = app('auth.password.broker')->createToken($user);
        
        // Send the reset notification
        $user->sendPasswordResetNotification($token);
        
        return back()->with('success', 'Password reset link sent to ' . $user->email);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,teacher,lab_assistant',
            'is_approved' => 'boolean',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function createUser()
    {
        return view('admin.create-user');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string|in:admin,teacher,lab_assistant',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'is_approved' => true, // Admin-created users are auto-approved
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }
    public function allRequests(Request $request)
    {
        $query = LabRequest::with(['subject', 'topic', 'experiment', 'user']);

        // Filter by status
        $status = $request->get('status');
        if ($status && in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $status);
        }

        // Filter by lab number
        $labNumber = $request->get('lab_number');
        if ($labNumber) {
            $query->where('lab_number', $labNumber);
        }

        // Search by teacher name or class
        $search = $request->get('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhere('classname', 'like', "%{$search}%");
            });
        }

        // Only show upcoming/active requests
        $query->where('preferred_date', '>=', now()->subDays(1))
            ->orderBy('preferred_date', 'asc')
            ->orderBy('created_at', 'desc');

        $requests = $query->paginate(20);

        // Get unique lab numbers for filter
        $labNumbers = LabRequest::distinct()->pluck('lab_number')->sort();

        return view('admin.requests', compact('requests', 'status', 'labNumber', 'search', 'labNumbers'));
    }

    /**
     * View all history (completed/past requests)
     */
    public function allHistory(Request $request)
    {
        $query = LabRequest::with(['subject', 'topic', 'experiment', 'user']);

        // Filter by status
        $status = $request->get('status');
        if ($status && in_array($status, ['completed', 'cancelled', 'no_show', 'rejected'])) {
            $query->where('status', $status);
        }

        // Filter by lab number
        $labNumber = $request->get('lab_number');
        if ($labNumber) {
            $query->where('lab_number', $labNumber);
        }

        // Search
        $search = $request->get('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhere('classname', 'like', "%{$search}%");
            });
        }

        // Only show past/completed
        $query->where(function($q) {
            $q->whereIn('status', ['completed', 'cancelled', 'no_show', 'rejected'])
            ->orWhere('preferred_date', '<', now());
        })
        ->orderBy('preferred_date', 'desc')
        ->orderBy('completed_at', 'desc');

        $requests = $query->paginate(20);

        // Get unique lab numbers for filter
        $labNumbers = LabRequest::distinct()->pluck('lab_number')->sort();

        return view('admin.history', compact('requests', 'status', 'labNumber', 'search', 'labNumbers'));
    }

    /**
     * View request details
     */
    public function requestDetails($id)
    {
        $labRequest = LabRequest::with(['subject', 'topic', 'experiment', 'user'])->findOrFail($id);

        $materials = collect();
        $apparatuses = collect();

        if ($labRequest->experiment_id) {
            $materials = DefaultMaterial::where('experiment_id', $labRequest->experiment_id)
                ->select('id', 'name', 'quantity', 'unit','concentration')
                ->orderBy('name')
                ->get();

            $apparatuses = DefaultApparatus::where('experiment_id', $labRequest->experiment_id)
                ->select('id', 'name', 'quantity')
                ->orderBy('name')
                ->get();
        }

        return view('admin.request-details', [
            'request' => $labRequest,
            'materials' => $materials,
            'apparatuses' => $apparatuses,
        ]);
    }

    /**
     * Mark request as completed
     */
    public function markCompleted($id)
    {
        $request = LabRequest::findOrFail($id);
        
        $request->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return back()->with('success', 'Request marked as completed.');
    }

    /**
     * Mark request as no-show
     */
    public function markNoShow($id)
    {
        $request = LabRequest::findOrFail($id);
        
        $request->update([
            'status' => 'no_show',
        ]);

        return back()->with('success', 'Request marked as no-show.');
    }

    /**
     * Cancel request
     */
    public function rejectRequest($id)
    {
        $request = LabRequest::findOrFail($id);
        
        $request->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Request has been rejected.');
    }

        public function approveRequest($id)
    {
        $request = LabRequest::findOrFail($id);
        
        $request->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Request has been approved.');
    }

    /**
     * Delete request
     */
    public function deleteRequest($id)
    {
        $request = LabRequest::findOrFail($id);
        $request->delete();

        return redirect()->route('admin.requests')->with('success', 'Request has been deleted.');
    }
    // ============================================
    // EXPERIMENTS MANAGEMENT METHODS
    // ============================================

    public function manageExperimentsIndex(Request $request)
    {
        $query = Experiment::with(['topic.subject']);
        
        // Filter by form level - handle both "Form X" and "X" formats
        if ($request->has('form_level') && $request->form_level != '') {
            $formLevel = $request->form_level;
            // Convert to "Form X" format if just number is provided
            $formLevelString = is_numeric($formLevel) ? "Form {$formLevel}" : $formLevel;
            
            $query->whereHas('topic.subject', function($q) use ($formLevelString) {
                $q->where('form_level', $formLevelString);
            });
        }
        
        // Filter by subject
        if ($request->has('subject_id') && $request->subject_id != '') {
            $query->whereHas('topic', function($q) use ($request) {
                $q->where('subject_id', $request->subject_id);
            });
        }
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $experiments = $query->orderBy('name')->paginate(15);
        
        // Get all subjects for filter grouped by form level
        $subjects = Subject::orderBy('form_level')->orderBy('name')->get();
        
        return view('admin.manage_experiments.index', compact('experiments', 'subjects'));
    }

    public function manageExperimentsCreate()
    {
        return view('admin.manage_experiments.create');
    }

    public function manageExperimentsStore(Request $request)
    {
        $validated = $request->validate([
            'form_level' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
            'topic_id' => 'required|exists:topics,id',
            'experiment_name' => 'required|string|max:255',
            
            // Materials
            'materials' => 'nullable|array',
            'materials.*.name' => 'required|string|max:255',
            'materials.*.quantity' => 'required|numeric|min:0',
            'materials.*.unit' => 'required|string|max:50',
            'materials.*.concentration' => 'nullable|numeric|min:0',
            
            // Apparatus
            'apparatus' => 'nullable|array',
            'apparatus.*.name' => 'required|string|max:255',
            'apparatus.*.quantity' => 'required|integer|min:1',
        ]);
        
        DB::beginTransaction();
        try {
            // Create experiment
            $experiment = Experiment::create([
                'name' => $validated['experiment_name'],
                'topic_id' => $validated['topic_id'],
            ]);
            
            // Add materials
            if (!empty($validated['materials'])) {
                foreach ($validated['materials'] as $material) {
                    DefaultMaterial::create([
                        'experiment_id' => $experiment->id,
                        'name' => $material['name'],
                        'quantity' => $material['quantity'],
                        'unit' => $material['unit'],
                        'concentration' => $material['concentration'] ?? null,
                    ]);
                }
            }
            
            // Add apparatus
            if (!empty($validated['apparatus'])) {
                foreach ($validated['apparatus'] as $item) {
                    DefaultApparatus::create([
                        'experiment_id' => $experiment->id,
                        'name' => $item['name'],
                        'quantity' => $item['quantity'],
                    ]);
                }
            }
            
            DB::commit();
            return redirect()->route('admin.manage_experiments.index')
                ->with('success', 'Experiment created successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating experiment: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create experiment. Please try again.');
        }
    }

    public function manageExperimentsEdit($id)
    {
        $experiment = Experiment::with(['topic.subject', 'defaultmaterial', 'defaultapparatus'])
            ->findOrFail($id);
        
        return view('admin.manage_experiments.edit', compact('experiment'));
    }

    public function manageExperimentsUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'experiment_name' => 'required|string|max:255',
            'topic_id' => 'required|exists:topics,id',
            
            // Materials
            'materials' => 'nullable|array',
            'materials.*.id' => 'nullable|exists:defaultmaterials,id',
            'materials.*.name' => 'required|string|max:255',
            'materials.*.quantity' => 'required|numeric|min:0',
            'materials.*.unit' => 'required|string|max:50',
            'materials.*.concentration' => 'nullable|numeric|min:0',
            
            // Apparatus
            'apparatus' => 'nullable|array',
            'apparatus.*.id' => 'nullable|exists:defaultapparatuses,id',
            'apparatus.*.name' => 'required|string|max:255',
            'apparatus.*.quantity' => 'required|integer|min:1',
            
            // Deleted items
            'deleted_materials' => 'nullable|string',
            'deleted_apparatus' => 'nullable|string',
        ]);
        
        DB::beginTransaction();
        try {
            $experiment = Experiment::findOrFail($id);
            
            // Update experiment
            $experiment->update([
                'name' => $validated['experiment_name'],
                'topic_id' => $validated['topic_id'],
            ]);
            
            // Handle deleted materials
            if (!empty($validated['deleted_materials'])) {
                $deletedMaterialIds = json_decode($validated['deleted_materials'], true);
                if (is_array($deletedMaterialIds)) {
                    DefaultMaterial::whereIn('id', $deletedMaterialIds)->delete();
                }
            }
            
            // Handle deleted apparatus
            if (!empty($validated['deleted_apparatus'])) {
                $deletedApparatusIds = json_decode($validated['deleted_apparatus'], true);
                if (is_array($deletedApparatusIds)) {
                    DefaultApparatus::whereIn('id', $deletedApparatusIds)->delete();
                }
            }
            
            // Update/Create materials
            if (!empty($validated['materials'])) {
                foreach ($validated['materials'] as $key => $material) {
                    // Check if this is an existing material (starts with "existing_")
                    if (strpos($key, 'existing_') === 0 && !empty($material['id'])) {
                        // Update existing
                        DefaultMaterial::where('id', $material['id'])->update([
                            'name' => $material['name'],
                            'quantity' => $material['quantity'],
                            'unit' => $material['unit'],
                            'concentration' => $material['concentration'] ?? null,
                        ]);
                    } elseif (strpos($key, 'new_') === 0) {
                        // Create new
                        DefaultMaterial::create([
                            'experiment_id' => $experiment->id,
                            'name' => $material['name'],
                            'quantity' => $material['quantity'],
                            'unit' => $material['unit'],
                            'concentration' => $material['concentration'] ?? null,
                        ]);
                    }
                }
            }
            
            // Update/Create apparatus
            if (!empty($validated['apparatus'])) {
                foreach ($validated['apparatus'] as $key => $item) {
                    // Check if this is an existing apparatus (starts with "existing_")
                    if (strpos($key, 'existing_') === 0 && !empty($item['id'])) {
                        // Update existing
                        DefaultApparatus::where('id', $item['id'])->update([
                            'name' => $item['name'],
                            'quantity' => $item['quantity'],
                        ]);
                    } elseif (strpos($key, 'new_') === 0) {
                        // Create new
                        DefaultApparatus::create([
                            'experiment_id' => $experiment->id,
                            'name' => $item['name'],
                            'quantity' => $item['quantity'],
                        ]);
                    }
                }
            }
            
            DB::commit();
            return redirect()->route('admin.manage_experiments.index')
                ->with('success', 'Experiment updated successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating experiment: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update experiment. Please try again.');
        }
    }

    public function manageExperimentsDestroy($id)
    {
        try {
            $experiment = Experiment::findOrFail($id);
            
            // Check if experiment is being used in any lab requests
            $usageCount = LabRequest::where('experiment_id', $id)->count();
            
            if ($usageCount > 0) {
                return redirect()->back()
                    ->with('error', "Cannot delete experiment. It is used in {$usageCount} lab request(s).");
            }
            
            // Delete materials and apparatus (cascade)
            $experiment->defaultmaterial()->delete();
            $experiment->defaultapparatus()->delete();
            
            // Delete experiment
            $experiment->delete();
            
            return redirect()->route('admin.manage_experiments.index')
                ->with('success', 'Experiment deleted successfully!');
                
        } catch (\Exception $e) {
            Log::error('Error deleting experiment: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to delete experiment. Please try again.');
        }
    }

    // AJAX API endpoints
    public function getSubjectsByForm($formLevel)
    {
        // Convert number to "Form X" format
        $formLevelString = is_numeric($formLevel) ? "Form {$formLevel}" : $formLevel;
        
        $subjects = Subject::where('form_level', $formLevelString)
            ->orderBy('name')
            ->get(['id', 'name', 'form_level']);
        
        return response()->json($subjects);
    }

    public function getTopicsBySubject($subjectId)
    {
        $topics = Topic::where('subject_id', $subjectId)
            ->orderBy('name')
            ->get(['id', 'name']);
        
        return response()->json($topics);
    }
}