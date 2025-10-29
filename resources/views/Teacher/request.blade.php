
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

                <div class="form-section">
                    <label class="section-title">Lab Number</label>
                    <div class="radio-group" id="labNumberGroup">
                        <div class="radio-button">
                            <input type="radio" name="lab_number" id="lab1" value="Lab 1" required>
                            <label for="lab1">Lab 1</label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" name="lab_number" id="lab2" value="Lab 2" required>
                            <label for="lab2">Lab 2</label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" name="lab_number" id="lab3" value="Lab 3" required>
                            <label for="lab3">Lab 3</label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" name="lab_number" id="lab4" value="Lab 4" required>
                            <label for="lab4">Lab 4</label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" name="lab_number" id="lab5" value="Lab 5" required>
                            <label for="lab5">Lab 5</label>
                        </div>
                    </div>
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
                    <select id="preferredTime" name="preferred_time" required style="width: 100%; padding: 15px; border: 2px solid #e1e8ed; border-radius: 12px; font-size: 16px; background: #f5f7fa; color: #333;">
                        <option value="">Select a time slot</option>
                        <option value="08:00">08:00 AM</option>
                        <option value="08:30">08:30 AM</option>
                        <option value="09:00">09:00 AM</option>
                        <option value="09:30">09:30 AM</option>
                        <option value="10:00">10:00 AM</option>
                        <option value="10:30">10:30 AM</option>
                        <option value="11:00">11:00 AM</option>
                        <option value="11:30">11:30 AM</option>
                        <option value="12:00">12:00 PM</option>
                        <option value="12:30">12:30 PM</option>
                        <option value="13:00">01:00 PM</option>
                        <option value="13:30">01:30 PM</option>
                        <option value="14:00">02:00 PM</option>
                        <option value="14:30">02:30 PM</option>
                        <option value="15:00">03:00 PM</option>
                        <option value="15:30">03:30 PM</option>
                        <option value="16:00">04:00 PM</option>
                        <option value="16:30">04:30 PM</option>
                    </select>
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
<script>
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Real-time availability checking
    let availabilityCheckTimeout;

    // Get selected lab number from radio buttons
    function getSelectedLabNumber() {
        const selectedLab = document.querySelector('input[name="lab_number"]:checked');
        return selectedLab ? selectedLab.value : null;
    }

    function checkAvailability() {
        const labValue = getSelectedLabNumber();
        const preferredDate = document.getElementById('preferredDate');
        const preferredTime = document.getElementById('preferredTime');
        const duration = document.getElementById('duration');
        const nextBtn2 = document.getElementById('nextBtn2');

        // Check if elements exist and have values
        if (!preferredDate || !preferredTime || !duration || !nextBtn2) {
            return;
        }

        const dateValue = preferredDate.value;
        const timeValue = preferredTime.value;
        const durationValue = duration.value;

        // Only check if all fields are filled
        if (!labValue || !dateValue || !timeValue || !durationValue) {
            // Enable button if fields are not complete yet
            nextBtn2.disabled = false;
            return;
        }

        // Clear previous timeout
        clearTimeout(availabilityCheckTimeout);

        // Show checking message
        showAvailabilityMessage('Checking availability...', 'info');
        
        // Disable button while checking
        nextBtn2.disabled = true;

        // Debounce the check (wait 500ms after user stops typing)
        availabilityCheckTimeout = setTimeout(async () => {
            try {
                const response = await fetch('{{ route("teacher.check.availability") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        lab_number: labValue,
                        preferred_date: dateValue,
                        preferred_time: timeValue,
                        duration: parseInt(durationValue)
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();

                if (data.available) {
                    showAvailabilityMessage('✓ Time slot is available!', 'success');
                    nextBtn2.disabled = false; // ENABLE button
                } else {
                    showAvailabilityMessage('⚠ ' + data.message, 'warning');
                    nextBtn2.disabled = true; // KEEP button DISABLED
                }
            } catch (error) {
                console.error('Error checking availability:', error);
                showAvailabilityMessage('Unable to check availability. Please try again.', 'error');
                nextBtn2.disabled = false; // Allow to proceed despite error
            }
        }, 500);
    }

    function showAvailabilityMessage(message, type) {
        // Remove existing message
        const existingMsg = document.getElementById('availabilityMessage');
        if (existingMsg) {
            existingMsg.remove();
        }

        // Create new message
        const msgDiv = document.createElement('div');
        msgDiv.id = 'availabilityMessage';
        msgDiv.style.padding = '12px';
        msgDiv.style.borderRadius = '8px';
        msgDiv.style.marginTop = '12px';
        msgDiv.style.fontSize = '14px';
        msgDiv.style.fontWeight = '600';

        if (type === 'success') {
            msgDiv.style.background = '#d4edda';
            msgDiv.style.color = '#155724';
            msgDiv.style.border = '1px solid #c3e6cb';
        } else if (type === 'warning') {
            msgDiv.style.background = '#fff3cd';
            msgDiv.style.color = '#856404';
            msgDiv.style.border = '1px solid #ffc107';
        } else if (type === 'info') {
            msgDiv.style.background = '#d1ecf1';
            msgDiv.style.color = '#0c5460';
            msgDiv.style.border = '1px solid #bee5eb';
        } else {
            msgDiv.style.background = '#f8d7da';
            msgDiv.style.color = '#721c24';
            msgDiv.style.border = '1px solid #f5c6cb';
        }

        msgDiv.textContent = message;

        // Insert after the time input
        const timeInput = document.getElementById('preferredTime');
        if (timeInput && timeInput.parentElement) {
            timeInput.parentElement.appendChild(msgDiv);
        }
    }

    // Add event listeners when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        // Get all lab number radio buttons
        const labRadios = document.querySelectorAll('input[name="lab_number"]');
        const preferredDate = document.getElementById('preferredDate');
        const preferredTime = document.getElementById('preferredTime');
        const duration = document.getElementById('duration');

        // Add listeners to lab radio buttons
        labRadios.forEach(radio => {
            radio.addEventListener('change', checkAvailability);
        });

        if (preferredDate) preferredDate.addEventListener('change', checkAvailability);
        if (preferredTime) preferredTime.addEventListener('change', checkAvailability);
        if (duration) duration.addEventListener('change', checkAvailability);
    });
    // ============================================
    // PAGE 2 VALIDATION - Disable Next until all fields filled
    // ============================================
    
    function validatePage2() {
        const numStudents = document.getElementById('numStudents');
        const groupSize = document.getElementById('groupSize');
        const repetition = document.getElementById('repetition');
        const classname = document.getElementById('classname');
        const labNumber = document.querySelector('input[name="lab_number"]:checked');
        const preferredDate = document.getElementById('preferredDate');
        const duration = document.getElementById('duration');
        const preferredTime = document.getElementById('preferredTime');
        const nextBtn2 = document.getElementById('nextBtn2');

        if (!nextBtn2) return;

        // Check if all required fields are filled
        const allFilled = numStudents && numStudents.value &&
                         groupSize && groupSize.value &&
                         repetition && repetition.value &&
                         classname && classname.value &&
                         labNumber &&
                         preferredDate && preferredDate.value &&
                         duration && duration.value &&
                         preferredTime && preferredTime.value;

        // Validate number fields are within range
        const validNumbers = numStudents && parseInt(numStudents.value) >= 1 && parseInt(numStudents.value) <= 100 &&
                            groupSize && parseInt(groupSize.value) >= 1 && parseInt(groupSize.value) <= 50 &&
                            repetition && parseInt(repetition.value) >= 1 && parseInt(repetition.value) <= 50;

        // Only enable if all fields filled AND numbers are valid
        // Note: availability check will override this if slot is not available
        if (allFilled && validNumbers) {
            // Don't enable yet - let availability check decide
            // Just trigger availability check
            if (typeof checkAvailability === 'function') {
                checkAvailability();
            }
        } else {
            nextBtn2.disabled = true;
        }
    }

    // Disable submit until ready
    
    function validatePage3() {
        const submitBtn = document.querySelector('.btn-submit');
        
        if (!submitBtn) return;

        // Page 3 has materials/apparatus loaded, which means:
        // - Page 1 is complete (experiment selected)
        // - Page 2 is complete (all fields filled)
        // So we can enable submit immediately when page 3 loads
        
        // But let's double-check all previous fields are still filled
        const numStudents = document.getElementById('numStudents');
        const groupSize = document.getElementById('groupSize');
        const repetition = document.getElementById('repetition');
        const classname = document.getElementById('classname');
        const labNumber = document.querySelector('input[name="lab_number"]:checked');
        const preferredDate = document.getElementById('preferredDate');
        const duration = document.getElementById('duration');
        const preferredTime = document.getElementById('preferredTime');

        const allFilled = numStudents && numStudents.value &&
                         groupSize && groupSize.value &&
                         repetition && repetition.value &&
                         classname && classname.value &&
                         labNumber &&
                         preferredDate && preferredDate.value &&
                         duration && duration.value &&
                         preferredTime && preferredTime.value;

        submitBtn.disabled = !allFilled;
    }

    // Event Listeners
    
    document.addEventListener('DOMContentLoaded', function() {
        // Page 2 fields
        const page2Fields = [
            document.getElementById('numStudents'),
            document.getElementById('groupSize'),
            document.getElementById('repetition'),
            document.getElementById('classname'),
            document.getElementById('preferredDate'),
            document.getElementById('duration'),
            document.getElementById('preferredTime')
        ];

        // Add event listeners to all page 2 fields
        page2Fields.forEach(field => {
            if (field) {
                field.addEventListener('input', validatePage2);
                field.addEventListener('change', validatePage2);
            }
        });

        // Add listeners to lab number radio buttons
        const labRadios = document.querySelectorAll('input[name="lab_number"]');
        labRadios.forEach(radio => {
            radio.addEventListener('change', validatePage2);
        });

        // Initial validation on page load
        validatePage2();

        // Override the nextBtn2 click to validate page 3 when it loads
        const originalNextBtn2Click = document.getElementById('nextBtn2');
        if (originalNextBtn2Click) {
            const originalOnClick = originalNextBtn2Click.onclick;
            originalNextBtn2Click.onclick = function(e) {
                
                if (originalOnClick) {
                    originalOnClick.call(this, e);
                }
                
                // Then validate page 3 after a short delay (to let materials load)
                setTimeout(() => {
                    validatePage3();
                }, 100);
            };
        }
    });

    // Also validate page 3 whenever we navigate to it
    const originalNextBtn2Handler = document.getElementById('nextBtn2');
    if (originalNextBtn2Handler) {
        originalNextBtn2Handler.addEventListener('click', function() {
            setTimeout(() => {
                validatePage3();
            }, 100);
        });
    }
</script>
</x-teacher-layout>
