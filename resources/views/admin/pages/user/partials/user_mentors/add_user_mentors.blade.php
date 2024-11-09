@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Add User Mentors Modal -->
<div id="add_user_mentor" class="modal custom-modal fade" role="dialog" style="height: 61%;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User Mentor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.user_mentors.store') }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="row">
                        <!-- Mentor Dropdown with Select2 -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Mentor<span class="text-danger">*</span></label>
                                <div class="custom-select-wrapper">
                                    <select class="form-control select2" name="mentor_id" required>
                                        <option selected disabled>Select Mentor</option>
                                        @foreach ($userMentors as $userMentor)
                                            @if ($userMentor->mentor)
                                                <!-- Ensure mentor exists -->
                                                <option value="{{ $userMentor->mentor->id }}">
                                                    {{ $userMentor->mentor->username }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="invalid-feedback">
                                    Please select a mentor.
                                </div>
                            </div>
                        </div>

                        <!-- Student Dropdown with Select2 -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Student<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="student_id" required>
                                    <option selected disabled>Select Student</option>
                                    @foreach ($usersactive as $student)
                                        <option value="{{ $student->id }}">{{ $student->username }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select a student.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (Required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 on elements with the 'select2' class
        $('.select2').select2({
            width: '100%', // Ensures it takes full width of container
            placeholder: 'Please select', // Placeholder text
            allowClear: true // Allows clear functionality
        });
    });

    // JavaScript for form validation
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
