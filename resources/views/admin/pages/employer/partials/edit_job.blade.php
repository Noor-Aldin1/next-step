@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


-- Update Job Posting Modal -->
<div id="update_job" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Job Posting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.jobs.update', ':id') }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data" novalidate id="updateJobForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="job_id" id="job-id">

                    <div class="row">
                        <!-- Employer Selection -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Choose Employer <span class="text-danger">*</span></label>
                                <select class="form-control" name="employer_id" id="employer-id" required>
                                    <option value="">Select Employer</option>
                                    @foreach ($jobPostings->unique('employer_id') as $jobPosting)
                                        <option value="{{ $jobPosting->employer->id }}">
                                            {{ $jobPosting->employerUser->username }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select an employer.</div>
                            </div>
                        </div>

                        <!-- Category Selection -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Choose Category <span class="text-danger">*</span></label>
                                <select class="form-control" name="category_id" id="category-id" required>
                                    <option value="">Select Job Type</option>
                                    @php
                                        $uniqueCategories = $jobPostings
                                            ->flatMap(fn($jobPosting) => $jobPosting->categories)
                                            ->unique('id');
                                    @endphp
                                    @foreach ($uniqueCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select a category.</div>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" required>
                                <div class="invalid-feedback">Please provide a valid title.</div>
                            </div>
                        </div>

                        <!-- Company Name -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="company_name" id="company-name"
                                    required>
                                <div class="invalid-feedback">Please provide a company name.</div>
                            </div>
                        </div>

                        <!-- Requirements -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Requirements</label>
                                <textarea class="form-control" name="requirements" id="requirements" rows="3"></textarea>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>
                        </div>

                        <!-- Position -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="position" id="position" required>
                                <div class="invalid-feedback">Please provide a position.</div>
                            </div>
                        </div>

                        <!-- Job Type -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Job Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="job_type" id="job-type" required>
                                    <option value="">Select Job Type</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Internship">Internship</option>
                                </select>
                                <div class="invalid-feedback">Please select a job type.</div>
                            </div>
                        </div>

                        <!-- Experience -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Experience</label>
                                <input type="text" class="form-control" name="experience" id="experience">
                            </div>
                        </div>

                        <!-- Salary -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Salary</label>
                                <input type="number" class="form-control" step="0.01" name="salary"
                                    id="salary">
                            </div>
                        </div>

                        <!-- Last Date to Apply -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Last Date to Apply</label>
                                <input type="date" class="form-control" name="last_date_to_apply"
                                    id="last-date-input">
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Get today's date in YYYY-MM-DD format
                                const today = new Date().toISOString().split('T')[0];

                                // Set the minimum date attribute for the input
                                document.getElementById('last-date-input').setAttribute('min', today);
                            });
                        </script>

                        <!-- City -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">City <span class="text-danger">*</span></label>
                                <select class="form-control" name="city" id="city" required>
                                    <option value="">Select City</option>
                                    <option value="Amman">Amman</option>
                                    <option value="Irbid">Irbid</option>
                                    <option value="Balqa">Balqa</option>
                                    <option value="Karak">Karak</option>
                                    <option value="Ma an">Ma an</option>
                                    <option value="Mafraq">Mafraq</option>
                                    <option value="Tafilah">Tafilah</option>
                                    <option value="Zarqa">Zarqa</option>
                                    <option value="Madaba">Madaba</option>
                                    <option value="Jerash">Jerash</option>
                                    <option value="Ajloun">Ajloun</option>
                                    <option value="Aqaba">Aqaba</option>
                                </select>
                                <div class="invalid-feedback">Please select a city.</div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address">
                            </div>
                        </div>

                        <!-- Education Level -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Education Level</label>
                                <input type="text" class="form-control" name="education_level"
                                    id="education-level">
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Update</button>
                    </div>
                </form>

                <!-- JavaScript to Populate Form -->
                <script>
                    document.querySelectorAll('.edit-job').forEach(button => {
                        button.addEventListener('click', function() {
                            const jobId = this.getAttribute('data-id');
                            document.getElementById('job-id').value = jobId;
                            document.getElementById('employer-id').value = this.getAttribute('data-employer-id');
                            document.getElementById('category-id').value = this.getAttribute('data-category-id');
                            document.getElementById('title').value = this.getAttribute('data-title');
                            document.getElementById('company-name').value = this.getAttribute('data-company-name');
                            document.getElementById('requirements').value = this.getAttribute('data-requirements');
                            document.getElementById('description').value = this.getAttribute('data-description');
                            document.getElementById('position').value = this.getAttribute('data-position');
                            document.getElementById('job-type').value = this.getAttribute('data-job-type');
                            document.getElementById('experience').value = this.getAttribute('data-experience');
                            document.getElementById('salary').value = this.getAttribute('data-salary');
                            document.getElementById('last-date-input').value = this.getAttribute(
                                'data-last-date-to-apply');
                            document.getElementById('city').value = this.getAttribute('data-city');
                            document.getElementById('address').value = this.getAttribute('data-address');
                            document.getElementById('education-level').value = this.getAttribute(
                                'data-education-level');

                            document.getElementById('updateJobForm').action =
                                `{{ route('admin.jobs.update', '') }}/${jobId}`;
                        });
                    });
                </script>



            </div>
        </div>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
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
<!-- /Update Job Posting Modal -->
