<!-- Modal -->
<div class="modal fade" id="editExperienceModal" tabindex="-1" aria-labelledby="editExperienceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editExperienceModalLabel">Edit Experience</h5>
                <button type="button" class="btn-close" onclick="closeEditExperienceModal()"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editExperienceForm">
                    @csrf <!-- Laravel CSRF token -->
                    @method('PUT') <!-- Specify that this is a PUT request for updating -->

                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" name="position" class="form-control" id="position" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" name="company_name" class="form-control" id="company_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description_ex" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_due" class="form-label">Start Date</label>
                            <input type="date" name="start_due" class="form-control" id="start_due_ex" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_due" class="form-label">End Date / Expected to End</label>
                            <input type="date" name="end_due" class="form-control" id="end_due_ex" required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Update Experience</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openEditExperienceModal(button) {
        // Get values from the button's data attributes
        const id = button.getAttribute('data-id');
        const position = button.getAttribute('data-position');
        const company_name = button.getAttribute('data-company_name');
        const description = button.getAttribute('data-description');
        const start_due = button.getAttribute('data-start_due');
        const end_due = button.getAttribute('data-end_due');
        console.log(id, position, company_name, description, start_due, end_due);

        // Set the values in the modal's input fields
        document.getElementById('position').value = position || ''; // Set to empty if position is null
        document.getElementById('company_name').value = company_name || ''; // Set to empty if company_name is null
        document.getElementById('description_ex').value = description || ''; // Set to empty if description is null
        document.getElementById('start_due_ex').value = start_due || ''; // Set to empty if start_due is null
        document.getElementById('end_due_ex').value = end_due || ''; // Set to empty if end_due is null

        const form = document.querySelector('#editExperienceForm');
        form.action = `/experiences/${id}`; // Ensure this matches your update route

        // Show the modal
        var modal = new bootstrap.Modal(document.getElementById('editExperienceModal'));
        modal.show();
    }

    function closeEditExperienceModal() {
        var modalEl = document.getElementById('editExperienceModal');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();
        }
    }
</script>
