<x-admin-layout>
    <div style="max-width: 1400px; margin: 40px auto; padding: 0 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h1 style="margin:0;font-size:32px;color:var(--accent);font-weight:700;">Manage Users</h1>
            <a href="{{ route('admin.users.create') }}" 
               style="display: inline-block; padding: 12px 24px; background: var(--accent); color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                + Create User
            </a>
        </div>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                ✗ {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div style="background: #d1ecf1; color: #0c5460; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #bee5eb;">
                ℹ {{ session('info') }}
            </div>
        @endif

        <!-- Filters -->
        <div style="background: white; padding: 20px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
            <form method="GET" action="{{ route('admin.users') }}" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: end;">
                <!-- Search -->
                <div style="flex: 1; min-width: 250px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #415A77; font-size: 14px;">Search</label>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Name or email..." 
                           style="color: #415A77;width: 100%; padding: 10px 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 14px;">
                </div>

                <!-- Status Filter -->
                <div style="min-width: 150px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #415A77; font-size: 14px;">Status</label>
                    <select name="status" style="width: 100%; padding: 10px 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 14px;color: #415A77;">
                        <option value="all" {{ $status === 'all' ? 'selected' : '' }}>All</option>
                        <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>Approved</option>
                    </select>
                </div>

                <!-- Role Filter -->
                <div style="min-width: 150px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #415A77; font-size: 14px;">Role</label>
                    <select name="role" style="width: 100%; padding: 10px 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 14px;color: #415A77;">
                        <option value="">All Roles</option>
                        <option value="teacher" {{ $role === 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="lab_assistant" {{ $role === 'lab_assistant' ? 'selected' : '' }}>Lab Assistant</option>
                        <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 8px;">
                    <button type="submit" style="padding: 10px 20px; background: var(--accent); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Filter
                    </button>
                    <a href="{{ route('admin.users') }}" style="padding: 10px 20px; background: var(--muted); color: white; border-radius: 8px; text-decoration: none; display: inline-block; font-weight: 600;">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Users Table -->
        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
            @if($users->isEmpty())
                <div style="padding: 60px 20px; text-align: center; color: #666;">
                    <div style="font-size: 48px; margin-bottom: 16px;">👥</div>
                    <p>No users found matching your criteria.</p>
                </div>
            @else
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: #f8f9fa;">
                        <tr>
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: var(--accentlight); border-bottom: 2px solid #e1e8ed;">User</th>
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: var(--accentlight); border-bottom: 2px solid #e1e8ed;">Role</th>
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: var(--accentlight); border-bottom: 2px solid #e1e8ed;">Status</th>
                            <th style="padding: 16px; text-align: left; font-weight: 600; color: var(--accentlight); border-bottom: 2px solid #e1e8ed;">Registered</th>
                            <th style="padding: 16px; text-align: center; font-weight: 600; color: var(--accentlight); border-bottom: 2px solid #e1e8ed;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr style="border-bottom: 1px solid #f0f4f8;">
                                <td style="padding: 16px;">
                                    <div style="font-weight: 600; color: #1b263b; margin-bottom: 2px;">{{ $user->name }}</div>
                                    <div style="font-size: 13px; color: #7b8aa3;">{{ $user->email }}</div>
                                </td>
                                <td style="padding: 16px;">
                                    <span style="display: inline-block; padding: 4px 12px; background: #415A77; color: #E0E1DD; border-radius: 12px; font-size: 13px; font-weight: 600;">
                                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                    </span>
                                </td>
                                <td style="padding: 16px;">
                                    @if($user->is_approved)
                                        <span style="display: inline-block; padding: 4px 12px; background: #d4edda; color: #155724; border-radius: 12px; font-size: 13px; font-weight: 600;">
                                            ✓ Approved
                                        </span>
                                    @else
                                        <span style="display: inline-block; padding: 4px 12px; background: #fff3cd; color: #856404; border-radius: 12px; font-size: 13px; font-weight: 600;">
                                            ⏳ Pending
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 16px; color: #7b8aa3; font-size: 14px;">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td style="padding: 16px;">
                                    <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                                        @if(!$user->is_approved)
                                            <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Approve this user?')" 
                                                        style="padding: 6px 12px; background: #28a745; color: white; border: none; border-radius: 6px; font-size: 13px; cursor: pointer; font-weight: 600;">
                                                    ✓ Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Reject this user?')" 
                                                        style="padding: 6px 12px; background: #dc3545; color: white; border: none; border-radius: 6px; font-size: 13px; cursor: pointer; font-weight: 600;">
                                                    ✗ Reject
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                                           style="padding: 6px 12px; background: var(--accent); color: white; border-radius: 6px; font-size: 13px; text-decoration: none; font-weight: 600;">
                                            Edit
                                        </a>
                                        
                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')" 
                                                    style="padding: 6px 12px; background: red; color: white; border: none; border-radius: 6px; font-size: 13px; cursor: pointer; font-weight: 600;">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div style="padding: 20px;">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>