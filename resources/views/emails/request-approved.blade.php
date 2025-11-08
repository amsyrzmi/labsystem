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
            background: #5186f2;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            text-align: center;
            color: #7b8aa3;
            font-size: 14px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e1e8ed;
        }
        .success-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="success-icon">✓</div>
        <h1 style="margin: 0;">Request Approved!</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $labRequest->user->name }},</p>
        
        <p>Great news! Your lab request has been <strong>approved</strong> and scheduled.</p>
        
        <div class="info-box">
            <h3 style="margin-top: 0; color: #1b263b;">Request Details</h3>
            
            <div class="info-row">
                <span class="label">Subject:</span>
                <span class="value">{{ optional($labRequest->subject)->name ?? 'N/A' }}</span>
            </div>
            
            <div class="info-row">
                <span class="label">Experiment:</span>
                <span class="value">{{ optional($labRequest->experiment)->name ?? 'N/A' }}</span>
            </div>
            
            <div class="info-row">
                <span class="label">Class:</span>
                <span class="value">{{ $labRequest->classname }}</span>
            </div>
            
            <div class="info-row">
                <span class="label">Students:</span>
                <span class="value">{{ $labRequest->num_students }}</span>
            </div>
            
            <div class="info-row">
                <span class="label">Lab Number:</span>
                <span class="value">{{ $labRequest->lab_number }}</span>
            </div>
        </div>
        
        <div class="highlight">
            <h3 style="margin: 0 0 10px 0;">📅 Scheduled Date & Time</h3>
            <p style="font-size: 18px; margin: 5px 0;">
                <strong>{{ \Carbon\Carbon::parse($labRequest->approved_date)->format('l, d M Y') }}</strong>
            </p>
            <p style="font-size: 18px; margin: 5px 0;">
                🕐 {{ \Carbon\Carbon::parse($labRequest->approved_time)->format('h:i A') }}
            </p>
            <p style="font-size: 16px; margin: 5px 0;">
                Duration: {{ $labRequest->duration }} minutes
            </p>
        </div>
        
        <p><strong>What's Next?</strong></p>
        <ul>
            <li>Mark your calendar for the scheduled date and time</li>
            <li>Prepare your students for the lab session</li>
            <li>Arrive at Lab {{ $labRequest->lab_number }} 5 minutes before the session</li>
            <li>Bring any specific materials mentioned in your request</li>
        </ul>
        
        <p>If you have any questions or need to make changes, please contact the lab assistant as soon as possible.</p>
        
        <div class="footer">
            <p>This is an automated message from the Lab Management System.</p>
            <p>© {{ date('Y') }} Science Laboratory Management</p>
        </div>
    </div>
</body>
</html>