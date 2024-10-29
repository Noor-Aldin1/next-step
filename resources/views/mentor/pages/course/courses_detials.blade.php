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
                                        @if ($lectures->isEmpty())
                                            <div class="list-group-item">No lectures scheduled yet.</div>
                                        @else
                                            @foreach ($lectures as $lecture)
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
                                                        data-start-time="{{ $lectureStartTime->toIso8601String() }}"
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
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

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
                                    var startTime = new Date(button.getAttribute('data-start-time'));
                                    var isAboutToStart = button.getAttribute('data-is-about-to-start') === 'true';

                                    var modalDetails = lectureModal.querySelector('#lectureDetails');
                                    var modalLink = lectureModal.querySelector('#lectureLink');

                                    modalDetails.textContent = details;
                                    modalLink.href = link;

                                    // Disable the link if the lecture has not started yet
                                    modalLink.disabled = isAboutToStart && new Date() < startTime;
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
