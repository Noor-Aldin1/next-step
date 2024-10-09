<!-- Modal -->
<div class="modal fade" id="jobEditModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editJobForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Job Title<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" name="title" class="form-control solid" placeholder="Job Title"
                                required>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Company Name<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" name="company_name" class="form-control solid"
                                placeholder="Company Name" required>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Position<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" name="position" class="form-control solid" placeholder="Position"
                                required>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Job Category<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <select name="category" class="form-control solid" required>
                                <option selected disabled>Choose a category...</option>
                                @foreach ($categories_name as $cat)
                                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Job Type<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <select name="job_type" class="form-control solid" required>
                                <option value="Full-time">Full-Time</option>
                                <option value="Part-time">Part-Time</option>
                                <option value="Contract">Contract</option>
                                <option value="Internship">Internship</option>
                            </select>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Experience<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" name="experience" class="form-control solid"
                                placeholder="e.g., 4 years" required>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Last Date To Apply<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="date" name="last_date_to_apply" class="form-control" required>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Salary<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="number" name="salary" class="form-control solid" placeholder="$"
                                step="0.01" required>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">City<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <select name="city" class="form-control solid" required>
                                <option selected disabled>Choose a city...</option>
                                <option value="Amman">Amman</option>
                                <option value="Irbid">Irbid</option>
                                <option value="Balqa">Balqa</option>
                                <option value="Karak">Karak</option>
                                <option value="Ma'an">Ma'an</option>
                                <option value="Mafraq">Mafraq</option>
                                <option value="Tafilah">Tafilah</option>
                                <option value="Zarqa">Zarqa</option>
                                <option value="Madaba">Madaba</option>
                                <option value="Jerash">Jerash</option>
                                <option value="Ajloun">Ajloun</option>
                                <option value="Aqaba">Aqaba</option>
                            </select>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Address<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" name="address" class="form-control solid" placeholder="Address"
                                required>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <label class="form-label font-w600">Education Level<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" name="education_level" class="form-control solid"
                                placeholder="Education Level" required>
                        </div>
                        <div class="col-xl-12 mb-4">
                            <label class="form-label font-w600">Requirements<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <textarea name="requirements" class="form-control solid" rows="5" required></textarea>
                        </div>
                        <div class="col-xl-12 mb-4">
                            <label class="form-label font-w600">Description<span
                                    class="text-danger scale5 ms-2">*</span></label>
                            <textarea name="description" class="form-control solid" rows="5" required></textarea>
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

<script>
    $(document).ready(function() {
        $('#jobEditModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var jobId = button.data('job-id');
            var title = button.data('title'); // Changed from title1 to title
            var companyName = button.data('company-name');
            var position = button.data('position');
            var category = button.data('category');
            var jobType = button.data('job-type');
            var experience = button.data('experience');
            var lastDate = button.data('last-date');
            var salary = button.data('salary');
            var city = button.data('city');
            var address = button.data('address');
            var educationLevel = button.data('education-level');
            var requirements = button.data('requirements');
            var description = button.data('description');

            // Update the modal's content
            var modal = $(this);
            modal.find('#editJobForm').attr('action', '/employer/job_postings/' + jobId);
            modal.find('input[name="title"]').val(title); // Changed from title1 to title
            modal.find('input[name="company_name"]').val(companyName);
            modal.find('input[name="position"]').val(position);
            modal.find('select[name="category"]').val(category);
            modal.find('select[name="job_type"]').val(jobType);
            modal.find('input[name="experience"]').val(experience);
            modal.find('input[name="last_date_to_apply"]').val(lastDate);
            modal.find('input[name="salary"]').val(salary);
            modal.find('select[name="city"]').val(city);
            modal.find('input[name="address"]').val(address);
            modal.find('input[name="education_level"]').val(educationLevel);
            modal.find('textarea[name="requirements"]').val(requirements);
            modal.find('textarea[name="description"]').val(description);
        });
    });
</script>
