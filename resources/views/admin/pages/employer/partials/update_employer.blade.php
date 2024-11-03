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
                <form action="{{ route('admin.employers.update', $employee->id) }}" method="POST"
                    class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Specify the method as PUT for updates -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="username"
                                    value="{{ old('username', $employee->user->username) }}" required>
                                <div class="invalid-feedback">
                                    Please provide a valid username.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email"
                                    value="{{ old('email', $employee->user->email) }}" required>
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
                                <input class="form-control" type="text" name="company_name"
                                    value="{{ old('company_name', $employee->company_name) }}" required>
                                <div class="invalid-feedback">
                                    Please provide a company name.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Business Sector <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="business_sector"
                                    value="{{ old('business_sector', $employee->business_sector) }}" required>
                                <div class="invalid-feedback">
                                    Please provide a business sector.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Employee Number <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="employee_num"
                                    value="{{ old('employee_num', $employee->employee_num) }}" required>
                                <div class="invalid-feedback">
                                    Please provide a valid employee number.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">City <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="city"
                                    value="{{ old('city', $employee->city) }}" required>
                                <div class="invalid-feedback">
                                    Please provide a city.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Account Manager <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="account_manager"
                                    value="{{ old('account_manager', $employee->account_manager) }}" required>
                                <div class="invalid-feedback">
                                    Please provide an account manager name.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="phone"
                                    value="{{ old('phone', $employee->phone) }}" required>
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
