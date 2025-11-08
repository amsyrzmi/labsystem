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
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
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
        .reason-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            color: #7b8aa3;
            font-size: 14px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e1e8ed;
        }
        .warning-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="warning-icon">⚠️</div>
        <h1 style="margin: 0;">Request Not Approved</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $labRequest->user->name }},</p>
        
        <p>We regret to inform you that your lab request could not be approved at this time.</p>
        
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
                <span class="label">Requested Date:</span>
                <span class="value">{{ \Carbon\Carbon::parse($labRequest->preferred_date)->format('d M Y, h:i A') }}</span>
            </div>
            
            <div class="info-row">
                <span class="label">Lab Number:</span>
                <span class="value">{{ $labRequest->lab_number }}</span>
            </div>
        </div>
        
        @if($labRequest->rejection_reason)
        <div class="reason-box">
            <h4 style="margin-top: 0; color: #856404;">Reason for Rejection:</h4>
            <p style="margin-bottom: 0; color: #856404;">{{ $labRequest->rejection_reason }}</p>
        </div>
        @endif
        
        <p><strong>What You Can Do:</strong></p>
        <ul>
            <li>Review the rejection reason above</li>
            <li>Contact the lab assistant to discuss alternative options</li>
            <li>Submit a new request with adjusted dates or requirements</li>
            <li>Consider booking a different lab or time slot</li>
        </ul>
        
        <p>We apologize for any inconvenience. Please feel free to reach out if you need assistance with rebooking.</p>
        
        <div class="footer">
            <p>This is an automated message from the Lab Management System.</p>
            <p>© {{ date('Y') }} Science Laboratory Management</p>
        </div>
    </div>
</body>
</html>