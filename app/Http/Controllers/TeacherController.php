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
        $validated = $request->validate([
            'form_level' => 'required|string|max:50',
            'subject_id' => 'nullable|exists:subjects,id',
            'topic_id' => 'nullable|exists:topics,id',
            'experiment_id' => 'nullable|exists:experiments,id',
            'num_students' => 'required|integer|min:1|max:200',
            'group_size' => 'required|integer|min:1|max:50',
            'preferred_date' => 'required|date|after_or_equal:today',
            'preferred_time' => 'required|date_format:H:i',
            'classname' => 'required|string|max:255',
            'lab_number' => 'required|string|max:255',
            'repetition' => 'required|integer|min:1|max:10',
            'duration' => 'required|integer|min:30|max:240',
            'additional_notes' => 'nullable|string|max:2000',
        ]);

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
                'duration' => $validated['duration'],
                'preferred_time' => $validated['preferred_time'],
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

    /**
     * IMPROVED: Show active/upcoming requests only
     */
    public function listUserRequests()
    {
        $requests = LabRequest::with(['subject', 'topic', 'experiment'])
            ->where('user_id', Auth::id())
            ->where(function($query) {
                // Show pending/approved requests regardless of date
                $query->whereIn('status', ['pending', 'approved'])
                      // OR show future rejected requests
                      ->orWhere(function($q) {
                          $q->where('status', 'rejected')
                            ->where('preferred_date', '>=', now());
                      });
            })
            ->orderBy('preferred_date', 'asc') 
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Teacher.requests_list', [
            'requests' => $requests,
        ]);
    }

    /**
     * IMPROVED: Show completed/past requests only
     */
    public function listUserHistory()
    {
        $requests = LabRequest::with(['subject', 'topic', 'experiment']) 
            ->where('user_id', Auth::id())
            ->where(function($query) {
                $query->whereIn('status', ['completed', 'cancelled', 'no_show'])
                    ->orWhere(function($q) {
                        $q->whereIn('status', ['approved', 'rejected'])
                            ->where('preferred_date', '<', now());
                    });
            })
            ->orderBy('preferred_date', 'desc')
            ->orderBy('completed_at', 'desc')
            ->get();

        return view('Teacher.history', [
            'requests' => $requests,
        ]);
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
}