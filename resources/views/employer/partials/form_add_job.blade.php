<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Job Posting Form -->
                <div id="error-list" class="alert alert-danger d-none">
                    <ul></ul>
                </div>
                <form id="jobForm" class="row g-3 needs-validation" novalidate
                    action="{{ route('employer.job_postings.store') }}" method="POST">
                    @csrf
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label class="form-label font-w600">Job Title<span class="text-danger ms-2">*</span></label>
                        <input type="text" name="title" id="title" class="form-control solid"
                            placeholder="Job Title" required maxlength="255">
                        <div class="invalid-feedback">Job Title is required and must not exceed 255 characters.</div>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label class="form-label font-w600">Company Name<span class="text-danger ms-2">*</span></label>
                        <input type="text" name="company_name" id="company_name" class="form-control solid"
                            placeholder="Company Name" required maxlength="255">
                        <div class="invalid-feedback">Company Name is required and must not exceed 255 characters.</div>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label class="form-label font-w600">Position<span class="text-danger ms-2">*</span></label>
                        <input type="text" name="position" id="position" class="form-control solid"
                            placeholder="Position" required maxlength="255">
                        <div class="invalid-feedback">Position is required and must not exceed 255 characters.</div>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label class="form-label font-w600">Job Category<span class="text-danger ms-2">*</span></label>
                        <select name="category" id="category" class="form-control solid" required>
                            <option value="">Choose...</option>
                            @foreach ($categories_name as $cat)
                                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Category is required.</div>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label class="form-label font-w600">Job Type<span class="text-danger ms-2">*</span></label>
                        <select name="job_type" id="job_type" class="form-control solid" required>
                            <option value="">Choose...</option>
                            <option value="Full-time">Full-Time</option>
                            <option value="Part-time">Part-Time</option>
                            <option value="Contract">Contract</option>
                            <option value="Internship">Internship</option>
                        </select>
                        <div class="invalid-feedback">Job Type is required.</div>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label class="form-label font-w600">Experience</label>
                        <input type="text" name="experience" id="experience" class="form-control solid"
                            placeholder="4 years" maxlength="255">
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label class="form-label font-w600">Last Date To Apply<span
                                class="text-danger ms-2">*</span></label>
                        <input type="date" name="last_date_to_apply" id="last_date_to_apply" class="form-control"
                            required>
                        <div class="invalid-feedback">Last Date To Apply is required.</div>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label class="form-label font-w600">Salary</label>
                        <input type="number" required name="salary" id="salary" class="form-control solid"
                            placeholder="$" step="0.01">
                        <div class="invalid-feedback">Salary is required.</div>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label class="form-label font-w600">City<span class="text-danger ms-2">*</span></label>
                        <select name="city" id="city" class="form-control solid" required>
                            <option value="">Choose a city...</option>
                            <option value="Amman">Amman</option>
                            <option value="Irbid">Irbid</option>
                            <option value="Balqa">Balqa</option>
                        </select>
                        <div class="invalid-feedback">City is required.</div>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label class="form-label font-w600">Address<span class="text-danger ms-2">*</span></label>
                        <input type="text" name="address" id="address" class="form-control solid"
                            placeholder="Address" required maxlength="255">
                        <div class="invalid-feedback">Address is required and must not exceed 255 characters.</div>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label class="form-label font-w600">Education Level</label>
                        <input type="text" name="education_level" id="education_level" class="form-control solid"
                            placeholder="Education Level" maxlength="255">
                    </div>
                    <div class="col-xl-12 mb-4">
                        <label class="form-label font-w600">Requirements</label>
                        <textarea name="requirements" id="requirements" class="form-control solid" rows="5"></textarea>
                    </div>
                    <div class="col-xl-12 mb-4">
                        <label class="form-label font-w600">Description</label>
                        <textarea name="description" id="description" class="form-control solid" rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save job</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Validation with jQuery -->
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
