@component('mail::message')
<div style="text-align: center; margin-bottom: 30px;">
<h1 style="color: #667eea; margin: 0; font-size: 32px; font-weight: 700;">LabCore</h1>
<p style="color: #7b8aa3; margin-top: 5px;">Science Laboratory Management System</p>
</div>

# Hello {{ $userName }},

Great news! Your **LabCore** account has been approved by an administrator.

You can now log in and start using the system.

@component('mail::button', ['url' => $loginUrl, 'color' => 'success'])
Log In Now
@endcomponent

If you have any questions, please contact your system administrator.

Thanks,<br>
The {{ config('app.name') }} Team

<div style="text-align: center; margin-top: 30px; color: #7b8aa3; font-size: 12px;">
<p>© {{ date('Y') }} LabCore. All rights reserved.</p>
<p>Made by NexusSphere</p>
</div>
@endcomponent