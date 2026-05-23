<x-lab-assistant-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/lab-assistant.css')

    <style>
        .inventory-dashboard {
            padding: 24px;
            max-width: 1400px;
            margin: 0 auto;
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

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-left: 4px solid var(--accent);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .stat-card.warning {
            border-left-color: #ff9800;
            background: linear-gradient(135deg, #fff9f0 0%, #ffffff 100%);
        }

        .stat-card.danger {
            border-left-color: #f44336;
            background: linear-gradient(135deg, #fff0f0 0%, #ffffff 100%);
        }

        .stat-icon {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 8px;
        }

        .stat-card.warning .stat-value {
            color: #ff9800;
        }

        .stat-card.danger .stat-value {
            color: #f44336;
        }

        .stat-label {
            font-size: 14px;
            color: #7b8aa3;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e6eef6;
        }

        .card-title {
            font-size: 20px;
            font-weight: 700;
            color: #1b263b;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accentlight) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(25, 71, 174, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .alert-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .alert-item {
            display: flex;
            align-items: center;
            padding: 12px;
            margin-bottom: 8px;
            border-radius: 8px;
            background: #fff3cd;
            border-left: 4px solid #ffc107;
        }

        .alert-item.critical {
            background: #f8d7da;
            border-left-color: #f44336;
        }

        .alert-icon {
            font-size: 24px;
            margin-right: 12px;
        }

        .alert-content {
            flex: 1;
        }

        .alert-title {
            font-weight: 600;
            color: #1b263b;
            margin-bottom: 4px;
        }

        .alert-details {
            font-size: 13px;
            color: #666;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #7b8aa3;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .transaction-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            border-bottom: 1px solid #e6eef6;
        }

        .transaction-item:last-child {
            border-bottom: none;
        }

        .transaction-info {
            flex: 1;
        }

        .transaction-name {
            font-weight: 600;
            color: #1b263b;
            margin-bottom: 4px;
        }

        .transaction-meta {
            font-size: 13px;
            color: #7b8aa3;
        }

        .transaction-badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-deduct {
            background: #ffebee;
            color: #c62828;
        }

        .badge-restore {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .full-width-card {
            grid-column: 1 / -1;
        }

        @media (max-width: 968px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        @media (max-width: 640px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-actions {
                width: 100%;
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="inventory-dashboard">
        <div class="page-header">
            <h1 class="page-title">📦 Inventory Management</h1>
            <div class="header-actions">
                <a href="{{ route('lab_assistant.inventory.materials') }}" class="btn btn-primary">
                    Manage Materials
                </a>
                <a href="{{ route('lab_assistant.inventory.apparatus') }}" class="btn btn-primary">
                    Manage Apparatus
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 24px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🧪</div>
                <div class="stat-value">{{ $totalMaterials }}</div>
                <div class="stat-label">Total Materials</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🔬</div>
                <div class="stat-value">{{ $totalApparatus }}</div>
                <div class="stat-label">Total Apparatus</div>
            </div>

            <div class="stat-card {{ $lowStockMaterials > 0 ? 'warning' : '' }}">
                <div class="stat-icon">⚠️</div>
                <div class="stat-value">{{ $lowStockMaterials }}</div>
                <div class="stat-label">Low Stock Materials</div>
            </div>

            <div class="stat-card {{ $lowStockApparatus > 0 ? 'warning' : '' }}">
                <div class="stat-icon">⚠️</div>
                <div class="stat-value">{{ $lowStockApparatus }}</div>
                <div class="stat-label">Low Stock Apparatus</div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Low Stock Alerts -->
            <div class="card full-width-card">
                <div class="card-header">
                    <h2 class="card-title">🚨 Stock Alerts</h2>
                    <a href="{{ route('lab_assistant.inventory.materials') }}?low_stock=1" class="btn btn-secondary">
                        View All Low Stock
                    </a>
                </div>

                @php
                    $lowMaterials = \App\Models\InventoryMaterial::whereColumn('quantity', '<=', 'minimum_quantity')
                        ->orderBy('quantity')
                        ->take(5)
                        ->get();
                    
                    $lowApparatus = \App\Models\InventoryApparatus::whereColumn('available_quantity', '<=', 'minimum_quantity')
                        ->orderBy('available_quantity')
                        ->take(5)
                        ->get();
                    
                    $allLowStock = $lowMaterials->concat($lowApparatus);
                @endphp

                @if($allLowStock->isEmpty())
                    <div class="empty-state">
                        <div class="empty-state-icon">✅</div>
                        <p>All items are sufficiently stocked!</p>
                    </div>
                @else
                    <ul class="alert-list">
                        @foreach($lowMaterials as $material)
                            <li class="alert-item {{ $material->quantity == 0 ? 'critical' : '' }}">
                                <span class="alert-icon">{{ $material->quantity == 0 ? '🔴' : '🟡' }}</span>
                                <div class="alert-content">
                                    <div class="alert-title">{{ $material->name }}</div>
                                    <div class="alert-details">
                                        Current: {{ $material->quantity }} {{ $material->unit }} | 
                                        Minimum: {{ $material->minimum_quantity }} {{ $material->unit }}
                                        @if($material->concentration)
                                            | Concentration: {{ $material->concentration }} mol/dm³
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach

                        @foreach($lowApparatus as $apparatus)
                            <li class="alert-item {{ $apparatus->available_quantity == 0 ? 'critical' : '' }}">
                                <span class="alert-icon">{{ $apparatus->available_quantity == 0 ? '🔴' : '🟡' }}</span>
                                <div class="alert-content">
                                    <div class="alert-title">{{ $apparatus->name }}</div>
                                    <div class="alert-details">
                                        Available: {{ $apparatus->available_quantity }} / {{ $apparatus->total_quantity }} | 
                                        Minimum: {{ $apparatus->minimum_quantity }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Recent Transactions -->
            <div class="card full-width-card">
                <div class="card-header">
                    <h2 class="card-title">📊 Recent Transactions</h2>
                    <a href="{{ route('lab_assistant.inventory.transactions') }}" class="btn btn-secondary">
                        View All
                    </a>
                </div>

                @if($recentTransactions->isEmpty())
                    <div class="empty-state">
                        <div class="empty-state-icon">📭</div>
                        <p>No recent transactions</p>
                    </div>
                @else
                    <ul class="transaction-list">
                        @foreach($recentTransactions as $transaction)
                            <li class="transaction-item">
                                <div class="transaction-info">
                                    <div class="transaction-name">
                                        {{ $transaction->item_name }}
                                    </div>
                                    <div class="transaction-meta">
                                        {{ $transaction->quantity }} {{ $transaction->unit ?? '' }} • 
                                        Request #{{ $transaction->lab_request_id }} • 
                                        {{ $transaction->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <span class="transaction-badge badge-{{ $transaction->transaction_type }}">
                                    {{ $transaction->transaction_type === 'deduct' ? '➖ Deducted' : '➕ Restored' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-lab-assistant-layout>