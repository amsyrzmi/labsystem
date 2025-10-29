<x-admin-layout>
    <div style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">
        <h1 style="color: White; font-size: 36px; margin-bottom: 30px;">Admin Dashboard</h1>
        
        <!-- Stats Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
            <div style="background: linear-gradient(135deg, #1B263B 0%, #415A77 100%); color: white; padding: 24px; border-radius: 12px;">
                <div style="font-size: 40px; font-weight: 700;">{{ $stats['total_users'] }}</div>
                <div style="margin-top: 8px; opacity: 0.9;">Total Users</div>
            </div>
            
            <div style="background: linear-gradient(135deg, #415A77 0%, #778DA9 100%); color: white; padding: 24px; border-radius: 12px;">
                <div style="font-size: 40px; font-weight: 700;">{{ $stats['pending_approvals'] }}</div>
                <div style="margin-top: 8px; opacity: 0.9;">Pending Approvals</div>
            </div>
            
            <div style="background: linear-gradient(135deg, #778DA9 0%, #E0E1DD 100%); color: white; padding: 24px; border-radius: 12px;">
                <div style="font-size: 40px; font-weight: 700;">{{ $stats['teachers'] }}</div>
                <div style="margin-top: 8px; opacity: 0.9;">Teachers</div>
            </div>
            
            <div style="background: linear-gradient(135deg, #0D1B2A 0%, #415A77 100%); color: white; padding: 24px; border-radius: 12px;">
                <div style="font-size: 40px; font-weight: 700;">{{ $stats['lab_assistants'] }}</div>
                <div style="margin-top: 8px; opacity: 0.9;">Lab Assistants</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="background: linear-gradient(135deg, #0D1B2A 0%, #415A77 100%);1DD 100%); padding: 24px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h2 style="margin-bottom: 20px; color: white;">Quick Actions</h2>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('admin.users', ['status' => 'pending']) }}" 
                   style="display: inline-block; padding: 12px 24px; background: #1B263B; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                    View Pending Approvals
                </a>
                <a href="{{ route('admin.users') }}" 
                   style="display: inline-block; padding: 12px 24px; background: #1B263B; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                    Manage All Users
                </a>
                <a href="{{ route('admin.users.create') }}" 
                   style="display: inline-block; padding: 12px 24px; background: #415A77; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                    + Create New User
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>