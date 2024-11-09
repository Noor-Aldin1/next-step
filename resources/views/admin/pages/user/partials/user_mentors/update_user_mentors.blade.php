<!-- Display Errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Edit Mentor Modal -->
<div id="edit_user_mentor" class="modal custom-modal fade" role="dialog" style="height: 61%;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Mentor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($userMentor))
                    <form action="{{ isset($userMentor) ? route('admin.user_mentors.update', $userMentor->id) : '#' }}"
                        method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>

                        @csrf
                        @method('PUT')
                        {{-- <input type="hidden" name="user_id" id="user_id" value="{{ $id }}"> --}}

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">User<span class="text-danger">*</span></label>
                                    <div class="custom-select-wrapper">
                                        <select class="form-control select2" name="student_id" id="user_id" required>
                                            <option selected disabled>Select Mentor</option>
                                            @foreach ($usersactive as $student)
                                                <option value="{{ $student->id }}"
                                                    @if (isset($userMentor) && $userMentor->user_id == $student->id) selected @endif>
                                                    {{ $student->username }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="invalid-feedback">Please select a mentor.</div>
                                </div>
                            </div>
                            <!-- Mentor Dropdown with Select2 (Pre-filled with existing mentor) -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Mentor<span class="text-danger">*</span></label>
                                    <div class="custom-select-wrapper">
                                        <select class="form-control select2" name="mentor_id" id="mentor_id" required>
                                            <option selected disabled>Select Mentor</option>
                                            @foreach ($mentors as $mentor)
                                                <option value="{{ $mentor->id }}"
                                                    @if ($userMentor->mentor_id == $mentor->id) selected @endif>
                                                    {{ $mentor->user->username }}
                                                    <!-- Assuming 'user' relationship provides 'username' -->
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="invalid-feedback">Please select a mentor.</div>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Update</button>
                        </div>
                    </form>
                @else
                    <form></form>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Include Select2 and jQuery -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<!-- Initialize Select2 and Form Validation -->
<script>
    $(document).ready(function() {
        // Initialize Select2 on elements with the 'select2' class
        $('.select2').select2({
            width: '100%', // Full width of the container
            placeholder: 'Please select', // Placeholder text
            allowClear: true // Allow clearing the selection
        });

        // Script to populate modal fields with data when an edit button is clicked
        $('a[data-bs-toggle="modal"]').on('click', function() {
            const mentorId = $(this).data('mentor-id');
            $('#mentor_id').val(mentorId).trigger('change'); // Trigger change to update select2
        });
    });

    // Bootstrap form validation
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
