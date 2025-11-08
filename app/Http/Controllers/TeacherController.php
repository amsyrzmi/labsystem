<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Experiment;
use App\Models\DefaultMaterial;
use App\Models\DefaultApparatus;
use App\Models\LabRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    public function index()
    {
        return view('Teacher.index', ["Name" => Auth::user()->name]);
    }

    public function requests()
    {
        return view('Teacher.request');
    }

    public function getSubjectsByFormLevel(Request $request)
    {
        $formLevel = $request->get('form_level');
        
        $subjects = Subject::where('form_level', $formLevel)
            ->select('id', 'name')
            ->orderBy('name') // Add ordering
            ->get();
        
        return response()->json($subjects);
    }

    public function getTopicsBySubject(Request $request)
    {
        $subjectId = $request->get('subject_id');
        
        $topics = Topic::where('subject_id', $subjectId)
            ->select('id', 'name')
            ->orderBy('name') // Add ordering
            ->get();
        
        return response()->json($topics);
    }

    public function getExperimentsByTopic(Request $request)
    {
        $topicId = $request->get('topic_id');
        
        $experiments = Experiment::where('topic_id', $topicId)
            ->select('id', 'name')
            ->orderBy('name') // Add ordering
            ->get();
        
        return response()->json($experiments);
    }

    public function getExperimentDetails(Request $request)
    {
        $experimentId = $request->get('experiment_id');
        
        $materials = DefaultMaterial::where('experiment_id', $experimentId)
            ->select('id', 'name', 'quantity', 'unit')
            ->orderBy('name')
            ->get();
        
        $apparatuses = DefaultApparatus::where('experiment_id', $experimentId)
            ->select('id', 'name', 'quantity')
            ->orderBy('name')
            ->get();
        
        return response()->json([
            'materials' => $materials,
            'apparatuses' => $apparatuses
        ]);
    }

    public function submitRequest(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'form_level' => 'required|string|max:50',
            'subject_id' => 'nullable|exists:subjects,id',
            'topic_id' => 'nullable|exists:topics,id',
            'experiment_id' => 'nullable|exists:experiments,id',
            'num_students' => 'required|integer|min:1|max:200',
            'group_size' => 'required|integer|min:1|max:50',
            'preferred_date' => 'required|date|after_or_equal:today',
            'preferred_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    // Validate time is in 30-minute intervals
                    $time = \Carbon\Carbon::parse($value);
                    $minutes = $time->minute;
                    
                    if (!in_array($minutes, [0, 30])) {
                        $fail('Time must be in 30-minute intervals (e.g., 08:00, 08:30).');
                    }
                },
            ],
            'classname' => 'required|string|max:255',
            'lab_number' => 'required|string|max:255',
            'repetition' => 'required|integer|min:1|max:10',
            'duration' => [
                'required',
                'integer',
                'min:30',
                'max:240',
                function ($attribute, $value, $fail) {
                    // Validate duration is in 30-minute intervals
                    if ($value % 30 !== 0) {
                        $fail('Duration must be in 30-minute intervals (30, 60, 90, etc.).');
                    }
                },
            ],
            'additional_notes' => 'nullable|string|max:2000',
        ]);

        // Check for conflicts
        // Check for conflicts with BOTH approved and pending requests
        $approvedConflicts = LabRequest::where('lab_number', $validated['lab_number'])
            ->where('status', 'approved')
            ->where('approved_date', $validated['preferred_date'])
            ->get()
            ->filter(function($existingRequest) use ($validated) {
                $existingStart = \Carbon\Carbon::parse($existingRequest->approved_time);
                $existingEnd = $existingStart->copy()->addMinutes((int)$existingRequest->duration);
                
                $newStart = \Carbon\Carbon::parse($validated['preferred_time']);
                $newEnd = $newStart->copy()->addMinutes((int)$validated['duration']);
                
                return $newStart->lt($existingEnd) && $newEnd->gt($existingStart);
            });

        $pendingConflicts = LabRequest::where('lab_number', $validated['lab_number'])
            ->where('status', 'pending')
            ->where('preferred_date', $validated['preferred_date'])
            ->where('user_id', '!=', Auth::id()) // Exclude current user's own requests
            ->get()
            ->filter(function($existingRequest) use ($validated) {
                $existingStart = \Carbon\Carbon::parse($existingRequest->preferred_time);
                $existingEnd = $existingStart->copy()->addMinutes((int)$existingRequest->duration);
                
                $newStart = \Carbon\Carbon::parse($validated['preferred_time']);
                $newEnd = $newStart->copy()->addMinutes((int)$validated['duration']);
                
                return $newStart->lt($existingEnd) && $newEnd->gt($existingStart);
            });

        $hasConflict = $approvedConflicts->isNotEmpty() || $pendingConflicts->isNotEmpty();

        if ($hasConflict) {
            return redirect()->back()->withInput()->withErrors([
                'preferred_time' => 'This time slot is already booked or pending for ' . $validated['lab_number'] . '. Please choose a different time.'
            ]);
        }

        // Save in transaction
        DB::beginTransaction();
        try {
            $labRequest = LabRequest::create([
                'user_id' => Auth::id(),
                'form_level' => $validated['form_level'],
                'subject_id' => $validated['subject_id'] ?? null,
                'topic_id' => $validated['topic_id'] ?? null,
                'experiment_id' => $validated['experiment_id'] ?? null,
                'num_students' => $validated['num_students'],
                'classname' => $validated['classname'],
                'lab_number' => $validated['lab_number'],
                'repetition' => $validated['repetition'],
                'group_size' => $validated['group_size'],
                'preferred_date' => $validated['preferred_date'],
                'preferred_time' => $validated['preferred_time'],
                'duration' => $validated['duration'],
                'additional_notes' => $validated['additional_notes'] ?? null,
                'status' => 'pending',
            ]);

            DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Booking submitted successfully',
                    'data' => $labRequest,
                ]);
            }

            return redirect()->route('teacher.requests.list')->with('success', 'Booking submitted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Failed to submit lab request: ' . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Failed to submit booking.'], 500);
            }
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to submit booking. Please try again.']);
        }
    }



    public function listUserRequests(Request $request)
    {
        
        $query = LabRequest::with(['subject', 'topic', 'experiment']) 
            ->where('user_id', Auth::id())
            ->where(function($query) {
                $query->whereIn('status', ['pending', 'approved', 'rejected'])
                    ->orWhere(function($q) {
                        $q->whereIn('status', ['approved', 'rejected'])
                            ->where('preferred_date', '>=', now());
                    });
            });

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

        $requests = $query->paginate(10);

        // Get unique lab numbers for filter
        $labNumbers = LabRequest::distinct()->pluck('lab_number')->sort();

        return view('Teacher.requests_list', compact('requests', 'status', 'labNumber', 'search', 'labNumbers'));
    }

    /**
     * IMPROVED: Show completed/past requests only
     */
    public function listUserHistory(Request $request)
    {
        $query = LabRequest::with(['subject', 'topic', 'experiment']) 
            ->where('user_id', Auth::id())
            ->where(function($query) {
                $query->whereIn('status', ['completed', 'cancelled', 'no_show']);
            });

        // Filter by status
        $status = $request->get('status');
        if ($status && in_array($status, ['completed', 'cancelled', 'no_show'])) {
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
        $query->where('preferred_date', '<', now()->subDays(1))
            ->orderBy('preferred_date', 'asc')
            ->orderBy('created_at', 'desc');

        $requests = $query->paginate(10);

        // Get unique lab numbers for filter
        $labNumbers = LabRequest::distinct()->pluck('lab_number')->sort();

        return view('Teacher.history', compact('requests', 'status', 'labNumber', 'search', 'labNumbers'));
    }
    

    /**
     * Show details for active request
     */
    public function requestDetails($id)
    {
        $labRequest = LabRequest::with(['subject', 'topic', 'experiment'])
            ->where('user_id', Auth::id()) 
            ->findOrFail($id);

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

        return view('Teacher.request_details', [
            'request' => $labRequest,
            'materials' => $materials,
            'apparatuses' => $apparatuses,
        ]);
    }

    /**
     * Show details for history request
     */
    public function requestDetailsH($id)
    {
        $labRequest = LabRequest::with(['subject', 'topic', 'experiment'])
            ->where('user_id', Auth::id()) 
            ->findOrFail($id);

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

        return view('Teacher.request_detailsH', [
            'request' => $labRequest,
            'materials' => $materials,
            'apparatuses' => $apparatuses,
        ]);
    }
    public function checkAvailability(Request $request)
    {
        $validated = $request->validate([
            'lab_number' => 'required|string',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:30',
        ]);

        // Check both approved requests (with approved_date/time) 
        // and pending requests (with preferred_date/time)
        $approvedConflicts = LabRequest::where('lab_number', $validated['lab_number'])
            ->where('status', 'approved')
            ->where('approved_date', $validated['preferred_date'])
            ->get()
            ->filter(function($request) use ($validated) {
                $requestStart = \Carbon\Carbon::parse($request->approved_time);
                $requestEnd = $requestStart->copy()->addMinutes((int)$request->duration);
                
                $checkStart = \Carbon\Carbon::parse($validated['preferred_time']);
                $checkEnd = $checkStart->copy()->addMinutes((int)$validated['duration']);
                
                return $checkStart->lt($requestEnd) && $checkEnd->gt($requestStart);
            });

        // Also check pending requests to prevent double-booking
        $pendingConflicts = LabRequest::where('lab_number', $validated['lab_number'])
            ->where('status', 'pending')
            ->where('preferred_date', $validated['preferred_date'])
            ->get()
            ->filter(function($request) use ($validated) {
                $requestStart = \Carbon\Carbon::parse($request->preferred_time);
                $requestEnd = $requestStart->copy()->addMinutes((int)$request->duration);
                
                $checkStart = \Carbon\Carbon::parse($validated['preferred_time']);
                $checkEnd = $checkStart->copy()->addMinutes((int)$validated['duration']);
                
                return $checkStart->lt($requestEnd) && $checkEnd->gt($requestStart);
            });

        $hasConflict = $approvedConflicts->isNotEmpty() || $pendingConflicts->isNotEmpty();

        return response()->json([
            'available' => !$hasConflict,
            'message' => $hasConflict ? 'This time slot is already booked or pending for this lab.' : 'Time slot is available.',
        ]);
    }
    public function printRequest($id)
    {
        $labRequest = LabRequest::with(['subject', 'topic', 'experiment', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

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

        return view('Teacher.print_request', [
            'request' => $labRequest,
            'materials' => $materials,
            'apparatuses' => $apparatuses,
        ]);
    }

    /**
     * Show batch print selection form
     */
    public function showBatchPrint()
    {
        $labNumbers = LabRequest::where('user_id', Auth::id())
            ->distinct()
            ->pluck('lab_number')
            ->sort();

        return view('Teacher.batch_print', compact('labNumbers'));
    }

    /**
     * Print requests for a date range
     */
    public function printBatch(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'nullable|in:pending,approved,rejected,completed,cancelled,no_show',
            'lab_number' => 'nullable|string',
        ]);

        $query = LabRequest::with(['subject', 'topic', 'experiment', 'user'])
            ->where('user_id', Auth::id())
            ->whereBetween('preferred_date', [$validated['start_date'], $validated['end_date']]);

        if (!empty($validated['status'])) {
            $query->where('status', $validated['status']);
        }

        if (!empty($validated['lab_number'])) {
            $query->where('lab_number', $validated['lab_number']);
        }

        $requests = $query->orderBy('preferred_date', 'asc')
            ->orderBy('preferred_time', 'asc')
            ->get();

        // Get materials and apparatuses for each request
        $requestsWithDetails = $requests->map(function($labRequest) {
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

            return [
                'request' => $labRequest,
                'materials' => $materials,
                'apparatuses' => $apparatuses,
            ];
        });

        return view('Teacher.print_batch', [
            'requestsWithDetails' => $requestsWithDetails,
            'startDate' => $validated['start_date'],
            'endDate' => $validated['end_date'],
            'status' => $validated['status'] ?? null,
            'labNumber' => $validated['lab_number'] ?? null,
        ]);
    }
}