<x-lab-assistant-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/lab-assistant.css')
    @vite('resources/css/reagent_calculations_styles.css')

    <div class="container no-shadow">
        <a href="{{ route('lab_assistant.requests.list') }}" class="back-link">
            ← Back to Requests
        </a>

        <h1 class="page-title">Request Details #{{ $request->id }}</h1>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                <span class="info-value">
                    @if($request->custom_experiment_name)
                        <span style="background:#667eea;color:white;padding:2px 6px;border-radius:4px;font-size:11px;font-weight:600;">CUSTOM</span>
                        {{ $request->custom_experiment_name }}
                    @else
                        {{ optional($request->experiment)->name ?? 'Not specified' }}
                    @endif
                </span>
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
                <span class="info-label">Number of Groups</span>
                <span class="info-value">{{ $numberOfGroups }}</span>
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
                            @if(!is_null($material->concentration))
                                <span class="item-quantity">{{ $material->concentration }} mol/dm³ {{ $material->quantity }} {{ $material->unit }} x {{ $numberOfGroups }} x {{ $repetition }} = {{ $material->quantity * $numberOfGroups * $repetition }} {{ $material->unit }}</span>
                            @else
                                <span class="item-quantity">{{ $material->quantity }} {{ $material->unit }} x {{ $numberOfGroups }} x {{ $repetition }} = {{ $material->quantity * $numberOfGroups * $repetition }} {{ $material->unit }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Reagent Calculations Card -->
        @if($materialsWithConcentration->isNotEmpty())
        <div class="detail-card reagent-calculations-card">
            <div class="card-title">🧪 Reagent Preparation Calculations</div>
            
            @if(!empty($savedCalculations))
                <!-- Display Saved Calculations -->
                <div class="saved-calculations">
                    <div class="calculation-header">
                        <strong>✓ Saved Calculations</strong>
                        <button type="button" class="btn-small btn-edit" onclick="toggleEditMode()">
                            📝 Edit
                        </button>
                    </div>
                    
                    @foreach($savedCalculations as $calc)
                        <div class="calculation-result">
                            <div class="calc-title">
                                {{ $calc['material_name'] }} 
                                @if(isset($calc['display_name']))
                                    ({{ $calc['display_name'] }})
                                @elseif(isset($calc['reagent_name']))
                                    ({{ $calc['reagent_name'] }})
                                @endif
                                @if(isset($calc['variant']) && $calc['variant'])
                                    <span class="variant-badge">{{ $calc['variant'] }}</span>
                                @endif
                            </div>
                            <div class="calc-output">{{ $calc['output'] }}</div>
                            
                            @if($calc['reagent_type'] === 'liquid')
                                <div class="calc-details">
                                    <small>
                                        • Purity: {{ $calc['purity'] }}%<br>
                                        • Target: {{ $calc['concentration'] }} mol/dm³<br>
                                        • Volume: {{ $calc['volume'] }} cm³<br>
                                        @if(isset($calc['molar_mass']))
                                            • Molar Mass: {{ $calc['molar_mass'] }} g/mol<br>
                                        @endif
                                        @if(isset($calc['formula']))
                                            • Formula: {{ $calc['formula'] }}<br>
                                        @endif
                                        • Mass of solution: {{ $calc['details']['mass_of_solution'] }} g<br>
                                        • Mass of pure reagent: {{ $calc['details']['mass_of_pure_reagent'] }} g<br>
                                        • Molarity (concentrated): {{ $calc['details']['molarity_concentrated'] }} mol/dm³
                                    </small>
                                </div>
                            @else
                                <div class="calc-details">
                                    <small>
                                        • Target: {{ $calc['concentration'] }} mol/dm³<br>
                                        • Volume: {{ $calc['volume'] }} cm³<br>
                                        @if(isset($calc['molar_mass']))
                                            • Molar Mass: {{ $calc['molar_mass'] }} g/mol<br>
                                        @endif
                                        @if(isset($calc['formula']))
                                            • Formula: {{ $calc['formula'] }}
                                        @endif
                                    </small>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Calculation Form (hidden initially if calculations exist) -->
            <div id="calculationForm" class="{{ !empty($savedCalculations) ? 'hidden' : '' }}">
                <form action="{{ route('lab_assistant.requests.calculate_reagents', $request->id) }}" method="POST">
                    @csrf
                    
                    @foreach($materialsWithConcentration as $index => $material)
                        @php
                            $totalQuantity = $material->quantity * $numberOfGroups * $repetition;
                            // Get all matching reagents (could be multiple variants)
                            $matchingReagents = isset($reagentMatches[$material->id]) 
                                ? collect([$reagentMatches[$material->id]]) 
                                : collect();
                            
                            // Try to find more variants
                            if ($matchingReagents->isNotEmpty()) {
                                $baseName = $matchingReagents->first()->name;
                                $allVariants = \App\Models\Reagent::where('name', $baseName)->get();
                                if ($allVariants->count() > 1) {
                                    $matchingReagents = $allVariants;
                                }
                            }
                        @endphp
                        
                        <div class="reagent-calculation-item">
                            <div class="material-header">
                                <strong>{{ $material->name }}</strong>
                                <span class="concentration-badge">
                                    Target: {{ $material->concentration }} mol/dm³ | 
                                    Total Volume: {{ $totalQuantity }} {{ $material->unit }}
                                </span>
                            </div>
                            
                            @if($matchingReagents->isNotEmpty())
                                <input type="hidden" name="calculations[{{ $index }}][material_id]" value="{{ $material->id }}">
                                
                                <!-- Variant Selector (if multiple variants exist) -->
                                @if($matchingReagents->count() > 1)
                                    <div class="variant-selector-group">
                                        <label for="reagent_{{ $index }}" class="variant-label">
                                            🔬 Select Reagent Form:
                                        </label>
                                        <select 
                                            id="reagent_{{ $index }}"
                                            name="calculations[{{ $index }}][reagent_id]" 
                                            class="variant-select"
                                            required
                                            onchange="updateReagentInfo({{ $index }})"
                                        >
                                            <option value="">-- Select Form --</option>
                                            @foreach($matchingReagents as $reagent)
                                                <option 
                                                    value="{{ $reagent->id }}"
                                                    data-type="{{ $reagent->type }}"
                                                    data-molar-mass="{{ $reagent->molar_mass }}"
                                                    data-density="{{ $reagent->density }}"
                                                    data-formula="{{ $reagent->formula }}"
                                                    data-variant="{{ $reagent->variant }}"
                                                    data-display-name="{{ $reagent->display_name }}"
                                                >
                                                    {{ $reagent->display_name }} - {{ $reagent->molar_mass }} g/mol
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="input-helper">Different forms have different molar masses</small>
                                    </div>
                                @else
                                    <input type="hidden" name="calculations[{{ $index }}][reagent_id]" value="{{ $matchingReagents->first()->id }}">
                                @endif
                                
                                <!-- Reagent Info Display -->
                                <div class="reagent-info" id="reagent_info_{{ $index }}">
                                    @if($matchingReagents->count() === 1)
                                        @php $reagent = $matchingReagents->first(); @endphp
                                        <div class="reagent-property">
                                            <span class="property-label">Reagent:</span>
                                            <span class="property-value">{{ $reagent->display_name }}</span>
                                        </div>
                                        <div class="reagent-property">
                                            <span class="property-label">Formula:</span>
                                            <span class="property-value">{{ $reagent->formula }}</span>
                                        </div>
                                        <div class="reagent-property">
                                            <span class="property-label">Type:</span>
                                            <span class="property-value type-badge type-{{ $reagent->type }}">
                                                {{ ucfirst($reagent->type) }}
                                            </span>
                                        </div>
                                        <div class="reagent-property">
                                            <span class="property-label">Molar Mass:</span>
                                            <span class="property-value">{{ $reagent->molar_mass }} g/mol</span>
                                        </div>
                                        @if($reagent->type === 'liquid')
                                            <div class="reagent-property">
                                                <span class="property-label">Density:</span>
                                                <span class="property-value">{{ $reagent->density }} g/cm³</span>
                                            </div>
                                        @endif
                                    @else
                                        <div class="reagent-property-placeholder">
                                            <em>Select a form above to see reagent properties</em>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Purity Input (for liquids) - shown/hidden dynamically -->
                                <div class="purity-input-group" id="purity_group_{{ $index }}" style="{{ ($matchingReagents->count() === 1 && $matchingReagents->first()->type === 'liquid') ? '' : 'display: none;' }}">
                                    <label for="purity_{{ $index }}" class="purity-label">
                                        Purity of Concentrated Reagent (%)
                                    </label>
                                    <input 
                                        type="number" 
                                        id="purity_{{ $index }}"
                                        name="calculations[{{ $index }}][purity]" 
                                        class="purity-input"
                                        min="0" 
                                        max="100" 
                                        step="0.01"
                                        placeholder="e.g., 69"
                                    >
                                    <small class="input-helper">Enter the purity percentage (e.g., 69 for 69%)</small>
                                </div>
                            @else
                                <div class="reagent-not-found">
                                    ⚠️ No matching reagent found in database for "{{ $material->name }}".
                                    <br><small>Please add this reagent to the database first.</small>
                                </div>
                            @endif
                        </div>
                        
                        @if(!$loop->last)
                            <hr class="divider">
                        @endif
                    @endforeach
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-approve">
                            🧮 Calculate & Save
                        </button>
                        @if(!empty($savedCalculations))
                            <button type="button" class="btn btn-cancel" onclick="toggleEditMode()">
                                Cancel
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        @endif

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
                            <span class="item-quantity">{{ $apparatus->quantity }} x {{ $numberOfGroups }} x {{ $repetition }} = {{ $apparatus->quantity * $numberOfGroups * $repetition }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Action Buttons -->
        @if($request->status === 'pending')
            <div class="action-bar">
                <form action="{{ route('lab_assistant.requests.approve.form', $request->id) }}" method="GET" style="display: inline;">
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

        function toggleEditMode() {
            const savedCalcs = document.querySelector('.saved-calculations');
            const calcForm = document.getElementById('calculationForm');
            
            if (savedCalcs && calcForm) {
                savedCalcs.classList.toggle('hidden');
                calcForm.classList.toggle('hidden');
            }
        }

        function updateReagentInfo(index) {
            const select = document.getElementById('reagent_' + index);
            const selectedOption = select.options[select.selectedIndex];
            const infoDiv = document.getElementById('reagent_info_' + index);
            const purityGroup = document.getElementById('purity_group_' + index);
            const purityInput = document.getElementById('purity_' + index);
            
            if (!selectedOption.value) {
                infoDiv.innerHTML = '<div class="reagent-property-placeholder"><em>Select a form above to see reagent properties</em></div>';
                purityGroup.style.display = 'none';
                return;
            }
            
            const type = selectedOption.dataset.type;
            const molarMass = selectedOption.dataset.molarMass;
            const density = selectedOption.dataset.density;
            const formula = selectedOption.dataset.formula;
            const variant = selectedOption.dataset.variant;
            const displayName = selectedOption.dataset.displayName;
            
            // Update info display
            let html = `
                <div class="reagent-property">
                    <span class="property-label">Reagent:</span>
                    <span class="property-value">${displayName}</span>
                </div>
                <div class="reagent-property">
                    <span class="property-label">Formula:</span>
                    <span class="property-value">${formula}</span>
                </div>
                <div class="reagent-property">
                    <span class="property-label">Type:</span>
                    <span class="property-value type-badge type-${type}">
                        ${type.charAt(0).toUpperCase() + type.slice(1)}
                    </span>
                </div>
                <div class="reagent-property">
                    <span class="property-label">Molar Mass:</span>
                    <span class="property-value">${molarMass} g/mol</span>
                </div>
            `;
            
            if (type === 'liquid' && density) {
                html += `
                    <div class="reagent-property">
                        <span class="property-label">Density:</span>
                        <span class="property-value">${density} g/cm³</span>
                    </div>
                `;
            }
            
            infoDiv.innerHTML = html;
            
            // Show/hide purity input based on type
            if (type === 'liquid') {
                purityGroup.style.display = 'block';
                purityInput.required = true;
            } else {
                purityGroup.style.display = 'none';
                purityInput.required = false;
                purityInput.value = '';
            }
        }
    </script>

    <style>
        .hidden {
            display: none !important;
        }

        .reagent-calculations-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-left: 4px solid var(--accent);
        }

        .calculation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e6eef6;
        }

        .btn-small {
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-edit {
            background: var(--accentlight);
            color: white;
        }

        .btn-edit:hover {
            background: var(--accent);
            transform: translateY(-1px);
        }

        .saved-calculations {
            margin-bottom: 20px;
        }

        .calculation-result {
            background: white;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            border-left: 4px solid var(--accent);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .calc-title {
            font-weight: 700;
            color: var(--accent);
            font-size: 16px;
            margin-bottom: 8px;
        }

        .variant-badge {
            display: inline-block;
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
            color: white;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            margin-left: 8px;
        }

        .calc-output {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accentlight) 100%);
            color: white;
            padding: 12px;
            border-radius: 6px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .calc-details {
            color: #666;
            line-height: 1.6;
            margin-top: 8px;
            padding: 8px;
            background: #f8f9fa;
            border-radius: 4px;
        }

        .reagent-calculation-item {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 2px solid #e6eef6;
        }

        .material-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .material-header strong {
            color: var(--accent);
            font-size: 18px;
        }

        .concentration-badge {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accentlight) 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .variant-selector-group {
            margin: 16px 0;
            padding: 16px;
            background: linear-gradient(135deg, #e3f2fd 0%, #ffffff 100%);
            border-radius: 8px;
            border: 2px solid #2196F3;
        }

        .variant-label {
            display: block;
            font-weight: 600;
            color: #1b263b;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .variant-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 15px;
            color: #1b263b;
            background-color: white;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .variant-select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(25, 71, 174, 0.1);
        }

        .variant-select:hover {
            border-color: var(--accentlight);
            background-color: #f8f9fa;
        }

        .reagent-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
            margin-bottom: 16px;
            padding: 16px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .reagent-property {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .reagent-property-placeholder {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }

        .property-label {
            font-size: 12px;
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .property-value {
            color: var(--accent);
            font-weight: 600;
            font-size: 14px;
        }

        .type-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
        }

        .type-solid {
            background: #e7f3ff;
            color: #2196F3;
        }

        .type-liquid {
            background: #fff3e0;
            color: #ff9800;
        }

        .purity-input-group {
            margin-top: 16px;
            padding: 16px;
            background: #fff9e6;
            border-radius: 8px;
            border: 2px dashed #ffc107;
        }

        .purity-label {
            display: block;
            font-weight: 600;
            color: #1b263b;
            margin-bottom: 8px;
        }

        .purity-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.2s ease;
        }

        .purity-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(25, 71, 174, 0.1);
        }

        .input-helper {
            display: block;
            color: #666;
            font-size: 12px;
            margin-top: 6px;
        }

        .reagent-not-found {
            background: #fff3cd;
            border: 2px solid #ffc107;
            color: #856404;
            padding: 16px;
            border-radius: 8px;
            text-align: center;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            justify-content: flex-end;
        }

        @media (max-width: 768px) {
            .material-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .reagent-info {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
            }

            .variant-selector-group {
                padding: 12px;
            }
            
            .variant-select {
                font-size: 14px;
                padding: 10px 12px;
            }
        }
    </style>
</x-lab-assistant-layout>