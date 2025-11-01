<x-admin-layout>
    <style>
    .admin-btn {
        display: inline-block;
        padding: 12px 24px;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: background 0.3s ease-in, transform 0.15s;
    }

    
    .admin-btn:hover {
        transform: translateY(-2px);
        border:none;
        
    }
    .stat-card {
        transition: transform 0.15s, box-shadow 0.15s, border 0.15s;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        border:none;
        
    }


    /* Button-specific gradients */
    .btn-requests {
        background: var(--accent);
    }
    .btn-requests:hover {
        background: linear-gradient(135deg, var(--accent) 0%, #d09a00 100%);
    }

    .btn-pending {
        background: var(--accent);
    }
    .btn-pending:hover {
        background: linear-gradient(135deg, var(--accent) 0%, #b50023 100%);
    }

    .btn-users {
        background: var(--accent);
    }
    .btn-users:hover {
        background: linear-gradient(135deg, var(--accent) 0%, #0097b3 100%);
    }

    .btn-create {
        background: var(--accentlight);
    }
    .btn-create:hover {
        background: var(--accent);
    }
    </style>
    <div style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">
        <h1 style="margin:20px;font-size:32px;color:var(--accent);font-weight:700;">Admin Dashboard</h1>
        
        <!-- Stats Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
            <div class="stat-card" style="background: linear-gradient(135deg, var(--accent) 0%, #00D4FF 100%); color: white; padding: 24px; border-radius: 12px;">
                <div style="font-size: 40px; font-weight: 700;">{{ $stats['total_users'] }}</div>
                <div style="margin-top: 8px; opacity: 0.9;">Total Users</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, var(--accent) 0%, #1E90FF 100%); color: white; padding: 24px; border-radius: 12px;">
                <div style="font-size: 40px; font-weight: 700;">{{ $stats['teachers'] }}</div>
                <div style="margin-top: 8px; opacity: 0.9;">Teachers</div>
            </div>

            <div class="stat-card" style="background: linear-gradient(135deg, var(--accent) 0%, #00F5A0 100%); color: white; padding: 24px; border-radius: 12px;">
                <div style="font-size: 40px; font-weight: 700;">{{ $stats['lab_assistants'] }}</div>
                <div style="margin-top: 8px; opacity: 0.9;">Lab Assistants</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, var(--accent) 0%, #FF0033 100%); color: white; padding: 24px; border-radius: 12px;">
                <div style="font-size: 40px; font-weight: 700;">{{ $stats['pending_approvals'] }}</div>
                <div style="margin-top: 8px; opacity: 0.9;">Pending Approvals</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, var(--accent) 0%, #FFB800 100%); color: white; padding: 24px; border-radius: 12px;">
                <div style="font-size: 40px; font-weight: 700;">{{ $stats['pending_requests'] }}</div>
                <div style="margin-top: 8px; opacity: 0.9;">Pending Requests</div>
            </div>

            <div class="stat-card" style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%); color: white; padding: 24px; border-radius: 12px;">
                <div style="font-size: 40px; font-weight: 700;">{{ $stats['upcoming_sessions'] }}</div>
                <div style="margin-top: 8px; opacity: 0.9;">Upcoming Sessions</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="background: linear-gradient(90deg, var(--accent) 0%, var(--accentlight) 100%); padding: 24px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h2 style="margin:5px;font-size:28px;color:white;font-weight:700;">Quick Actions</h2>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('admin.requests') }}" class="admin-btn btn-requests">
                    View Lab Requests
                </a>

                <a href="{{ route('admin.users', ['status' => 'pending']) }}" class="admin-btn btn-pending">
                    View Pending Approvals
                </a>

                <a href="{{ route('admin.users') }}" class="admin-btn btn-users">
                    Manage All Users
                </a>

                <a href="{{ route('admin.users.create') }}" class="admin-btn btn-create">
                    + Create New User
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>