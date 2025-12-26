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
  const loader = document.getElementById('loader');
  const header = document.querySelector('header');

  if (!loader) return;

  // Helper to show loader with optional header-covering logic
  function showLoader() {
    // If header contains class "hide-on-load" (you can rename), let the loader cover header
    if (header && header.classList.contains('hide-on-load')) {
      loader.classList.add('cover-header');
    } else {
      loader.classList.remove('cover-header');
    }

    // show with class for transition
    loader.classList.add('is-visible');

    // ensure it becomes display:flex (CSS transition needs display set)
    loader.style.display = 'flex';
  }

  // Helper to hide loader (useful for AJAX flows; page navigation will unload anyway)
  function hideLoader() {
    loader.classList.remove('is-visible');
    // wait for transition then remove display to avoid overlaying invisible element
    setTimeout(() => {
      if (!loader.classList.contains('is-visible')) {
        loader.style.display = 'none';
      }
    }, 250);
  }

  // Show loader on any normal HTML form submit
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function (e) {
      // If a form submit is done via JS/AJAX and prevented, consider not showing loader.
      // Here we show loader unconditionally — modify if you have AJAX forms.
      showLoader();
    });
  });

  // Show loader on navigation / refresh
  window.addEventListener('beforeunload', function () {
    // show loader right before leaving (browser may ignore heavy work but overlay will appear)
    showLoader();
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

const classnameGroup = document.getElementById('classnameGroup');
const classnameValue = document.getElementById('classnameValue');
let selectedFormLevel = null;

// Class mapping based on form level
const classMapping = {
    'form 1': ['1A', '1B', '1C'],
    'form 2': ['2A', '2B', '2C'],
    'form 3': ['3A', '3B', '3C'],
    'form 4': ['4A', '4B', '4C'],
    'form 5': ['5A', '5B', '5C']
};

// Function to populate class options based on form level
function populateClasses(formLevel) {
    if (!classnameGroup) return;
    
    classnameGroup.innerHTML = '';
    const classes = classMapping[formLevel] || [];
    
    if (classes.length > 0) {
        classes.forEach(className => {
            const radioDiv = document.createElement('div');
            radioDiv.className = 'radio-button';
            radioDiv.innerHTML = `
                <input type="radio" name="classname_radio" id="class${className}" value="${className}">
                <label for="class${className}">${className}</label>
            `;
            classnameGroup.appendChild(radioDiv);
        });

        const classRadios = document.querySelectorAll('input[name="classname_radio"]');
        classRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (classnameValue) {
                    classnameValue.value = this.value;
                }
                validatePage2();
            });
        });
    } else {
        classnameGroup.innerHTML = '<p style="text-align: center; color: #999;">Please select a form level first.</p>';
    }
}

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
        selectedFormLevel = formLevel;        // ← ADD THIS LINE
        populateClasses(formLevel);           // ← ADD THIS LINE
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

            // ADD CUSTOM EXPERIMENT OPTION
            const customDiv = document.createElement('div');
            customDiv.className = 'radio-button custom-experiment-option';
            customDiv.innerHTML = `
                <input type="radio" name="experiment_id" id="experimentCustom" value="custom">
                <label for="experimentCustom">📝 Custom Experiment</label>
            `;
            experimentGroup.appendChild(customDiv);

            // ADD CUSTOM EXPERIMENT INPUT (hidden by default)
            const customInputDiv = document.createElement('div');
            customInputDiv.id = 'customExperimentInput';
            customInputDiv.className = 'custom-experiment-input hidden';
            customInputDiv.innerHTML = `
                <label for="custom_experiment_name" style="display: block; margin-bottom: 8px; color: #2c3e50; font-weight: 600;">
                    Enter Custom Experiment Name:
                </label>
                <input 
                    type="text" 
                    id="custom_experiment_name" 
                    name="custom_experiment_name" 
                    placeholder="e.g., Investigating pH levels in household products"
                    style="width: 100%; padding: 12px; border: 2px solid #3498db; border-radius: 8px; font-size: 15px;"
                />
                <small style="display: block; margin-top: 6px; color: #7f8c8d;">
                    Provide a clear, descriptive name for your custom experiment
                </small>
            `;
            experimentGroup.appendChild(customInputDiv);

            const experimentInputs = document.querySelectorAll('input[name="experiment_id"]');
experimentInputs.forEach(input => {
    input.addEventListener('change', function() {
        if (this.value === 'custom') {
            // Show custom input, clear experiment_id
            document.getElementById('customExperimentInput').classList.remove('hidden');
            selectedExperimentId = null;
            
            // Remove the experiment_id input from form OR set it to empty
            this.value = ''; // Clear the value
            this.removeAttribute('name'); // Remove name so it doesn't submit
            
            // Enable next button when custom name is entered
            const customNameInput = document.getElementById('custom_experiment_name');
            customNameInput.addEventListener('input', function() {
                nextBtn1.disabled = this.value.trim().length < 3;
            });
            
            nextBtn1.disabled = true;
        } else {
            // Hide custom input, set selected experiment
            document.getElementById('customExperimentInput').classList.add('hidden');
            document.getElementById('custom_experiment_name').value = '';
            
            // Re-enable the name attribute for other radios
            const customRadio = document.getElementById('experimentCustom');
            if (customRadio) {
                customRadio.setAttribute('name', 'experiment_id');
            }
            
            selectedExperimentId = this.value;
            nextBtn1.disabled = false;
        }
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
    const customRadio = document.getElementById('experimentCustom');
    const isCustom = customRadio && customRadio.checked;

    if (isCustom) {
        // For custom experiments, show placeholder content
        const customName = document.getElementById('custom_experiment_name').value;
        
        materialsList.innerHTML = `
            <div class="empty-message" style="background: #e3f2fd; padding: 20px; border-radius: 8px; color: #1976d2;">
                <strong>📝 Custom Experiment: ${customName}</strong>
                <p style="margin-top: 10px; font-size: 14px;">
                    Since this is a custom experiment, please specify required materials and apparatus 
                    in the "Additional Notes" section below.
                </p>
            </div>
        `;
        apparatusList.innerHTML = `
            <div class="empty-message" style="background: #fff3e0; padding: 20px; border-radius: 8px; color: #e65100;">
                <strong>⚠️ Important</strong>
                <p style="margin-top: 10px; font-size: 14px;">
                    Please list all required apparatus in the Additional Notes section.
                </p>
            </div>
        `;
        return;
    }

    // Original logic for standard experiments
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
    // Populate classes if form level is selected
    if (selectedFormLevel) {
        populateClasses(selectedFormLevel);
    }
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
// Availability checking
let availabilityCheckTimeout;

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

    if (!preferredDate || !preferredTime || !duration || !nextBtn2) {
        return;
    }

    const dateValue = preferredDate.value;
    const timeValue = preferredTime.value;
    const durationValue = duration.value;

    if (!labValue || !dateValue || !timeValue || !durationValue) {
        nextBtn2.disabled = false;
        return;
    }

    clearTimeout(availabilityCheckTimeout);
    showAvailabilityMessage('Checking availability...', 'info');
    nextBtn2.disabled = true;

    availabilityCheckTimeout = setTimeout(async () => {
        try {
            const response = await fetch('/teacher/check-availability', {
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
                nextBtn2.disabled = false;
            } else {
                showAvailabilityMessage('⚠ ' + data.message, 'warning');
                nextBtn2.disabled = true;
            }
        } catch (error) {
            console.error('Error checking availability:', error);
            showAvailabilityMessage('Unable to check availability. Please try again.', 'error');
            nextBtn2.disabled = false;
        }
    }, 500);
}

function showAvailabilityMessage(message, type) {
    const existingMsg = document.getElementById('availabilityMessage');
    if (existingMsg) {
        existingMsg.remove();
    }

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

    const timeInput = document.getElementById('preferredTime');
    if (timeInput && timeInput.parentElement) {
        timeInput.parentElement.appendChild(msgDiv);
    }
}

function validatePage2() {
    const numStudents = document.getElementById('numStudents');
    const groupSize = document.getElementById('groupSize');
    const repetition = document.getElementById('repetition');
    const classname = document.getElementById('classnameValue');
    const labNumber = document.querySelector('input[name="lab_number"]:checked');
    const preferredDate = document.getElementById('preferredDate');
    const duration = document.getElementById('duration');
    const preferredTime = document.getElementById('preferredTime');
    const nextBtn2 = document.getElementById('nextBtn2');

    if (!nextBtn2) return;

    const allFilled = numStudents && numStudents.value &&
                     groupSize && groupSize.value &&
                     repetition && repetition.value &&
                     classname && classname.value &&
                     labNumber &&
                     preferredDate && preferredDate.value &&
                     duration && duration.value &&
                     preferredTime && preferredTime.value;

    const validNumbers = numStudents && parseInt(numStudents.value) >= 1 && parseInt(numStudents.value) <= 100 &&
                        groupSize && parseInt(groupSize.value) >= 1 && parseInt(groupSize.value) <= 50 &&
                        repetition && parseInt(repetition.value) >= 1 && parseInt(repetition.value) <= 50;

    if (allFilled && validNumbers) {
        if (typeof checkAvailability === 'function') {
            checkAvailability();
        }
    } else {
        nextBtn2.disabled = true;
    }
}

function validatePage3() {
    const submitBtn = document.querySelector('.btn-submit');
    
    if (!submitBtn) return;

    const numStudents = document.getElementById('numStudents');
    const groupSize = document.getElementById('groupSize');
    const repetition = document.getElementById('repetition');
    const classname = document.getElementById('classnameValue');
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

// Event listeners for validation
if (document.getElementById('numStudents')) {
    const page2Fields = [
        document.getElementById('numStudents'),
        document.getElementById('groupSize'),
        document.getElementById('repetition'),
        document.getElementById('preferredDate'),
        document.getElementById('duration'),
        document.getElementById('preferredTime')
    ];

    page2Fields.forEach(field => {
        if (field) {
            field.addEventListener('input', validatePage2);
            field.addEventListener('change', validatePage2);
        }
    });

    const labRadios = document.querySelectorAll('input[name="lab_number"]');
    labRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            validatePage2();
            checkAvailability();
        });
    });

    validatePage2();
}





