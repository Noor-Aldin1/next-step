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
                                    <h4><a data-toggle="modal" data-target="#add-task-modal" href="#">Add Task ➕</a>
                                    </h4>
                                </div>
                                <div class="overflow-auto" style="max-height: 400px;">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="list-group">
                                        @if ($tasks->isEmpty())
                                            <div class="list-group-item">No tasks yet.</div>
                                        @else
                                            @foreach ($tasks as $task)
                                                <div class="list-group-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h5>{{ $task->title }}</h5>
                                                            <p>{{ $task->description }}</p>
                                                            <p><strong>Due Date:</strong> {{ $task->due_date }}</p>
                                                            <p><strong>Status:</strong>
                                                                <span
                                                                    class="
                                                            @if ($task->status === 'pending') text-warning
                                                            @elseif($task->status === 'in_progress') text-info
                                                            @elseif($task->status === 'completed') text-success @endif">
                                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div class="btn-group">
                                                            <!-- Edit button with modal trigger -->
                                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                                data-target="#editTaskModal-{{ $task->id }}">Edit</button>

                                                            <!-- Delete button with SweetAlert2 confirmation -->
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="deleteTask({{ $task->id }})">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Edit Task Modal -->
                                                <div class="modal fade" id="editTaskModal-{{ $task->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="editTaskModalLabel-{{ $task->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editTaskModalLabel-{{ $task->id }}">Edit Task
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('mentor.tasks.update', $task->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="title-{{ $task->id }}">Title</label>
                                                                        <input type="text" name="title"
                                                                            class="form-control"
                                                                            id="title-{{ $task->id }}"
                                                                            value="{{ $task->title }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="description-{{ $task->id }}">Description</label>
                                                                        <textarea name="description" class="form-control" id="description-{{ $task->id }}">{{ $task->description }}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="due_date-{{ $task->id }}">Due
                                                                            Date</label>
                                                                        <input type="date" name="due_date"
                                                                            class="form-control"
                                                                            id="due_date-{{ $task->id }}"
                                                                            value="{{ $task->due_date }}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content body end -->

    {{-- --------- Modal Add Task --------- --}}
    <div class="modal fade none-border" id="add-task-modal">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Add Task</strong></h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mentor.tasks.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="control-label">Title</label>
                                <input class="form-control form-white" placeholder="Enter title" type="text"
                                    name="title" required>
                            </div>

                            <div class="col-md-6 mb-3 d-none">
                                <label class="control-label">Choose Course</label>
                                <select class="form-control form-white" id="course-select" name="course_id" required>
                                    <option selected disabled value="{{ $course->id }}">{{ $course->title }}</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="control-label">Due Date</label>
                                <input id="last_date_to_apply" type="date" class="form-control" name="due_date" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="control-label">Description</label>
                                <textarea class="form-control form-white" placeholder="Enter description" name="description" rows="3"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 script for delete confirmation -->
    <script>
        function deleteTask(taskId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the delete action
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ url('mentor/tasks') }}' + '/' + taskId;
                    const csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(csrfField);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Show success/error alerts
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Set the minimum date for Last Date To Apply to today
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd; // Format as YYYY-MM-DD

            $('#last_date_to_apply').attr('min', today);

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = $('.needs-validation');

            // Loop over them and prevent submission
            forms.each(function() {
                $(this).on('submit', function(event) {
                    if (!this.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        // You can add any custom logic here before submission if needed
                    }

                    $(this).addClass('was-validated');
                });
            });
        });
    </script>
@endsection
