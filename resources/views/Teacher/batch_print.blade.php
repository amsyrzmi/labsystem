<x-teacher-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div style="max-width:800px;margin:20px auto;padding:0 16px;">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:18px;">
            <h1 style="margin:0;font-size:32px;color:var(--accent);font-weight:700;">Batch Print Requests</h1>
            <a href="{{ route('teacher.history') }}" class="btnbackmain" style="
                display:inline-block;
                padding:10px 16px;
                border-radius:10px;
                background:var(--accent);
                color:white;
                font-weight:700;
                text-decoration:none;
            ">
                Back
            </a>
        </div>

        <div class="container" style="background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
            <h2 style="color: var(--accent); margin-bottom: 24px; font-size: 24px;">Select Date Range and Filters</h2>

            <form method="POST" action="{{ route('teacher.print.batch.process') }}" target="_blank">
                @csrf

                <div class="form-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 20px;">
                    <!-- Start Date -->
                    <div class="input-group">
                        <label for="start_date" style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text);">
                            Start Date <span style="color: #e02f2f;">*</span>
                        </label>
                        <input type="date" 
                               id="start_date" 
                               name="start_date" 
                               required
                               style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 14px;">
                    </div>

                    <!-- End Date -->
                    <div class="input-group">
                        <label for="end_date" style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text);">
                            End Date <span style="color: #e02f2f;">*</span>
                        </label>
                        <input type="date" 
                               id="end_date" 
                               name="end_date" 
                               required
                               style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 14px;">
                    </div>

                    <!-- Status Filter -->
                    <div class="input-group">
                        <label for="status" style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text);">
                            Status (Optional)
                        </label>
                        <select id="status" 
                                name="status" 
                                style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 14px; background: white;">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="no_show">No Show</option>
                        </select>
                    </div>

                    <!-- Lab Number Filter -->
                    <div class="input-group">
                        <label for="lab_number" style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text);">
                            Lab Number (Optional)
                        </label>
                        <select id="lab_number" 
                                name="lab_number" 
                                style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 14px; background: white;">
                            <option value="">All Labs</option>
                            @foreach($labNumbers as $lab)
                                <option value="{{ $lab }}">{{ $lab }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Quick Date Presets -->
                <div style="margin-bottom: 30px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 12px; color: var(--text);">
                        Quick Select:
                    </label>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button type="button" class="preset-btn" data-range="this-week" style="padding: 8px 16px; background: #f0f4f8; border: 2px solid #e1e8ed; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;">
                            This Week
                        </button>
                        <button type="button" class="preset-btn" data-range="last-week" style="padding: 8px 16px; background: #f0f4f8; border: 2px solid #e1e8ed; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;">
                            Last Week
                        </button>
                        <button type="button" class="preset-btn" data-range="this-month" style="padding: 8px 16px; background: #f0f4f8; border: 2px solid #e1e8ed; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;">
                            This Month
                        </button>
                        <button type="button" class="preset-btn" data-range="last-month" style="padding: 8px 16px; background: #f0f4f8; border: 2px solid #e1e8ed; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;">
                            Last Month
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <div style="text-align: center;">
                    <button type="submit" style="padding: 14px 32px; background: var(--accent); color: white; border: none; border-radius: 10px; font-weight: 700; font-size: 16px; cursor: pointer; transition: all 0.2s;">
                        🖨️ Generate Print Preview
                    </button>
                </div>
            </form>
        </div>
    </div>

    
    <script>
    // Quick date presets
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const range = this.dataset.range;
            const today = new Date();
            let startDate, endDate;

            switch(range) {
                case 'this-week': {
                    // Start of this week (Monday)
                    startDate = new Date(today);
                    const dayOfWeek = startDate.getDay();
                    const diff = dayOfWeek === 0 ? -6 : 1 - dayOfWeek; // Adjust to Monday
                    startDate.setDate(startDate.getDate() + diff);

                    // End of this week (Sunday)
                    endDate = new Date(startDate);
                    endDate.setDate(startDate.getDate() + 6);
                    break;
                }

                case 'last-week': {
                    // Start of last week (previous Monday)
                    startDate = new Date(today);
                    const dayOfWeek = startDate.getDay();
                    const diffToThisWeekMonday = dayOfWeek === 0 ? -6 : 1 - dayOfWeek;
                    // Move to this week's Monday, then back 7 days
                    startDate.setDate(startDate.getDate() + diffToThisWeekMonday - 7);

                    // End of last week (Sunday)
                    endDate = new Date(startDate);
                    endDate.setDate(startDate.getDate() + 6);
                    break;
                }
                case 'this-month':{
                    // First day of current month
                    startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                    
                    // Last day of current month
                    endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                    break;
                }


                case 'last-month': {
                    // First day of previous month
                    startDate = new Date(today.getFullYear(), today.getMonth() - 1, 1);

                    // Last day of previous month
                    endDate = new Date(today.getFullYear(), today.getMonth(), 0);
                    break;
                }

                case 'next-month': {
                    // First day of next month
                    startDate = new Date(today.getFullYear(), today.getMonth() + 1, 1);

                    // Last day of next month
                    endDate = new Date(today.getFullYear(), today.getMonth() + 2, 0);
                    break;
                }

                case 'this-year': {
                    // Entire previous calendar year
                    const thisYear = today.getFullYear();
                    startDate = new Date(thisYear, 0, 1); 
                    endDate = new Date(thisYear, 11, 31);   
                    break;
                }
                case 'last-year': {
                    // Entire previous calendar year
                    const lastYear = today.getFullYear() - 1;
                    startDate = new Date(lastYear, 0, 1);   // Jan 1 of last year
                    endDate = new Date(lastYear, 11, 31);   // Dec 31 of last year
                    break;
                }

                default:
                    return; // unknown range
            }

            // Format dates to YYYY-MM-DD
            const formatDate = (date) => {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };

            document.getElementById('start_date').value = formatDate(startDate);
            document.getElementById('end_date').value = formatDate(endDate);

            // Highlight selected button
            document.querySelectorAll('.preset-btn').forEach(b => {
                b.style.background = '#f0f4f8';
                b.style.borderColor = '#e1e8ed';
                b.style.color = ''; // reset color
            });
            this.style.background = 'var(--accent)';
            this.style.borderColor = 'var(--accent)';
            this.style.color = 'white';
        });
    });

    // Validate end date is after start date
    document.getElementById('end_date').addEventListener('change', function() {
        const startVal = document.getElementById('start_date').value;
        if (!startVal) return;
        const startDate = new Date(startVal);
        const endDate = new Date(this.value);

        if (endDate < startDate) {
            alert('End date must be after start date');
            this.value = '';
        }
    });
</script>


    <style>
        .preset-btn:hover {
            background: var(--accentlight) !important;
            border-color: var(--accentlight) !important;
            color: white !important;
            transform: translateY(-2px);
        }
    </style>
</x-teacher-layout>