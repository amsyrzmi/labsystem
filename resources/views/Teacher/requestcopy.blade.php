
<x-layout>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Select Form & Subject</title>
    <style>

        .container {
            background: transparent;
            border-radius: 20px;
            padding: 40px;
            margin: 40px auto;
            max-width: 1000px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        h2 {
            color: white;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .form-section {
            margin-bottom: 35px;
        }

        .form-section label.section-title {
            display: block;
            color: white;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .radio-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 12px;
        }
        /* Full width for topic cards */
        #topicGroup {
            grid-template-columns: 1fr;
        }

        .radio-button {
            position: relative;
        }

        .radio-button input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .radio-button label {
            display: block;
            padding: 15px 20px;
            background: #f5f7fa;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #555;
        }

        .radio-button label:hover {
            background: #e8eef5;
            border-color: #415A77;
            transform: translateY(-2px);
        }

        .radio-button input[type="radio"]:checked + label {
            background: #1B263B;
            border-color: #415A77;
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .hidden {
            display: none;
        }

        .loading {
            text-align: center;
            color: #415A77;
            font-style: italic;
            padding: 20px;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: #415A77;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .submit-btn:disabled {
            background: #778DA9;
            cursor: not-allowed;
            transform: none;
        }
         /* Button container */
        .button-container {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-next, .btn-submit {
            background: #415A77;
            color: white;
        }

        .btn-next:hover, .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: #778DA9;
        }

        .btn-back {
            background: #f5f7fa;
            color: #555;
            border: 2px solid #e1e8ed;
        }

        .btn-back:hover {
            background: #e8eef5;
            border-color: #778DA9;
            transform: translateY(-2px);
        }

        .btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            opacity: 0.6;
        }

        .btn-next:disabled:hover,
        .btn-submit:disabled:hover {
            transform: none;
            box-shadow: none;
        }
        /* Input field styling */
        .input-group {
            margin-bottom: 25px;
        }

        .input-group label {
            display: block;
            color: #555;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .input-group input[type="number"],
        .input-group input[type="date"],
        .input-group input[type="time"] {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f5f7fa;
            color: #333;
        }

        .input-group input[type="number"]:focus,
        .input-group input[type="date"]:focus,
        .input-group input[type="time"]:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        /* Date and time input color customization */
        .input-group input[type="date"]::-webkit-calendar-picker-indicator,
        .input-group input[type="time"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            filter: invert(45%) sepia(85%) saturate(2276%) hue-rotate(226deg) brightness(95%) contrast(92%);
        }
        /* Page system */
        .form-page {
            display: none;
        }

        .form-page.active {
            display: block;
        }
        /* Cards for materials and apparatus */
        .info-card {
            background: #f8f9fa;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .info-card h3 {
            color: #415A77;
            font-size: 20px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-card h3::before {
            content: '•';
            font-size: 30px;
        }

        .item-list {
            list-style: none;
            padding: 0;
        }

        .item-list li {
            background: white;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            border-left: 4px solid #778DA9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-name {
            font-weight: 500;
            color: #333;
        }

        .item-quantity {
            color: #778DA9;
            font-weight: 600;
            background: #f0f3ff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
        }

        .empty-message {
            text-align: center;
            color: #999;
            font-style: italic;
            padding: 20px;
        }
        .notes-section {
            margin-bottom: 25px;
        }

        .notes-section label {
            display: block;
            color: #555;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .notes-section textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            font-size: 16px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: all 0.3s ease;
            background: #f5f7fa;
            color: #333;
            min-height: 120px;
            resize: vertical;
        }

        .notes-section textarea:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .notes-section textarea::placeholder {
            color: #999;
        }
    </style>
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

    <script>
        const formLevelInputs = document.querySelectorAll('input[name="form_level"]');
        const subjectSection = document.getElementById('subjectSection');
        const subjectGroup = document.getElementById('subjectGroup');
        const subjectLoading = document.getElementById('subjectLoading');
        const topicSection = document.getElementById('topicSection');
        const topicGroup = document.getElementById('topicGroup');
        const topicLoading = document.getElementById('topicLoading');
        const experimentSection = document.getElementById('experimentSection');
        const experimentGroup = document.getElementById('experimentGroup');
        const experimentLoading = document.getElementById('experimentLoading');
        const nextBtn1 = document.getElementById('nextBtn1');
        const nextBtn2 = document.getElementById('nextBtn2');
        const backBtn1 = document.getElementById('backBtn1');
        const backBtn2 = document.getElementById('backBtn2');
        const page1 = document.getElementById('page1');
        const page2 = document.getElementById('page2');
        const page3 = document.getElementById('page3');
        const materialsList = document.getElementById('materialsList');
        const apparatusList = document.getElementById('apparatusList');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        let selectedExperimentId = null;

        const today = new Date();

        const minSelectableDate = new Date(today.getTime() + (3 * 24 * 60 * 60 * 1000));
        const maxSelectableDate = new Date(today.getTime() + (10 * 24 * 60 * 60 * 1000));
        const formattedMinDate = minSelectableDate.toISOString().split('T')[0];
        const formattedMaxDate = maxSelectableDate.toISOString().split('T')[0];

        document.getElementById('preferredDate').setAttribute('min', formattedMinDate);
        document.getElementById('preferredDate').setAttribute('max', formattedMaxDate);

        formLevelInputs.forEach(input => {
            input.addEventListener('change', function() {
                const formLevel = this.value;
                fetchSubjects(formLevel);
                topicSection.classList.add('hidden');
                topicGroup.innerHTML = '';
                experimentSection.classList.add('hidden');
                experimentGroup.innerHTML = '';
                nextBtn1.disabled = true;
            });
        });

        async function fetchSubjects(formLevel) {
            subjectSection.classList.remove('hidden');
            subjectLoading.classList.remove('hidden');
            subjectGroup.innerHTML = '';
            nextBtn1.disabled = true;

            try {
                const response = await fetch(`/subjects-by-form?form_level=${encodeURIComponent(formLevel)}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const subjects = await response.json();
                subjectLoading.classList.add('hidden');

                if (subjects.length > 0) {
                    subjects.forEach(subject => {
                        const radioDiv = document.createElement('div');
                        radioDiv.className = 'radio-button';
                        radioDiv.innerHTML = `
                            <input type="radio" name="subject_id" id="subject${subject.id}" value="${subject.id}">
                            <label for="subject${subject.id}">${subject.name}</label>
                        `;
                        subjectGroup.appendChild(radioDiv);
                    });

                    const subjectInputs = document.querySelectorAll('input[name="subject_id"]');
                    subjectInputs.forEach(input => {
                        input.addEventListener('change', function() {
                            const subjectId = this.value;
                            fetchTopics(subjectId);
                        });
                    });
                } else {
                    subjectGroup.innerHTML = '<p style="text-align: center; color: #999;">No subjects available.</p>';
                }
            } catch (error) {
                console.error('Error fetching subjects:', error);
                subjectLoading.classList.add('hidden');
                subjectGroup.innerHTML = '<p style="text-align: center; color: #e74c3c;">Error loading subjects.</p>';
            }
        }

        async function fetchTopics(subjectId) {
            topicSection.classList.remove('hidden');
            topicLoading.classList.remove('hidden');
            topicGroup.innerHTML = '';
            experimentSection.classList.add('hidden');
            experimentGroup.innerHTML = '';
            nextBtn1.disabled = true;

            try {
                const response = await fetch(`/topics-by-subject?subject_id=${encodeURIComponent(subjectId)}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const topics = await response.json();
                topicLoading.classList.add('hidden');

                if (topics.length > 0) {
                    topics.forEach(topic => {
                        const radioDiv = document.createElement('div');
                        radioDiv.className = 'radio-button';
                        radioDiv.innerHTML = `
                            <input type="radio" name="topic_id" id="topic${topic.id}" value="${topic.id}">
                            <label for="topic${topic.id}">${topic.name}</label>
                        `;
                        topicGroup.appendChild(radioDiv);
                    });

                    const topicInputs = document.querySelectorAll('input[name="topic_id"]');
                    topicInputs.forEach(input => {
                        input.addEventListener('change', function() {
                            const topicId = this.value;
                            fetchExperiments(topicId);
                        });
                    });
                } else {
                    topicGroup.innerHTML = '<p style="text-align: center; color: #999;">No topics available.</p>';
                }
            } catch (error) {
                console.error('Error fetching topics:', error);
                topicLoading.classList.add('hidden');
                topicGroup.innerHTML = '<p style="text-align: center; color: #e74c3c;">Error loading topics.</p>';
            }
        }

        async function fetchExperiments(topicId) {
            experimentSection.classList.remove('hidden');
            experimentLoading.classList.remove('hidden');
            experimentGroup.innerHTML = '';
            nextBtn1.disabled = true;

            try {
                const response = await fetch(`/experiments-by-topic?topic_id=${encodeURIComponent(topicId)}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const experiments = await response.json();
                experimentLoading.classList.add('hidden');

                if (experiments.length > 0) {
                    experiments.forEach(experiment => {
                        const radioDiv = document.createElement('div');
                        radioDiv.className = 'radio-button';
                        radioDiv.innerHTML = `
                            <input type="radio" name="experiment_id" id="experiment${experiment.id}" value="${experiment.id}">
                            <label for="experiment${experiment.id}">${experiment.name}</label>
                        `;
                        experimentGroup.appendChild(radioDiv);
                    });

                    const experimentInputs = document.querySelectorAll('input[name="experiment_id"]');
                    experimentInputs.forEach(input => {
                        input.addEventListener('change', function() {
                            selectedExperimentId = this.value;
                            nextBtn1.disabled = false;
                        });
                    });
                } else {
                    experimentGroup.innerHTML = '<p style="text-align: center; color: #999;">No experiments available.</p>';
                }
            } catch (error) {
                console.error('Error fetching experiments:', error);
                experimentLoading.classList.add('hidden');
                experimentGroup.innerHTML = '<p style="text-align: center; color: #e74c3c;">Error loading experiments.</p>';
            }
        }

        async function loadExperimentDetails() {
            try {
                const response = await fetch(`/experiment-details?experiment_id=${encodeURIComponent(selectedExperimentId)}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();
                
                materialsList.innerHTML = '';
                apparatusList.innerHTML = '';

                if (data.materials.length > 0) {
                    data.materials.forEach(material => {
                        const li = document.createElement('li');
                        li.innerHTML = `
                            <span class="item-name">${material.name}</span>
                            <span class="item-quantity">${material.quantity} ${material.unit}</span>
                        `;
                        materialsList.appendChild(li);
                    });
                } else {
                    materialsList.innerHTML = '<div class="empty-message">No materials required</div>';
                }

                if (data.apparatuses.length > 0) {
                    data.apparatuses.forEach(apparatus => {
                        const li = document.createElement('li');
                        li.innerHTML = `
                            <span class="item-name">${apparatus.name}</span>
                            <span class="item-quantity">${apparatus.quantity}</span>
                        `;
                        apparatusList.appendChild(li);
                    });
                } else {
                    apparatusList.innerHTML = '<div class="empty-message">No apparatus required</div>';
                }
            } catch (error) {
                console.error('Error loading experiment details:', error);
                materialsList.innerHTML = '<div class="empty-message">Error loading materials</div>';
                apparatusList.innerHTML = '<div class="empty-message">Error loading apparatus</div>';
            }
        }

        nextBtn1.addEventListener('click', function() {
            page1.classList.remove('active');
            page2.classList.add('active');
        });

        nextBtn2.addEventListener('click', function() {
            loadExperimentDetails();
            page2.classList.remove('active');
            page3.classList.add('active');
        });

        backBtn1.addEventListener('click', function() {
            page2.classList.remove('active');
            page1.classList.add('active');
        });

        backBtn2.addEventListener('click', function() {
            page3.classList.remove('active');
            page2.classList.add('active');
        });
    </script>
</x-layout>
