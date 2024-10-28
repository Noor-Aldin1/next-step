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

                            <!-- Task Section -->
                            <div>
                                <div class="d-flex justify-content-between">
                                    <h4 class="text-primary">Upcoming Tasks</h4>

                                </div>
                                <div class="overflow-auto" style="max-height: 400px;">
                                    @if ($errors->any())
                                        <div class="alert alert-danger mb-3">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="list-group">
                                        @if ($tasks->isEmpty())
                                            <div class="list-group-item text-center text-muted">
                                                No tasks yet.
                                            </div>
                                        @else
                                            @foreach ($tasks as $task)
                                                <div class="list-group-item p-4 border-0 shadow-sm mb-2"
                                                    style="border-radius: 8px; background-color: #f9f9f9;">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h5 class="mb-1 font-weight-bold">{{ $task->title }}</h5>
                                                            <p class="mb-1"><strong>Expected Delivery:</strong>
                                                                {{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y') }}
                                                            </p>
                                                            <p class="mb-1"><strong>Date Submitted:</strong>
                                                                {{ \Carbon\Carbon::parse($task->completion_date)->format('F j, Y') }}
                                                            </p>


                                                            <!-- Details button to trigger the modal -->
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-secondary mt-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#taskModal{{ $task->id }}">
                                                                Details
                                                            </button>
                                                        </div>
                                                        <div>
                                                            @if ($task->submission != null)
                                                                <a href="{{ asset('storage/' . $task->submission) }}"
                                                                    target="_blank"
                                                                    class="btn btn-sm btn-outline-primary mt-2">
                                                                    View Submission
                                                                </a>
                                                            @else
                                                                <span class="text-muted mt-2 d-block">No submission
                                                                    yet</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal for task description -->
                                                <div class="modal fade" id="taskModal{{ $task->id }}" tabindex="-1"
                                                    aria-labelledby="taskModalLabel{{ $task->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="taskModalLabel{{ $task->id }}">
                                                                    {{ $task->title }} - Description</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">❌</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>{{ $task->description }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <!-- Include Bootstrap JS (if not already included) -->
                                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content body end -->




@endsection
