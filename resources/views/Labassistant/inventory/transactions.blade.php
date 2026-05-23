<x-lab-assistant-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/lab-assistant.css')

    <style>
        .transactions-page {
            padding: 24px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .transaction-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .transaction-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .transaction-title {
            font-size: 18px;
            font-weight: 700;
            color: #1b263b;
        }

        .transaction-type-badge {
            padding: 6px 14px;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 600;
        }

        .type-deduct {
            background: #ffebee;
            color: #c62828;
        }

        .type-restore {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .transaction-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
            margin-bottom: 12px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .detail-label {
            font-size: 12px;
            color: #7b8aa3;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 15px;
            color: #1b263b;
            font-weight: 600;
        }

        .transaction-meta {
            display: flex;
            gap: 16px;
            font-size: 13px;
            color: #7b8aa3;
            padding-top: 12px;
            border-top: 1px solid #e6eef6;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-completed {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-restored {
            background: #e3f2fd;
            color: #1565c0;
        }

        .filters-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .filter-row {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .transaction-details {
                grid-template-columns: 1fr;
            }

            .transaction-meta {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>

    <div class="transactions-page">
        <a href="{{ route('lab_assistant.inventory.index') }}" class="back-link">
            ← Back to Inventory
        </a>

        <div class="page-header">
            <h1 class="page-title">📊 Transaction History</h1>
        </div>

        @if($transactions->isEmpty())
            <div class="empty-state" style="background: white; border-radius: 12px; padding: 60px;">
                <div class="empty-icon">📭</div>
                <h3>No Transactions Yet</h3>
                <p>Transaction history will appear here once lab requests are approved.</p>
            </div>
        @else
            @foreach($transactions as $transaction)
                <div class="transaction-card">
                    <div class="transaction-header">
                        <div class="transaction-title">
                            {{ $transaction->item_name }}
                            <span style="font-size: 14px; color: #7b8aa3; font-weight: 400;">
                                ({{ ucfirst($transaction->item_type) }})
                            </span>
                        </div>
                        <span class="transaction-type-badge type-{{ $transaction->transaction_type }}">
                            {{ $transaction->transaction_type === 'deduct' ? '➖ Deducted' : '➕ Restored' }}
                        </span>
                    </div>

                    <div class="transaction-details">
                        <div class="detail-item">
                            <span class="detail-label">Quantity</span>
                            <span class="detail-value">
                                {{ $transaction->quantity }} {{ $transaction->unit ?? '' }}
                            </span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Lab Request</span>
                            <span class="detail-value">
                                <a href="{{ route('lab_assistant.requests.details', $transaction->lab_request_id) }}" 
                                   style="color: var(--accent); text-decoration: none;">
                                    #{{ $transaction->lab_request_id }}
                                </a>
                            </span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Status</span>
                            <span class="detail-value">
                                <span class="status-badge status-{{ $transaction->status }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Date</span>
                            <span class="detail-value">
                                {{ $transaction->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                    </div>

                    <div class="transaction-meta">
                        <span>
                            <strong>Request:</strong> 
                            {{ optional($transaction->labRequest)->experiment->name ?? 'N/A' }}
                        </span>
                        <span>
                            <strong>Teacher:</strong> 
                            {{ optional($transaction->labRequest)->user->name ?? 'N/A' }}
                        </span>
                        @if($transaction->completed_at)
                            <span>
                                <strong>Completed:</strong> 
                                {{ $transaction->completed_at->format('d M Y, H:i') }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach

            <div style="margin-top: 24px;">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</x-lab-assistant-layout>