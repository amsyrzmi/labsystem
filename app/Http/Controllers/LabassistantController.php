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
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestApproved;
use App\Mail\RequestRejected;
use Carbon\Carbon;


class LabassistantController extends Controller
{

    public function index()
    {
        // Show dashboard or redirect to requests list
        return view('Labassistant.index');
    }

    /**
     * Show ALL pending/approved requests (not user-specific)
     */
    public function listAllRequests(Request $request)
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
            ->orderBy('created_at', 'desc');

        $requests = $query->paginate(10);

        // Get unique lab numbers for filter
        $labNumbers = LabRequest::distinct()->pluck('lab_number')->sort();

        return view('Labassistant.requests_list', compact('requests', 'status', 'labNumber', 'search', 'labNumbers'));
    }

    /**
     * Show ALL completed/past requests (not user-specific)
     */
    public function listAllHistory()
    {
        $requests = LabRequest::with(['subject', 'topic', 'experiment', 'user'])
            ->where(function($query) {
                $query->whereIn('status', ['completed', 'cancelled', 'no_show', 'rejected'])
                      ->orWhere(function($q) {
                          $q->where('preferred_date', '<', now());
                      });
            })
            ->orderBy('preferred_date', 'desc')
            ->orderBy('completed_at', 'desc')
            ->get();

        return view('Labassistant.history', [
            'requests' => $requests,
        ]);
    }

    /**
     * Approve a request
     */
    public function approveRequest($id)
    {
        $request = LabRequest::findOrFail($id);
        $request->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Request approved successfully.');
    }

    /**
     * Reject a request
     */
    public function rejectRequest(Request $request, $id)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $labRequest = LabRequest::findOrFail($id);
        $labRequest->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        // Send rejection email
        try {
            if ($labRequest->user && $labRequest->user->email) {
                Mail::to($labRequest->user->email)->send(new RequestRejected($labRequest));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send rejection email: ' . $e->getMessage());
            // Continue execution even if email fails
        }

        return redirect()->back()->with('success', 'Request rejected and notification email sent.');
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
            $materials = \App\Models\DefaultMaterial::where('experiment_id', $labRequest->experiment_id)
                ->select('id', 'name', 'quantity', 'unit')
                ->orderBy('name')
                ->get();

            $apparatuses = \App\Models\DefaultApparatus::where('experiment_id', $labRequest->experiment_id)
                ->select('id', 'name', 'quantity')
                ->orderBy('name')
                ->get();
        }

        return view('Labassistant.request_details', [
            'request' => $labRequest,
            'materials' => $materials,
            'apparatuses' => $apparatuses,
        ]);
    }
    public function showApproveForm($id)
    {
        $request = LabRequest::with(['subject', 'topic', 'experiment', 'user'])->findOrFail($id);
        
        return view('Labassistant.approve_form', [
            'request' => $request,
        ]);
    }

    public function approveRequestWithSchedule(Request $request, $id)
    {
        $validated = $request->validate([
            'approved_date' => 'required|date|after_or_equal:today',
            'approved_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:30|max:240',
        ]);

        $labRequest = LabRequest::findOrFail($id);

        // Check for conflicts
        if ($labRequest->hasConflict(
            $validated['approved_date'],
            $validated['approved_time'],
            $labRequest->lab_number,
            $validated['duration'],
            $id
        )) {
            return redirect()->back()->withErrors([
                'conflict' => 'This time slot conflicts with another booking in the same lab.'
            ])->withInput();
        }

        $labRequest->update([
            'status' => 'approved',
            'approved_date' => $validated['approved_date'],
            'approved_time' => $validated['approved_time'],
            'duration' => $validated['duration'],
            'approved_at' => now(),
        ]);

        // Send approval email
        try {
            if ($labRequest->user && $labRequest->user->email) {
                Mail::to($labRequest->user->email)->send(new RequestApproved($labRequest));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send approval email: ' . $e->getMessage());
            // Continue execution even if email fails
        }

        return redirect()->route('lab_assistant.requests.list')
            ->with('success', 'Request approved, scheduled, and notification email sent.');
    }
    public function timetable(Request $request)
    {
        // Get week parameter (current, next, next2)
        $weekParam = $request->get('week', 'current');
        
        // Calculate date range based on week parameter
        $startDate = match($weekParam) {
            'next' => now()->addWeek()->startOfWeek(),
            'next2' => now()->addWeeks(2)->startOfWeek(),
            default => now()->startOfWeek(),
        };
        
        $endDate = $startDate->copy()->endOfWeek();

        // Get all approved sessions for the week
        $schedules = LabRequest::with(['subject', 'topic', 'experiment', 'user'])
            ->where('status', 'approved')
            ->whereBetween('approved_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->orderBy('approved_date')
            ->orderBy('approved_time')
            ->get();

        // Process schedules to split into individual 30-minute segments
        $processedSchedules = collect();
        
        foreach($schedules as $session) {
            $startTime = Carbon::parse($session->approved_time);
            $duration = $session->duration;
            
            // Calculate how many 30-minute slots this session occupies
            $slotsNeeded = ceil($duration / 30);
            
            // Create individual segment for each 30-minute slot
            for ($i = 0; $i < $slotsNeeded; $i++) {
                $slotTime = $startTime->copy()->addMinutes($i * 30);
                $segmentDuration = min(30, $duration - ($i * 30)); // Remaining duration or 30 min
                
                $segment = clone $session;
                $segment->segment_time = $slotTime->format('H:i');
                $segment->segment_date = $session->approved_date;
                $segment->segment_duration = $segmentDuration;
                $segment->segment_number = $i + 1;
                $segment->total_segments = $slotsNeeded;
                $segment->original_start_time = $startTime->format('H:i');
                
                $processedSchedules->push($segment);
            }
        }

        // Group schedules by date for list view
        $schedulesByDate = $schedules->groupBy(function($item) {
            return Carbon::parse($item->approved_date)->format('Y-m-d');
        });

        // Get unique labs for filter
        $labs = LabRequest::where('status', 'approved')
            ->distinct()
            ->pluck('lab_number')
            ->sort()
            ->values();

        // Generate week days array
        $weekDays = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i);
            $weekDays[] = [
                'dayName' => $date->format('D'),
                'date' => $date->format('d M'),
                'fullDate' => $date->format('Y-m-d'),
                'isToday' => $date->isToday(),
            ];
        }

        // Time slots (school hours)
        $timeSlots = [
            '08:00', '08:30', '09:00', '09:30', '10:00', '10:30',
            '11:00', '11:30', '12:00', '12:30', '13:00', '13:30',
            '14:00', '14:30', '15:00', '15:30', '16:00', '16:30',
        ];

        return view('Labassistant.timetable', [
            'schedules' => $processedSchedules,
            'schedulesByDate' => $schedulesByDate,
            'labs' => $labs,
            'weekDays' => $weekDays,
            'timeSlots' => $timeSlots,
            'currentWeek' => $weekParam,
        ]);
    }
    public function printRequest($id)
    {
        $labRequest = LabRequest::with(['subject', 'topic', 'experiment', 'user'])
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

        return view('Labassistant.print_request', [
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
        $labNumbers = LabRequest::all()
            ->pluck('lab_number')
            ->sort();

        return view('Labassistant.batch_print', compact('labNumbers'));
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

        return view('Labassistant.print_batch', [
            'requestsWithDetails' => $requestsWithDetails,
            'startDate' => $validated['start_date'],
            'endDate' => $validated['end_date'],
            'status' => $validated['status'] ?? null,
            'labNumber' => $validated['lab_number'] ?? null,
        ]);
    }
}
