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
<div id="add_mentor" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Mentor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <div style="gap: 8px" class="d-flex justify-content-center align-items-center ">
                <div class="form-NewUser">
                    <input checked class="form-check-input" type="radio" name="flexRadioDefault"
                        id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        New User
                    </label>
                </div>
                <div class="form-DefaultUser">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Choose Default User
                    </label>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.mentors.store') }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row">
                        <!-- New User Fields -->
                        <div class="col-sm-6 new-user-fields">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="username" required>
                                <div class="invalid-feedback">
                                    Please provide a username.
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 new-user-fields">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" required>
                                <div class="invalid-feedback">
                                    Please provide a valid email.
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 new-user-fields">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Password <span class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="password" required>
                                <div class="invalid-feedback">
                                    Please provide a password.
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 new-user-fields">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Confirm Password <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="password_confirmation" required>
                                <div class="invalid-feedback">
                                    Please confirm your password.
                                </div>
                            </div>
                        </div>

                        <!-- Common Fields -->

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a status.
                                </div>
                            </div>
                        </div>

                        <!-- Choose Default User Fields -->
                        <div class="col-sm-6 choose-default-user-fields" style="display:none;">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Users <span class="text-danger">*</span></label>
                                <select class="form-control" name="user_idCHose" required>
                                    @if ($users->isEmpty())
                                        <option value="" disabled>No Found User for Select User</option>
                                    @else
                                        <option disabled selected value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    Please select a User.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label for="videoUpload" class="col-form-label">Video (optional)</label>
                                <input name="video" type="file" id="videoUpload" accept="video/*">
                                <div class="invalid-feedback">
                                    Please upload a valid video file.
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 new-user-fields">
                            <div class="input-block mb-3">
                                <label for="imageUpload" class="col-form-label">Photo (optional)</label>
                                <input name="image" type="file" id="imageUpload" accept="image/*">
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
