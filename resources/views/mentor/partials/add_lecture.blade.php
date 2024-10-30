<div class="modal fade none-border" id="add-category2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Schedule a Lecture</strong></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('addLecture.add') }}" method="POST">
                    @csrf <!-- CSRF token for form submission -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="control-label">Title Lecture</label>
                            <input class="form-control form-white" placeholder="Enter title" type="text"
                                name="title" required> <!-- Changed name to 'title' -->
                        </div>

                        <div class="col-md-6 mb-3">

                            @if (!empty($courseName))
                                <label class="control-label">Choose Course</label>
                                <select class="form-control form-white" id="course-select" name="course_id" required>
                                    <option disabled selected>Choose a course...</option>

                                    @foreach ($courseName as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                            @else
                                <label class="control-label">This Course</label>
                                <select disabled class="form-control form-white" id="course-select" required>
                                    <option selected>{{ $course->title }}</option>
                                </select>
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                            @endif


                        </div>

                        <!-- Start Session Datepicker -->
                        <div class="col-md-6 mb-3">
                            <label class="control-label">Start Session</label>
                            <input id="lecture-start-datepicker" type="text" placeholder="Select a date"
                                class="form-control" required>
                            <div id="start-time-slots-container" class="time-slots" style="display: none;"></div>
                            <input type="hidden" name="start_session" id="start-session-slot">
                        </div>

                        <!-- End Session Datepicker -->
                        <div class="col-md-6 mb-3">
                            <label class="control-label">End Session</label>
                            <input id="lecture-end-datepicker" type="text" placeholder="Select a date"
                                class="form-control" required>
                            <div id="end-time-slots-container" class="time-slots" style="display: none;"></div>
                            <input type="hidden" name="end_session" id="end-session-slot">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="control-label">Enter the Lecture's Link</label>
                            <input class="form-control form-white" placeholder="https://example.com/lecture"
                                type="text" name="linke_lecture" required> <!-- Ensure the name matches -->
                        </div>

                        <div class="col-12 mb-3">
                            <label class="control-label">Description</label>
                            <textarea class="form-control form-white" placeholder="Enter description" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        // Datepicker configuration for Start Session
        $("#lecture-start-datepicker").datepicker({
            minDate: 0,
            onSelect: function(dateText) {
                loadAvailableTimes(dateText, 'start');
            },
            dateFormat: 'yy-mm-dd'
        });

        // Datepicker configuration for End Session
        $("#lecture-end-datepicker").datepicker({
            minDate: 0,
            onSelect: function(dateText) {
                loadAvailableTimes(dateText, 'end');
            },
            dateFormat: 'yy-mm-dd'
        });

        // Load available times based on the selected date
        function loadAvailableTimes(date, sessionType) {
            const timeSlotsId = sessionType === 'start' ? '#start-time-slots-container' :
                '#end-time-slots-container';
            $(timeSlotsId).empty().show();

            // Get current time and today's date
            const now = new Date();
            const currentDateTime = new Date(date + ' ' + now.getHours() + ':' + now.getMinutes());
            const selectedDate = new Date(date);

            $.ajax({
                url: '/api/available-times',
                method: 'GET',
                data: {
                    date: date
                },
                success: function(response) {
                    if (response.success) {
                        const availableTimes = response.available_times[date] || [];
                        availableTimes.forEach(function(time) {
                            const timeSlotDateTime = new Date(date + ' ' + time);

                            // For today, only show times that are now or in the future
                            if (selectedDate.toDateString() === new Date().toDateString()) {
                                if (timeSlotDateTime >= currentDateTime) {
                                    appendTimeSlot(time, timeSlotsId, sessionType,
                                        selectedDate);
                                }
                            } else {
                                // For other days, show all available times
                                appendTimeSlot(time, timeSlotsId, sessionType,
                                    selectedDate);
                            }
                        });
                    } else {
                        $(timeSlotsId).append('<div>No available times for this date.</div>');
                    }
                },
                error: function() {
                    $(timeSlotsId).append('<div>Error loading available times.</div>');
                }
            });
        }

        // Function to append time slots
        function appendTimeSlot(time, timeSlotsId, sessionType, selectedDate) {
            const timeSlot = $('<div>')
                .addClass('time-slot')
                .text(time)
                .click(function() {
                    $(timeSlotsId).children().removeClass('selected');
                    $(this).addClass('selected');
                    const selectedDateTime = `${selectedDate.toISOString().split('T')[0]} ${time}:00`;
                    if (sessionType === 'start') {
                        $('#start-session-slot').val(selectedDateTime);
                    } else {
                        $('#end-session-slot').val(selectedDateTime);
                    }
                });
            $(timeSlotsId).append(timeSlot);
        }
    });
</script>
