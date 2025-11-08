<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #1947ae 0%, #5186f2 100%);
            color: white;
            padding: 30px;
            border-radius: 12px 12px 0 0;
            text-align: center;
        }
        .content {
            background: #ffffff;
            padding: 30px;
            border: 1px solid #e6eef6;
            border-top: none;
        }
        .info-box {
            background: #f0f4f8;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e1e8ed;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: 600;
            color: #415A77;
        }
        .value {
            color: #1947ae;
            font-weight: 500;
        }
        .highlight {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .schedule-box {
            background: linear-gradient(135deg, #5186f2 0%, #1947ae 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }
        .schedule-box h3 {
            margin: 0 0 15px 0;
            font-size: 18px;
        }
        .schedule-box p {
            margin: 8px 0;
            font-size: 16px;
        }
        .status-badge {
            background: #fff3cd;
            color: #856404;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            display: inline-block;
        }
        .cta-button {
            display: inline-block;
            background: #1947ae;
            color: white;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
            transition: background 0.3s ease;
        }
        .cta-button:hover {
            background: #5186f2;
        }
        .footer {
            text-align: center;
            color: #7b8aa3;
            font-size: 14px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e1e8ed;
        }
        .notification-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .section-title {
            color: #1b263b;
            font-weight: 700;
            font-size: 16px;
            margin: 24px 0 12px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="notification-icon">🔔</div>
        <h1 style="margin: 0;">New Lab Request</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9; font-size: 14px;">Request #{{ $labRequest->id }}</p>
    </div>
    
    <div class="content">
        <p>A new laboratory session request has been submitted and requires your attention.</p>
        
        <div style="text-align: center; margin: 20px 0;">
            <span class="status-badge">{{ strtoupper($labRequest->status) }}</span>
        </div>

        <!-- Teacher Information -->
        <h3 class="section-title">👨‍🏫 Teacher Information</h3>
        <div class="info-box">
            <div class="info-row">
                <span class="label">Name:</span>
                <span class="value">{{ $labRequest->user->name ?? 'N/A' }}</span>
            </div>
            
            <div class="info-row">
                <span class="label">Email:</span>
                <span class="value">{{ $labRequest->user->email ?? 'N/A' }}</span>
            </div>
        </div>

        <!-- Session Details -->
        <h3 class="section-title">📋 Session Details</h3>
        <div class="info-box">
            <div class="info-row">
                <span class="label">Class:</span>
                <span class="value">{{ $labRequest->classname }}</span>
            </div>
            
            <div class="info-row">
                <span class="label">Form Level:</span>
                <span class="value">{{ strtoupper($labRequest->form_level) }}</span>
            </div>
            
            <div class="info-row">
                <span class="label">Lab Number:</span>
                <span class="value">{{ $labRequest->lab_number }}</span>
            </div>
            
            <div class="info-row">
                <span class="label">Number of Students:</span>
                <span class="value">{{ $labRequest->num_students }}</span>
            </div>
            
            <div class="info-row">
                <span class="label">Group Size:</span>
                <span class="value">{{ $labRequest->group_size }}</span>
            </div>
        </div>

        <!-- Experiment Details -->
        <h3 class="section-title">🧪 Experiment Details</h3>
        <div class="info-box">
            <div class="info-row">
                <span class="label">Subject:</span>
                <span class="value">{{ $labRequest->subject->name ?? 'N/A' }}</span>
            </div>
            
            <div class="info-row">
                <span class="label">Topic:</span>
                <span class="value">{{ $labRequest->topic->name ?? 'N/A' }}</span>
            </div>
            
            <div class="info-row">
                <span class="label">Experiment:</span>
                <span class="value">{{ $labRequest->experiment->name ?? 'N/A' }}</span>
            </div>
        </div>

        <!-- Preferred Schedule -->
        <h3 class="section-title">📅 Preferred Schedule</h3>
        <div class="schedule-box">
            <p style="font-size: 18px; margin: 5px 0;">
                <strong>{{ \Carbon\Carbon::parse($labRequest->preferred_date)->format('l, d M Y') }}</strong>
            </p>
            <p style="font-size: 18px; margin: 5px 0;">
                🕐 {{ \Carbon\Carbon::parse($labRequest->preferred_time)->format('h:i A') }}
            </p>
            <p style="font-size: 16px; margin: 5px 0;">
                Duration: {{ $labRequest->duration }} minutes
            </p>
        </div>

        <!-- Additional Notes -->
        @if($labRequest->additional_notes)
        <h3 class="section-title">📝 Additional Notes</h3>
        <div class="highlight">
            <p style="margin: 0; color: #856404;">{{ $labRequest->additional_notes }}</p>
        </div>
        @endif

        <!-- Action Required -->
        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 24px 0; text-align: center;">
            <p style="margin: 0 0 15px 0; color: #415A77; font-weight: 600;">
                ⚡ Action Required
            </p>
            <p style="margin: 0 0 20px 0; color: #7b8aa3; font-size: 14px;">
                Please review and respond to this request as soon as possible.
            </p>
            <a href="{{ config('app.url') }}/lab-assistant/requests" class="cta-button">
                View & Process Request
            </a>
        </div>
        
        <div class="footer">
            <p>This is an automated notification from the Lab Management System.</p>
            <p>Submitted on {{ $labRequest->created_at->format('l, d M Y at h:i A') }}</p>
            <p style="margin-top: 10px;">© {{ date('Y') }} Science Laboratory Management</p>
        </div>
    </div>
</body>
</html>