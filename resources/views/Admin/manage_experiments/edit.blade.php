<x-admin-layout>
    @vite('resources/css/lab-assistant.css')

    <div class="container no-shadow">
        <form method="POST" action="{{ route('admin.manage_experiments.update', $experiment->id) }}">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="deleted_materials" id="deletedMaterials" value="">
            <input type="hidden" name="deleted_apparatus" id="deletedApparatus" value="">

            <div class="page-header" style="margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-end; width: 100%;">
                    <div>
                        <a href="{{ route('admin.manage_experiments.index') }}" class="btn-link" style="text-decoration: none; font-size: 13px; font-weight: 700; color: var(--muted);">
                            &larr; BACK TO EXPERIMENTS
                        </a>
                        <h1 class="page-title" style="margin-top: 8px;">Edit Experiment</h1>
                    </div>
                    <div style="display: flex; gap: 12px;">
                        <a href="{{ route('admin.manage_experiments.index') }}" class="btn btn-cancel">Cancel</a>
                        <button type="submit" class="btn btn-approve">Save Changes</button>
                    </div>
                </div>
            </div>

            <div class="request-card" style="margin-bottom: 30px;">
                <div class="card-header">
                    <div class="card-title">📑 Protocol Details</div>
                </div>
                <hr class="divider">
                <div style="padding: 10px 0;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr 2fr; gap: 20px;">
                        <div class="form-group" style="background: #f8fafc; padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            <label class="form-label" style="font-size: 11px; color: #64748b;">Subject & Level</label>
                            <div style="font-weight: 700; color: #334155;">
                                {{ $experiment->topic->subject->name }} 
                                <span style="color: var(--accent);">— Form {{ $experiment->topic->subject->form_level }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Topic Category</label>
                            <select name="topic_id" class="form-control">
                                @foreach($experiment->topic->subject->topics as $topic)
                                    <option value="{{ $topic->id }}" {{ $topic->id == $experiment->topic_id ? 'selected' : '' }}>
                                        {{ $topic->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Experiment Title</label>
                            <input type="text" name="experiment_name" class="form-control" value="{{ old('experiment_name', $experiment->name) }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="request-card" style="margin-bottom: 30px;">
                <div class="card-header">
                    <div class="card-title">📦 Materials</div>
                    <button type="button" onclick="addMaterial()" class="btn btn-view" style="font-size: 12px;">+ Add Material</button>
                </div>
                <hr class="divider">
                
                <div id="materialsContainer" style="display: flex; flex-direction: column; gap: 12px; padding: 10px 0;">
                    @forelse($experiment->defaultmaterial as $material)
                        <div class="item-row-box" id="material-existing-{{ $material->id }}">
                            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr 40px; gap: 15px; align-items: flex-end;">
                                <div class="form-group" style="margin:0">
                                    <label class="form-label" style="font-size: 10px;">Item Name</label>
                                    <input type="text" name="materials[existing_{{ $material->id }}][name]" class="form-control" value="{{ $material->name }}" required>
                                </div>
                                <div class="form-group" style="margin:0">
                                    <label class="form-label" style="font-size: 10px;">Qty</label>
                                    <input type="number" name="materials[existing_{{ $material->id }}][quantity]" class="form-control" value="{{ $material->quantity }}" step="0.01" required>
                                </div>
                                <div class="form-group" style="margin:0">
                                    <label class="form-label" style="font-size: 10px;">Unit</label>
                                    <select name="materials[existing_{{ $material->id }}][unit]" class="form-control">
                                        @foreach(['g','kg','mg','cm³','ml','L','mol','pcs'] as $unit)
                                            <option value="{{ $unit }}" {{ $material->unit == $unit ? 'selected' : '' }}>{{ $unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="margin:0">
                                    <label class="form-label" style="font-size: 10px;">Conc.</label>
                                    <input type="text" name="materials[existing_{{ $material->id }}][concentration]" class="form-control" value="{{ $material->concentration }}">
                                </div>
                                <button type="button" class="btn-delete-icon" onclick="removeMaterialExisting({{ $material->id }})">&times;</button>
                            </div>
                        </div>
                    @empty
                        <div id="mat-empty" class="empty-state-dashed">No materials added yet.</div>
                    @endforelse
                </div>
            </div>

            <div class="request-card" style="margin-bottom: 50px;">
                <div class="card-header">
                    <div class="card-title">🧪 Apparatus</div>
                    <button type="button" onclick="addApparatus()" class="btn btn-view" style="font-size: 12px;">+ Add Apparatus</button>
                </div>
                <hr class="divider">
                <div id="apparatusContainer" style="display: flex; flex-direction: column; gap: 12px; padding: 10px 0;">
                    @forelse($experiment->defaultapparatus as $apparatus)
                        <div class="item-row-box" id="apparatus-existing-{{ $apparatus->id }}">
                            <div style="display: grid; grid-template-columns: 3fr 1fr 40px; gap: 15px; align-items: flex-end;">
                                <div class="form-group" style="margin:0">
                                    <label class="form-label" style="font-size: 10px;">Item Name</label>
                                    <input type="text" name="apparatus[existing_{{ $apparatus->id }}][name]" class="form-control" value="{{ $apparatus->name }}" required>
                                </div>
                                <div class="form-group" style="margin:0">
                                    <label class="form-label" style="font-size: 10px;">Quantity</label>
                                    <input type="number" name="apparatus[existing_{{ $apparatus->id }}][quantity]" class="form-control" value="{{ $apparatus->quantity }}" min="1" required>
                                </div>
                                <button type="button" class="btn-delete-icon" onclick="removeApparatusExisting({{ $apparatus->id }})">&times;</button>
                            </div>
                        </div>
                    @empty
                        <div id="app-empty" class="empty-state-dashed">No apparatus added yet.</div>
                    @endforelse
                </div>
            </div>
        </form>
    </div>

    <style>
        .item-row-box { background: #ffffff; border: 1px solid #edf2f7; padding: 15px; border-radius: 10px; transition: border-color 0.2s; }
        .item-row-box:hover { border-color: var(--accent); }
        .btn-delete-icon { background: #fee2e2; color: #ef4444; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; font-size: 20px; display: flex; align-items: center; justify-content: center; transition: 0.2s; }
        .btn-delete-icon:hover { background: #ef4444; color: white; }
        .empty-state-dashed { text-align: center; padding: 30px; border: 2px dashed #e2e8f0; border-radius: 12px; color: #94a3b8; }
        .badge-new { background: #22c55e; color: white; padding: 2px 8px; border-radius: 4px; font-size: 9px; font-weight: 800; position: absolute; top: -10px; left: 15px; }
    </style>

    <script>
        let materialIndex = 1000;
        let apparatusIndex = 1000;
        let deletedMaterials = [];
        let deletedApparatus = [];

        function addMaterial() {
            const container = document.getElementById('materialsContainer');
            if(document.getElementById('mat-empty')) document.getElementById('mat-empty').style.display = 'none';
            const index = materialIndex++;
            const div = document.createElement('div');
            div.className = 'item-row-box';
            div.id = `material-new-${index}`;
            div.style.position = 'relative';
            div.innerHTML = `
                <span class="badge-new">NEW</span>
                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr 40px; gap: 15px; align-items: flex-end;">
                    <div class="form-group" style="margin:0"><label class="form-label" style="font-size:10px">Name</label>
                        <input type="text" name="materials[new_${index}][name]" class="form-control" placeholder="e.g. Acid" required></div>
                    <div class="form-group" style="margin:0"><label class="form-label" style="font-size:10px">Qty</label>
                        <input type="number" name="materials[new_${index}][quantity]" class="form-control" step="0.01" required></div>
                    <div class="form-group" style="margin:0"><label class="form-label" style="font-size:10px">Unit</label>
                        <select name="materials[new_${index}][unit]" class="form-control">
                            <option value="g">g</option><option value="ml">ml</option><option value="pcs">pcs</option>
                        </select></div>
                    <div class="form-group" style="margin:0"><label class="form-label" style="font-size:10px">Conc.</label>
                        <input type="text" name="materials[new_${index}][concentration]" class="form-control"></div>
                    <button type="button" class="btn-delete-icon" onclick="this.parentElement.parentElement.remove()">&times;</button>
                </div>`;
            container.appendChild(div);
        }

        function addApparatus() {
            const container = document.getElementById('apparatusContainer');
            if(document.getElementById('app-empty')) document.getElementById('app-empty').style.display = 'none';
            const index = apparatusIndex++;
            const div = document.createElement('div');
            div.className = 'item-row-box';
            div.id = `apparatus-new-${index}`;
            div.style.position = 'relative';
            div.innerHTML = `
                <span class="badge-new">NEW</span>
                <div style="display: grid; grid-template-columns: 3fr 1fr 40px; gap: 15px; align-items: flex-end;">
                    <div class="form-group" style="margin:0"><label class="form-label" style="font-size:10px">Apparatus Name</label>
                        <input type="text" name="apparatus[new_${index}][name]" class="form-control" required></div>
                    <div class="form-group" style="margin:0"><label class="form-label" style="font-size:10px">Quantity</label>
                        <input type="number" name="apparatus[new_${index}][quantity]" class="form-control" min="1" required></div>
                    <button type="button" class="btn-delete-icon" onclick="this.parentElement.parentElement.remove()">&times;</button>
                </div>`;
            container.appendChild(div);
        }

        function removeMaterialExisting(id) {
            if (confirm('Permanently remove this material from the protocol?')) {
                deletedMaterials.push(id);
                document.getElementById('deletedMaterials').value = JSON.stringify(deletedMaterials);
                document.getElementById(`material-existing-${id}`).remove();
            }
        }

        function removeApparatusExisting(id) {
            if (confirm('Permanently remove this apparatus from the protocol?')) {
                deletedApparatus.push(id);
                document.getElementById('deletedApparatus').value = JSON.stringify(deletedApparatus);
                document.getElementById(`apparatus-existing-${id}`).remove();
            }
        }
    </script>
</x-admin-layout>