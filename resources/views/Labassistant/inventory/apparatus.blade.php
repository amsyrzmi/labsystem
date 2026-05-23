<x-lab-assistant-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/lab-assistant.css')

    <style>
        .materials-page {
            padding: 24px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .back-link {
            display: inline-block;
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 24px;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--accentlight);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #1b263b;
            margin: 0;
        }

        .filters-bar {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 24px;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-label {
            display: block;
            font-weight: 600;
            color: #1b263b;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .filter-input {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.2s ease;
        }

        .filter-input:focus {
            outline: none;
            border-color: var(--accent);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            padding-top: 28px;
        }

        .table-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accentlight) 100%);
            color: white;
        }

        .data-table th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table td {
            padding: 16px;
            border-bottom: 1px solid #e6eef6;
        }

        .data-table tbody tr {
            transition: background-color 0.2s ease;
        }

        .data-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .stock-indicator {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .stock-ok {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .stock-low {
            background: #fff3cd;
            color: #856404;
        }

        .stock-critical {
            background: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-icon {
            padding: 6px 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-edit {
            background: #2196F3;
            color: white;
        }

        .btn-edit:hover {
            background: #1976D2;
        }

        .btn-delete {
            background: #f44336;
            color: white;
        }

        .btn-delete:hover {
            background: #d32f2f;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 32px;
            border-radius: 12px;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            margin-bottom: 24px;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 700;
            color: #1b263b;
            margin: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #1b263b;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent);
        }

        .form-helper {
            font-size: 13px;
            color: #7b8aa3;
            margin-top: 6px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accentlight) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(25, 71, 174, 0.3);
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #7b8aa3;
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .filters-bar {
                flex-direction: column;
            }

            .filter-group {
                width: 100%;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-icon {
                width: 100%;
            }
        }
    </style>

    <div class="materials-page">
        <a href="{{ route('lab_assistant.inventory.index') }}" class="back-link">
            ← Back to Inventory
        </a>

        <div class="page-header">
            <h1 class="page-title">🔬 Apparatus Inventory</h1>
            <button onclick="openAddModal()" class="btn btn-primary">
                ➕ Add Apparatus
            </button>
        </div>

        <!-- Filters -->
        <form method="GET" class="filters-bar">
            <div class="filter-group">
                <label class="filter-label">Search</label>
                <input type="text" 
                       name="search" 
                       class="filter-input" 
                       placeholder="Search apparatus..."
                       value="{{ request('search') }}">
            </div>

            <div class="checkbox-group">
                <input type="checkbox" 
                       name="low_stock" 
                       id="low_stock" 
                       value="1"
                       {{ request('low_stock') ? 'checked' : '' }}>
                <label for="low_stock" style="margin: 0;">Show only low stock</label>
            </div>

            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </form>

        <!-- Apparatus Table -->
        <div class="table-card">
            @if($apparatus->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">🔬</div>
                    <h3>No Apparatus Found</h3>
                    <p>Start by adding your first apparatus to the inventory.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Total Quantity</th>
                                <th>Available</th>
                                <th>In Use</th>
                                <th>Min. Quantity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($apparatus as $item)
                                @php
                                    $inUse = $item->total_quantity - $item->available_quantity;
                                @endphp
                                <tr>
                                    <td>
                                        <strong>{{ $item->name }}</strong>
                                        @if($item->notes)
                                            <br><small style="color: #7b8aa3;">{{ Str::limit($item->notes, 50) }}</small>
                                        @endif
                                    </td>
                                    <td><strong>{{ $item->total_quantity }}</strong></td>
                                    <td>{{ $item->available_quantity }}</td>
                                    <td>{{ $inUse }}</td>
                                    <td>{{ $item->minimum_quantity }}</td>
                                    <td>
                                        @if($item->available_quantity == 0)
                                            <span class="stock-indicator stock-critical">All In Use</span>
                                        @elseif($item->available_quantity <= $item->minimum_quantity)
                                            <span class="stock-indicator stock-low">Low Availability</span>
                                        @else
                                            <span class="stock-indicator stock-ok">Available</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button onclick="openEditModal({{ $item->id }})" class="btn-icon btn-edit">
                                                ✏️ Edit
                                            </button>
                                            <button onclick="confirmDelete({{ $item->id }})" class="btn-icon btn-delete">
                                                🗑️ Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="padding: 20px;">
                    {{ $apparatus->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Add Apparatus Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add New Apparatus</h2>
            </div>

            <form action="{{ route('lab_assistant.inventory.apparatus.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">Apparatus Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Total Quantity *</label>
                    <input type="number" name="total_quantity" class="form-control" min="0" required>
                    <div class="form-helper">Total number of this apparatus owned</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Minimum Quantity (Alert Threshold) *</label>
                    <input type="number" name="minimum_quantity" class="form-control" min="0" required>
                    <div class="form-helper">Alert when available quantity falls below this level</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="3" placeholder="Additional information..."></textarea>
                </div>

                <div class="form-actions">
                    <button type="button" onclick="closeAddModal()" class="btn btn-cancel">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Apparatus</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Material Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Apparatus</h2>
            </div>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Apparatus Name *</label>
                    <input type="text" name="name" id="edit_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Quantity *</label>
                    <input type="number" name="quantity" id="edit_quantity" class="form-control" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Minimum Quantity *</label>
                    <input type="number" name="minimum_quantity" id="edit_minimum_quantity" class="form-control" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" id="edit_notes" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-actions">
                    <button type="button" onclick="closeEditModal()" class="btn btn-cancel">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Apparatus</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content" style="max-width: 400px;">
            <div class="modal-header">
                <h2 class="modal-title">Confirm Delete</h2>
            </div>

            <p>Are you sure you want to delete this material? This action cannot be undone.</p>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-actions">
                    <button type="button" onclick="closeDeleteModal()" class="btn btn-cancel">Cancel</button>
                    <button type="submit" class="btn btn-delete">Delete</button>
                </div>
            </form>
        </div>
    </div>

<script>
    // Apparatus data for editing
    const apparatus = @json($apparatus->items());
    
    // Base URLs for routes (without parameters)
    const updateRouteBase = "{{ route('lab_assistant.inventory.apparatus') }}";
    const deleteRouteBase = "{{ route('lab_assistant.inventory.apparatus') }}";

    function openAddModal() {
        document.getElementById('addModal').style.display = 'flex';
    }

    function closeAddModal() {
        document.getElementById('addModal').style.display = 'none';
    }

    function openEditModal(id) {
        const item = apparatus.find(a => a.id === id);
        if (!item) return;

        document.getElementById('edit_name').value = item.name;
        document.getElementById('edit_total_quantity').value = item.total_quantity;
        document.getElementById('edit_minimum_quantity').value = item.minimum_quantity;
        document.getElementById('edit_notes').value = item.notes || '';

        // Set the form action with the ID
        document.getElementById('editForm').action = updateRouteBase + '/' + id;
        
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function confirmDelete(id) {
        // Set the form action with the ID
        document.getElementById('deleteForm').action = deleteRouteBase + '/' + id;
        document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    }

    // Close modals with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeAddModal();
            closeEditModal();
            closeDeleteModal();
        }
    });
</script>
</x-lab-assistant-layout>