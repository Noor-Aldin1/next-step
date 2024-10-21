@extends('user.m-user.main')

@section('content')
    <!--**********************************
                                                                                                                                                                Content body start
                                                                                                                                                            ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0" style="background-color: #6673fd;">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light px-3" style="background-color: #6673fd;">
                        <a class="navbar-brand text-white" href="#">Course Details</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="#">Tasks</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="#">Materials</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>


            <div class="row">
                @include('user.m-user.partials.sideinfo')
            
                <div class="col-xl-9 col-xxl-8 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <p>{{ $course->description }}</p>
                            <hr>
                            {{-- this is Lecture --}}
                            <div>
                                <div class="card-body">
                                    <!-- Upcoming Lecture Periods -->
                                    <h4 class="text-primary">Upcoming Lecture Periods</h4>
                                    <div class="list-group">
                                        @if (!$duration->isEmpty())
                                            <!-- Check if there are upcoming lectures -->
                                            @foreach ($duration as $time)
                                                @php
                                                    // Get the current time and the lecture start and end time
                                                    $currentTime = \Carbon\Carbon::now();
                                                    $lectureStartTime = \Carbon\Carbon::parse($time->start_session);
                                                    $lectureEndTime = \Carbon\Carbon::parse($time->end_session); // Ensure end_session is available

                                                    // Determine if the lecture is about to start (within the next 10 minutes)
                                                    $isAboutToStart =
                                                        $currentTime->diffInMinutes($lectureStartTime) <= 10 &&
                                                        $currentTime->lessThanOrEqualTo($lectureStartTime);
                                                @endphp

                                                @if ($currentTime->lessThan($lectureEndTime) && $currentTime->greaterThanOrEqualTo($lectureStartTime))
                                                    <!-- Display ongoing lectures -->
                                                    <div class="list-group-item d-flex align-items-center justify-content-between rounded-pill border-0 mb-2"
                                                        style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                                        <div class="d-flex align-items-center">
                                                            <span
                                                                class="badge bg-primary me-3 p-2">{{ $lectureStartTime->format('h:i A') }}</span>
                                                            <span
                                                                class="fs-5">{{ $time->title ?? 'Introduction to Early Education' }}</span>
                                                        </div>
                                                        <button class="btn btn-link text-primary" data-bs-toggle="modal"
                                                            data-bs-target="#lectureModal"
                                                            data-details="{{ $time->description }}"
                                                            data-link="{{ $time->linke_lecture }}"
                                                            data-is-about-to-start="false"> <!-- Pass the state to modal -->
                                                            View Details
                                                        </button>
                                                    </div>
                                                    <p class="text-success">The lecture is still ongoing.</p>
                                                @elseif ($isAboutToStart)
                                                    <!-- Display lectures that are about to start -->
                                                    <div class="list-group-item d-flex align-items-center justify-content-between rounded-pill border-0 mb-2"
                                                        style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                                        <div class="d-flex align-items-center">
                                                            <span
                                                                class="badge bg-warning me-3 p-2">{{ $lectureStartTime->format('h:i A') }}</span>
                                                            <span
                                                                class="fs-5">{{ $time->title ?? 'Introduction to Early Education' }}</span>
                                                        </div>
                                                        <button class="btn btn-link text-primary" data-bs-toggle="modal"
                                                            data-bs-target="#lectureModal"
                                                            data-details="{{ $time->description }}"
                                                            data-link="{{ $time->linke_lecture }}"
                                                            data-is-about-to-start="true"> <!-- Pass the state to modal -->
                                                            View Details
                                                        </button>
                                                    </div>
                                                    <p class="text-warning">The lecture is about to start.</p>
                                                @else
                                                    <!-- Status message for the completed lecture -->
                                                    @if ($currentTime->greaterThan($lectureEndTime))
                                                        <div class="list-group-item d-flex align-items-center justify-content-between rounded-pill border-0 mb-2"
                                                            style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                                            <span class="fs-5">{{ $time->title ?? 'No Title' }} - Lecture
                                                                Completed</span>
                                                        </div>
                                                        <p class="text-danger">The lecture has been completed.</p>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="list-group-item d-flex align-items-center justify-content-between rounded-pill border-0 mb-2"
                                                style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                                There are no lectures scheduled yet.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for displaying lecture details -->
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
                                                disabled>
                                                Enter the Lecture
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                            <script>
                                // Event listener for the modal
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

                                    // Enable or disable the link based on whether the lecture is about to start
                                    modalLink.disabled = isAboutToStart && new Date() < new Date('{{ $time->start_session }}');
                                });
                            </script>
                            {{-- end Lecture --}}




                         
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--**********************************
                                                                                                                                                                Content body end
                                                                                                                                                            ***********************************-->
@endsection
