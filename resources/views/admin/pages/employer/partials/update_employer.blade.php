<!-- Edit Employee Modal -->
<div id="edit_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editEmployeeForm" action="{{ route('admin.employers.update', ':id') }}" method="POST"
                    class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Specify the method as PUT for updates -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                <input id="editUsername" class="form-control" type="text" name="username" required>
                                <div class="invalid-feedback">
                                    Please provide a valid username.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input id="editEmail" class="form-control" type="email" name="email" required>
                                <div class="invalid-feedback">
                                    Please provide a valid email.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Password <span class="text-danger">*</span> (leave blank
                                    to keep current)</label>
                                <input class="form-control" type="password" name="password">
                                <div class="invalid-feedback">
                                    Please provide a password.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Confirm Password</label>
                                <input class="form-control" type="password" name="password_confirmation">
                                <div class="invalid-feedback">
                                    Please confirm your password.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Company Name <span class="text-danger">*</span></label>
                                <input id="editCompanyName" class="form-control" type="text" name="company_name"
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a company name.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Business Sector <span class="text-danger">*</span></label>
                                <input id="editBusinessSector" class="form-control" type="text"
                                    name="business_sector" required>
                                <div class="invalid-feedback">
                                    Please provide a business sector.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Employee Number <span class="text-danger">*</span></label>
                                <input id="editEmployeeNum" class="form-control" type="number" name="employee_num"
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid employee number.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">City <span class="text-danger">*</span></label>
                                <input id="editCity" class="form-control" type="text" name="city" required>
                                <div class="invalid-feedback">
                                    Please provide a city.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Account Manager <span class="text-danger">*</span></label>
                                <input id="editAccountManager" class="form-control" type="text"
                                    name="account_manager" required>
                                <div class="invalid-feedback">
                                    Please provide an account manager name.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                                <input id="editPhone" class="form-control" type="text" name="phone" required>
                                <div class="invalid-feedback">
                                    Please provide a phone number.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label for="imageUpload" class="col-form-label">Photo (optional)</label>
                                <input name="image" type="file" id="imageUpload" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Employee Modal -->

<!-- Link Trigger -->
<a style=" display :none" class="dropdown-item" href="#" data-bs-toggle="modal"
    data-bs-target="#edit_employee" data-username="{{ $employ->username }}" data-email="{{ $employ->email }}"
    data-company-name="{{ $employ->company_name }}" data-business-sector="{{ $employ->business_sector }}"
    data-employee-num="{{ $employ->employee_num }}" data-city="{{ $employ->city }}"
    data-account-manager="{{ $employ->account_manager }}" data-phone="{{ $employ->phone }}"
    data-id="{{ $employ->id }}">
    <i class="fa-solid fa-pencil m-r-5"></i> Edit
</a>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#edit_employee').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var modal = $(this);

            // Update the form action with the correct employee ID
            var formAction = $('#editEmployeeForm').attr('action').replace(':id', button.data('id'));
            $('#editEmployeeForm').attr('action', formAction);

            // Populate the form fields with the data from the trigger button
            modal.find('#editUsername').val(button.data('username'));
            modal.find('#editEmail').val(button.data('email'));
            modal.find('#editCompanyName').val(button.data('company-name'));
            modal.find('#editBusinessSector').val(button.data('business-sector'));
            modal.find('#editEmployeeNum').val(button.data('employee-num'));
            modal.find('#editCity').val(button.data('city'));
            modal.find('#editAccountManager').val(button.data('account-manager'));
            modal.find('#editPhone').val(button.data('phone'));
        });
    });
</script>
