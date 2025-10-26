<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabRequest;
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
    public function listAllRequests()
    {
        $requests = LabRequest::with(['subject', 'topic', 'experiment', 'user'])
            ->whereIn('status', ['pending', 'approved'])
            ->where('preferred_date', '>=', now())
            ->orderBy('preferred_date', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Labassistant.requests_list', [
            'requests' => $requests,
        ]);
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

        return redirect()->back()->with('success', 'Request rejected.');
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

        return redirect()->route('lab_assistant.requests.list')
            ->with('success', 'Request approved and scheduled successfully.');
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
            'schedules' => $schedules,
            'schedulesByDate' => $schedulesByDate,
            'labs' => $labs,
            'weekDays' => $weekDays,
            'timeSlots' => $timeSlots,
            'currentWeek' => $weekParam,
        ]);
    }
}
