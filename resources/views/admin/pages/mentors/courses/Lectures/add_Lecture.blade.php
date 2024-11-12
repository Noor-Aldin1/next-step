<!-- Schedule Lecture Modal -->
<div style="height: auto" id="scheduleLectureModal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Schedule a Lecture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>

            <div class="modal-body">
                <form action="{{ route('addLecture.add') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <!-- Title Input -->
                        <div class="col-sm-6 mb-3">
                            <label for="lectureTitle" class="col-form-label">Title Lecture <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="lectureTitle"
                                placeholder="Enter title" required>
                            <div class="invalid-feedback">Please provide a lecture title.</div>
                        </div>

                        <!-- Course Selection -->
                        <div class="col-sm-6 mb-3">
                            <label for="courseSelect" class="col-form-label">Choose Course <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" id="courseSelect" name="course_id" required>
                                <option disabled selected>Choose a course...</option>
                                <!-- Dynamic course options here -->
                            </select>
                            <div class="invalid-feedback">Please select a course.</div>
                        </div>

                        <!-- Start Session Datepicker -->
                        <div class="col-sm-6 mb-3">
                            <label for="lectureStartDatepicker" class="col-form-label">Start Session <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="lectureStartDatepicker" class="form-control"
                                placeholder="Select a date" required>
                            <div id="start-time-slots-container" class="time-slots" style="display: none;"></div>
                            <input type="hidden" name="start_session" id="start-session-slot">
                            <div class="invalid-feedback">Please select a start session date and time.</div>
                        </div>

                        <!-- End Session Datepicker -->
                        <div class="col-sm-6 mb-3">
                            <label for="lectureEndDatepicker" class="col-form-label">End Session <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="lectureEndDatepicker" class="form-control"
                                placeholder="Select a date" required>
                            <div id="end-time-slots-container" class="time-slots" style="display: none;"></div>
                            <input type="hidden" name="end_session" id="end-session-slot">
                            <div class="invalid-feedback">Please select an end session date and time.</div>
                        </div>

                        <!-- Lecture Link Input -->
                        <div class="col-12 mb-3">
                            <label for="lectureLink" class="col-form-label">Lecture Link <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="link_lecture" class="form-control" id="lectureLink"
                                placeholder="https://example.com/lecture" required>
                            <div class="invalid-feedback">Please enter a valid lecture link.</div>
                        </div>

                        <!-- Description Textarea -->
                        <div class="col-12 mb-3">
                            <label for="lectureDescription" class="col-form-label">Description <span
                                    class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" id="lectureDescription" rows="3" required></textarea>
                            <div class="invalid-feedback">Please provide a description for the lecture.</div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-btn">Save Lecture</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script for Datepicker and Time Slots -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize date pickers for start and end sessions
        const startDateInput = document.getElementById('lectureStartDatepicker');
        const endDateInput = document.getElementById('lectureEndDatepicker');

        // Custom Datepicker logic (for simplicity, date format is 'yyyy-mm-dd')
        function initializeDatePicker(inputElement) {
            inputElement.addEventListener('focus', function() {
                const today = new Date();
                const minDate = today.toISOString().split('T')[0]; // format: yyyy-mm-dd
                inputElement.setAttribute('min', minDate);
            });
        }

        initializeDatePicker(startDateInput);
        initializeDatePicker(endDateInput);

        // Function to load available time slots via AJAX
        function loadAvailableTimes(date, sessionType) {
            const timeSlotsContainer = sessionType === 'start' ? document.getElementById(
                'start-time-slots-container') : document.getElementById('end-time-slots-container');
            timeSlotsContainer.style.display = 'none'; // Hide initially
            timeSlotsContainer.innerHTML = ''; // Clear previous slots

            // Mock data: simulate an API call (replace with actual AJAX request)
            setTimeout(function() {
                const availableTimes = {
                    '2024-11-13': ['09:00', '10:00', '11:00'],
                    '2024-11-14': ['12:00', '14:00', '15:00'],
                };

                const times = availableTimes[date] || [];
                if (times.length > 0) {
                    times.forEach(function(time) {
                        const timeSlotDiv = document.createElement('div');
                        timeSlotDiv.classList.add('time-slot');
                        timeSlotDiv.textContent = time;
                        timeSlotDiv.addEventListener('click', function() {
                            const hiddenInputId = sessionType === 'start' ?
                                'start-session-slot' : 'end-session-slot';
                            document.getElementById(hiddenInputId).value = date + ' ' +
                                time + ':00';
                            document.querySelectorAll(
                                    `#${sessionType}-time-slots-container .time-slot`)
                                .forEach(slot => slot.classList.remove('selected'));
                            timeSlotDiv.classList.add('selected');
                        });
                        timeSlotsContainer.appendChild(timeSlotDiv);
                    });
                    timeSlotsContainer.style.display = 'block'; // Show slots after loading
                } else {
                    timeSlotsContainer.innerHTML = '<div>No available times for this date.</div>';
                    timeSlotsContainer.style.display = 'block';
                }
            }, 500);
        }

        // Event listener for start date
        startDateInput.addEventListener('change', function() {
            loadAvailableTimes(startDateInput.value, 'start');
        });

        // Event listener for end date
        endDateInput.addEventListener('change', function() {
            loadAvailableTimes(endDateInput.value, 'end');
        });
    });
</script>

<style>
    /* Time Slot Styling */
    .time-slot {
        padding: 8px;
        margin: 5px 0;
        background-color: #f0f0f0;
        cursor: pointer;
    }

    .time-slot.selected {
        background-color: #007bff;
        color: white;
    }
</style>
