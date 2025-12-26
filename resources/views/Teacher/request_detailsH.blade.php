<x-teacher-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <a href="{{ route('teacher.history') }}" style="display:inline-block;margin-bottom:18px;color:var(--accent);text-decoration:none;">← Back to my history</a>

    <div class="container" style="max-width:960px;margin:10px auto 40px;padding:18px;background:transparent;">
        <h1 style="font-size:26px;color:var(--accent);margin-bottom:6px;">Request #{{ $request->id }}</h1>
        <div style="color:#7b8aa3;margin-bottom:18px;">Created: {{ $request->created_at->format('d M Y H:i') }}</div>

        <div style="display:grid;grid-template-columns:1fr 360px;gap:18px;align-items:start;">
            {{-- Left: request summary & notes --}}
            <div style="background:#fff;border:1px solid #e6eef6;border-radius:12px;padding:16px;">
                <div style="font-weight:700;color:var(--accent);font-size:18px;">
                    {{ optional($request->subject)->name ?? '— Subject —' }}
                </div>
                <div style="color:var(--text);margin-top:6px;">
                    Experiment: 
                    @if($request->custom_experiment_name)
                        <span style="background:#667eea;color:white;padding:3px 8px;border-radius:6px;font-size:12px;font-weight:600;">CUSTOM</span>
                        {{ $request->custom_experiment_name }}
                    @else
                        {{ optional($request->experiment)->name ?? '— No experiment —' }}
                    @endif
                </div>

                <div style="display:flex;gap:12px;margin-top:12px;flex-wrap:wrap;">
                    <div>
                        <div style="font-size:12px;color:var(--text);">Students</div>
                        <div style="font-weight:600;">{{ $request->num_students }}</div>
                    </div>
                    <div>
                        <div style="font-size:12px;color:var(--text);">Group size</div>
                        <div style="font-weight:600;">{{ $request->group_size }}</div>
                    </div>
                    <div>
                        <div style="font-size:12px;color:var(--text);">Date</div>
                        <div style="font-weight:600;">{{ \Carbon\Carbon::parse($request->preferred_date)->format('d M Y') }}</div>
                    </div>
                    <div>
                        <div style="font-size:12px;color:var(--text);">Time</div>
                        <div style="font-weight:600;">{{ \Carbon\Carbon::parse($request->preferred_time)->format('H:i') }}</div>
                    </div>
                </div>

                @if($request->additional_notes)
                    <div style="margin-top:14px;padding:12px;background:#f5f8ff;border-radius:8px;">
                        <strong>Additional notes</strong>
                        <div style="margin-top:6px;color:#415A77;">{{ $request->additional_notes }}</div>
                    </div>
                @endif
            </div>

            {{-- Right: status card --}}
            <div style="background:#fff;border:1px solid #e6eef6;border-radius:12px;padding:16px;">
                <div style="font-size:12px;color:#7b8aa3;">Status</div>
                <div style="font-weight:700;margin-top:6px;color:
                    @if($request->status === 'pending') #e59a00
                    @elseif($request->status === 'approved') #0f9d58
                    @elseif($request->status === 'rejected') #e02f2f
                    @else #415A77 @endif;
                ">{{ ucfirst($request->status) }}</div>
                <div style="margin-top:10px;font-size:12px;color:#8b9bb3;">
                    Request ID: {{ $request->id }}
                </div>
            </div>
        </div>

        {{-- Materials & Apparatus --}}
        <div style="display:grid;grid-template-columns:1fr 1fr; gap:18px; margin-top:22px;">
            <div style="background:#fff;border:1px solid #e6eef6;border-radius:12px;padding:16px;">
                <h3 style="margin:0 0 12px 0;color:#415A77;">Required Materials</h3>

                @if($materials->isEmpty())
                    <div style="color:#999;font-style:italic;padding:18px;border-radius:8px;background:#fbfcff;">No materials found for this experiment.</div>
                @else
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;">
                        @foreach($materials as $m)
                            <li style="background:#f8f9fa;padding:10px;border-radius:8px;display:flex;justify-content:space-between;align-items:center;">
                                <div style="font-weight:600;color:#243444;">{{ $m->name }}</div>
                                <div style="font-weight:700;color:var(--accent);">{{ $m->quantity }} {{ $m->unit ?? '' }}</div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div style="background:#fff;border:1px solid #e6eef6;border-radius:12px;padding:16px;">
                <h3 style="margin:0 0 12px 0;color:#415A77;">Required Apparatus</h3>

                @if($apparatuses->isEmpty())
                    <div style="color:#999;font-style:italic;padding:18px;border-radius:8px;background:#fbfcff;">No apparatus found for this experiment.</div>
                @else
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;">
                        @foreach($apparatuses as $a)
                            <li style="background:#f8f9fa;padding:10px;border-radius:8px;display:flex;justify-content:space-between;align-items:center;">
                                <div style="font-weight:600;color:#243444;">{{ $a->name }}</div>
                                <div style="font-weight:700;color:var(--accent);">{{ $a->quantity }}</div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

</x-teacher-layout>
