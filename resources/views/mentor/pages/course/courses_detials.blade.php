@extends('mentor.master_page')

@section('content')
    <!-- Content body start -->
    <div class="content-body">
        <div class="container-fluid">
            @include('mentor.pages.course.nav-course')

            <div class="row">
                @include('mentor.pages.course.sideinfo')

                <div class="col-xl-9 col-xxl-8 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <p>{{ $course->description }}</p>
                            <hr>

                            <!-- Lecture Schedule Section -->
                            <div>
                                <h4 class="text-primary">Upcoming Lecture Periods</h4>
                                <div class="overflow-auto" style="max-height: 400px;">
                                    <div class="list-group">
                                        @forelse ($lectures as $lecture)
                                            @php
                                                $currentTime = \Carbon\Carbon::now();
                                                $lectureStartTime = \Carbon\Carbon::parse($lecture->start_session);
                                                $lectureEndTime = \Carbon\Carbon::parse($lecture->end_session);
                                                $isAboutToStart =
                                                    $currentTime->diffInMinutes($lectureStartTime) <= 10 &&
                                                    $currentTime->lessThanOrEqualTo($lectureStartTime);
                                            @endphp

                                            <div class="list-group-item d-flex align-items-center justify-content-between rounded-pill border-0 mb-2"
                                                style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="badge bg-primary me-3 p-2">{{ $lectureStartTime->format('h:i A') }}</span>
                                                    <span class="fs-5">{{ $lecture->title }}</span>
                                                </div>
                                                <button class="btn btn-link text-primary" data-bs-toggle="modal"
                                                    data-bs-target="#lectureModal"
                                                    data-details="{{ $lecture->description }}"
                                                    data-link="{{ $lecture->linke_lecture }}"
                                                    data-is-about-to-start="{{ $isAboutToStart }}">
                                                    View Details
                                                </button>
                                            </div>

                                            @if ($currentTime->between($lectureStartTime, $lectureEndTime))
                                                <p class="text-success">The lecture is ongoing.</p>
                                            @elseif ($isAboutToStart)
                                                <p class="text-warning">The lecture is about to start.</p>
                                            @else
                                                <p class="text-danger">The lecture has been completed.</p>
                                            @endif
                                        @empty
                                            <div class="list-group-item">No lectures scheduled yet.</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <!-- Lecture Creation Form -->
                            <hr>
                            <h4 class="text-primary mt-4">Create a New Lecture</h4>
                            <div id="form-errors" class="alert alert-danger d-none"></div>
                            <form id="lectureForm">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="title">Lecture Title:</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Lecture Description:</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="linke_lecture">Lecture Link:</label>
                                    <input type="url" name="linke_lecture" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="start_session">Start Time:</label>
                                    <input type="text" id="start_session" name="start_session" class="form-control"
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="end_session">End Time:</label>
                                    <input type="text" id="end_session" name="end_session" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Schedule Lecture</button>
                            </form>

                            <script>
                                // Initialize Mobiscroll datepickers
                                $('#start_session').mobiscroll().datetime({
                                    controls: ['calendar', 'time'],
                                    touchUi: true,
                                    min: new Date(), // Disable past dates
                                    onSet: function(event) {
                                        if (event.valueText) {
                                            $('#start_session').val(event.valueText);
                                            // Call the function to fetch available dates based on the selected start date
                                            fetchAvailableDates(event.valueText);
                                        }
                                    }
                                });

                                $('#end_session').mobiscroll().datetime({
                                    controls: ['calendar', 'time'],
                                    touchUi: true,
                                    min: new Date(), // Disable past dates
                                    onSet: function(event) {
                                        if (event.valueText) {
                                            $('#end_session').val(event.valueText);
                                        }
                                    }
                                });

                                function fetchAvailableDates(selectedDate) {
                                    $.ajax({
                                        url: '/api/available-dates', // URL to your API endpoint
                                        type: 'GET',
                                        data: {
                                            start_date: selectedDate
                                        },
                                        success: function(response) {
                                            if (response.available_dates) {
                                                alert("Available Dates: " + response.available_dates.join(", "));
                                            } else {
                                                alert("No available dates.");
                                            }
                                        },
                                        error: function(xhr) {
                                            alert("An error occurred while fetching available dates.");
                                        }
                                    });
                                }

                                // Handle form submission with AJAX
                                $('#lectureForm').on('submit', function(e) {
                                    e.preventDefault(); // Prevent default form submission

                                    // Clear previous errors
                                    $('#form-errors').addClass('d-none').empty();

                                    const formData = $(this).serialize(); // Get form data

                                    // Send AJAX request
                                    $.ajax({
                                        url: '{{ route('courses.student.schedule', $course->id) }}',
                                        type: 'POST',
                                        data: formData,
                                        success: function(response) {
                                            alert("Lecture scheduled successfully!"); // Success message
                                            location.reload(); // Reload the page to see new lecture
                                        },
                                        error: function(xhr) {
                                            if (xhr.status === 422) {
                                                const errors = xhr.responseJSON.errors;
                                                for (const key in errors) {
                                                    $('#form-errors').append('<p>' + errors[key][0] + '</p>');
                                                }
                                                $('#form-errors').removeClass('d-none');
                                            } else {
                                                alert("An error occurred. Please try again.");
                                            }
                                        }
                                    });
                                });
                            </script>

                            <!-- Lecture Details Modal -->
                            <div class="modal fade" id="lectureModal" tabindex="-1" aria-labelledby="lectureModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="lectureModalLabel">Lecture Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"> ❌ </button>
                                        </div>
                                        <div class="modal-body">
                                            <p id="lectureDetails"></p>
                                            <a id="lectureLink" href="#" target="_blank" class="btn btn-primary"
                                                disabled>Enter the Lecture</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                var lectureModal = document.getElementById('lectureModal');
                                lectureModal.addEventListener('show.bs.modal', function(event) {
                                    var button = event.relatedTarget;
                                    var details = button.getAttribute('data-details');
                                    var link = button.getAttribute('data-link');
                                    var isAboutToStart = button.getAttribute('data-is-about-to-start') === 'true';

                                    var modalDetails = lectureModal.querySelector('#lectureDetails');
                                    var modalLink = lectureModal.querySelector('#lectureLink');

                                    modalDetails.textContent = details;
                                    modalLink.href = link;
                                    modalLink.disabled = isAboutToStart && new Date() < new Date('{{ $lectureStartTime }}');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content body end -->
@endsection
