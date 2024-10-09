<!-- Modal -->
<div class="modal fade" id="editCertificationModal" tabindex="-1" aria-labelledby="editCertificationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCertificationModalLabel">Edit Certification</h5>
                <button type="button" class="btn-close" onclick="closeEditModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editCertificationForm">
                    @csrf <!-- Laravel CSRF token -->
                    @method('PUT') <!-- Specify that this is a PUT request for updating -->

                    <div class="mb-3">
                        <label for="name" class="form-label">Certification Name</label>
                        <input type="text" name="name" class="form-control" id="name_c" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_due" class="form-label">Start Date</label>
                            <input type="date" name="start_due" class="form-control" id="start_due_c" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_due" class="form-label">End Date / Expected to End</label>
                            <input type="date" name="end_due" class="form-control" id="end_due_c" required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Update Certification</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openEditModal(button) {
        // Get values from the button's data attributes
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const start_due = button.getAttribute('data-start_due');
        const end_due = button.getAttribute('data-end_due');

        console.log("ID:", id, "Name:", name, "Start Date:", start_due, "End Date:", end_due); // Debugging line

        // Set the values in the modal's input fields
        document.getElementById('name_c').value = name || ''; // Set to empty if name is null
        document.getElementById('start_due_c').value = start_due || ''; // Set to empty if start_due is null
        document.getElementById('end_due_c').value = end_due || ''; // Set to empty if end_due is null

        const form = document.querySelector('#editCertificationForm');
        form.action = `/certifications/${id}`; // Ensure this matches your update route

        // Show the modal
        var modal = new bootstrap.Modal(document.getElementById('editCertificationModal'));
        modal.show();
    }

    function closeEditModal() {
        var modalEl = document.getElementById('editCertificationModal');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();
        }
    }
</script>
