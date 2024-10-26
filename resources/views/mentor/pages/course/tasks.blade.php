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
                                    @foreach ($tasks as $index => $task)
                                        <li class="list-group-item border-0 px-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <!-- Task title -->
                                                <a href="#"
                                                    class="text-primary {{ \Carbon\Carbon::now()->greaterThan($task->due_date) ? 'disabled' : '' }}">
                                                    {{ $loop->iteration }} - {{ $task->title }}
                                                </a>
                                                <!-- Task due date -->
                                                <span class="badge badge-pill badge-primary">
                                                    <span>End Task:</span>
                                                    {{ $task->due_date ? $task->due_date : 'No due date' }}
                                                    <!-- Format the date -->
                                                </span>
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
                                                        class="btn btn-info ml-2">
                                                        View Submission
                                                    </a>
                                                @else
                                                    <!-- Optional placeholder or other actions if not submitted -->
                                                    <span class="text-muted ml-2">No submission yet</span>
                                                @endif
                                            </div>

                                            <!-- Alert if task has ended and no submission is made -->
                                            @if (\Carbon\Carbon::now()->greaterThan($task->due_date) && !$submission)
                                                <div style="color:red" class="-red mt-2" role="alert">
                                                    The deadline for this task has passed, and submissions are no longer
                                                    allowed.
                                                </div>
                                            @elseif (!\Carbon\Carbon::now()->greaterThan($task->due_date) && !$submission)
                                                <!-- Upload file form -->
                                                <form
                                                    action="{{ route('task.submit', ['mentorId' => $mentorId, 'task_id' => $task->id]) }}"
                                                    method="POST" enctype="multipart/form-data" class="mt-2 submit-form">
                                                    @csrf
                                                    <div class="d-flex align-items-center">
                                                        @auth

                                                            <input type="hidden" name="student_id" value="{{ auth()->id() }}">
                                                        @endauth
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



@endsection
