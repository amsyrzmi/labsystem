<x-admin-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div style="max-width:1200px;margin:20px auto;padding:0 16px;">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:18px;">
            <h1 style="margin:0;font-size:32px;color:white;font-weight:700;">All Lab Requests</h1>
        </div>

        <!-- Filters -->
        <div style="background: transparent; padding: 20px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
            <form method="GET" action="{{ route('admin.requests') }}" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: end;">
                <!-- Search -->
                <div style="flex: 1; min-width: 250px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #fff; font-size: 14px;">Search</label>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Teacher or class..." 
                           style="width: 100%; padding: 10px 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 14px;">
                </div>

                <!-- Status Filter -->
                <div style="min-width: 150px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #fff; font-size: 14px;">Status</label>
                    <select name="status" style="background:#0D1B2A;width: 100%; padding: 10px 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 14px;">
                        <option value="">All Status</option>
                        <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <!-- Lab Number Filter -->
                <div style="min-width: 150px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #fff; font-size: 14px;">Lab</label>
                    <select name="lab_number" style="background:#0D1B2A;width: 100%; padding: 10px 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 14px;">
                        <option value="">All Labs</option>
                        @foreach($labNumbers as $lab)
                            <option value="{{ $lab }}" {{ $labNumber === $lab ? 'selected' : '' }}>{{ $lab }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 8px;">
                    <button type="submit" style="padding: 10px 20px; background: #778DA9; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Filter
                    </button>
                    <a href="{{ route('admin.requests') }}" style="padding: 10px 20px; background: #6c757d; color: white; border-radius: 8px; text-decoration: none; display: inline-block; font-weight: 600;">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="container" style="max-width: 1200px; margin: 0 auto;">
            @if(session('success'))
                <div style="background:#e6ffed;padding:12px;border-radius:8px;margin-bottom:18px;color:#1f8a46;">
                    {{ session('success') }}
                </div>
            @endif

            @if($requests->isEmpty())
                <div style="text-align:center;padding:40px;border-radius:12px;background:#f8f9fa;color:#666;">
                    No lab requests found.
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
                                    <!-- NEW: Show Teacher Name -->
                                    <div style="margin-top:4px;color:#7b8aa3;font-size:14px;">
                                        👤 Teacher: <strong>{{ optional($r->user)->name ?? 'Unknown' }}</strong>
                                    </div>
                                </div>

                                <div style="text-align:right;">
                                    <div style="font-weight:700;color:
                                        @if($r->status === 'pending') #e59a00
                                        @elseif($r->status === 'approved') #0f9d58
                                        @elseif($r->status === 'rejected') #e02f2f
                                        @else #415A77 @endif;
                                        ">
                                        {{ ucfirst($r->status) }}
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
                                        {{ \Carbon\Carbon::parse($r->preferred_date)->format('d M Y') }}
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

                            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:14px;gap:10px;flex-wrap:wrap;">
                                <a href="{{ route('admin.requests.details', $r->id) }}" class="btn-details" style="
                                    display:inline-block;padding:10px 14px;border-radius:10px;border:1px solid #e1e8ed;
                                    background:white;color:#1b263b;text-decoration:none;font-weight:600;
                                    ">
                                    View Details
                                </a>

                                <!-- NEW: Admin Actions -->
                                <div style="display:flex;gap:8px;flex-wrap:wrap;">
                                    @if($r->status === 'approved')
                                        <form action="{{ route('admin.requests.complete', $r->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Mark as completed?')" style="padding:8px 14px;background:#28a745;color:white;border:none;border-radius:8px;cursor:pointer;font-weight:600;font-size:13px;">
                                                ✓ Complete
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.requests.noshow', $r->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Mark as no-show?')" style="padding:8px 14px;background:#ffc107;color:#000;border:none;border-radius:8px;cursor:pointer;font-weight:600;font-size:13px;">
                                                No Show
                                            </button>
                                        </form>
                                    @endif

                                    @if(in_array($r->status, ['pending', 'approved']))
                                        <form action="{{ route('admin.requests.cancel', $r->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Cancel this request?')" style="padding:8px 14px;background:#dc3545;color:white;border:none;border-radius:8px;cursor:pointer;font-weight:600;font-size:13px;">
                                                Cancel
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.requests.delete', $r->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete permanently?')" style="padding:8px 14px;background:#6c757d;color:white;border:none;border-radius:8px;cursor:pointer;font-weight:600;font-size:13px;">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div style="margin-top: 24px;">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .btn-details:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(66,102,178,0.08); }
    </style>
</x-admin-layout>