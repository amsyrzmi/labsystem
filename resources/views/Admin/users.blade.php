<x-admin-layout>
    <div class="admin-container">
        <div class="admin-header">
            <div>
                <h1 class="page-title" style="color:var(--accent)">Manage Users</h1>
                <p class="page-subtitle">Oversee account permissions and system access</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn-create">
                <span class="icon">+</span> Create New User
            </a>
        </div>

        @if(session('success') || session('error') || session('info'))
            <div class="alert-container">
                @if(session('success'))
                    <div class="alert alert-success"><b>✓</b> {{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error"><b>✗</b> {{ session('error') }}</div>
                @endif
            </div>
        @endif

        <div class="toolbar-card">
            <form method="GET" action="{{ route('admin.users') }}" class="filter-grid">
                <div class="input-group search">
                    <label>Search Directory</label>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Name, email, or staff ID...">
                </div>

                <div class="input-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="all" {{ $status === 'all' ? 'selected' : '' }}>All Statuses</option>
                        <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>⏳ Pending Approval</option>
                        <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>✅ Approved</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>Access Level</label>
                    <select name="role">
                        <option value="">All Roles</option>
                        <option value="teacher" {{ $role === 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="lab_assistant" {{ $role === 'lab_assistant' ? 'selected' : '' }}>Lab Assistant</option>
                        <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-filter" style="background:var(--accent)">Apply Filters</button>
                    <a href="{{ route('admin.users') }}" class="btn-reset">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-card">
            @if($users->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">👥</div>
                    <h3>No users matching your search</h3>
                    <p>Try adjusting your filters or clearing the search bar.</p>
                </div>
            @else
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>User Identification</th>
                            <th>Role</th>
                            <th>Account Status</th>
                            <th>Join Date</th>
                            <th style="text-align: right;">Management</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                        <div>
                                            <div class="user-name">{{ $user->name }}</div>
                                            <div class="user-email">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-badge role-{{ $user->role }}">
                                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->is_approved)
                                        <span class="status-indicator status-active">Active</span>
                                    @else
                                        <span class="status-indicator status-pending">Pending Approval</span>
                                    @endif
                                </td>
                                <td class="date-cell">{{ $user->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="action-flex">
                                        @if(!$user->is_approved)
                                            <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-icon approve" title="Approve User">✓</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-icon edit" title="Edit User">✎</a>
                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-icon delete" onclick="return confirm('Delete user?')" title="Delete User">🗑</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination-footer">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .admin-container { max-width: 1400px; margin: 40px auto; padding: 0 20px; font-family: 'Inter', sans-serif; }
        
        /* Header */
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-title { margin: 0; font-size: 28px; color: #1e293b; font-weight: 800; }
        .page-subtitle { margin: 4px 0 0 0; color: #64748b; font-size: 14px; }
        .btn-create { background: var(--accent); color: white; padding: 12px 24px; border-radius: 10px; text-decoration: none; font-weight: 600; transition: 0.2s; box-shadow: 0 4px 12px rgba(var(--accent-rgb), 0.2); }
        .btn-create:hover { opacity: 0.9; transform: translateY(-1px); }

        /* Toolbar */
        .toolbar-card { background: white; padding: 24px; border-radius: 16px; margin-bottom: 24px; border: 1px solid #e2e8f0; }
        .filter-grid { display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 20px; align-items: end; }
        .input-group label { display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #94a3b8; margin-bottom: 8px; letter-spacing: 0.5px; }
        .input-group input, .input-group select { width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #334155; }
        .btn-filter { background: #1e293b; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; }
        .btn-reset { color: #64748b; text-decoration: none; font-size: 14px; font-weight: 600; padding: 10px; }

        /* Table Structure */
        .table-card { background: white; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .modern-table { width: 100%; border-collapse: collapse; }
        .modern-table thead { background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
        .modern-table th { padding: 16px 24px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; }
        .modern-table td { padding: 16px 24px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }

        /* User Identity Cell */
        .user-info { display: flex; align-items: center; gap: 12px; }
        .user-avatar { width: 40px; height: 40px; background: var(--accent); color: #ffffff; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; }
        .user-name { font-weight: 700; color: #1e293b; font-size: 15px; }
        .user-email { font-size: 13px; color: #64748b; }

        /* Badges */
        .role-badge { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .role-admin { background: #fef2f2; color: #dc2626; }
        .role-teacher { background: #eff6ff; color: #2563eb; }
        .role-lab_assistant { background: #f0fdf4; color: #16a34a; }

        .status-indicator { display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; }
        .status-active::before { content: ""; width: 8px; height: 8px; background: #22c55e; border-radius: 50%; }
        .status-pending::before { content: ""; width: 8px; height: 8px; background: #eab308; border-radius: 50%; }

        /* Action Buttons */
        .action-flex { display: flex; gap: 8px; justify-content: flex-end; }
        .btn-icon { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: 0.2s; text-decoration: none; font-size: 16px; }
        .btn-icon.approve { background: #dcfce7; color: #16a34a; }
        .btn-icon.edit { background: #f1f5f9; color: #475569; }
        .btn-icon.delete { background: #fee2e2; color: #ef4444; }
        .btn-icon:hover { transform: scale(1.1); filter: brightness(0.95); }

        /* Alerts */
        .alert { padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
    </style>
</x-admin-layout>