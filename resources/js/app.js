import './bootstrap';

// Minimal accessible menu toggle
document.addEventListener('DOMContentLoaded', function () {
  const btn = document.getElementById('navToggle');
  const menu = document.getElementById('navMenu');

  if (!btn || !menu) return;

  function setOpen(open) {
    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    menu.dataset.open = open ? 'true' : 'false';
  }

  btn.addEventListener('click', (e) => {
    const isOpen = btn.getAttribute('aria-expanded') === 'true';
    setOpen(!isOpen);
  });

  // close on Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') setOpen(false);
  });

  // click outside to close (mobile)
  document.addEventListener('click', (e) => {
    if (!menu.contains(e.target) && !btn.contains(e.target)) setOpen(false);
  });
});

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
// app.js (near top)
const csrfMeta = document.querySelector('meta[name="csrf-token"]');

const checkAvailabilityUrlMeta = document.querySelector('meta[name="check-availability-url"]');
const CHECK_AVAILABILITY_URL = checkAvailabilityUrlMeta ? checkAvailabilityUrlMeta.content : '/teacher/check-availability';

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


// Real-time availability checking
let availabilityCheckTimeout;

function checkAvailability() {
    const labNumber = document.getElementById('labNumber').value;
    const preferredDate = document.getElementById('preferredDate').value;
    const preferredTime = document.getElementById('preferredTime').value;
    const duration = document.getElementById('duration').value;

    // Only check if all fields are filled
    if (!labNumber || !preferredDate || !preferredTime || !duration) {
        return;
    }

    // Clear previous timeout
    clearTimeout(availabilityCheckTimeout);

    // Show checking message
    showAvailabilityMessage('Checking availability...', 'info');

    // Debounce the check (wait 500ms after user stops typing)
    availabilityCheckTimeout = setTimeout(async () => {
        try {
            const response = await fetch(CHECK_AVAILABILITY_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                lab_number: labNumber,
                preferred_date: preferredDate,
                preferred_time: preferredTime,
                duration: parseInt(duration)
            })
            });

            const data = await response.json();

            if (data.available) {
                showAvailabilityMessage('✓ Time slot is available!', 'success');
                nextBtn2.disabled = false;
            } else {
                showAvailabilityMessage('⚠ ' + data.message, 'warning');
                nextBtn2.disabled = true;
            }
        } catch (error) {
            console.error('Error checking availability:', error);
            showAvailabilityMessage('Error checking availability', 'error');
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
    const timeInput = document.getElementById('preferredTime').parentElement;
    timeInput.appendChild(msgDiv);
}

// Add event listeners
document.addEventListener('DOMContentLoaded', function() {
    const labNumber = document.getElementById('labNumber');
    const preferredDate = document.getElementById('preferredDate');
    const preferredTime = document.getElementById('preferredTime');
    const duration = document.getElementById('duration');

    if (labNumber) labNumber.addEventListener('change', checkAvailability);
    if (preferredDate) preferredDate.addEventListener('change', checkAvailability);
    if (preferredTime) preferredTime.addEventListener('change', checkAvailability);
    if (duration) duration.addEventListener('change', checkAvailability);
});

