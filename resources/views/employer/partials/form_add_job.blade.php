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
                <form id="jobForm" action="{{ route('employer.job_postings.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Job Title -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Job Title<span class="text-danger ms-2">*</span></label>
                            <input type="text" name="title" id="title" class="form-control solid"
                                placeholder="Job Title" required maxlength="255">
                        </div>
                        <!-- Company Name -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Company Name<span
                                    class="text-danger ms-2">*</span></label>
                            <input type="text" name="company_name" id="company_name" class="form-control solid"
                                placeholder="Company Name" required maxlength="255">
                        </div>
                        <!-- Position -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Position<span class="text-danger ms-2">*</span></label>
                            <input type="text" name="position" id="position" class="form-control solid"
                                placeholder="Position" required maxlength="255">
                        </div>
                        <!-- Job Category -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Job Category<span
                                    class="text-danger ms-2">*</span></label>
                            <select name="category" id="category" class="form-control solid" required>
                                <option value="">Choose...</option>
                                @foreach ($categories_name as $cat)
                                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Job Type -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Job Type<span class="text-danger ms-2">*</span></label>
                            <select name="job_type" id="job_type" class="form-control solid" required>
                                <option value="">Choose...</option>
                                <option value="Full-time">Full-Time</option>
                                <option value="Part-time">Part-Time</option>
                                <option value="Contract">Contract</option>
                                <option value="Internship">Internship</option>
                            </select>
                        </div>
                        <!-- Experience -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Experience</label>
                            <input type="text" name="experience" id="experience" class="form-control solid"
                                placeholder="4 years" maxlength="255">
                        </div>
                        <!-- Last Date To Apply -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Last Date To Apply<span
                                    class="text-danger ms-2">*</span></label>
                            <input type="date" name="last_date_to_apply" id="last_date_to_apply"
                                class="form-control">
                        </div>
                        <!-- Salary -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Salary</label>
                            <input type="number" name="salary" id="salary" class="form-control solid"
                                placeholder="$" step="0.01">
                        </div>
                        <!-- City -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">City<span class="text-danger ms-2">*</span></label>
                            <select name="city" id="city" class="form-control solid" required>
                                <option value="">Choose a city...</option>
                                <option value="Amman">Amman</option>
                                <option value="Irbid">Irbid</option>
                                <option value="Balqa">Balqa</option>
                                <!-- Add other cities -->
                            </select>
                        </div>
                        <!-- Address -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Address<span class="text-danger ms-2">*</span></label>
                            <input type="text" name="address" id="address" class="form-control solid"
                                placeholder="Address" required maxlength="255">
                        </div>
                        <!-- Education Level -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Education Level</label>
                            <input type="text" name="education_level" id="education_level"
                                class="form-control solid" placeholder="Education Level" maxlength="255">
                        </div>
                        <!-- Requirements -->
                        <div class="col-xl-12 mb-4">
                            <label class="form-label font-w600">Requirements</label>
                            <textarea name="requirements" id="requirements" class="form-control solid" rows="5"></textarea>
                        </div>
                        <!-- Description -->
                        <div class="col-xl-12 mb-4">
                            <label class="form-label font-w600">Description</label>
                            <textarea name="description" id="description" class="form-control solid" rows="5"></textarea>
                        </div>
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

<!-- JavaScript Validation and SweetAlert2 Integration -->
<script>
    document.getElementById('jobForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Stop form submission

        const form = event.target;
        const title = form.title.value.trim();
        const companyName = form.company_name.value.trim();
        const position = form.position.value.trim();
        const jobType = form.job_type.value;
        const city = form.city.value;
        const address = form.address.value.trim();
        const category = form.category.value;

        let hasError = false;
        let errors = [];

        // Validate fields based on Laravel rules
        if (title === '' || title.length > 255) {
            hasError = true;
            errors.push('Title is required and must not exceed 255 characters.');
        }

        if (companyName === '' || companyName.length > 255) {
            hasError = true;
            errors.push('Company Name is required and must not exceed 255 characters.');
        }

        if (position === '' || position.length > 255) {
            hasError = true;
            errors.push('Position is required and must not exceed 255 characters.');
        }

        if (jobType === '') {
            hasError = true;
            errors.push('Job Type is required.');
        }

        if (city === '') {
            hasError = true;
            errors.push('City is required.');
        }

        if (address === '' || address.length > 255) {
            hasError = true;
            errors.push('Address is required and must not exceed 255 characters.');
        }

        if (category === '') {
            hasError = true;
            errors.push('Category is required.');
        }

        if (hasError) {
            // Use SweetAlert2 to display validation errors
            Swal.fire({
                title: 'Validation Errors',
                icon: 'error',
                html: '<ul>' + errors.map(error => `<li>${error}</li>`).join('') + '</ul>',
                confirmButtonText: 'Okay'
            });
        } else {
            form.submit(); // Proceed with form submission if no errors
        }
    });
</script>
