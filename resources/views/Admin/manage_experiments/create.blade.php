<x-admin-layout>
    @vite('resources/css/lab-assistant.css')

    <div class="container no-shadow">
        
        <div class="page-header" style="margin-bottom: 30px;">
            <div style="display: flex; flex-direction: column; gap: 5px;">
                <a href="{{ route('admin.manage_experiments.index') }}" style="text-decoration: none; color: var(--muted); font-size: 14px; font-weight: 600;">
                    &larr; Back to Experiments
                </a>
                <h1 class="page-title">New Experiment</h1>
                <p style="color: #64748b; margin: 0;">Configure the protocol requirements for the laboratory session.</p>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-error" style="margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 15px;">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.manage_experiments.store') }}">
            @csrf

            <div class="request-card" style="margin-bottom: 24px;">
                <div class="card-header">
                    <div class="card-title">📑 General Information</div>
                </div>
                <hr class="divider">
                
                <div style="padding: 10px 0;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label class="form-label">Form Level</label>
                            <select name="form_level" id="formLevel" class="form-control" required>
                                <option value="">Select Level</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">Form {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subject</label>
                            <select name="subject_id" id="subjectSelect" class="form-control" required disabled>
                                <option value="">Select Level First</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Topic</label>
                            <select name="topic_id" id="topicSelect" class="form-control" required disabled>
                                <option value="">Select Subject First</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Experiment Title</label>
                        <input type="text" name="experiment_name" class="form-control" placeholder="e.g. Rate of Reaction: Temperature Effects" required>
                    </div>
                </div>
            </div>

            <div class="request-card" style="margin-bottom: 24px;">
                <div class="card-header">
                    <div>
                        <div class="card-title">📦 Chemicals & Materials</div>
                        <div class="card-subtitle">Consumables required per group</div>
                    </div>
                    <button type="button" onclick="addMaterial()" class="btn btn-view" style="font-size: 12px;">
                        + Add Item
                    </button>
                </div>
                <hr class="divider">
                
                <div id="materialsContainer" style="display: flex; flex-direction: column; gap: 15px;">
                    </div>
            </div>

            <div class="request-card" style="margin-bottom: 30px;">
                <div class="card-header">
                    <div>
                        <div class="card-title">🧪 Apparatus</div>
                        <div class="card-subtitle">Glassware and hardware</div>
                    </div>
                    <button type="button" onclick="addApparatus()" class="btn btn-view" style="font-size: 12px;">
                        + Add Item
                    </button>
                </div>
                <hr class="divider">

                <div id="apparatusContainer" style="display: flex; flex-direction: column; gap: 15px;">
                    </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; padding-bottom: 40px;">
                <a href="{{ route('admin.manage_experiments.index') }}" class="btn btn-cancel" style="display: inline-flex; align-items: center;">
                    Discard
                </a>
                <button type="submit" class="btn btn-approve">
                    Create Protocol
                </button>
            </div>
        </form>
    </div>

    <script>
        let materialIndex = 0;
        let apparatusIndex = 0;

        function addMaterial() {
            const container = document.getElementById('materialsContainer');
            const idx = materialIndex++;
            const div = document.createElement('div');
            
            // Using standard styling for the row
            div.style.backgroundColor = '#f8fafc';
            div.style.padding = '15px';
            div.style.borderRadius = '8px';
            div.style.border = '1px solid #e2e8f0';
            div.style.position = 'relative';

            div.innerHTML = `
                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 15px; padding-right: 30px;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" style="font-size:11px;">Name</label>
                        <input type="text" name="materials[${idx}][name]" class="form-control" placeholder="Item Name" required>
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" style="font-size:11px;">Qty</label>
                        <input type="number" name="materials[${idx}][quantity]" class="form-control" step="0.01" required>
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" style="font-size:11px;">Unit</label>
                        <select name="materials[${idx}][unit]" class="form-control" required>
                            <option value="g">g</option><option value="ml">ml</option><option value="mol">mol</option><option value="pcs">pcs</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" style="font-size:11px;">Conc.</label>
                        <input type="text" name="materials[${idx}][concentration]" class="form-control" placeholder="Optional">
                    </div>
                </div>
                <button type="button" onclick="this.parentElement.remove()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #ef4444; background: none; border: none; font-size: 20px; cursor: pointer; padding: 5px;">&times;</button>
            `;
            container.appendChild(div);
        }

        function addApparatus() {
            const container = document.getElementById('apparatusContainer');
            const idx = apparatusIndex++;
            const div = document.createElement('div');
            
            div.style.backgroundColor = '#f8fafc';
            div.style.padding = '15px';
            div.style.borderRadius = '8px';
            div.style.border = '1px solid #e2e8f0';
            div.style.position = 'relative';

            div.innerHTML = `
                <div style="display: grid; grid-template-columns: 3fr 1fr; gap: 15px; padding-right: 30px;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" style="font-size:11px;">Apparatus Name</label>
                        <input type="text" name="apparatus[${idx}][name]" class="form-control" placeholder="e.g. Beaker 250ml" required>
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" style="font-size:11px;">Quantity</label>
                        <input type="number" name="apparatus[${idx}][quantity]" class="form-control" min="1" value="1" required>
                    </div>
                </div>
                <button type="button" onclick="this.parentElement.remove()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #ef4444; background: none; border: none; font-size: 20px; cursor: pointer; padding: 5px;">&times;</button>
            `;
            container.appendChild(div);
        }

        // --- Logic (Unchanged but cleaned) ---
        const subjectSelect = document.getElementById('subjectSelect');
        const topicSelect = document.getElementById('topicSelect');

        document.getElementById('formLevel').addEventListener('change', async function() {
            subjectSelect.innerHTML = '<option>Loading...</option>';
            subjectSelect.disabled = true;
            topicSelect.disabled = true;
            topicSelect.innerHTML = '<option value="">Select Subject First</option>';

            if (this.value) {
                try {
                    const res = await fetch(`{{ url('/admin/api/subjects') }}/${this.value}`);
                    const data = await res.json();
                    subjectSelect.innerHTML = '<option value="">Select Subject</option>' + data.map(s => `<option value="${s.id}">${s.name}</option>`).join('');
                    subjectSelect.disabled = false;
                } catch(e) { console.error(e); }
            }
        });

        subjectSelect.addEventListener('change', async function() {
            topicSelect.innerHTML = '<option>Loading...</option>';
            topicSelect.disabled = true;

            if (this.value) {
                try {
                    const res = await fetch(`{{ url('/admin/api/topics') }}/${this.value}`);
                    const data = await res.json();
                    topicSelect.innerHTML = '<option value="">Select Topic</option>' + data.map(t => `<option value="${t.id}">${t.name}</option>`).join('');
                    topicSelect.disabled = false;
                } catch(e) { console.error(e); }
            }
        });

        // Initialize with one empty row each
        window.onload = () => { addMaterial(); addApparatus(); };
    </script>
</x-admin-layout>