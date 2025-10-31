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
                ->select('id', 'name', 'quantity', 'unit')
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
    public function cancelRequest($id)
    {
        $request = LabRequest::findOrFail($id);
        
        $request->update([
            'status' => 'cancelled',
        ]);

        return back()->with('success', 'Request has been cancelled.');
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
}