<!-- Modal Add Meeting -->
<div class="modal fade none-border" id="add-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Schedule a Quick Meeting</strong></h4>
            </div>

            <!-- Display Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="modal-body">
                <form method="POST" action="{{ route('meetings.add') }}">
                    @csrf <!-- Include CSRF token for security -->

                    <div class="row">
                        <!-- Student Name Selection -->

                        <div class="col-md-12 mb-3">
                            <label class="control-label">Choose Student Name</label>
                            <select class="form-control form-white" id="single-select" name="user_id" required>
                                <option disabled selected>Choose a name...</option>
                                @foreach ($usernames as $user)
                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Meeting Status Selection -->

                        {{-- <div class="col-md-6 mb-3">
                            <label class="control-label">Choose Status</label>
                            <select class="form-control form-white" name="status" required>
                                <option disabled selected>Select Status</option>
                                @foreach ($statuses as $stat)
                                    <option value="{{ $stat }}">{{ $stat }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <input type="hidden" value="scheduled" name="status" />


                        <!-- Start Session Datepicker -->
                        <div class="col-md-6 mb-3">
                            <label class="control-label">Start Session</label>
                            <input id="start-session-datepicker" type="text" placeholder="Select a date"
                                class="form-control">
                            <div id="start-time-slots" class="time-slots" style="display: none;"></div>
                            <input type="hidden" name="start_session" id="start-time-slot">
                        </div>

                        <!-- End Session Datepicker -->
                        <div class="col-md-6 mb-3">
                            <label class="control-label">End Session</label>
                            <input id="end-session-datepicker" type="text" placeholder="Select a date"
                                class="form-control">
                            <div id="end-time-slots" class="time-slots" style="display: none;"></div>
                            <input type="hidden" name="end_session" id="end-time-slot">
                        </div>

                        <!-- Meeting Link Input -->
                        <div class="col-md-12 mb-3">
                            <label class="control-label">Meeting Link</label>
                            <input required class="form-control form-white" placeholder="https://example.com/meeting"
                                type="url" name="meeting_link">
                        </div>

                        <!-- Notes Input -->
                        <div class="col-12 mb-3">
                            <label class="control-label">Notes</label>
                            <textarea class="form-control form-white" placeholder="Enter description" name="notes" rows="3"></textarea>
                        </div>
                    </div>

                    <!-- Save Button -->


            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for Datepickers and Time Slot Loading -->
<script>
    $(function() {
        // Datepicker configuration for Start Session
        $("#start-session-datepicker").datepicker({
            minDate: 0,
            onSelect: function(dateText) {
                loadAvailableTimes(dateText, 'start');
            },
            dateFormat: 'yy-mm-dd'
        });

        // Datepicker configuration for End Session
        $("#end-session-datepicker").datepicker({
            minDate: 0,
            onSelect: function(dateText) {
                loadAvailableTimes(dateText, 'end');
            },
            dateFormat: 'yy-mm-dd'
        });

        // Load available times based on the selected date
        function loadAvailableTimes(date, sessionType) {
            const timeSlotsId = sessionType === 'start' ? '#start-time-slots' : '#end-time-slots';
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
                            // Create a Date object for the current time slot
                            const timeSlotDateTime = new Date(date + ' ' + time);

                            // For today, only show time slots that are now or in the future
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

                    // Update the hidden input with formatted datetime
                    const selectedDateTime = `${selectedDate.toISOString().split('T')[0]} ${time}:00`;
                    if (sessionType === 'start') {
                        $('#start-time-slot').val(selectedDateTime);
                    } else {
                        $('#end-time-slot').val(selectedDateTime);
                    }
                });
            $(timeSlotsId).append(timeSlot);
        }
    });
</script>
