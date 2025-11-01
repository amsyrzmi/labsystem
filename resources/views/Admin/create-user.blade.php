<x-admin-layout>
    <div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
        <div style="margin-bottom: 24px;">
            <a href="{{ route('admin.users') }}" 
               style="display: inline-flex; align-items: center; gap: 8px; color: var(--accent); text-decoration: none; font-weight: 600;">
                ← Back to Users
            </a>
        </div>

        <div style="background: white; padding: 32px; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
            <h1 style="color: var(--accent); font-size: 28px; margin-bottom: 8px;">Create New User</h1>
            <p style="color: #7b8aa3; margin-bottom: 24px;">
                Admin-created users are automatically approved and can log in immediately.
            </p>

            @if($errors->any())
                <div style="background: #f8d7da; color: #721c24; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    <strong>Please fix the following errors:</strong>
                    <ul style="margin: 8px 0 0 20px; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; font-weight: 600; margin-bottom: 8px; color: #415A77;">
                        Full Name *
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required
                           placeholder="John Doe"
                           style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 16px;">
                </div>

                <!-- Email -->
                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; font-weight: 600; margin-bottom: 8px; color: #415A77;">
                        Email Address *
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required
                           placeholder="john@example.com"
                           style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 16px;">
                </div>

                <!-- Role -->
                <div style="margin-bottom: 20px;">
                    <label for="role" style="display: block; font-weight: 600; margin-bottom: 8px; color: #415A77;">
                        Role *
                    </label>
                    <select id="role" 
                            name="role" 
                            required
                            style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 16px;">
                        <option value="">Select a role</option>
                        <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="lab_assistant" {{ old('role') === 'lab_assistant' ? 'selected' : '' }}>Lab Assistant</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <div style="font-size: 13px; color: #7b8aa3; margin-top: 6px;">
                        Choose the appropriate role for this user
                    </div>
                </div>

                <!-- Password -->
                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; font-weight: 600; margin-bottom: 8px; color: #415A77;">
                        Password *
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required
                           placeholder="Minimum 8 characters"
                           style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 16px;">
                    <div style="font-size: 13px; color: #7b8aa3; margin-top: 6px;">
                        Must be at least 8 characters long
                    </div>
                </div>

                <!-- Confirm Password -->
                <div style="margin-bottom: 20px;">
                    <label for="password_confirmation" style="display: block; font-weight: 600; margin-bottom: 8px; color: #415A77;">
                        Confirm Password *
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           required
                           placeholder="Re-enter password"
                           style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 16px;">
                </div>

                <!-- Info Box -->
                <div style="background: var(--accentlight); padding: 16px; border-radius: 8px; margin-bottom: 24px; border-left: 4px solid var(--accent);">
                    <div style="display: flex; gap: 12px;">
                        <div style="color: #fff; font-size: 20px;">ℹ</div>
                        <div style="color: #fff; font-size: 14px;">
                            <strong>Note:</strong> This user will be automatically approved and can log in immediately. 
                            They will receive a welcome email with login instructions.
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 12px; justify-content: flex-end;">
                    <a href="{{ route('admin.users') }}" 
                       style="padding: 12px 24px; background: #6c757d; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                        Cancel
                    </a>
                    <button type="submit" 
                            style="padding: 12px 24px; background: var(--accent); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>