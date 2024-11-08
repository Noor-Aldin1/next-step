@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Update User Modal -->
<div style="height: 73%;" id="update_user" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($user))
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="needs-validation"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT') <!-- Method Spoofing for PUT request -->
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="row">
                            <!-- Username -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        value="{{ $user->username }}" placeholder="Enter username" required>
                                    <div class="invalid-feedback">
                                        Please enter a username.
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ $user->email }}" placeholder="Enter email" required>
                                    <div class="invalid-feedback">
                                        Please enter an email.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Role -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Role <span class="text-danger">*</span></label>
                                    <select class="form-control" name="role_id" required>
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a role.
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Password <small>(leave blank to keep current
                                            password)</small></label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter new password">
                                    <div class="invalid-feedback">
                                        Password must be at least 8 characters long.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Photo -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Photo</label>
                                    <input type="file" class="form-control" name="photo">
                                    <div class="invalid-feedback">
                                        Please upload a valid image file.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Update</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-info">User data not available.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener for all elements with `data-bs-toggle="modal"` targeting `#update_user`
        document.querySelectorAll('a[data-bs-target="#update_user"]').forEach(button => {
            button.addEventListener('click', function() {
                // Get data attributes from the clicked link
                const userId = this.getAttribute('data-id');
                const username = this.getAttribute('data-username');
                const email = this.getAttribute('data-email');
                const roleId = this.getAttribute('data-role_id');
                const photo = this.getAttribute('data-photo');

                // Populate the modal fields
                document.querySelector('#update_user #user_id').value = userId;
                document.querySelector('#update_user #username').value = username;
                document.querySelector('#update_user #email').value = email;
                document.querySelector('#update_user #role_id').value = roleId;

                // Optionally populate the photo preview, if applicable
                if (photo) {
                    document.querySelector('#update_user #photo_preview').src =
                        `/storage/${photo}`;
                }
            });
        });
    });


    // Bootstrap form validation
    (function() {
        'use strict';
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
