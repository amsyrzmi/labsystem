<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Lab Request</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 3px solid #2c5282;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2c5282;
            margin: 0;
            font-size: 24px;
        }
        .request-id {
            background: #ebf4ff;
            color: #2c5282;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
            font-weight: 600;
            margin-top: 10px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            color: #2c5282;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 2px solid #e2e8f0;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #666;
        }
        .info-value {
            color: #2c5282;
            font-weight: 600;
        }
        .status-badge {
            background: #fff3cd;
            color: #856404;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: 600;
        }
        .notes {
            background: #fffbeb;
            border-left: 4px solid #fbbf24;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }
        .cta-button {
            display: inline-block;
            background: #2c5282;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 20px;
            text-align: center;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e2e8f0;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🔬 New Lab Request Submitted</h1>
            <div class="request-id">Request #{{ $labRequest->id }}</div>
        </div>

        <p style="margin-bottom: 20px;">A new laboratory session request has been submitted and requires your attention.</p>

        <!-- Teacher Information -->
        <div class="section">
            <div class="section-title">👨‍🏫 Teacher Information</div>
            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value">{{ $labRequest->user->name ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $labRequest->user->email ?? 'N/A' }}</span>
            </div>
        </div>

        <!-- Session Details -->
        <div class="section">
            <div class="section-title">📋 Session Details</div>
            <div class="info-row">
                <span class="info-label">Class:</span>
                <span class="info-value">{{ $labRequest->classname }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Form Level:</span>
                <span class="info-value">{{ strtoupper($labRequest->form_level) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Lab Number:</span>
                <span class="info-value">{{ $labRequest->lab_number }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Number of Students:</span>
                <span class="info-value">{{ $labRequest->num_students }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Group Size:</span>
                <span class="info-value">{{ $labRequest->group_size }}</span>
            </div>
        </div>

        <!-- Experiment Details -->
        <div class="section">
            <div class="section-title">🧪 Experiment Details</div>
            <div class="info-row">
                <span class="info-label">Subject:</span>
                <span class="info-value">{{ $labRequest->subject->name ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Topic:</span>
                <span class="info-value">{{ $labRequest->topic->name ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Experiment:</span>
                <span class="info-value">{{ $labRequest->experiment->name ?? 'N/A' }}</span>
            </div>
        </div>

        <!-- Schedule -->
        <div class="section">
            <div class="section-title">📅 Schedule</div>
            <div class="info-row">
                <span class="info-label">Preferred Date:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($labRequest->preferred_date)->format('l, d M Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Preferred Time:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($labRequest->preferred_time)->format('h:i A') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Duration:</span>
                <span class="info-value">{{ $labRequest->duration }} minutes</span>
            </div>
        </div>

        <!-- Status -->
        <div class="section">
            <div class="section-title">Status</div>
            <span class="status-badge">{{ strtoupper($labRequest->status) }}</span>
        </div>

        <!-- Additional Notes -->
        @if($labRequest->additional_notes)
        <div class="notes">
            <strong>📝 Additional Notes:</strong><br>
            {{ $labRequest->additional_notes }}
        </div>
        @endif

        <!-- Call to Action -->
        <div style="text-align: center;">
            <a href="{{ config('app.url') }}/lab-assistant/requests" class="cta-button">
                View Request Details
            </a>
        </div>

        <div class="footer">
            <p>This is an automated notification from the Laboratory Management System.</p>
            <p>Submitted on {{ $labRequest->created_at->format('d M Y, h:i A') }}</p>
        </div>
    </div>
</body>
</html>