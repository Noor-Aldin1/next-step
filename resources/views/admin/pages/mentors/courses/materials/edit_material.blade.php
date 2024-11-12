<!-- Edit Material Modal -->
<div id="edit_material" class="modal custom-modal fade" role="dialog" style="height: 61%;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Material ID (hidden input) -->
                    <input type="hidden" id="material_id" name="material_id">
                    <input type="hidden" name="course_id" id="courseId" value="{{ $course->id }}">

                    <div class="row">
                        <!-- Material Title -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Material Title<span class="text-danger">*</span></label>
                                <input type="text" name="title" id="material_title" class="form-control" required>
                                <div class="invalid-feedback">Please enter the material title.</div>
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">File Upload<span class="text-danger">*</span></label>
                                <input type="file" name="file_path" id="material_file_path" class="form-control">
                                <div class="invalid-feedback">Please upload a valid file.</div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Description<span class="text-danger">*</span></label>
                                <textarea name="description" id="material_description" class="form-control" rows="3" required></textarea>
                                <div class="invalid-feedback">Please provide a description.</div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Populate Modal Fields and Set Form Action -->
<script>
    $(document).ready(function() {
        // Populate modal fields with data when the edit button is clicked
        $('a[data-bs-toggle="modal"]').on('click', function() {
            const materialId = $(this).data('id');
            const materialTitle = $(this).data('title');
            const materialDescription = $(this).data('description');

            // Populate the fields in the modal
            $('#material_id').val(materialId);
            $('#material_title').val(materialTitle);
            $('#material_description').val(materialDescription);

            // Set the form action dynamically based on the material ID
            $('form.needs-validation').attr('action', `/mentor/materials/${materialId}`);
        });

        // Bootstrap form validation
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    });
</script>

<!-- Delete Material Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.deleteMaterialBtn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            const materialId = this.getAttribute('data-id');

            // SweetAlert2 confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send the DELETE request to the server
                    const url = `{{ route('mentor.materials.destroy', ':id') }}`.replace(':id',
                        materialId);
                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Deleted!', 'The material has been deleted.',
                                        'success')
                                    .then(() => location.reload());
                            } else {
                                Swal.fire('Error!',
                                    'There was a problem deleting the material.',
                                    'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error!',
                                'There was a problem deleting the material.', 'error');
                        });
                }
            });
        });
    });
</script>
