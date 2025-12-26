<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Experiment;
use App\Models\DefaultMaterial;
use App\Models\DefaultApparatus;
use App\Models\LabRequest;
use App\Models\Reagent;
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
        // Get statistics
        $stats = [
            'pending' => LabRequest::where('status', 'pending')->count(),
            'approved_today' => LabRequest::where('status', 'approved')
                ->whereDate('approved_at', today())
                ->count(),
            'today_sessions' => LabRequest::where('status', 'approved')
                ->whereDate('approved_date', today())
                ->count(),
            'total_active' => LabRequest::whereIn('status', ['pending', 'approved'])
                ->where('preferred_date', '>=', now()->subDay())
                ->count(),
        ];
        
        // Get today's sessions
        $todaySessions = LabRequest::with(['experiment', 'user'])
            ->where('status', 'approved')
            ->whereDate('approved_date', today())
            ->orderBy('approved_time')
            ->get();
        
        // Get pending requests
        $pendingRequests = LabRequest::with(['experiment', 'user'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        // Get lab status (sessions per lab today)
        $labStatus = LabRequest::where('status', 'approved')
            ->whereDate('approved_date', today())
            ->selectRaw('lab_number as name, COUNT(*) as sessions')
            ->groupBy('lab_number')
            ->orderBy('lab_number')
            ->get()
            ->toArray();
        
        // Add labs with no sessions
        $allLabs = ['Lab 1', 'Lab 2', 'Lab 3', 'Lab 4']; // Adjust based on your labs
        $existingLabs = array_column($labStatus, 'name');
        foreach ($allLabs as $lab) {
            if (!in_array($lab, $existingLabs)) {
                $labStatus[] = ['name' => $lab, 'sessions' => 0];
            }
        }
        
        // Sort lab status
        usort($labStatus, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
        
        // Get recent activity
        $recentActivity = LabRequest::with(['experiment', 'user'])
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();
        
        return view('Labassistant.index', compact(
            'stats',
            'todaySessions',
            'pendingRequests',
            'labStatus',
            'recentActivity'
        ));
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
        $numStudents = (int) $labRequest->num_students;
        $groupSize = (int) $labRequest->group_size;
        $numberOfGroups = intdiv($numStudents, $groupSize);
        $repetition = (int)$labRequest->repetition;

        if ($labRequest->experiment_id) {
            $materials = \App\Models\DefaultMaterial::where('experiment_id', $labRequest->experiment_id)
                ->select('id', 'name', 'quantity', 'unit', 'concentration')
                ->orderBy('name')
                ->get();

            $apparatuses = \App\Models\DefaultApparatus::where('experiment_id', $labRequest->experiment_id)
                ->select('id', 'name', 'quantity')
                ->orderBy('name')
                ->get();
        }

        // Get materials with concentration
        $materialsWithConcentration = $materials->filter(function($material) {
            return !is_null($material->concentration);
        });

        // Match materials with reagents (now includes finding first variant)
        $reagentMatches = [];
        foreach ($materialsWithConcentration as $material) {
            // Try exact match first
            $reagent = Reagent::where('name', $material->name)
                ->orderBy('variant')
                ->first();
            
            // If no exact match, try fuzzy match
            if (!$reagent) {
                $reagent = Reagent::where('name', 'LIKE', '%' . $material->name . '%')
                    ->orderBy('variant')
                    ->first();
            }
            
            if ($reagent) {
                $reagentMatches[$material->id] = $reagent;
            }
        }

        // Get saved calculations - already cast as array by model
        $savedCalculations = $labRequest->reagent_calculations ?? [];

        return view('Labassistant.request_details', [
            'request' => $labRequest,
            'materials' => $materials,
            'apparatuses' => $apparatuses,
            'numberOfGroups' => $numberOfGroups,
            'repetition' => $repetition,
            'materialsWithConcentration' => $materialsWithConcentration,
            'reagentMatches' => $reagentMatches,
            'savedCalculations' => $savedCalculations,
        ]);
    }

    /**
     * UPDATED calculateReagents METHOD with variant support
     * Replace the existing method in your LabassistantController
     */

    public function calculateReagents(Request $request, $id)
    {
        $labRequest = LabRequest::findOrFail($id);
        
        $validated = $request->validate([
            'calculations' => 'required|array',
            'calculations.*.material_id' => 'required|integer',
            'calculations.*.reagent_id' => 'required|integer',
            'calculations.*.purity' => 'nullable|numeric|min:0|max:100',
        ]);

        $calculations = [];
        $numStudents = (int) $labRequest->num_students;
        $groupSize = (int) $labRequest->group_size;
        $numberOfGroups = intdiv($numStudents, $groupSize);
        $repetition = (int) $labRequest->repetition;

        foreach ($validated['calculations'] as $calc) {
            $material = DefaultMaterial::findOrFail($calc['material_id']);
            $reagent = Reagent::findOrFail($calc['reagent_id']);
            
            $totalQuantity = $material->quantity * $numberOfGroups * $repetition;
            $concentration = $material->concentration;

            $result = [];
            
            if ($reagent->type === 'liquid') {
                $purity = $calc['purity'] ?? 100;
                $calcResult = $reagent->calculateLiquid($concentration, $totalQuantity, $purity);
                
                $result = [
                    'material_id' => $material->id,
                    'material_name' => $material->name,
                    'reagent_id' => $reagent->id,
                    'reagent_name' => $reagent->name,
                    'variant' => $reagent->variant,
                    'display_name' => $reagent->display_name,
                    'formula' => $reagent->formula,
                    'molar_mass' => $reagent->molar_mass,
                    'reagent_type' => 'liquid',
                    'concentration' => $concentration,
                    'volume' => $totalQuantity,
                    'purity' => $purity,
                    'volume_needed' => $calcResult['volume'],
                    'unit' => 'cm³',
                    'details' => $calcResult['details'],
                    'output' => "{$calcResult['volume']} cm³ of concentrated {$reagent->display_name} is needed for {$concentration} mol/dm³ of {$totalQuantity} cm³ solution."
                ];
            } else {
                $mass = $reagent->calculateSolid($concentration, $totalQuantity);
                
                $result = [
                    'material_id' => $material->id,
                    'material_name' => $material->name,
                    'reagent_id' => $reagent->id,
                    'reagent_name' => $reagent->name,
                    'variant' => $reagent->variant,
                    'display_name' => $reagent->display_name,
                    'formula' => $reagent->formula,
                    'molar_mass' => $reagent->molar_mass,
                    'reagent_type' => 'solid',
                    'concentration' => $concentration,
                    'volume' => $totalQuantity,
                    'mass_needed' => round($mass, 2),
                    'unit' => 'g',
                    'output' => round($mass, 2) . " g of {$reagent->display_name} is needed for the solution."
                ];
            }
            
            $calculations[] = $result;
        }

        // Save calculations - Laravel will handle encoding due to array cast
        $labRequest->update([
            'reagent_calculations' => $calculations
        ]);

        return redirect()->back()->with('success', 'Reagent calculations saved successfully.');
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
        
        return view('Labassistant.manage_experiments.index', compact('experiments', 'subjects'));
    }

    public function manageExperimentsCreate()
    {
        return view('Labassistant.manage_experiments.create');
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
            return redirect()->route('lab_assistant.manage_experiments.index')
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
        
        return view('Labassistant.manage_experiments.edit', compact('experiment'));
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
            return redirect()->route('lab_assistant.manage_experiments.index')
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
            
            return redirect()->route('lab_assistant.manage_experiments.index')
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