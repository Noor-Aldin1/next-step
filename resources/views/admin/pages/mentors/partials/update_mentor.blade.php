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
