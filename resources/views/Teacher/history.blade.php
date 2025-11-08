<x-teacher-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div style="max-width:1100px;margin:20px auto;padding:0 16px;">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:18px;">
            <h1 style="margin:0;font-size:32px;color:var(--accent);font-weight:700;">Requests History</h1>
            <div style="display:flex;gap:10px;">
                <a href="{{ route('teacher.print.batch') }}" class="btn-batch-print" style="
                    display:inline-block;
                    padding:10px 16px;
                    border-radius:10px;
                    background:var(--accent);
                    color:white;
                    font-weight:700;
                    text-decoration:none;
                "> 
                    🖨️ Batch Print
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div style="background: transparent; padding: 20px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
            <form method="GET" action="{{ route('teacher.history') }}" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: end;">
                <!-- Search -->
                <div style="flex: 1; min-width: 250px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: var(--text); font-size: 14px;">Search</label>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Class..." 
                           style="width: 100%; padding: 10px 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 14px;">
                </div>

                <!-- Status Filter -->
                <div style="min-width: 150px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: var(--text); font-size: 14px;">Status</label>
                    <select name="status" style="background:var(--accent);color:var(--page-bg);width: 100%; padding: 10px 12px; border: 2px solid var(--accent); border-radius: 8px; font-size: 14px;">
                        <option value="">All Status</option>
                        <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="no_show" {{ $status === 'no_show' ? 'selected' : '' }}>No show</option>
                    </select>
                </div>

                <!-- Lab Number Filter -->
                <div style="min-width: 150px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: var(--text); font-size: 14px;">Lab</label>
                    <select name="lab_number" style="background:var(--accent);color:var(--page-bg);width: 100%; padding: 10px 12px; border: 2px solid var(--accent); border-radius: 8px; font-size: 14px;">
                        <option value="">All Labs</option>
                        @foreach($labNumbers as $lab)
                            <option value="{{ $lab }}" {{ $labNumber === $lab ? 'selected' : '' }}>{{ $lab }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 8px;">
                    <button type="submit" style="padding: 10px 20px; background: var(--accentlight); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Filter
                    </button>
                    <a href="{{ route('teacher.history') }}" style="padding: 10px 20px; background: var(--muted); color: white; border-radius: 8px; text-decoration: none; display: inline-block; font-weight: 600;">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="container no-shadow" style="max-width: 1100px; margin: 0 auto;">
            @if(session('success'))
                <div style="background:#e6ffed;padding:12px;border-radius:8px;margin-bottom:18px;color:#1f8a46;">
                    {{ session('success') }}
                </div>
            @endif

            @if($requests->isEmpty())
                <div style="text-align:center;padding:40px;border-radius:12px;background:#f8f9fa;color:#666;">
                    No history found
                </div>
            @else
                <div style="display:grid;grid-template-columns:1fr;gap:18px;">
                    @foreach($requests as $r)
                        <div class="request-card" style="
                            background: linear-gradient(130deg, var(--page-bg) 0%, #ffffff 100%);
                            border: 1px solid #e6eef6;
                            border-radius: 12px;
                            padding: 18px;
                            box-shadow: 0 6px 18px rgba(30,60,90,0.06);
                            ">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                                <div>
                                    <div style="font-weight:700;font-size:18px;color:var(--accent);">
                                        {{ optional($r->subject)->name ?? '— No subject —' }}
                                    </div>
                                    <div style="margin-top:4px;color:var(--text);font-size:14px;">
                                        Experiment: {{ optional($r->experiment)->name ?? '— No experiment selected —' }}
                                    </div>
                                </div>

                                <div style="text-align:right;">
                                    <div style="font-weight:700;color:
                                        @if($r->status === 'pending') #e59a00
                                        @elseif($r->status === 'approved') #0f9d58
                                        @elseif($r->status === 'rejected') #e02f2f
                                        @elseif($r->status === 'completed') #1976d2
                                        @elseif($r->status === 'cancelled') #9e9e9e
                                        @elseif($r->status === 'no_show') #ff6f00
                                        @else #415A77 @endif;
                                        ">
                                        {{ ucfirst(str_replace('_', ' ', $r->status)) }}
                                    </div>
                                    <div style="font-size:12px;color:#8b9bb3;margin-top:6px;">
                                        #{{ $r->id }} • {{ $r->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            </div>

                            <hr style="border:none;border-top:1px solid #eef4fb;margin:12px 0;">

                            <div style="display:flex;gap:5px;flex-wrap:wrap;">
                                <div style="flex:1;min-width:140px;">
                                    <div style="font-size:12px;color:var(--text);">Students</div>
                                    <div style="font-weight:600;color:var(--accent);">{{ $r->num_students ?? '—' }}</div>
                                </div>

                                <div style="flex:1;min-width:140px;">
                                    <div style="font-size:12px;color:var(--text);">Lab Number</div>
                                    <div style="font-weight:600;color:var(--accent);">{{ $r->lab_number ?? '—' }}</div>
                                </div>

                                <div style="flex:1;min-width:140px;">
                                    <div style="font-size:12px;color:var(--text);">Class Name</div>
                                    <div style="font-weight:600;color:var(--accent);">{{ $r->classname ?? '—' }}</div>
                                </div>

                                <div style="flex:1;min-width:140px;">
                                    <div style="font-size:12px;color:var(--text);">Group size</div>
                                    <div style="font-weight:600;color:var(--accent);">{{ $r->group_size ?? '—' }}</div>
                                </div>

                                <div style="flex:1;min-width:160px;">
                                    <div style="font-size:12px;color:var(--text);">Date</div>
                                    <div style="font-weight:600;color:var(--accent);">
                                        {{ optional($r->preferred_date)->format('d M Y') ?? \Carbon\Carbon::parse($r->preferred_date)->format('d M Y') }}
                                    </div>
                                </div>

                                <div style="flex:1;min-width:120px;">
                                    <div style="font-size:12px;color:var(--text);">Time</div>
                                    <div style="font-weight:600;color:var(--accent);">
                                        {{ \Carbon\Carbon::parse($r->preferred_time)->format('H:i') }}
                                    </div>
                                </div>
                            </div>

                            @if($r->additional_notes)
                                 <div style="margin-top:12px;padding:10px;background:linear-gradient(150deg, var(--accentlight) 0%, #ffffff 100%);border-radius:8px;color:white;font-size:14px;border-left:6px solid var(--accent);">
                                    <strong>Notes:</strong> {{ $r->additional_notes }}
                                </div>
                            @endif
                            
                            

                            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:14px;gap:10px;">
                                <a href="{{ route('teacher.requests.detailsH', $r->id) }}" class="btn-details">
                                    Details
                                </a>
                                <a href="{{ route('teacher.print.request', $r->id) }}" target="_blank" class="btn-print">
                                    🖨️ Print
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <div style="margin-top: 24px;">
                    {{ $requests->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .btn-details {
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid #e1e8ed;
            background: var(--accent);
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .btn-details:hover {
            background:var(--accentlight); 
            transform: translateY(-2px); 
            box-shadow: 0 6px 18px rgba(66,102,178,0.08);
        }
        .btn-print {
            padding: 10px 14px;
            border-radius: 10px;
            background: var(--accent);
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .btn-print:hover {
            background: var(--accentlight);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(16,185,129,0.3);
        }
        .btn-new-request:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 8px 24px rgba(65,90,119,0.15); 
        }
        .btn-batch-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(16,185,129,0.3);
            background: var(--accentlight);
        }
    </style>
</x-teacher-layout>
