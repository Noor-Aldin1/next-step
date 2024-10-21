@extends('user.m-user.main')

@section('content')
    <!--**********************************
                                                                                                        Content body start
                                                                                                    ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            @include('user.m-user.partials.nav-course')

            <div class="row">
                @include('user.m-user.partials.sideinfo')

                <div class="col-xl-9 col-xxl-8 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-primary mb-4">Assignments</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Scrollable container for assignments -->
                            <div class="overflow-auto" style="max-height: 400px;">
                                <ul class="list-group mb-3 list-group-flush">
                                    @foreach ($tasks as $task)
                                        <li class="list-group-item border-0 px-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <!-- Task title -->
                                                <a href="#" class="text-primary disabled">
                                                    {{ $task->title }}
                                                </a>
                                                <!-- Task due date -->
                                                <span class="badge badge-pill badge-primary">{{ $task->due_date }}</span>
                                            </div>
                                            <br>
                                            <div class="text-muted d-flex justify-content-start align-items-center">
                                                <!-- Button to view task description -->
                                                <button class="btn" data-toggle="modal" style="background: #6673fd"
                                                    data-target="#taskModal" data-description="{{ $task->description }}">
                                                    View Description
                                                </button>

                                                @php
                                                    // Retrieve the submission for the current task
                                                    $submission = $submissions[$task->id] ?? null; // This will be the file path as a string or null
                                                @endphp

                                                <!-- Check if the task has already been submitted -->
                                                @if ($submission)
                                                    <!-- Button to view submission -->
                                                    <a href="{{ asset('storage/' . $submission) }}" target="_blank"
                                                        class="btn btn-info  ml-2">
                                                        View Submission
                                                    </a>
                                                @else
                                                    <!-- Optional placeholder or other actions if not submitted -->
                                                    <span class="text-muted ml-2">No submission yet</span>

                                            </div>

                                            <!-- Upload file form -->
                                            <form
                                                action="{{ route('task.submit', ['mentorId' => $mentorId, 'task_id' => $task->id]) }}"
                                                method="POST" enctype="multipart/form-data" class="mt-2 submit-form">
                                                @csrf
                                                <div class="d-flex align-items-center">
                                                    <input type="hidden" name="student_id" value="{{ auth()->id() }}">
                                                    <input type="file" class="form-control-file" name="submission"
                                                        required>
                                                    <button type="submit"
                                                        class="btn btn-success btn-sm ml-2">Upload</button>
                                                </div>
                                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                            </form>
                                    @endif

                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- End scrollable container -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
                                                                                                        Content body end
                                                                                                    ***********************************-->

    <!-- Modal for task description -->
    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Task Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="taskDescription"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert2 and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // SweetAlert2 confirmation for form submission
            document.querySelectorAll('.submit-form').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent the form from submitting immediately

                    const formElement = this; // Reference to the form being submitted

                    // Show the SweetAlert2 confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this submission!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, submit it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formElement.submit(); // Submit the form if confirmed
                        }
                    });
                });
            });

            // Set the task description in the modal
            $('#taskModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var description = button.data('description'); // Extract info from data-* attributes
                console.log(description); // Debug log to check description value
                var modal = $(this);
                modal.find('#taskDescription').text(description); // Update the modal's content
            });
        });
    </script>

@endsection
