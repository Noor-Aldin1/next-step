<!-- Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                <button type="button" class="btn-close" onclick="closeEditModal_p()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editProjectForm">
                    @csrf <!-- Laravel CSRF token -->
                    @method('PUT') <!-- Specify that this is a PUT request for updating -->

                    <div class="mb-3">
                        <label for="name" class="form-label">Project Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Project Description</label>
                        <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_due" class="form-label">Start Date</label>
                            <input type="date" name="start_due" class="form-control" id="start_due" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_due" class="form-label">End Date / Expected to End</label>
                            <input type="date" name="end_due" class="form-control" id="end_due" required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Update Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openEditModal_p(button) {
        // Get values from the button's data attributes
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const description = button.getAttribute('data-description');
        const start_due = button.getAttribute('data-start_due');
        const end_due = button.getAttribute('data-end_due');

        console.log("ID:", id, "Name:", name, "Description:", description, "Start Date:", start_due, "End Date:",
            end_due); // Debugging line

        // Set the values in the modal's input fields
        document.getElementById('name').value = name || '';
        document.getElementById('description').value = description || '';
        document.getElementById('start_due').value = start_due || '';
        document.getElementById('end_due').value = end_due || '';

        const form = document.querySelector('#editProjectForm');
        form.action = `/projects/${id}`; // Ensure this matches your update route

        // Show the modal
        var modal = new bootstrap.Modal(document.getElementById('editProjectModal'));
        modal.show();
    }

    function closeEditModal_p() {
        var modalEl = document.getElementById('editProjectModal');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();
        }
    }
</script>
