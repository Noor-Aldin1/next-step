@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Update Certification Modal -->
<div style="height: 73%;" id="update_certification" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Certification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($certification))
                    <form action="{{ route('admin.certifications.update', $certification->id) }}" method="POST"
                        class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT') <!-- Method Spoofing for PUT request -->

                        <input type="number" name="user_id" id="user_id" value="{{ $certification->user_id }}"
                            hidden>

                        <div class="row">
                            <!-- Certification Name -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Certification Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $certification->name }}" placeholder="Enter certification name"
                                        required>
                                    <div class="invalid-feedback">
                                        Please enter a certification name.
                                    </div>
                                </div>
                            </div>

                            <!-- Start Due Date -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Start Due <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="start_due" id="start_due"
                                        value="{{ $certification->start_due }}" required>
                                    <div class="invalid-feedback">
                                        Please select a start due date.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- End Due Date -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">End Due <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="end_due" id="end_due"
                                        value="{{ $certification->end_due }}" required>
                                    <div class="invalid-feedback">
                                        Please select an end due date.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Update</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-info"></div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize Select2 on elements with the 'select2' class (if needed for other fields)
        $('.select2').select2({
            width: '100%', // Ensures it takes full width of container
            placeholder: 'Please select', // Placeholder text
            allowClear: true // Allows clear functionality
        });

        // Example script to populate modal fields with data when an edit button is clicked
        $('a[data-bs-toggle="modal"]').on('click', function() {
            const certificationId = $(this).data('id');
            const certificationName = $(this).data('name');
            const certificationStartDue = $(this).data('start_due');
            const certificationEndDue = $(this).data('end_due');

            // Set the value of the hidden fields or inputs in the modal
            $('#update_certification #name').val(certificationName);
            $('#update_certification #start_due').val(certificationStartDue);
            $('#update_certification #end_due').val(certificationEndDue);
        });
    });

    // Bootstrap form validation
    (function() {
        'use strict'
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
</script>




{{-- "Delete" buttons for certifications --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener to all "Delete" buttons for certifications
        document.querySelectorAll('.deleteCertificationBtn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link action

                var certificationId = this.getAttribute('data-id');
                console.log(certificationId);

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
                        fetch(`/admin/certifications/${certificationId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Show success alert and reload the page to reflect the change
                                    Swal.fire('Deleted!',
                                        'The certification has been deleted.',
                                        'success').then(() => {
                                        location
                                            .reload(); // Reload the page to update the list
                                    });
                                } else {
                                    Swal.fire('Error!',
                                        'There was a problem deleting the certification.',
                                        'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error!',
                                    'There was a problem deleting the certification.',
                                    'error');
                            });
                    }
                });
            });
        });
    });
</script>
