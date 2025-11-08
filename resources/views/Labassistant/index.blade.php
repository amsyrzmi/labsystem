<x-lab-assistant-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/lab-assistant.css')

    <div class="container no-shadow" style="max-width:1200px;margin:20px auto;padding:0 16px;">
        
        <!-- Welcome Header -->
        <div style="background: linear-gradient(135deg, var(--accent) 0%, var(--accentlight) 100%); border-radius: 16px; padding: 40px 35px; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(25, 71, 174, 0.15); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
            <div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            
            <div style="position: relative; z-index: 1;">
                <div style="font-size: 16px; color: rgba(255,255,255,0.9); font-weight: 600; margin-bottom: 8px;">
                    {{ now()->format('l, d F Y') }}
                </div>
                <h1 style="margin: 0; font-size: 36px; color: white; font-weight: 800; margin-bottom: 10px;">
                    Welcome Back, {{ auth()->user()->name }}! 🔬
                </h1>
                <p style="margin: 0; color: rgba(255,255,255,0.95); font-size: 16px; max-width: 600px;">
                    Manage laboratory requests, approve sessions, and maintain lab schedules efficiently.
                </p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <!-- Pending Requests -->
            <div style="background:  linear-gradient(-130deg, var(--page-bg) 0%, #ffffff 100%); border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-left: 4px solid #ffc107; transition: all 0.3s ease;">
                <div style="display: flex; justify-content: end; align-items: start; margin-bottom: 16px;">
                    <div style="text-align: right;">
                        <div style="font-size: 32px; font-weight: 800; color: #e59a00; line-height: 1;">
                            {{ $stats['pending'] ?? 0 }}
                        </div>
                        <div style="font-size: 13px; color: var(--muted); font-weight: 600; margin-top: 4px;">
                            Pending Review
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approved Today -->
            <div style="background:  linear-gradient(-130deg, var(--page-bg) 0%, #ffffff 100%); border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-left: 4px solid #28a745; transition: all 0.3s ease;">
                <div style="display: flex; justify-content: end; align-items: start; margin-bottom: 16px;">
                    <div style="text-align: right;">
                        <div style="font-size: 32px; font-weight: 800; color: #0f9d58; line-height: 1;">
                            {{ $stats['approved_today'] ?? 0 }}
                        </div>
                        <div style="font-size: 13px; color: var(--muted); font-weight: 600; margin-top: 4px;">
                            Approved Today
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Sessions -->
            <div style="background:  linear-gradient(-130deg, var(--page-bg) 0%, #ffffff 100%); border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-left: 4px solid var(--accent); transition: all 0.3s ease;">
                <div style="display: flex; justify-content: end; align-items: start; margin-bottom: 16px;">
                    <div style="text-align: right;">
                        <div style="font-size: 32px; font-weight: 800; color: var(--accent); line-height: 1;">
                            {{ $stats['today_sessions'] ?? 0 }}
                        </div>
                        <div style="font-size: 13px; color: var(--muted); font-weight: 600; margin-top: 4px;">
                            Today's Sessions
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Active -->
            <div style="background:  linear-gradient(-130deg, var(--page-bg) 0%, #ffffff 100%); border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-left: 4px solid #6c757d; transition: all 0.3s ease;">
                <div style="display: flex; justify-content: end; align-items: start; margin-bottom: 16px;">
                    <div style="text-align: right;">
                        <div style="font-size: 32px; font-weight: 800; color: #495057; line-height: 1;">
                            {{ $stats['total_active'] ?? 0 }}
                        </div>
                        <div style="font-size: 13px; color: var(--muted); font-weight: 600; margin-top: 4px;">
                            Total Active
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
                    <a href="{{ route('lab_assistant.requests.list') }}" style="display: flex; align-items: center; gap: 16px; padding: 18px; background: linear-gradient(135deg, var(--accent) 0%, var(--accentlight) 100%); border-radius: 10px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(25, 71, 174, 0.2);">

                        <div style="flex: 1;">
                            <div style="font-weight: 700; color: white; font-size: 16px;">Review Requests</div>
                            <div style="font-size: 13px; color: rgba(255,255,255,0.9); margin-top: 2px;">Process pending requests</div>
                        </div>
                        <div style="color: white; font-size: 20px;">→</div>
                    </a>

                    <a href="{{ route('lab_assistant.timetable') }}" style="display: flex; align-items: center; gap: 16px; padding: 18px; background: #f8f9fa; border: 2px solid #e1e8ed; border-radius: 10px; text-decoration: none; transition: all 0.3s ease;">

                        <div style="flex: 1;">
                            <div style="font-weight: 700; color: var(--accent); font-size: 16px;">Lab Timetable</div>
                            <div style="font-size: 13px; color: var(--muted); margin-top: 2px;">View weekly schedule</div>
                        </div>
                        <div style="color: var(--accent); font-size: 20px;">→</div>
                    </a>

                    <a href="{{ route('lab_assistant.history') }}" style="display: flex; align-items: center; gap: 16px; padding: 18px; background: #f8f9fa; border: 2px solid #e1e8ed; border-radius: 10px; text-decoration: none; transition: all 0.3s ease;">

                        <div style="flex: 1;">
                            <div style="font-weight: 700; color: var(--accent); font-size: 16px;">Request History</div>
                            <div style="font-size: 13px; color: var(--muted); margin-top: 2px;">View past sessions</div>
                        </div>
                        <div style="color: var(--accent); font-size: 20px;">→</div>
                    </a>

                    <a href="{{ route('lab_assistant.print.batch') }}" style="display: flex; align-items: center; gap: 16px; padding: 18px; background: #f8f9fa; border: 2px solid #e1e8ed; border-radius: 10px; text-decoration: none; transition: all 0.3s ease;">

                        <div style="flex: 1;">
                            <div style="font-weight: 700; color: var(--accent); font-size: 16px;">Batch Print</div>
                            <div style="font-size: 13px; color: var(--muted); margin-top: 2px;">Print multiple requests</div>
                        </div>
                        <div style="color: var(--accent); font-size: 20px;">→</div>
                    </a>
                </div>
            </div>

            <!-- Today's Schedule -->
            <div style="background: white; border-radius: 12px; padding: 28px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                <h2 style="margin: 0 0 20px 0; font-size: 20px; color: var(--accent); font-weight: 700; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 24px;">🕐</span>
                    Today's Schedule
                </h2>

                @if(isset($todaySessions) && $todaySessions->isNotEmpty())
                    <div style="display: grid; gap: 12px; max-height: 370px; overflow-y: auto;">
                        @foreach($todaySessions as $session)
                            <div style="padding: 16px; background: linear-gradient(135deg, #f0f4f8 0%, #ffffff 100%); border-left: 4px solid var(--accent); border-radius: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                                    <div style="font-weight: 700; color: var(--accent); font-size: 15px;">
                                        {{ \Carbon\Carbon::parse($session->approved_time ?? $session->preferred_time)->format('H:i') }}
                                    </div>
                                    <div style="display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; background: #e7f3ff; color: #2196F3;">
                                        Lab {{ $session->lab_number }}
                                    </div>
                                </div>
                                <div style="font-weight: 600; color: #1b263b; font-size: 14px; margin-bottom: 4px;">
                                    {{ optional($session->experiment)->name ?? 'Lab Session' }}
                                </div>
                                <div style="font-size: 13px; color: var(--muted);">
                                    <span style="font-weight: 600;">Teacher:</span> {{ optional($session->user)->name ?? 'N/A' }}
                                </div>
                                <div style="font-size: 13px; color: var(--muted);">
                                    <span style="font-weight: 600;">Class:</span> {{ $session->classname }} ({{ $session->num_students }} students)
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 40px 20px; color: var(--muted);">
                        <div style="font-size: 48px; margin-bottom: 12px; opacity: 0.3;">✅</div>
                        <p style="margin: 0; font-size: 14px;">No sessions scheduled for today</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Pending Requests & Lab Status -->
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-bottom: 30px;">
            
            <!-- Pending Requests -->
            <div style="background: white; border-radius: 12px; padding: 28px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 style="margin: 0; font-size: 20px; color: var(--accent); font-weight: 700; display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 24px;">⏳</span>
                        Pending Requests
                    </h2>
                    <a href="{{ route('lab_assistant.requests.list', ['status' => 'pending']) }}" style="color: var(--accentlight); text-decoration: none; font-weight: 600; font-size: 14px;">
                        View All →
                    </a>
                </div>

                @if(isset($pendingRequests) && $pendingRequests->isNotEmpty())
                    <div style="display: grid; gap: 12px;">
                        @foreach($pendingRequests->take(4) as $request)
                            <div style="display: flex; align-items: center; gap: 16px; padding: 16px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 10px; transition: all 0.2s ease;">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #ffc107 0%, #ffeb3b 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                    ⏳
                                </div>
                                
                                <div style="flex: 1; min-width: 0;">
                                    <div style="font-weight: 700; color: #856404; font-size: 15px; margin-bottom: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ optional($request->experiment)->name ?? 'Lab Request' }}
                                    </div>
                                    <div style="font-size: 13px; color: #856404; margin-bottom: 2px;">
                                        <strong>Teacher:</strong> {{ optional($request->user)->name ?? 'N/A' }}
                                    </div>
                                    <div style="font-size: 12px; color: #a67c00;">
                                        {{ \Carbon\Carbon::parse($request->preferred_date)->format('d M Y') }} • Lab {{ $request->lab_number }}
                                    </div>
                                </div>
                                
                                <a href="{{ route('lab_assistant.requests.details', $request->id) }}" style="padding: 8px 16px; background: #ffc107; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 13px; white-space: nowrap;">
                                    Review
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 40px 20px; color: var(--muted);">
                        <div style="font-size: 48px; margin-bottom: 12px; opacity: 0.3;">✅</div>
                        <p style="margin: 0; font-size: 14px;">All requests reviewed!</p>
                    </div>
                @endif
            </div>

            <!-- Lab Status Overview -->
            <div style="background: white; border-radius: 12px; padding: 28px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                <h2 style="margin: 0 0 20px 0; font-size: 20px; color: var(--accent); font-weight: 700; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 24px;">🧪</span>
                    Lab Status
                </h2>

                @if(isset($labStatus) && !empty($labStatus))
                    <div style="display: grid; gap: 12px;">
                        @foreach($labStatus as $lab)
                            <div style="padding: 14px; background: #f8f9fa; border-radius: 8px; border-left: 3px solid {{ $lab['sessions'] > 0 ? '#28a745' : '#e1e8ed' }};">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <div style="font-weight: 700; color: var(--accent); font-size: 15px;">
                                        {{ $lab['name'] }}
                                    </div>
                                    <div style="font-size: 18px; font-weight: 700; color: {{ $lab['sessions'] > 0 ? '#28a745' : '#9ca3af' }};">
                                        {{ $lab['sessions'] }}
                                    </div>
                                </div>
                                <div style="font-size: 12px; color: var(--muted);">
                                    {{ $lab['sessions'] }} {{ Str::plural('session', $lab['sessions']) }} today
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 30px 20px; color: var(--muted);">
                        <div style="font-size: 48px; margin-bottom: 12px; opacity: 0.3;">🔬</div>
                        <p style="margin: 0; font-size: 13px;">No lab data available</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Activity -->
        <div style="background: white; border-radius: 12px; padding: 28px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="margin: 0; font-size: 20px; color: var(--accent); font-weight: 700; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 24px;">📊</span>
                    Recent Activity
                </h2>
                <a href="{{ route('lab_assistant.requests.list') }}" style="color: var(--accentlight); text-decoration: none; font-weight: 600; font-size: 14px;">
                    View All →
                </a>
            </div>

            @if(isset($recentActivity) && $recentActivity->isNotEmpty())
                <div style="display: grid; gap: 10px;">
                    @foreach($recentActivity->take(6) as $activity)
                        <div style="display: flex; align-items: center; gap: 16px; padding: 14px; background: #f8f9fa; border-radius: 10px; transition: all 0.2s ease;">
                            <div style="width: 8px; height: 8px; border-radius: 50%; background: 
                                @if($activity->status === 'pending') #ffc107
                                @elseif($activity->status === 'approved') #28a745
                                @elseif($activity->status === 'rejected') #dc3545
                                @else #6c757d @endif;
                            "></div>
                            
                            <div style="flex: 1; min-width: 0;">
                                <div style="font-weight: 700; color: var(--accent); font-size: 14px; margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ optional($activity->experiment)->name ?? 'Lab Request' }}
                                </div>
                                <div style="font-size: 12px; color: var(--muted);">
                                    {{ optional($activity->user)->name ?? 'Unknown' }} • {{ $activity->classname }}
                                </div>
                            </div>
                            
                            <div style="text-align: right; flex-shrink: 0;">
                                <div style="display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; background: 
                                    @if($activity->status === 'pending') #fff3cd; color: #856404
                                    @elseif($activity->status === 'approved') #d4edda; color: #155724
                                    @elseif($activity->status === 'rejected') #f8d7da; color: #721c24
                                    @else #e2e3e5; color: #383d41 @endif;
                                ">
                                    {{ ucfirst($activity->status) }}
                                </div>
                                <div style="font-size: 10px; color: var(--muted); margin-top: 4px;">
                                    {{ $activity->created_at->diffForHumans() }}
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
            div[style*="grid-template-columns: 1fr 1fr"],
            div[style*="grid-template-columns: 2fr 1fr"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</x-lab-assistant-layout>