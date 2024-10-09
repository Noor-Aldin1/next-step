<!-- Modal -->
<div class="modal fade" id="experienceModal" tabindex="-1" aria-labelledby="experienceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="experienceModalLabel">Add Experience</h5>
                <button type="button" class="btn-close" onclick="closeExperienceModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('experiences.store') }}" method="POST">
                    @csrf <!-- Laravel CSRF token -->

                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" name="position" class="form-control" id="position_e" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" name="company_name" class="form-control" id="company_name_e" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description_e" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_due" class="form-label">Start Date</label>
                            <input type="date" name="start_due" class="form-control" id="start_due_e" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_due" class="form-label">End Date / Expected to End</label>
                            <input type="date" name="end_due" class="form-control" id="end_due_e" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" onclick="setPresent()">Present</button>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-pay-now">Add Experience</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openExperienceModal() {
        var modal = new bootstrap.Modal(document.getElementById('experienceModal'));
        modal.show();
    }

    function closeExperienceModal() {
        var modalEl = document.getElementById('experienceModal');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();
        }
    }

    function setPresent() {
        // Get the End Date input element
        var endDateInput = document.getElementById('end_due_e');

        // Disable the End Date input and set its value to null
        endDateInput.disabled = true; // Disable the input
        endDateInput.value = ''; // Set value to null
    }
</script>
