<x-lab-assistant-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    @vite('resources/css/lab-assistant.css')

    <div class="container no-shadow">
        <a href="{{ route('lab_assistant.requests.list') }}" class="back-link">
            ← Back to Requests
        </a>

        <h1 class="page-title">Request Details #{{ $request->id }}</h1>

        <!-- Request Information -->
        <div class="detail-card">
            <div class="card-title">Request Information</div>
            
            <div class="info-row">
                <span class="info-label">Status</span>
                <span class="info-value">
                    <span class="status-badge status-{{ $request->status }}">{{ ucfirst($request->status) }}</span>
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Teacher</span>
                <span class="info-value">{{ optional($request->user)->name ?? 'Unknown' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Form Level</span>
                <span class="info-value">{{ ucfirst($request->form_level) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Subject</span>
                <span class="info-value">{{ optional($request->subject)->name ?? 'Not specified' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Topic</span>
                <span class="info-value">{{ optional($request->topic)->name ?? 'Not specified' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Experiment</span>
                <span class="info-value">{{ optional($request->experiment)->name ?? 'Not specified' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Number of Students</span>
                <span class="info-value">{{ $request->num_students }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Group Size</span>
                <span class="info-value">{{ $request->group_size }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Class Name</span>
                <span class="info-value">{{ $request->classname }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Lab Number</span>
                <span class="info-value">{{ $request->lab_number }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Repetition</span>
                <span class="info-value">{{ $request->repetition }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Preferred Date</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($request->preferred_date)->format('l, d M Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Preferred Time</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($request->preferred_time)->format('H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Request Date</span>
                <span class="info-value">{{ $request->created_at->format('d M Y, H:i') }}</span>
            </div>

            @if($request->additional_notes)
                <div class="notes-box">
                    <strong>📝 Additional Notes:</strong><br>
                    {{ $request->additional_notes }}
                </div>
            @endif
        </div>

        <!-- Required Materials -->
        <div class="detail-card">
            <div class="card-title">Required Materials</div>
            @if($materials->isEmpty())
                <div class="empty-message">No materials required for this experiment</div>
            @else
                <ul class="materials-list">
                    @foreach($materials as $material)
                        <li>
                            <span class="item-name">{{ $material->name }}</span>
                            <span class="item-quantity">{{ $material->quantity }} {{ $material->unit }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Required Apparatus -->
        <div class="detail-card">
            <div class="card-title">Required Apparatus</div>
            @if($apparatuses->isEmpty())
                <div class="empty-message">No apparatus required for this experiment</div>
            @else
                <ul class="apparatus-list">
                    @foreach($apparatuses as $apparatus)
                        <li>
                            <span class="item-name">{{ $apparatus->name }}</span>
                            <span class="item-quantity">{{ $apparatus->quantity }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Action Buttons -->
        @if($request->status === 'pending')
            <div class="action-bar">
                <form action="{{ route('lab_assistant.requests.approve.schedule', $request->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-approve" onclick="return confirm('Are you sure you want to approve this request?')">
                        ✓ Approve Request
                    </button>
                </form>
                
                <button type="button" class="btn btn-reject" onclick="openRejectModal()">
                    ✗ Reject Request
                </button>
            </div>
        @endif
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
        <div style="background: white; padding: 24px; border-radius: 12px; max-width: 500px; width: 90%;">
            <h3 style="margin-bottom: 16px; color: #1b263b;">Reject Request</h3>
            <form action="{{ route('lab_assistant.requests.reject', $request->id) }}" method="POST">
                @csrf
                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #415A77;">Reason for Rejection *</label>
                    <textarea name="rejection_reason" style="width: 100%; padding: 10px; border: 1px solid #e1e8ed; border-radius: 8px; resize: vertical;" rows="4" required placeholder="Please provide a reason..."></textarea>
                </div>
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" onclick="closeRejectModal()" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 8px; cursor: pointer;">Cancel</button>
                    <button type="submit" class="btn btn-reject">Reject Request</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal() {
            document.getElementById('rejectModal').style.display = 'flex';
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').style.display = 'none';
        }
    </script>
</x-lab-assistant-layout>