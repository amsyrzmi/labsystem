
<x-teacher-layout>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Select Form & Subject</title>
    <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:18px;">
    <h1 style="margin:0;font-size:32px;color:white;font-weight:700;">Request A Lab</h1>
    <a href="{{ route('teacher.requests.list') }}" class="btn-new-request" style="
                display:inline-block;
                padding:10px 16px;
                border-radius:10px;
                background:#415A77;
                color:white;
                font-weight:700;
                text-decoration:none;
            ">
                Back
            </a>
  </div>
  <div class="container">
        <h2>Book Lab Session</h2>

        <form id="labBookingForm" method="POST" action="{{ route('teacher.requests.submit') }}">
            @csrf
            
            <!-- PAGE 1: Form Level, Subject, Topic, Experiment -->
            <div class="form-page active" id="page1">
                <div class="form-section">
                    <label class="section-title">Select Form Level</label>
                    <div class="radio-group" id="formLevelGroup">
                        <div class="radio-button">
                            <input type="radio" name="form_level" id="form1" value="form 1">
                            <label for="form1">Form 1</label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" name="form_level" id="form2" value="form 2">
                            <label for="form2">Form 2</label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" name="form_level" id="form3" value="form 3">
                            <label for="form3">Form 3</label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" name="form_level" id="form4" value="form 4">
                            <label for="form4">Form 4</label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" name="form_level" id="form5" value="form 5">
                            <label for="form5">Form 5</label>
                        </div>
                    </div>
                </div>

                <div class="form-section hidden" id="subjectSection">
                    <label class="section-title">Select Subject</label>
                    <div id="subjectLoading" class="loading hidden">Loading subjects...</div>
                    <div class="radio-group" id="subjectGroup"></div>
                </div>

                <div class="form-section hidden" id="topicSection">
                    <label class="section-title">Select Topic</label>
                    <div id="topicLoading" class="loading hidden">Loading topics...</div>
                    <div class="radio-group" id="topicGroup"></div>
                </div>

                <div class="form-section hidden" id="experimentSection">
                    <label class="section-title">Select Experiment</label>
                    <div id="experimentLoading" class="loading hidden">Loading experiments...</div>
                    <div class="radio-group" id="experimentGroup"></div>
                </div>

                <div class="button-container">
                    <button type="button" class="btn btn-next" id="nextBtn1" disabled>Next</button>
                </div>
            </div>

            <!-- PAGE 2: Student Details, Date, Time -->
            <div class="form-page" id="page2">
                <div class="input-group">
                    <label for="numStudents">How many students?</label>
                    <input type="number" id="numStudents" name="num_students" min="1" max="100" required>
                </div>

                <div class="input-group">
                    <label for="groupSize">Students per group</label>
                    <input type="number" id="groupSize" name="group_size" min="1" max="50" required>
                </div>

                <div class="input-group">
                    <label for="repetition">Repetition</label>
                    <input type="number" id="repetition" name="repetition" min="1" max="50" required>
                </div>

                <div class="input-group">
                    <label for="classname">Class</label>
                    <input type="text" id="classname" name="classname" required>
                </div>

                <div class="input-group">
                    <label for="labNumber">Lab Number</label>
                    <input type="text" id="labNumber" name="lab_number" required>
                </div>

                <div class="input-group">
                    <label for="preferredDate">Preferred Date</label>
                    <input type="date" id="preferredDate" name="preferred_date" required>
                </div>
                <div class="input-group">
                    <label for="duration">Expected Duration (minutes)</label>
                    <select id="duration" name="duration" required style="width: 100%; padding: 15px; border: 2px solid #e1e8ed; border-radius: 12px; font-size: 16px; background: #f5f7fa; color: #333;">
                        <option value="30">30 minutes</option>
                        <option value="60" selected>1 hour</option>
                        <option value="90">1.5 hours</option>
                        <option value="120">2 hours</option>
                        <option value="150">2.5 hours</option>
                        <option value="180">3 hours</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="preferredTime">Preferred Time</label>
                    <input type="time" id="preferredTime" name="preferred_time" required>
                </div>

                <div class="button-container">
                    <button type="button" class="btn btn-back" id="backBtn1">Back</button>
                    <button type="button" class="btn btn-next" id="nextBtn2">Next</button>
                </div>
            </div>

            <!-- PAGE 3: Materials & Apparatus Review -->
            <div class="form-page" id="page3">
                <div class="info-card">
                    <h3>Required Materials</h3>
                    <ul class="item-list" id="materialsList"></ul>
                </div>

                <div class="info-card">
                    <h3>Required Apparatus</h3>
                    <ul class="item-list" id="apparatusList"></ul>
                </div>
                <div class="notes-section">
                    <label for="additionalNotes">Additional Notes (Optional)</label>
                    <textarea 
                        id="additionalNotes" 
                        name="additional_notes" 
                        placeholder="Add any special requests, requirements, or notes for this lab session..."
                    ></textarea>
                </div>

                <div class="button-container">
                    <button type="button" class="btn btn-back" id="backBtn2">Back</button>
                    <button type="submit" class="btn btn-submit">Submit Booking</button>
                </div>
            </div>
        </form>
    </div>
</x-teacher-layout>
