<x-teacher-layout>

    <div style="max-width:1200px;margin:20px auto;padding:0 16px;">
        
        <!-- Welcome Header -->
        <div style="background: linear-gradient(135deg, var(--accent) 0%, var(--accentlight) 100%); border-radius: 16px; padding: 40px 35px; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(25, 71, 174, 0.15); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
            <div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            
            <div style="position: relative; z-index: 1;">
                <div style="font-size: 16px; color: rgba(255,255,255,0.9); font-weight: 600; margin-bottom: 8px;">
                    {{ now()->format('l, d F Y') }}
                </div>
                <h1 style="margin: 0; font-size: 36px; color: white; font-weight: 800; margin-bottom: 10px;">
                    Welcome Back, {{ auth()->user()->name }}! 👋
                </h1>
                <p style="margin: 0; color: rgba(255,255,255,0.95); font-size: 16px; max-width: 600px;">
                    Ready to manage your laboratory sessions? Here's your dashboard overview.
                </p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <!-- Total Requests -->
            <div style="background: linear-gradient(-130deg, var(--page-bg) 0%, #ffffff 100%); border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-left: 4px solid var(--accent); transition: all 0.3s ease;">
                <div style="display: flex; justify-content: end; align-items: start; margin-bottom: 16px;">
                    
                    <div style="text-align: right;">
                        <div style="font-size: 32px; font-weight: 800; color: var(--accent); line-height: 1;">
                            {{ $stats['total'] ?? 0 }}
                        </div>
                        <div style="font-size: 13px; color: var(--muted); font-weight: 600; margin-top: 4px;">
                            Total Requests
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending -->
            <div style="background: linear-gradient(-130deg, var(--page-bg) 0%, #ffffff 100%); border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-left: 4px solid #ffc107; transition: all 0.3s ease;">
                <div style="display: flex; justify-content: end; align-items: start; margin-bottom: 16px;">
                    <div style="text-align: right;">
                        <div style="font-size: 32px; font-weight: 800; color: #e59a00; line-height: 1;">
                            {{ $stats['pending'] ?? 0 }}
                        </div>
                        <div style="font-size: 13px; color: var(--muted); font-weight: 600; margin-top: 4px;">
                            Pending
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approved -->
            <div style="background: linear-gradient(-130deg, var(--page-bg) 0%, #ffffff 100%); border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-left: 4px solid #28a745; transition: all 0.3s ease;">
                <div style="display: flex; justify-content: end; align-items: start; margin-bottom: 16px;">
                    <div style="text-align: right;">
                        <div style="font-size: 32px; font-weight: 800; color: #0f9d58; line-height: 1;">
                            {{ $stats['approved'] ?? 0 }}
                        </div>
                        <div style="font-size: 13px; color: var(--muted); font-weight: 600; margin-top: 4px;">
                            Approved
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rejected -->
            <div style="background: linear-gradient(-130deg, var(--page-bg) 0%, #ffffff 100%); border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-left: 4px solid #dc3545; transition: all 0.3s ease;">
                <div style="display: flex; justify-content: end; align-items: start; margin-bottom: 16px;">
                    <div style="text-align: right;">
                        <div style="font-size: 32px; font-weight: 800; color: #e02f2f; line-height: 1;">
                            {{ $stats['rejected'] ?? 0 }}
                        </div>
                        <div style="font-size: 13px; color: var(--muted); font-weight: 600; margin-top: 4px;">
                            Rejected
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 30px;">
            
            <!-- Quick Actions -->
            <div style="background: white; border-radius: 12px; padding: 28px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                <h2 style="margin: 0 0 20px 0; font-size: 20px; color: var(--accent); font-weight: 700; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 24px;">⚡</span>
                    Quick Actions
                </h2>
                
                <div style="display: grid; gap: 12px;">
                    <a href="{{ route('teacher.requests') }}" style="display: flex; align-items: center; gap: 16px; padding: 18px; background: linear-gradient(135deg, var(--accent) 0%, var(--accentlight) 100%); border-radius: 10px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(25, 71, 174, 0.2);">
                        <div style="width: 45px; height: 45px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                            🔬
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 700; color: white; font-size: 16px;">New Lab Request</div>
                            <div style="font-size: 13px; color: rgba(255,255,255,0.9); margin-top: 2px;">Submit a new session</div>
                        </div>
                        <div style="color: white; font-size: 20px;">→</div>
                    </a>

                    <a href="{{ route('teacher.requests.list') }}" style="display: flex; align-items: center; gap: 16px; padding: 18px; background: #f8f9fa; border: 2px solid #e1e8ed; border-radius: 10px; text-decoration: none; transition: all 0.3s ease;">
                        <div style="width: 45px; height: 45px; background: var(--accentlight); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                            📋
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 700; color: var(--accent); font-size: 16px;">View My Requests</div>
                            <div style="font-size: 13px; color: var(--muted); margin-top: 2px;">Track your submissions</div>
                        </div>
                        <div style="color: var(--accent); font-size: 20px;">→</div>
                    </a>

                    <a href="{{ route('teacher.history') }}" style="display: flex; align-items: center; gap: 16px; padding: 18px; background: #f8f9fa; border: 2px solid #e1e8ed; border-radius: 10px; text-decoration: none; transition: all 0.3s ease;">
                        <div style="width: 45px; height: 45px; background: var(--accentlight); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                            🧾
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 700; color: var(--accent); font-size: 16px;">Request History</div>
                            <div style="font-size: 13px; color: var(--muted); margin-top: 2px;">Past lab sessions</div>
                        </div>
                        <div style="color: var(--accent); font-size: 20px;">→</div>
                    </a>
                </div>
            </div>

            <!-- Upcoming Sessions -->
            <div style="background: white; border-radius: 12px; padding: 28px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                <h2 style="margin: 0 0 20px 0; font-size: 20px; color: var(--accent); font-weight: 700; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 24px;">📅</span>
                    Upcoming Sessions
                </h2>

                @if(isset($upcomingSessions) && $upcomingSessions->isNotEmpty())
                    <div style="display: grid; gap: 12px; max-height: 320px; overflow-y: auto;">
                        @foreach($upcomingSessions as $session)
                            <div style="padding: 16px; background: linear-gradient(135deg, #f0f4f8 0%, #ffffff 100%); border-left: 4px solid var(--accent); border-radius: 8px;">
                                <div style="font-weight: 700; color: var(--accent); font-size: 15px; margin-bottom: 6px;">
                                    {{ optional($session->experiment)->name ?? 'Lab Session' }}
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--muted); margin-bottom: 4px;">
                                    <span>📅</span>
                                    <span>{{ \Carbon\Carbon::parse($session->approved_date ?? $session->preferred_date)->format('d M Y') }}</span>
                                    <span>•</span>
                                    <span>🕐</span>
                                    <span>{{ \Carbon\Carbon::parse($session->approved_time ?? $session->preferred_time)->format('H:i') }}</span>
                                </div>
                                <div style="font-size: 13px; color: var(--muted);">
                                    <span style="font-weight: 600;">Lab:</span> {{ $session->lab_number }} | 
                                    <span style="font-weight: 600;">Class:</span> {{ $session->classname }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 40px 20px; color: var(--muted);">
                        <div style="font-size: 48px; margin-bottom: 12px; opacity: 0.3;">📭</div>
                        <p style="margin: 0; font-size: 14px;">No upcoming sessions scheduled</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Activity -->
        <div style="background: white; border-radius: 12px; padding: 28px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="margin: 0; font-size: 20px; color: var(--accent); font-weight: 700; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 24px;">🕒</span>
                    Recent Activity
                </h2>
                <a href="{{ route('teacher.requests.list') }}" style="color: var(--accentlight); text-decoration: none; font-weight: 600; font-size: 14px;">
                    View All →
                </a>
            </div>

            @if(isset($recentRequests) && $recentRequests->isNotEmpty())
                <div style="display: grid; gap: 12px;">
                    @foreach($recentRequests->take(5) as $request)
                        <div style="display: flex; align-items: center; gap: 16px; padding: 16px; background: #f8f9fa; border-radius: 10px; transition: all 0.2s ease;">
                            <div style="width: 8px; height: 8px; border-radius: 50%; background: 
                                @if($request->status === 'pending') #ffc107
                                @elseif($request->status === 'approved') #28a745
                                @elseif($request->status === 'rejected') #dc3545
                                @else #6c757d @endif;
                            "></div>
                            
                            <div style="flex: 1;">
                                <div style="font-weight: 700; color: var(--accent); font-size: 15px; margin-bottom: 4px;">
                                    {{ optional($request->experiment)->name ?? 'Lab Request' }}
                                </div>
                                <div style="font-size: 13px; color: var(--muted);">
                                    {{ $request->classname }} • {{ \Carbon\Carbon::parse($request->preferred_date)->format('d M Y') }}
                                </div>
                            </div>
                            
                            <div style="text-align: right;">
                                <div style="display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; background: 
                                    @if($request->status === 'pending') #fff3cd; color: #856404
                                    @elseif($request->status === 'approved') #d4edda; color: #155724
                                    @elseif($request->status === 'rejected') #f8d7da; color: #721c24
                                    @else #e2e3e5; color: #383d41 @endif;
                                ">
                                    {{ ucfirst($request->status) }}
                                </div>
                                <div style="font-size: 11px; color: var(--muted); margin-top: 4px;">
                                    {{ $request->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 40px 20px; color: var(--muted);">
                    <div style="font-size: 48px; margin-bottom: 12px; opacity: 0.3;">📋</div>
                    <p style="margin: 0; font-size: 14px;">No recent activity</p>
                </div>
            @endif
        </div>

    </div>

    <style>
        @media (max-width: 768px) {
            div[style*="grid-template-columns: 1fr 1fr"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</x-teacher-layout>