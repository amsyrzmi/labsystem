<x-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div style="max-width:1100px;margin:20px auto;padding:0 16px;">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:18px;">
            <h1 style="margin:0;font-size:32px;color:white;font-weight:700;">My Requests</h1>

            <a href="{{ route('teacher.requests') }}" class="btn-new-request" style="
                display:inline-block;
                padding:10px 16px;
                border-radius:10px;
                background:#415A77;
                color:white;
                font-weight:700;
                text-decoration:none;
            ">
                + New Request
            </a>
        </div>

        <div class="container" style="max-width: 1100px; margin: 0 auto;">
            @if(session('success'))
                <div style="background:#e6ffed;padding:12px;border-radius:8px;margin-bottom:18px;color:#1f8a46;">
                    {{ session('success') }}
                </div>
            @endif

            @if($requests->isEmpty())
                <div style="text-align:center;padding:40px;border-radius:12px;background:#f8f9fa;color:#666;">
                    You have not made any lab requests yet.
                </div>
            @else
                <div style="display:grid;grid-template-columns:1fr;gap:18px;">
                    @foreach($requests as $r)
                        <div class="request-card" style="
                            background: linear-gradient(180deg, #ffffff 0%, #f7fbff 100%);
                            border: 1px solid #e6eef6;
                            border-radius: 12px;
                            padding: 18px;
                            box-shadow: 0 6px 18px rgba(30,60,90,0.06);
                            ">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                                <div>
                                    <div style="font-weight:700;font-size:18px;color:#1b263b;">
                                        {{ optional($r->subject)->name ?? '— No subject —' }}
                                    </div>
                                    <div style="margin-top:4px;color:#415A77;font-size:14px;">
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
                                    <div style="font-size:12px;color:#7b8aa3;">Students</div>
                                    <div style="font-weight:600;color:#26394f;">{{ $r->num_students ?? '—' }}</div>
                                </div>

                                <div style="flex:1;min-width:140px;">
                                    <div style="font-size:12px;color:#7b8aa3;">Lab Number</div>
                                    <div style="font-weight:600;color:#26394f;">{{ $r->lab_number ?? '—' }}</div>
                                </div>

                                <div style="flex:1;min-width:140px;">
                                    <div style="font-size:12px;color:#7b8aa3;">Class Name</div>
                                    <div style="font-weight:600;color:#26394f;">{{ $r->classname ?? '—' }}</div>
                                </div>

                                <div style="flex:1;min-width:140px;">
                                    <div style="font-size:12px;color:#7b8aa3;">Group size</div>
                                    <div style="font-weight:600;color:#26394f;">{{ $r->group_size ?? '—' }}</div>
                                </div>

                                <div style="flex:1;min-width:160px;">
                                    <div style="font-size:12px;color:#7b8aa3;">Date</div>
                                    <div style="font-weight:600;color:#26394f;">
                                        {{ optional($r->preferred_date)->format('d M Y') ?? \Carbon\Carbon::parse($r->preferred_date)->format('d M Y') }}
                                    </div>
                                </div>

                                <div style="flex:1;min-width:120px;">
                                    <div style="font-size:12px;color:#7b8aa3;">Time</div>
                                    <div style="font-weight:600;color:#26394f;">
                                        {{ \Carbon\Carbon::parse($r->preferred_time)->format('H:i') }}
                                    </div>
                                </div>
                            </div>

                            @if($r->additional_notes)
                                <div style="margin-top:12px;padding:10px;background:#f5f8ff;border-radius:8px;color:#415A77;font-size:14px;">
                                    <strong>Notes:</strong> {{ $r->additional_notes }}
                                </div>
                            @endif

                            @if($r->rejection_reason !== null)
                                <div style="margin-top:12px;padding:10px;background:#f5f8ff;border-radius:8px;color:red;font-size:14px;">
                                    <strong>Reason: </strong> {{ $r->rejection_reason }}
                                </div>
                            @endif

                            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:14px;gap:10px;">
                                <a href="{{ route('teacher.requests.details', $r->id) }}" class="btn-details" style="
                                    display:inline-block;padding:10px 14px;border-radius:10px;border:1px solid #e1e8ed;
                                    background:white;color:#1b263b;text-decoration:none;font-weight:600;
                                    ">
                                    Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <style>
        .btn-details:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(66,102,178,0.08); }
        .btn-new-request:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(65,90,119,0.15); }
    </style>
</x-layout>
