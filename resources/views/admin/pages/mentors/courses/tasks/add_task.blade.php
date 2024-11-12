@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Add Mentor Modal -->
<div style="height: auto" id="addTaskModal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Mentor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>

            <div class="modal-body">
                <form action="{{ route('mentor.tasks.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <input type="number" name="mentor_id" id="mentorId" value="{{ $course->mentor_id }}" hidden>
                    <input type="number" name="course_id" id="mentorId" value="{{ $course->id }}" hidden>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label for="taskTitle" class="col-form-label">Task Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" id="taskTitle" required>
                                <div class="invalid-feedback">Please provide a task title.</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label for="taskDueDate" class="col-form-label">Due Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="due_date" class="form-control" id="taskDueDate" required>
                                <div class="invalid-feedback">Please select a due date.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="input-block mb-3">
                                <label for="taskDescription" class="col-form-label">Description <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" id="taskDescription" rows="3" required></textarea>
                                <div class="invalid-feedback">Please provide a task description.</div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const newUserRadio = document.getElementById('flexRadioDefault1');
        const defaultUserRadio = document.getElementById('flexRadioDefault2');

        const newUserFields = document.querySelectorAll('.new-user-fields');
        const defaultUserFields = document.querySelectorAll('.choose-default-user-fields');

        // Initialize visibility based on the radio selection
        if (newUserRadio.checked) {
            showNewUserFields();
        } else if (defaultUserRadio.checked) {
            showDefaultUserFields();
        }

        newUserRadio.addEventListener('change', showNewUserFields);
        defaultUserRadio.addEventListener('change', showDefaultUserFields);

        function showNewUserFields() {
            newUserFields.forEach(field => field.style.display = 'block');
            defaultUserFields.forEach(field => field.style.display = 'none');
        }

        function showDefaultUserFields() {
            newUserFields.forEach(field => field.style.display = 'none');
            defaultUserFields.forEach(field => field.style.display = 'block');
        }
    });
</script>
