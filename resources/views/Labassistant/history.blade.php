<x-lab-assistant-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/lab-assistant.css'])
    <div class="container no-shadow">
        <div class="page-header">
            <h1 class="page-title">Request History</h1>
            <div style="display:flex;gap:10px;">
                <a href="{{ route('lab_assistant.print.batch') }}" class="btn-batch-print" style="
                    display:inline-block;
                    padding:10px 16px;
                    border-radius:10px;
                    background:var(--accent);
                    color:white;
                    font-weight:700;
                    text-decoration:none;
                "> 
                    🖨️ Batch Print
                </a>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="stat-card stat-completed">
                <div class="stat-number">{{ $requests->where('status', 'completed')->count() }}</div>
                <div class="stat-label">Completed</div>
            </div>
            <div class="stat-card stat-rejected">
                <div class="stat-number">{{ $requests->where('status', 'rejected')->count() }}</div>
                <div class="stat-label">Rejected</div>
            </div>
            <div class="stat-card stat-cancelled">
                <div class="stat-number">{{ $requests->where('status', 'cancelled')->count() }}</div>
                <div class="stat-label">Cancelled</div>
            </div>
            <div class="stat-card stat-noshow">
                <div class="stat-number">{{ $requests->where('status', 'no_show')->count() }}</div>
                <div class="stat-label">No Show</div>
            </div>
        </div>

        <!-- Filter Buttons -->
        <div class="filter-bar">
            <button class="filter-btn active" onclick="filterRequests('all')">All</button>
            <button class="filter-btn" onclick="filterRequests('completed')">Completed</button>
            <button class="filter-btn" onclick="filterRequests('rejected')">Rejected</button>
            <button class="filter-btn" onclick="filterRequests('cancelled')">Cancelled</button>
            <button class="filter-btn" onclick="filterRequests('no_show')">No Show</button>
        </div>

        <!-- Search Box -->
        <div class="search-box">
            <input type="text" id="searchInput" class="search-input" placeholder="Search by teacher name, subject, or class...">
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if($requests->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">📚</div>
                <h3>No history records</h3>
                <p>There are no completed or past lab requests yet.</p>
            </div>
        @else
            <div id="historyList">
                @foreach($requests as $req)
                    <div class="history-card" data-status="{{ $req->status }}" data-searchable="{{ strtolower(optional($req->user)->name . ' ' . optional($req->subject)->name . ' ' . $req->classname) }}">
                        <div class="card-header">
                            <div>
                                <div class="card-title">{{ optional($req->subject)->name ?? 'No Subject' }}</div>
                                <div class="card-subtitle">
                                    @if($req->custom_experiment_name)
                                        <span style="background:#667eea;color:white;padding:2px 6px;border-radius:4px;font-size:11px;font-weight:600;">CUSTOM</span>
                                        {{ $req->custom_experiment_name }}
                                    @else
                                        {{ optional($req->experiment)->name ?? '— No experiment selected —' }}
                                    @endif
                                </div>
                            </div>
                            <span class="status-badge status-{{ $req->status }}">
                                {{ ucfirst(str_replace('_', ' ', $req->status)) }}
                            </span>
                        </div>

                        <div class="teacher-info">
                            👤 <strong>Teacher:</strong> {{ optional($req->user)->name ?? 'Unknown' }} 
                            <span style="color: var(--page-bg); margin-left: 8px;">Request #{{ $req->id }}</span>
                            <span class="date-badge" style="float: right;">
                                {{ \Carbon\Carbon::parse($req->preferred_date)->format('d M Y') }}
                            </span>
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
                                <span class="info-label">Time</span>
                                <span class="info-value">{{ \Carbon\Carbon::parse($req->preferred_time)->format('H:i') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Requested On</span>
                                <span class="info-value">{{ $req->created_at->format('d M Y') }}</span>
                            </div>
                        </div>

                        @if($req->status === 'rejected' && $req->rejection_reason)
                            <div class="rejection-box">
                                <strong>❌ Rejection Reason:</strong><br>
                                {{ $req->rejection_reason }}
                            </div>
                        @endif

                        @if($req->status === 'completed' && $req->completed_at)
                            <div class="notes-box">
                                <strong>✅ Completed on:</strong> {{ \Carbon\Carbon::parse($req->completed_at)->format('d M Y, H:i') }}
                            </div>
                        @endif

                        @if($req->additional_notes)
                            <div class="notes-box">
                                <strong>📝 Notes:</strong> {{ $req->additional_notes }}
                            </div>
                        @endif


                        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:14px;gap:10px;">
                            <a href="{{ route('lab_assistant.requests.details', $req->id) }}" class="btn btn-view">
                                View Full Details
                            </a>
                            <a href="{{ route('lab_assistant.print.request', $req->id) }}" target="_blank" class="btn-print">
                                🖨️ Print
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        // Filter functionality
        let currentFilter = 'all';

        function filterRequests(status) {
            currentFilter = status;
            
            // Update active button
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filter cards
            const cards = document.querySelectorAll('.history-card');
            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (status === 'all' || cardStatus === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            // Reapply search filter
            applySearch();
        }

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', applySearch);
        }

        function applySearch() {
            const searchTerm = searchInput.value.toLowerCase();
            const cards = document.querySelectorAll('.history-card');
            
            cards.forEach(card => {
                const searchableText = card.getAttribute('data-searchable');
                const matchesSearch = searchableText.includes(searchTerm);
                const matchesFilter = currentFilter === 'all' || card.getAttribute('data-status') === currentFilter;
                
                if (matchesSearch && matchesFilter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Add smooth animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.history-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.3s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 50);
            });
        });
    </script>
    <style>
        .btn-print {
            padding: 10px 14px;
            border-radius: 10px;
            background: var(--accent);
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .btn-print:hover {
            background: var(--accentlight);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(16,185,129,0.3);
        }
        .btn-new-request:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 8px 24px rgba(65,90,119,0.15); 
        }
        .btn-batch-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(16,185,129,0.3);
            background: var(--accentlight);
        }
    </style>
</x-lab-assistant-layout>