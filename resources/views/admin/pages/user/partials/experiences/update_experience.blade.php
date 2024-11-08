@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Update Experience Modal -->
<div style="height: 93%;" id="update_experience" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($experience))
                    <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST"
                        class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT') <!-- Method Spoofing for PUT request -->

                        <input type="number" name="user_id" id="user_id" value="{{ $experience->user_id }}" hidden>

                        <div class="row">
                            <!-- Position -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Position <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="position" id="position"
                                        value="{{ $experience->position }}" placeholder="Enter position" required>
                                    <div class="invalid-feedback">
                                        Please enter a position.
                                    </div>
                                </div>
                            </div>

                            <!-- Company Name -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Company Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="company_name" id="company_name"
                                        value="{{ $experience->company_name }}" placeholder="Enter company name"
                                        required>
                                    <div class="invalid-feedback">
                                        Please enter a company name.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Start Due Date -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Start Due <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="start_due" id="start_due"
                                        value="{{ $experience->start_due }}" required>
                                    <div class="invalid-feedback">
                                        Please select a start due date.
                                    </div>
                                </div>
                            </div>

                            <!-- End Due Date -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">End Due <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="end_due" id="end_due"
                                        value="{{ $experience->end_due }}" required>
                                    <div class="invalid-feedback">
                                        Please select an end due date.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Description -->
                            <div class="col-sm-12">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter description">{{ $experience->description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Update</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-info">No experience selected for editing.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize Select2 on elements with the 'select2' class (if needed for other fields)
        $('.select2').select2({
            width: '100%',
            placeholder: 'Please select',
            allowClear: true
        });

        // Example script to populate modal fields with data when an edit button is clicked
        $('a[data-bs-toggle="modal"]').on('click', function() {
            const experienceId = $(this).data('id');
            const experiencePosition = $(this).data('position');
            const experienceCompanyName = $(this).data('company_name');
            const experienceStartDue = $(this).data('start_due');
            const experienceEndDue = $(this).data('end_due');
            const experienceDescription = $(this).data('description');

            // Set the value of the hidden fields or inputs in the modal
            $('#update_experience #position').val(experiencePosition);
            $('#update_experience #company_name').val(experienceCompanyName);
            $('#update_experience #start_due').val(experienceStartDue);
            $('#update_experience #end_due').val(experienceEndDue);
            $('#update_experience #description').val(experienceDescription);
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



{{-- "Delete" buttons for experiences --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener to all "Delete" buttons for experiences
        document.querySelectorAll('.deleteExperienceBtn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link action

                var experienceId = this.getAttribute('data-id');
                console.log(experienceId);

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
                        fetch(`/admin/experiences/${experienceId}`, {
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
                                        'The experience has been deleted.',
                                        'success').then(() => {
                                        location
                                            .reload(); // Reload the page to update the list
                                    });
                                } else {
                                    Swal.fire('Error!',
                                        'There was a problem deleting the experience.',
                                        'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error!',
                                    'There was a problem deleting the experience.',
                                    'error');
                            });
                    }
                });
            });
        });
    });
</script>
