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
                <form action="{{ route('employer.job_postings.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Job Title -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Job Title<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" name="title" class="form-control solid" placeholder="Job Title"
                                required>
                        </div>
                        <!-- Company Name -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Company Name<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" name="company_name" class="form-control solid"
                                placeholder="Company Name" required>
                        </div>
                        <!-- Position -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Position<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" name="position" class="form-control solid" placeholder="Position"
                                required>
                        </div>
                        <!-- Job Category -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Job Category<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <select name="category" class="form-control solid">
                                <option selected>Choose...</option>
                                @foreach ($categories_name as $cat)
                                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <!-- Job Type -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Job Type<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <select name="job_type" class="form-control solid" required>
                                <option selected disabled>Choose...</option>
                                <option value="Full-time">Full-Time</option>
                                <option value="Part-time">Part-Time</option>
                                <option value="Contract">Contract</option>
                                <option value="Internship">Internship</option>
                            </select>
                        </div>
                        <!-- Experience -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Experience<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" name="experience" class="form-control solid" placeholder="4 years">
                        </div>
                        <!-- Last Date To Apply -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Last Date To Apply<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="date" name="last_date_to_apply" class="form-control">
                        </div>
                        <!-- Salary -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Salary<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="number" name="salary" class="form-control solid" placeholder="$"
                                step="0.01">
                        </div>
                        <!-- City -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">City<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <select name="city" class="form-control solid" required>
                                <option selected disabled>Choose a city...</option>
                                <option value="Amman">Amman</option>
                                <option value="Irbid">Irbid</option>
                                <option value="Balqa">Balqa</option>
                                <!-- Add other cities -->
                            </select>
                        </div>
                        <!-- Address -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Address<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" name="address" class="form-control solid" placeholder="Address"
                                required>
                        </div>
                        <!-- Education Level -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Education Level<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" name="education_level" class="form-control solid"
                                placeholder="Education Level">
                        </div>
                        <!-- Requirements -->
                        <div class="col-xl-12 mb-4">
                            <label class="form-label font-w600">Requirements<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <textarea name="requirements" class="form-control solid" rows="5"></textarea>
                        </div>
                        <!-- Description -->
                        <div class="col-xl-12 mb-4">
                            <label class="form-label font-w600">Description<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <textarea name="description" class="form-control solid" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
