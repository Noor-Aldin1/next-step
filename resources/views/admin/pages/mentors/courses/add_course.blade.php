@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Add Course Modal -->
<div style="height: auto" id="addCourseModal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('admin.courses.store') }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label for="mentorSelect" class="col-form-label">Select Mentor <span
                                        class="text-danger">*</span></label>
                                <select name="mentor_id" id="mentorSelect" class="form-control" required
                                    onchange="filterUsers()">
                                    <option value="" disabled selected>Select a mentor</option>
                                    @foreach ($nameMentors as $mentor)
                                        <option value="{{ $mentor->mentor->id }}">
                                            {{ $mentor->mentor->user->username }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select a mentor.</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label for="userSelect" class="col-form-label">Select User <span
                                        class="text-danger">*</span></label>
                                <select name="student_id" id="userSelect" class="form-control" required>
                                    <option value="" disabled selected>Select a user</option>
                                    @foreach ($nameMentors as $mentor)
                                        <option value="{{ $mentor->student->id }}"
                                            data-mentor-id="{{ $mentor->mentor->id }}">
                                            {{ $mentor->student->username }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select a user associated with the mentor.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label for="courseTitle" class="col-form-label">Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" id="courseTitle" required>
                                <div class="invalid-feedback">Please provide a course title.</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label for="coursePhoto" class="col-form-label">Photo <span
                                        class="text-danger">*</span></label>
                                <input type="file" name="photo" class="form-control" id="coursePhoto"
                                    accept="image/*" required>
                                <div class="invalid-feedback">Please upload a course photo in an image format (max 2MB).
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="input-block mb-3">
                                <label for="courseDescription" class="col-form-label">Description <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" id="courseDescription" rows="3" required></textarea>
                                <div class="invalid-feedback">Please provide a course description.</div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function filterUsers() {
        const mentorId = document.getElementById('mentorSelect').value;
        const userSelect = document.getElementById('userSelect');

        // Loop through all options in the user select and show/hide based on mentorId
        for (const option of userSelect.options) {
            if (option.getAttribute('data-mentor-id') === mentorId) {
                option.hidden = false;
            } else {
                option.hidden = true;
            }
        }

        // Reset the selected user when mentor changes
        userSelect.value = '';
    }
</script>
