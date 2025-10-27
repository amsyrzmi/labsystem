@component('mail::message')
<div style="text-align: center; margin-bottom: 30px;">
<h1 style="color: #415A77; margin: 0; font-size: 32px; font-weight: 700;">LabCore</h1>
<p style="color: #7b8aa3; margin-top: 5px;">Science Laboratory Management System</p>
</div>

# Hello {{ $userName }},

We received a request to reset your password for your **LabCore** account.

Click the button below to reset your password:

@component('mail::button', ['url' => $resetUrl, 'color' => 'primary'])
Reset Password
@endcomponent

**This password reset link will expire in {{ $expiryMinutes }} minutes.**

If you did not request a password reset, no further action is required. Your password will remain unchanged.

---

### Security Tips:
- Never share your password with anyone
- Use a strong, unique password
- Enable two-factor authentication if available

---

<div style="text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #e1e8ed;">
</div>

Thanks,<br>
The {{ config('app.name') }} Team

<div style="text-align: center; margin-top: 30px; color: #7b8aa3; font-size: 12px;">
<p>© {{ date('Y') }} LabCore. All rights reserved.</p>
<p>Made by NexusSphere</p>
</div>
@endcomponent