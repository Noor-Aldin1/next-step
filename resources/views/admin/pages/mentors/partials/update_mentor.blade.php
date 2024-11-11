<style>
    /* style model in job list  */
    .custom-grid-badges {
        display: flex;
        gap: 10px;
        margin-top: 1rem;
    }

    .custom-badge {
        padding: 0.5rem 1rem;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        font-weight: bold;
    }

    .custom-bg-danger {
        background-color: #dc3545;
        color: white;
    }

    .custom-bg-purple {
        background-color: #6f42c1;
        color: white;
    }

    .custom-modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        padding: 2rem;
        border-radius: 8px;
        max-width: 700px;
        width: 90%;
        z-index: 1000;
    }

    .custom-modal h6 {
        margin-top: 0;
    }

    .custom-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    /* ------------ */
    .view-icons {
        display: flex;
        /* Use flexbox for alignment */
        align-items: center;
        /* Center items vertically */
        gap: 8px;
        /* Add space between text and icon */
    }

    .clear-filter-text {
        font-weight: bold;
        /* Make the text bold */
        font-size: 14px;
        /* Adjust font size as needed */
        color: #333;
        /* Change text color as desired */
    }
</style>
<!-- Edit Mentor Modal -->
<div id="edit_mentor" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Mentor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMentorForm" action="{{ route('admin.mentors.update', ':id') }}" method="POST"
                    class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Specify the method as PUT for updates -->

                    <div class="row">
                        <!-- Hidden user_id input -->
                        <input type="text" name="user_id" id="user_id" hidden>

                        <!-- Status field -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a status.
                                </div>
                            </div>
                        </div>

                        <!-- Video upload field -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label for="videoUpload" class="col-form-label">Video (optional)</label>
                                <input name="video" type="file" id="videoUpload" accept="video/*">
                                <div class="invalid-feedback">
                                    Please upload a valid video file.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Mentor Modal -->


<!-- JavaScript for handling the modal form population -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Trigger modal when the edit button is clicked
        $('#edit_mentor').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var modal = $(this);

            // Update the form action URL with the correct mentor ID
            var formAction = $('#editMentorForm').attr('action').replace(':id', button.data('id'));
            $('#editMentorForm').attr('action', formAction);

            // Populate the user_id field (hidden)
            modal.find('input[name="mentor_id"]').val(button.data('id'));

            // Populate the status dropdown with the current status
            modal.find('select[name="status"]').val(button.data('status'));

            // Optionally, handle the video field (if there is a current video file)
            // For example, you can provide a preview or handle existing file paths if needed
            if (button.data('video')) {
                modal.find('input[name="video"]').attr('data-existing-video', button.data('video'));
                // Optionally, display the existing video file or a placeholder message
            } else {
                modal.find('input[name="video"]').removeAttr('data-existing-video');
            }
        });
    });
</script>
