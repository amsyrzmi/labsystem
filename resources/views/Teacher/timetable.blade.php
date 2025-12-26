<x-teacher-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/lab-assistant.css')
    <div class="container no-shadow">
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
                <span class="filter-label2">Week:</span>
                <select id="weekSelect" class="filter-select option-select">
                    <option class="option-select" value="current" {{ $currentWeek == 'current' ? 'selected' : '' }}>Current Week</option>
                    <option class="option-select" value="next" {{ $currentWeek == 'next' ? 'selected' : '' }}>Next Week</option>
                    <option class="option-select" value="next2" {{ $currentWeek == 'next2' ? 'selected' : '' }}>2 Weeks Ahead</option>
                </select>
            </div>
            <div class="filter-group">
                <span class="filter-label2">Lab:</span>
                <select id="labFilter" class="filter-select option-select">
                    <option class="option-select" value="all">All Labs</option>
                    @foreach($labs as $lab)
                        <option class="option-select" value="{{ $lab }}">{{ $lab }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Legend -->
        <div class="legend">
            <div class="legend-item">
                <div class="legend-color" style="background: var(--accent);"></div>
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
                    @foreach($timeSlots as $timeIndex => $time)
                        <div class="time-slot">{{ $time }}</div>
                        @foreach($weekDays as $day)
                            <div class="schedule-cell" data-date="{{ $day['fullDate'] }}" data-time="{{ $time }}">
                                @php
                                    // Get all segments for this specific date and time slot
                                    $cellSegments = $schedules->filter(function($segment) use ($day, $time) {
                                        $segmentDate = \Carbon\Carbon::parse($segment->segment_date)->format('Y-m-d');
                                        return $segmentDate === $day['fullDate'] && $segment->segment_time === $time;
                                    });
                                @endphp
                                
                                @if($cellSegments->count() > 0)
                                    <div class="session-blocks-container">
                                        @foreach($cellSegments as $segment)
                                            <div class="session-block" 
                                                data-lab="{{ $segment->lab_number }}"
                                                data-session-id="{{ $segment->id }}"
                                                onclick="showSessionDetails({{ $segment->id }})">
                                                <div class="session-title">{{ $segment->lab_number }}</div>
                                                <div class="session-detail">{{ optional($segment->subject)->name }}</div>
                                                <div class="session-detail">{{ optional($segment->user)->name }}</div>
                                                <div class="session-detail">
                                                    @if($segment->total_segments > 1)
                                                        {{ $segment->segment_number }}/{{ $segment->total_segments }} ({{ $segment->segment_duration }}min)
                                                    @else
                                                        {{ $segment->duration }}min
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
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
                        <div style="color: var(--text);" class="date-header">
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
        let currentWeek = '{{ $currentWeek }}';
        let currentLab = 'all';

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Set the current week in the dropdown
            document.getElementById('weekSelect').value = currentWeek;
            
            // Set up event listeners
            setupEventListeners();
        });

        function setupEventListeners() {
            // Week select
            const weekSelect = document.getElementById('weekSelect');
            if (weekSelect) {
                weekSelect.addEventListener('change', function() {
                    changeWeek(this.value);
                });
            }

            // Lab filter
            const labFilter = document.getElementById('labFilter');
            if (labFilter) {
                labFilter.addEventListener('change', function() {
                    filterByLab(this.value);
                });
            }

            // View buttons
            const viewButtons = document.querySelectorAll('.view-btn');
            viewButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const view = this.textContent.toLowerCase().includes('week') ? 'week' : 'list';
                    switchView(view);
                });
            });
        }

        function switchView(view) {
            currentView = view;
            
            // Update buttons
            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.classList.remove('active');
                if ((view === 'week' && btn.textContent.toLowerCase().includes('week')) ||
                    (view === 'list' && btn.textContent.toLowerCase().includes('list'))) {
                    btn.classList.add('active');
                }
            });

            // Toggle views
            const weekView = document.getElementById('weekView');
            const listView = document.getElementById('listView');
            
            if (view === 'week') {
                weekView.style.display = 'block';
                listView.style.display = 'none';
            } else {
                weekView.style.display = 'none';
                listView.style.display = 'block';
            }

            // Reapply lab filter after view switch
            if (currentLab !== 'all') {
                filterByLab(currentLab);
            }
        }

        function changeWeek(week) {
            currentWeek = week;
            // Reload page with new week parameter
            const url = new URL(window.location.href);
            url.searchParams.set('week', week);
            window.location.href = url.toString();
        }

        function filterByLab(lab) {
            currentLab = lab;
            
            // Filter session blocks in week view
            const sessionBlocks = document.querySelectorAll('.session-block');
            sessionBlocks.forEach(block => {
                const parentContainer = block.closest('.session-blocks-container');
                const blockLab = block.getAttribute('data-lab');
                
                if (lab === 'all' || blockLab === lab) {
                    block.style.display = 'flex';
                } else {
                    block.style.display = 'none';
                }
            });

            // Hide empty containers in week view
            const sessionContainers = document.querySelectorAll('.session-blocks-container');
            sessionContainers.forEach(container => {
                const visibleBlocks = Array.from(container.querySelectorAll('.session-block'))
                    .filter(block => block.style.display !== 'none');
                
                if (visibleBlocks.length === 0) {
                    container.style.display = 'none';
                } else {
                    container.style.display = 'flex';
                }
            });

            // Filter session cards in list view
            const sessionCards = document.querySelectorAll('.session-card');
            sessionCards.forEach(card => {
                const cardLab = card.getAttribute('data-lab');
                
                if (lab === 'all' || cardLab === cardLab) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            // Hide empty date groups in list view
            const dateGroups = document.querySelectorAll('.date-group');
            dateGroups.forEach(group => {
                const visibleCards = Array.from(group.querySelectorAll('.session-card'))
                    .filter(card => card.style.display !== 'none');
                
                if (visibleCards.length === 0) {
                    group.style.display = 'none';
                } else {
                    group.style.display = 'block';
                }
            });
        }

        //

        function closeModal() {
            const modal = document.getElementById('sessionModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        // Mobile detection and responsive handling
        function checkMobileView() {
            const weekGrid = document.querySelector('.week-grid');
            const mobileMessage = document.querySelector('.mobile-message');
            
            if (window.innerWidth < 768) {
                if (mobileMessage) mobileMessage.style.display = 'block';
                if (weekGrid) weekGrid.style.display = 'none';
            } else {
                if (mobileMessage) mobileMessage.style.display = 'none';
                if (weekGrid) weekGrid.style.display = 'grid';
            }
        }

        // Check on load
        window.addEventListener('DOMContentLoaded', checkMobileView);

        // Check on resize
        window.addEventListener('resize', checkMobileView);

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Close modal on outside click
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('sessionModal');
            if (modal && e.target === modal) {
                closeModal();
            }
        });
    </script>
</x-teacher-layout>