<x-lab-assistant-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    @vite('resources/css/lab-assistant.css')

    <div class="container no-shadow">
        <div class="page-header">
            <h1 class="page-title">Lab Requests</h1>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="stat-card">
                <div class="stat-number">{{ $requests->where('status', 'pending')->count() }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $requests->where('status', 'approved')->count() }}</div>
                <div class="stat-label">Approved</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $requests->count() }}</div>
                <div class="stat-label">Total Active</div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if($requests->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <h3>No active requests</h3>
                <p>All caught up! There are no pending or upcoming lab requests.</p>
            </div>
        @else
            <div>
                @foreach($requests as $req)
                    <div class="request-card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">{{ optional($req->subject)->name ?? 'No Subject' }}</div>
                                <div class="card-subtitle">{{ optional($req->experiment)->name ?? 'No Experiment' }}</div>
                            </div>
                            <span class="status-badge status-{{ $req->status }}">
                                {{ ucfirst($req->status) }}
                            </span>
                        </div>

                        <div class="teacher-info">
                             <strong>Teacher:</strong> {{ optional($req->user)->name ?? 'Unknown' }} 
                            <span style="color: #E0E1DD; margin-left: 8px;">Request #{{ $req->id }}</span>
                        </div>

                        <hr class="divider">

                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">Students</span>
                                <span class="info-value">{{ $req->num_students }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Group Size</span>
                                <span class="info-value">{{ $req->group_size }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Class</span>
                                <span class="info-value">{{ $req->classname }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Lab Number</span>
                                <span class="info-value">{{ $req->lab_number }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Date</span>
                                <span class="info-value">{{ \Carbon\Carbon::parse($req->preferred_date)->format('d M Y') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Time</span>
                                <span class="info-value">{{ \Carbon\Carbon::parse($req->preferred_time)->format('H:i') }}</span>
                            </div>
                        </div>

                        @if($req->additional_notes)
                            <div class="notes-box">
                                <strong>📝 Notes:</strong> {{ $req->additional_notes }}
                            </div>
                        @endif

                        <div class="action-buttons">
                            <a href="{{ route('lab_assistant.requests.details', $req->id) }}" class="btn btn-view">
                                View Details
                            </a>
                            
                            @if($req->status === 'pending')
                            <a href="{{ route('lab_assistant.requests.approve.form', $req->id) }}" class="btn btn-approve">
                                ✓ Approve & Schedule
                            </a>
                                
                                <button type="button" class="btn btn-reject" onclick="openRejectModal({{ $req->id }})">
                                    ✗ Reject
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">Reject Request</div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Reason for Rejection *</label>
                        <textarea name="rejection_reason" class="form-control" rows="4" required placeholder="Please provide a reason for rejecting this request..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeRejectModal()">Cancel</button>
                    <button type="submit" class="btn btn-reject">Reject Request</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal(requestId) {
            const modal = document.getElementById('rejectModal');
            const form = document.getElementById('rejectForm');
            form.action = `/lab-assistant/requests/${requestId}/reject`;
            modal.classList.add('active');
        }

        function closeRejectModal() {
            const modal = document.getElementById('rejectModal');
            modal.classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeRejectModal();
            }
        });
    </script>
</x-lab-assistant-layout>