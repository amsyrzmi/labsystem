<x-lab-assistant-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/lab-assistant.css')
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Lab Timetable</h1>
            <div class="view-controls">
                <button class="view-btn active" onclick="switchView('week')">Week View</button>
                <button class="view-btn" onclick="switchView('list')">List View</button>
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-bar">
            <div class="filter-group">
                <span class="filter-label">Week:</span>
                <select id="weekSelect" class="filter-select" onchange="changeWeek(this.value)">
                    <option value="current">Current Week</option>
                    <option value="next">Next Week</option>
                    <option value="next2">2 Weeks Ahead</option>
                </select>
            </div>
            <div class="filter-group">
                <span class="filter-label">Lab:</span>
                <select id="labFilter" class="filter-select" onchange="filterByLab(this.value)">
                    <option value="all">All Labs</option>
                    @foreach($labs as $lab)
                        <option value="{{ $lab }}">{{ $lab }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Legend -->
        <div class="legend">
            <div class="legend-item">
                <div class="legend-color" style="background: #1B263B;"></div>
                <span style="color: black;">Scheduled Session</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #28a745;"></div>
                <span style="color: black;">Available Slot</span>
            </div>
        </div>

        <!-- Week View -->
        <div class="timetable-week" id="weekView">
            @if($schedules->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">📅</div>
                    <h3>No sessions scheduled</h3>
                    <p>There are no approved lab sessions for this week.</p>
                </div>
            @else
                <div class="week-grid">
                    <!-- Header Row -->
                    <div class="time-slot"></div>
                    @foreach($weekDays as $day)
                        <div class="day-header {{ $day['isToday'] ? 'today' : '' }}">
                            <div>{{ $day['dayName'] }}</div>
                            <div style="font-size: 13px; font-weight: 400; opacity: 0.8;">{{ $day['date'] }}</div>
                        </div>
                    @endforeach

                    <!-- Time Slots -->
                    @foreach($timeSlots as $time)
                        <div class="time-slot">{{ $time }}</div>
                        @foreach($weekDays as $day)
                            <div class="schedule-cell" data-date="{{ $day['fullDate'] }}" data-time="{{ $time }}">
                                @foreach($schedules as $session)
                                    @php
                                        $sessionDate = \Carbon\Carbon::parse($session->approved_date)->format('Y-m-d');
                                        $sessionTime = \Carbon\Carbon::parse($session->approved_time)->format('H:i');
                                    @endphp
                                    @if($sessionDate === $day['fullDate'] && $sessionTime === $time)
                                        <div class="session-block" 
                                             data-lab="{{ $session->lab_number }}"
                                             onclick="showSessionDetails({{ $session->id }})">
                                            <div class="session-title">{{ $session->lab_number }}</div>
                                            <div class="session-detail">{{ optional($session->subject)->name }}</div>
                                            <div class="session-detail">{{ optional($session->user)->name }}</div>
                                            <div class="session-detail">{{ $session->duration }}min</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <div class="mobile-message" style="display: none;">
                    Please switch to List View on mobile devices for better experience.
                </div>
            @endif
        </div>

        <!-- List View -->
        <div class="timetable-list" id="listView">
            @if($schedules->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">📅</div>
                    <h3>No sessions scheduled</h3>
                    <p>There are no approved lab sessions for this week.</p>
                </div>
            @else
                @foreach($schedulesByDate as $date => $sessions)
                    <div class="date-group">
                        <div style="color: white;" class="date-header">
                            {{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}
                        </div>
                        @foreach($sessions as $session)
                            <div class="session-card" 
                                 data-lab="{{ $session->lab_number }}"
                                 onclick="showSessionDetails({{ $session->id }})">
                                <div class="session-card-header">
                                    <div class="session-time">
                                        {{ \Carbon\Carbon::parse($session->approved_time)->format('H:i') }}
                                        - 
                                        {{ \Carbon\Carbon::parse($session->approved_time)->addMinutes($session->duration)->format('H:i') }}
                                    </div>
                                    <div class="session-lab">{{ $session->lab_number }}</div>
                                </div>
                                <div style="font-size: 18px; font-weight: 600; color: #1b263b; margin-bottom: 8px;">
                                    {{ optional($session->subject)->name ?? 'No Subject' }}
                                </div>
                                <div class="session-info">
                                    <div class="info-item">
                                        <span class="info-label">Teacher</span>
                                        <span class="info-value">{{ optional($session->user)->name ?? 'Unknown' }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Experiment</span>
                                        <span class="info-value">{{ optional($session->experiment)->name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Class</span>
                                        <span class="info-value">{{ $session->classname }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Students</span>
                                        <span class="info-value">{{ $session->num_students }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Duration</span>
                                        <span class="info-value">{{ $session->duration }} minutes</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Session Details Modal -->
    <div id="sessionModal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
        <div style="background: white; padding: 24px; border-radius: 12px; max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="margin: 0; color: #1b263b;">Session Details</h3>
                <button onclick="closeModal()" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #7b8aa3;">&times;</button>
            </div>
            <div id="modalContent"></div>
        </div>
    </div>

    <script>
        let currentView = 'week';
        let currentWeek = 'current';
        let currentLab = 'all';

        function switchView(view) {
            currentView = view;
            
            // Update buttons
            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Toggle views
            if (view === 'week') {
                document.getElementById('weekView').style.display = 'block';
                document.getElementById('listView').style.display = 'none';
            } else {
                document.getElementById('weekView').style.display = 'none';
                document.getElementById('listView').style.display = 'block';
            }
        }

        function changeWeek(week) {
            currentWeek = week;
            // In a real implementation, this would reload the page with different dates
            window.location.href = `{{ route('lab_assistant.timetable') }}?week=${week}`;
        }

        function filterByLab(lab) {
            currentLab = lab;
            
            // Filter session blocks in week view
            document.querySelectorAll('.session-block').forEach(block => {
                if (lab === 'all' || block.getAttribute('data-lab') === lab) {
                    block.style.display = 'block';
                } else {
                    block.style.display = 'none';
                }
            });

            // Filter session cards in list view
            document.querySelectorAll('.session-card').forEach(card => {
                if (lab === 'all' || card.getAttribute('data-lab') === lab) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function showSessionDetails(sessionId) {
            // Fetch session details via AJAX
            fetch(`/lab-assistant/requests/${sessionId}`)
                .then(response => response.text())
                .then(html => {
                    // You can either load the full page or extract just the details
                    // For simplicity, we'll open in a new window
                    window.open(`/lab-assistant/requests/${sessionId}`, '_blank');
                });
        }

        function closeModal() {
            document.getElementById('sessionModal').style.display = 'none';
        }

        // Mobile detection
        if (window.innerWidth < 768) {
            document.querySelector('.mobile-message').style.display = 'block';
            document.querySelector('.week-grid').style.display = 'none';
        }

        // Responsive handling
        window.addEventListener('resize', function() {
            if (window.innerWidth < 768) {
                document.querySelector('.mobile-message').style.display = 'block';
                document.querySelector('.week-grid').style.display = 'none';
            } else {
                document.querySelector('.mobile-message').style.display = 'none';
                document.querySelector('.week-grid').style.display = 'grid';
            }
        });
    </script>
</x-lab-assistant-layout>