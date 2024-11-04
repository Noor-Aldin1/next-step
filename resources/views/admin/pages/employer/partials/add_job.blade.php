@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Add Employee Modal -->
<div id="add_job" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.jobs.store') }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Choose Employer <span class="text-danger">*</span></label>
                                <select class="form-control" name="employer_id" required>
                                    <option value="">Select Employer</option>
                                    @foreach ($jobPostings->unique('employer_id') as $jobPosting)
                                        <option style="color:black" value="{{ $jobPosting->employer->id }}">
                                            {{ $jobPosting->employerUser->username }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select an employer.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Choose Category <span class="text-danger">*</span></label>
                                <select class="form-control" name="category_id" required>
                                    <option value="">Select Job Type</option>

                                    @php
                                        // Flatten categories from all job postings and get unique categories
                                        $uniqueCategories = $jobPostings
                                            ->flatMap(function ($jobPosting) {
                                                return $jobPosting->categories;
                                            })
                                            ->unique('id');
                                    @endphp

                                    @foreach ($uniqueCategories as $category)
                                        <option style="color:black" value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <div class="invalid-feedback">
                                    Please select Category.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Title <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="title" required>
                                <div class="invalid-feedback">
                                    Please provide a valid title.
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Company Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="company_name" required>
                                <div class="invalid-feedback">
                                    Please provide a company name.
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Requirements</label>
                                <textarea class="form-control" name="requirements" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Position <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="position" required>
                                <div class="invalid-feedback">
                                    Please provide a position.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Job Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="job_type" required>
                                    <option value="">Select Job Type</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Internship">Internship</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a job type.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Experience</label>
                                <input class="form-control" type="text" name="experience">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Salary</label>
                                <input class="form-control" type="number" step="0.01" name="salary">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Last Date to Apply</label>
                                <input class="form-control" type="date" name="last_date_to_apply"
                                    id="last-date-input">
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                // Get today's date
                                var today = new Date();
                                var dd = String(today.getDate()).padStart(2, '0');
                                var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
                                var yyyy = today.getFullYear();
                                today = yyyy + '-' + mm + '-' + dd; // Format: YYYY-MM-DD

                                // Set the min attribute of the date input
                                $('#last-date-input').attr('min', today);
                            });
                        </script>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">City <span class="text-danger">*</span></label>
                                <select class="form-control" name="city" required>
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
                                <div class="invalid-feedback">
                                    Please select a city.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Address</label>
                                <input class="form-control" type="text" name="address">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Education Level</label>
                                <input class="form-control" type="text" name="education_level">
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
<!-- /Add Employee Modal -->
