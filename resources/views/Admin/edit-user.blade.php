<x-admin-layout>
    <div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
        <div style="margin-bottom: 24px;">
            <a href="{{ route('admin.users') }}" 
               style="display: inline-flex; align-items: center; gap: 8px; color: #fff; text-decoration: none; font-weight: 600;">
                ← Back to Users
            </a>
        </div>

        <div style="background: white; padding: 32px; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
            <h1 style="color: #1b263b; font-size: 28px; margin-bottom: 24px;">Edit User</h1>

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

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; font-weight: 600; margin-bottom: 8px; color: #415A77;">
                        Full Name *
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name) }}" 
                           required
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
                           value="{{ old('email', $user->email) }}" 
                           required
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
                        <option value="teacher" {{ old('role', $user->role) === 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="lab_assistant" {{ old('role', $user->role) === 'lab_assistant' ? 'selected' : '' }}>Lab Assistant</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <!-- Approval Status -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #415A77;">
                        Account Status
                    </label>
                    <div style="display: flex; gap: 20px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" 
                                   name="is_approved" 
                                   value="1" 
                                   {{ old('is_approved', $user->is_approved) ? 'checked' : '' }}
                                   style="width: 18px; height: 18px; cursor: pointer;">
                            <span style="color: #415A77;">Approved</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" 
                                   name="is_approved" 
                                   value="0" 
                                   {{ !old('is_approved', $user->is_approved) ? 'checked' : '' }}
                                   style="width: 18px; height: 18px; cursor: pointer;">
                            <span style="color: #415A77;">Pending</span>
                        </label>
                    </div>
                </div>

                <!-- User Info -->
                <div style="background: #f8f9fa; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                    <div style="font-size: 14px; color: #7b8aa3; margin-bottom: 8px;">
                        <strong>Account Created:</strong> {{ $user->created_at->format('d M Y, H:i') }}
                    </div>
                    @if($user->approved_at)
                        <div style="font-size: 14px; color: #7b8aa3; margin-bottom: 8px;">
                            <strong>Approved On:</strong> {{ $user->approved_at->format('d M Y, H:i') }}
                        </div>
                    @endif
                    @if($user->approvedBy)
                        <div style="font-size: 14px; color: #7b8aa3;">
                            <strong>Approved By:</strong> {{ $user->approvedBy->name }}
                        </div>
                    @endif
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 12px; justify-content: flex-end;">
                    <a href="{{ route('admin.users') }}" 
                       style="padding: 12px 24px; background: #6c757d; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                        Cancel
                    </a>
                    <button type="submit" 
                            style="padding: 12px 24px; background: #415A77; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Save Changes
                    </button>
                </div>
            </form>

            <!-- Password Reset Section -->
            <div style="margin-top: 40px; padding-top: 24px; border-top: 2px solid #e1e8ed;">
                <h3 style="color: #1b263b; margin-bottom: 12px;">Password Management</h3>
                <p style="color: #7b8aa3; margin-bottom: 16px;">
                    To reset the user's password, send them a password reset link via their email.
                </p>
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <button type="submit" 
                            style="padding: 10px 20px; background: #1B263B; color: #fff; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Send Password Reset Link
                    </button>
                </form>
            </div>

            <!-- Danger Zone -->
            <div style="margin-top: 40px; padding: 24px; background: #fff5f5; border: 2px solid #f5c6cb; border-radius: 8px;">
                <h3 style="color: #dc3545; margin-bottom: 12px;">Danger Zone</h3>
                <p style="color: #721c24; margin-bottom: 16px;">
                    Once you delete this user, there is no going back. Please be certain.
                </p>
                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you absolutely sure? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            style="padding: 10px 20px; background: #dc3545; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>