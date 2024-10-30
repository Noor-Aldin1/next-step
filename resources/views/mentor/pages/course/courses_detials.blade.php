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
                            {{-- This is Lecture --}}
                            <div>
                                <div class="card-body">
                                    <!-- Upcoming Lecture Periods -->
                                    <div class="d-flex justify-content-between">
                                        <h4 class="text-primary">Upcoming Lecture Periods</h4>
                                        <h4>
                                            <a data-toggle="modal" data-target="#add-category2" href="#">Add Lecture
                                                ➕</a>
                                        </h4>
                                    </div>
                                    <!-- Scrollable list of lectures -->
                                    <div class="overflow-auto" style="max-height: 400px;">
                                        <div class="list-group">
                                            @if (!$duration->isEmpty())
                                                <!-- Display all scheduled lectures without timing conditions -->
                                                @foreach ($duration as $time)
                                                    <div class="list-group-item d-flex align-items-center justify-content-between rounded-pill border-0 mb-2"
                                                        style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                                        <div class="d-flex align-items-center">
                                                            <span
                                                                class="badge bg-primary me-3 p-2">{{ \Carbon\Carbon::parse($time->start_session)->format('h:i A') }}</span>
                                                            <span
                                                                class="fs-5">{{ $time->title ?? 'Introduction to Early Education' }}</span>
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-link text-primary" data-bs-toggle="modal"
                                                                data-bs-target="#lectureModal"
                                                                data-details="{{ $time->description }}"
                                                                data-link="{{ $time->linke_lecture }}">
                                                                View Details
                                                            </button>
                                                            <form action="{{ route('mentor.events.destroy', $time->id) }}"
                                                                method="POST" class="delete-form" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-danger delete-btn">Cancel </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="list-group-item d-flex align-items-center justify-content-between rounded-pill border-0 mb-2"
                                                    style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                                    There are no lectures scheduled yet.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End scrollable list -->
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
                                            <a id="lectureLink" href="#" target="_blank" class="btn btn-primary">
                                                Enter the Lecture
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Include SweetAlert2 library -->
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                            <script>
                                // SweetAlert2 confirmation for delete action
                                document.querySelectorAll('.delete-btn').forEach(button => {
                                    button.addEventListener('click', function(event) {
                                        event.preventDefault();
                                        const form = this.closest('.delete-form');
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            text: "This action cannot be undone!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, delete it!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                form.submit();
                                            }
                                        });
                                    });
                                });

                                // Script for lecture modal details
                                var lectureModal = document.getElementById('lectureModal');
                                lectureModal.addEventListener('show.bs.modal', function(event) {
                                    var button = event.relatedTarget;
                                    var details = button.getAttribute('data-details');
                                    var link = button.getAttribute('data-link');

                                    var modalDetails = lectureModal.querySelector('#lectureDetails');
                                    var modalLink = lectureModal.querySelector('#lectureLink');

                                    modalDetails.textContent = details;
                                    modalLink.href = link;
                                });
                            </script>
                            {{-- End Lecture --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('mentor.partials.add_lecture')
@endsection
