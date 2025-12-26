<x-lab-assistant-layout>
    @vite('resources/css/lab-assistant.css')

    <div class="container no-shadow">
        
        <div class="page-header">
            <div>
                <div class="stat-label" style="color:var(--accent); margin-bottom: 5px;">Laboratory Management</div>
                <h1 class="page-title" style="margin-top: 0;">Experiments</h1>
            </div>
            <a href="{{ route('lab_assistant.manage_experiments.create') }}" class="btn btn-approve">
                + Create New Experiment
            </a>
        </div>

        <div class="filter-bar">
            <form method="GET" action="{{ route('lab_assistant.manage_experiments.index') }}" id="filterForm" style="width: 100%; display: flex; flex-wrap: wrap; gap: 16px; align-items: flex-end;">
                
                <div class="filter-group" style="flex-direction: column; align-items: flex-start;">
                    <label class="filter-label2" style="font-size: 13px; margin-bottom:4px;">Level</label>
                    <select name="form_level" id="formLevelFilter" class="filter-select" style="color:white;>
                        <option value="" class="option-select">All Forms</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ request('form_level') == $i ? 'selected' : '' }} class="option-select">
                                Form {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="filter-group" style="flex-direction: column; align-items: flex-start;">
                    <label class="filter-label2" style="font-size: 13px; margin-bottom:4px;">Subject</label>
                    <select name="subject_id" id="subjectFilter" class="filter-select" style="color:white;>
                        <option value="" class="option-select">All Subjects</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }} class="option-select">
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="flex: 1; min-width: 250px;">
                    <label class="filter-label2" style="font-size: 13px; margin-bottom:4px; display:block;">Search Protocol</label>
                    <input type="text" name="search" class="search-input" style="margin:0; width: 100%; box-sizing: border-box;" 
                           placeholder="e.g. Titration Analysis..." value="{{ request('search') }}">
                </div>

                <div class="view-controls">
                    <button type="submit" class="btn btn-view" style="margin-top:0;">Apply Filters</button>
                    @if(request()->hasAny(['form_level', 'subject_id', 'search']))
                        <a href="{{ route('lab_assistant.manage_experiments.index') }}" class="btn btn-cancel" style="margin-top:0; text-decoration: none;">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        @forelse($experiments as $experiment)
            <div class="request-card">
                <div class="card-header">
                    <div>
                        <div class="card-title">{{ $experiment->name }}</div>
                        <div class="card-subtitle">
                            <span style="font-weight: 600;">Topic:</span> {{ $experiment->topic->name }}
                        </div>
                    </div>
                    <span class="status-badge status-completed">
                        {{ strtoupper($experiment->topic->subject->form_level) }}
                    </span>
                </div>

                <div class="teacher-info">
                     <strong>Subject:</strong> {{ $experiment->topic->subject->name }}
                </div>

                <hr class="divider">

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Materials</span>
                        <span class="info-value">
                            {{ $experiment->defaultmaterial->count() }} items
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Apparatus</span>
                        <span class="info-value">
                             {{ $experiment->defaultapparatus->count() }} sets
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Created</span>
                        <span class="info-value">{{ $experiment->created_at->format('d M Y') }}</span>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('lab_assistant.manage_experiments.edit', $experiment->id) }}" class="btn btn-view">
                        Edit Details
                    </a>
                    
                    <form action="{{ route('lab_assistant.manage_experiments.destroy', $experiment->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-reject" onclick="return confirm('Are you sure you want to delete this experiment protocol?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">🧪</div>
                <h3>No experiments found</h3>
                <p>Try adjusting your search filters or add a new experiment.</p>
            </div>
        @endforelse

        <div style="margin-top: 30px;">
            {{ $experiments->links() }}
        </div>
    </div>

    <script>
        const formFilter = document.getElementById('formLevelFilter');
        const subjectFilter = document.getElementById('subjectFilter');

        formFilter.addEventListener('change', async () => {
            if(!formFilter.value) { 
                // Optional: Reset logic or just keep existing subjects
                return; 
            }
            
            // Visual feedback while loading
            subjectFilter.style.opacity = '0.5';
            subjectFilter.innerHTML = '<option class="option-select">Loading...</option>';
            
            try {
                const res = await fetch(`{{ url('/lab-assistant/api/subjects') }}/${formFilter.value}`);
                const subjects = await res.json();
                
                subjectFilter.innerHTML = '<option value="" class="option-select">All Subjects</option>';
                subjects.forEach(s => {
                    subjectFilter.innerHTML += `<option value="${s.id}" class="option-select">${s.name}</option>`;
                });
            } catch (error) {
                console.error('Error fetching subjects:', error);
                subjectFilter.innerHTML = '<option value="" class="option-select">Error loading subjects</option>';
            } finally {
                subjectFilter.style.opacity = '1';
            }
        });
    </script>
</x-lab-assistant-layout>