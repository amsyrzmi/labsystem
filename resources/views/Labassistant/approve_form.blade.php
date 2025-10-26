<x-lab-assistant-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/lab-assistant.css')
    <div class="container">
        <a href="{{ route('lab_assistant.requests.details', $request->id) }}" class="back-link">
            ← Back to Request
        </a>

        <h1 class="page-title">Approve & Schedule Request</h1>

        <div class="card">
            <h3 style="margin-bottom: 16px; color: #1b263b;">Request Information</h3>
            <div class="info-box">
                <div class="info-row">
                    <span class="info-label">Teacher:</span>
                    <span class="info-value">{{ optional($request->user)->name ?? 'Unknown' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Subject:</span>
                    <span class="info-value">{{ optional($request->subject)->name ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Experiment:</span>
                    <span class="info-value">{{ optional($request->experiment)->name ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Class:</span>
                    <span class="info-value">{{ $request->classname }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Students:</span>
                    <span class="info-value">{{ $request->num_students }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Lab Number:</span>
                    <span class="info-value">{{ $request->lab_number }}</span>
                </div>
            </div>

            <div class="highlight">
                <strong>Teacher's Preferred Schedule:</strong><br>
                📅 {{ \Carbon\Carbon::parse($request->preferred_date)->format('l, d M Y') }}<br>
                🕐 {{ \Carbon\Carbon::parse($request->preferred_time)->format('H:i') }}
                ({{ $request->duration }} minutes)
            </div>

            @if($errors->has('conflict'))
                <div class="alert alert-error" style="margin-top: 16px;">
                    ⚠️ {{ $errors->first('conflict') }}
                </div>
            @endif

            <form action="{{ route('lab_assistant.requests.approve.schedule', $request->id) }}" method="POST">
                @csrf

                <h3 style="margin-top: 32px; margin-bottom: 16px; color: #1b263b;">Set Final Schedule</h3>
                <p style="color: #7b8aa3; margin-bottom: 20px;">
                    You can approve with the teacher's preferred time, or adjust it if there's a conflict or better slot.
                </p>

                <div class="form-group">
                    <label class="form-label">Approved Date</label>
                    <input 
                        type="date" 
                        name="approved_date" 
                        class="form-control" 
                        value="{{ old('approved_date', $request->preferred_date) }}"
                        min="{{ date('Y-m-d') }}"
                        required
                    >
                    <div class="form-helper">Select the date for this lab session</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Approved Time</label>
                    <input 
                        type="time" 
                        name="approved_time" 
                        class="form-control" 
                        value="{{ old('approved_time', $request->preferred_time) }}"
                        required
                    >
                    <div class="form-helper">Select the start time for this lab session</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Duration (minutes)</label>
                    <select name="duration" class="form-control" required>
                        <option value="30" {{ $request->duration == 30 ? 'selected' : '' }}>30 minutes</option>
                        <option value="60" {{ $request->duration == 60 ? 'selected' : '' }}>1 hour</option>
                        <option value="90" {{ $request->duration == 90 ? 'selected' : '' }}>1.5 hours</option>
                        <option value="120" {{ $request->duration == 120 ? 'selected' : '' }}>2 hours</option>
                        <option value="150" {{ $request->duration == 150 ? 'selected' : '' }}>2.5 hours</option>
                        <option value="180" {{ $request->duration == 180 ? 'selected' : '' }}>3 hours</option>
                    </select>
                    <div class="form-helper">Expected duration of the lab session</div>
                </div>

                <div class="btn-group">
                    <a href="{{ route('lab_assistant.requests.details', $request->id) }}" class="btn btn-cancel">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-approve">
                        ✓ Approve & Schedule
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-lab-assistant-layout>