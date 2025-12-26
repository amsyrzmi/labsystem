<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Request #{{ $request->id }} - Print</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 30px;
            background: white;
            color: #333;
        }

        .print-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
        }

        .header {
            text-align: center;
            border-bottom: 4px solid #2c5282;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2c5282;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header .subtitle {
            color: #666;
            font-size: 14px;
        }

        .request-id {
            text-align: right;
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .status-pending { background: #fff3cd; color: #856404; }
        .status-approved { background: #d4edda; color: #155724; }
        .status-rejected { background: #f8d7da; color: #721c24; }
        .status-completed { background: #cce5ff; color: #004085; }

        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c5282;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .info-item {
            padding: 12px;
            background: #f7fafc;
            border-radius: 8px;
            border-left: 3px solid #2c5282;
        }

        .info-label {
            font-size: 12px;
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 16px;
            color: #2c5282;
            font-weight: 600;
        }

        .items-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .items-list li {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .items-list li:last-child {
            border-bottom: none;
        }

        .item-name {
            font-weight: 500;
            color: #2d3748;
        }

        .item-quantity {
            font-weight: 600;
            color: #2c5282;
            background: #ebf4ff;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 14px;
        }

        .notes-box {
            background: #fffbeb;
            border: 2px solid #fbbf24;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }

        .notes-box strong {
            color: #92400e;
            display: block;
            margin-bottom: 8px;
        }

        .rejection-box {
            background: #fee;
            border: 2px solid #f87171;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }

        .rejection-box strong {
            color: #991b1b;
            display: block;
            margin-bottom: 8px;
        }

        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #e2e8f0;
            text-align: center;
            color: #666;
            font-size: 12px;
        }

        .signature-section {
            margin-top: 40px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }

        .signature-box {
            text-align: center;
        }

        .signature-line {
            border-top: 2px solid #333;
            margin-top: 60px;
            padding-top: 10px;
            font-weight: 600;
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
        }

        .print-button:hover {
            background: #1a365d;
        }

        @media print {
            body {
                padding: 0;
            }

            .print-button {
                display: none;
            }

            .print-container {
                max-width: 100%;
            }
        }

        .empty-message {
            text-align: center;
            color: #999;
            font-style: italic;
            padding: 20px;
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">🖨️ Print</button>

    <div class="print-container">
        <div class="header">
            <h1>Laboratory Session Request</h1>
            <div class="subtitle">Science Laboratory Management System</div>
        </div>

        <div class="request-id">
            Request ID: <strong>#{{ $request->id }}</strong> | 
            Submitted: {{ $request->created_at->format('d M Y, h:i A') }}
        </div>

        <div style="margin-bottom: 20px;">
            <span class="status-badge status-{{ $request->status }}">
                {{ strtoupper(str_replace('_', ' ', $request->status)) }}
            </span>
        </div>

        <!-- Teacher Information -->
        <div class="section">
            <div class="section-title">Teacher Information</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Teacher Name</div>
                    <div class="info-value">{{ $request->user->name ?? 'N/A' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $request->user->email ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Experiment Details -->
        <div class="section">
            <div class="section-title">Experiment Details</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Form Level</div>
                    <div class="info-value">{{ strtoupper($request->form_level) }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Subject</div>
                    <div class="info-value">{{ $request->subject->name ?? 'N/A' }}</div>
                </div>
                <div class="info-item" style="grid-column: span 2;">
                    <div class="info-label">Topic</div>
                    <div class="info-value">{{ $request->topic->name ?? 'N/A' }}</div>
                </div>
                <div class="info-item" style="grid-column: span 2;">
                    <div class="info-label">Experiment</div>
                    <div class="info-value">
                        @if($request->custom_experiment_name)
                            <span style="background:#667eea;color:white;padding:3px 8px;border-radius:6px;font-size:12px;font-weight:600;">CUSTOM</span>
                            {{ $request->custom_experiment_name }}
                        @else
                            {{ optional($request->experiment)->name ?? '— No experiment —' }}
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Session Details -->
        <div class="section">
            <div class="section-title">Session Details</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Class Name</div>
                    <div class="info-value">{{ $request->classname }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Lab Number</div>
                    <div class="info-value">{{ $request->lab_number }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Number of Students</div>
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
                    <div class="info-label">Duration</div>
                    <div class="info-value">{{ $request->duration }} minutes</div>
                </div>
            </div>
        </div>

        <!-- Schedule -->
        <div class="section">
            <div class="section-title">Schedule</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Preferred Date</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($request->preferred_date)->format('d M Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Preferred Time</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($request->preferred_time)->format('h:i A') }}</div>
                </div>
                @if($request->status === 'approved' && $request->approved_date)
                <div class="info-item">
                    <div class="info-label">Approved Date</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($request->approved_date)->format('d M Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Approved Time</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($request->approved_time)->format('h:i A') }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Required Materials -->
        @if($materials->isNotEmpty())
        <div class="section">
            <div class="section-title">Required Materials</div>
            <ul class="items-list">
                @foreach($materials as $material)
                <li>
                    <span class="item-name">{{ $material->name }}</span>
                    <span class="item-quantity">{{ $material->quantity }} {{ $material->unit }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Required Apparatus -->
        @if($apparatuses->isNotEmpty())
        <div class="section">
            <div class="section-title">Required Apparatus</div>
            <ul class="items-list">
                @foreach($apparatuses as $apparatus)
                <li>
                    <span class="item-name">{{ $apparatus->name }}</span>
                    <span class="item-quantity">{{ $apparatus->quantity }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Additional Notes -->
        @if($request->additional_notes)
        <div class="notes-box">
            <strong>Additional Notes:</strong>
            {{ $request->additional_notes }}
        </div>
        @endif

        <!-- Rejection Reason -->
        @if($request->rejection_reason)
        <div class="rejection-box">
            <strong>Rejection Reason:</strong>
            {{ $request->rejection_reason }}
        </div>
        @endif

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-line">Teacher's Signature</div>
            </div>
            <div class="signature-box">
                <div class="signature-line">Lab Assistant's Signature</div>
            </div>
        </div>

        <div class="footer">
            <p>This is an official laboratory request document.</p>
            <p>Generated on {{ now()->format('d M Y, h:i A') }}</p>
        </div>
    </div>
</body>
</html>