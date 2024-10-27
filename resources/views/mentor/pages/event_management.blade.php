@extends('mentor.master_page')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Events</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Events</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Events Management</a></li>
                    </ol>
                </div>
            </div>
            {{-- Event Management --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var events = @json($events); // Pass the events array

                    var calendarEl = document.getElementById('calendar');

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,listMonth,timeGridDay'
                        },
                        events: events, // Use the events array
                        eventDidMount: function(info) {
                            // Set the background color based on the event type
                            if (info.event.title === 'Lecture') {
                                info.el.style.backgroundColor = '#1BD5BA'; // Set color for lectures
                                info.el.style.color = 'white'; // Set text color for contrast
                            } else if (info.event.title === 'Meeting') {
                                info.el.style.backgroundColor = '#1E7EDE'; // Set color for meetings
                                info.el.style.color = 'white'; // Set text color for contrast
                            }

                            // You can also add custom classes for further styling
                            if (info.event.extendedProps.is_special) {
                                info.el.classList.add('special-event'); // Example class for special events
                            }
                        }
                    });

                    calendar.render();
                });
            </script>




            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar" class="app-fullcalendar"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-intro-title">Calendar</h4>

                            <div class="">
                                <div id="external-events" class="my-3">
                                    <p>Drag and drop your event or click in the calendar</p>
                                    <div class="external-event" data-class="bg-primary"><i class="fa fa-move"></i>New Theme
                                        Release</div>
                                    <div class="external-event" data-class="bg-success"><i class="fa fa-move"></i>My Event
                                    </div>
                                    <div class="external-event" data-class="bg-warning"><i class="fa fa-move"></i>Meet
                                        manager</div>
                                    <div class="external-event" data-class="bg-dark"><i class="fa fa-move"></i>Create New
                                        theme</div>
                                </div>
                                <!-- checkbox -->
                                <div class="checkbox custom-control checkbox-event custom-checkbox pt-3 pb-5">
                                    <input type="checkbox" class="custom-control-input" id="drop-remove">
                                    <label class="custom-control-label" for="drop-remove">Remove After Drop</label>
                                </div>
                                <a href="javascript:void()" data-toggle="modal" data-target="#add-category"
                                    class="btn btn-primary btn-event w-100">
                                    <span class="align-middle"><i class="ti-plus"></i></span> Arrange a Meeting
                                </a>
                                <br>
                                <br>
                                <a href="javascript:void()" data-toggle="modal" data-target="#add-category2"
                                    class="btn btn-primary btn-event w-100">
                                    <span class="align-middle"><i class="ti-plus"></i></span> Schedule a lecture
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN MODAL -->
                <div class="modal fade none-border" id="event-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Add New Event</strong></h4>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect"
                                    data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success save-event waves-effect waves-light">Create
                                    event</button>

                                <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                                    data-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Add meeting -->
                @include('mentor.partials.add_meeting')

                @include('mentor.partials.add_lecture')


                {{-- -------Schedule a lecture------- --}}

            </div>

        </div>
    </div>
@endsection
