<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Requests - {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            color: #333;
        }

        .print-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .cover-page {
            text-align: center;
            padding: 100px 20px;
            border: 4px solid #2c5282;
            border-radius: 12px;
            page-break-after: always;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .cover-page h1 {
            font-size: 36px;
            color: #2c5282;
            margin-bottom: 20px;
        }

        .cover-page .date-range {
            font-size: 24px;
            color: #666;
            margin-bottom: 30px;
        }

        .cover-page .summary {
            display: inline-block;
            background: #f0f4f8;
            padding: 20px 40px;
            border-radius: 12px;
            margin-top: 30px;
        }

        .cover-page .summary-item {
            font-size: 18px;
            margin: 10px 0;
        }

        .request-card {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #2c5282;
        }

        .request-title {
            font-size: 20px;
            font-weight: 700;
            color: #2c5282;
        }

        .request-id {
            font-size: 14px;
            color: #666;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 16px;
            font-weight: 600;
            font-size: 13px;
        }

        .status-pending { background: #fff3cd; color: #856404; }
        .status-approved { background: #d4edda; color: #155724; }
        .status-rejected { background: #f8d7da; color: #721c24; }
        .status-completed { background: #cce5ff; color: #004085; }
        .status-cancelled { background: #e2e3e5; color: #383d41; }
        .status-no_show { background: #fff3cd; color: #856404; }

        .info-section {
            margin-bottom: 20px;
        }

        .info-section-title {
            font-size: 14px;
            font-weight: 700;
            color: #2c5282;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 15px;
        }

        .info-item {
            padding: 10px;
            background: #f7fafc;
            border-radius: 6px;
        }

        .info-label {
            font-size: 11px;
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 14px;
            color: #2c5282;
            font-weight: 600;
        }

        .materials-apparatus {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
        }

        .items-box {
            background: #f7fafc;
            border-radius: 8px;
            padding: 12px;
        }

        .items-box h4 {
            font-size: 12px;
            color: #2c5282;
            text-transform: uppercase;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .items-list {
            list-style: none;
            font-size: 12px;
        }

        .items-list li {
            padding: 6px 0;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
        }

        .items-list li:last-child {
            border-bottom: none;
        }

        .item-quantity {
            font-weight: 600;
            color: #2c5282;
        }

        .notes-box {
            background: #fffbeb;
            border: 1px solid #fbbf24;
            border-radius: 6px;
            padding: 10px;
            margin-top: 15px;
            font-size: 13px;
        }

        .notes-box strong {
            color: #92400e;
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 24px;
            background: #2c5282;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .print-button:hover {
            background: #1a365d;
        }

        .page-footer {
            text-align: center;
            color: #666;
            font-size: 11px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        @media print {
            body {
                padding: 0;
            }

            .print-button {
                display: none;
            }

            .request-card {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">🖨️ Print All</button>

    <div class="print-container">
        <!-- Cover Page -->
        <div class="cover-page">
            <h1>Laboratory Session Requests</h1>
            <div class="date-range">
                {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} 
                to 
                {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
            </div>

            <div class="summary">
                <div class="summary-item">
                    <strong>Total Requests:</strong> {{ $requestsWithDetails->count() }}
                </div>
                @if($status)
                <div class="summary-item">
                    <strong>Status Filter:</strong> {{ ucfirst($status) }}
                </div>
                @endif
                @if($labNumber)
                <div class="summary-item">
                    <strong>Lab Filter:</strong> {{ $labNumber }}
                </div>
                @endif
                <div class="summary-item" style="margin-top: 20px; color: #666; font-size: 14px;">
                    Generated on {{ now()->format('d M Y, h:i A') }}
                </div>
            </div>
        </div>

        <!-- Request Cards -->
        @forelse($requestsWithDetails as $data)
            @php
                $request = $data['request'];
                $materials = $data['materials'];
                $apparatuses = $data['apparatuses'];
            @endphp

            <div class="request-card">
                <div class="request-header">
                    <div>
                        <div class="request-title">{{ $request->experiment->name ?? 'N/A' }}</div>
                        <div class="request-id">Request #{{ $request->id }}</div>
                    </div>
                    <div>
                        <span class="status-badge status-{{ $request->status }}">
                            {{ strtoupper(str_replace('_', ' ', $request->status)) }}
                        </span>
                    </div>
                </div>

                <!-- Basic Info -->
                <div class="info-section">
                    <div class="info-section-title">Session Details</div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Teacher</div>
                            <div class="info-value">{{ $request->user->name ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Class</div>
                            <div class="info-value">{{ $request->classname }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lab</div>
                            <div class="info-value">{{ $request->lab_number }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Students</div>
                            <div class="info-value">{{ $request->num_students }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Group Size</div>
                            <div class="info-value">{{ $request->group_size }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Repetition</div>
                            <div class="info-value">{{ $request->repetition }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Date</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($request->preferred_date)->format('d M Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Time</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($request->preferred_time)->format('h:i A') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Duration</div>
                            <div class="info-value">{{ $request->duration }} min</div>
                        </div>
                    </div>
                </div>

                <!-- Experiment Details -->
                <div class="info-section">
                    <div class="info-section-title">Experiment Details</div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Form Level</div>
                            <div class="info-value">{{ strtoupper($request->form_level) }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Subject</div>
                            <div class="info-value">{{ $request->subject->name ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Topic</div>
                            <div class="info-value">{{ $request->topic->name ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Materials and Apparatus -->
                @if($materials->isNotEmpty() || $apparatuses->isNotEmpty())
                <div class="materials-apparatus">
                    @if($materials->isNotEmpty())
                    <div class="items-box">
                        <h4>Required Materials</h4>
                        <ul class="items-list">
                            @foreach($materials as $material)
                            <li>
                                <span>{{ $material->name }}</span>
                                <span class="item-quantity">{{ $material->quantity }} {{ $material->unit }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($apparatuses->isNotEmpty())
                    <div class="items-box">
                        <h4>Required Apparatus</h4>
                        <ul class="items-list">
                            @foreach($apparatuses as $apparatus)
                            <li>
                                <span>{{ $apparatus->name }}</span>
                                <span class="item-quantity">{{ $apparatus->quantity }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Notes -->
                @if($request->additional_notes)
                <div class="notes-box">
                    <strong>Notes:</strong> {{ $request->additional_notes }}
                </div>
                @endif

                @if($request->rejection_reason)
                <div class="notes-box" style="background: #fee; border-color: #f87171;">
                    <strong style="color: #991b1b;">Rejection Reason:</strong> {{ $request->rejection_reason }}
                </div>
                @endif
            </div>
        @empty
            <div style="text-align: center; padding: 60px; color: #999;">
                <p style="font-size: 18px; margin-bottom: 10px;">No requests found for the selected date range.</p>
                <p>Try adjusting your filters or date range.</p>
            </div>
        @endforelse

        @if($requestsWithDetails->isNotEmpty())
        <div class="page-footer">
            <p>Laboratory Session Requests Report</p>
            <p>{{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
            <p>Generated on {{ now()->format('d M Y, h:i A') }}</p>
        </div>
        @endif
    </div>
</body>
</html>