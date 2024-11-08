@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Add Certification Modal -->
<div style="height: 73%;" id="add_certification" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Certification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.certifications.store') }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="number" name="user_id" id="user_id" value="{{ $id }}" hidden>

                    <div class="row">
                        <!-- Certification Name -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Certification Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Enter certification name" required>
                                <div class="invalid-feedback">
                                    Please enter a certification name.
                                </div>
                            </div>
                        </div>

                        <!-- Start Due Date -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Start Due <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="start_due" required>
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
                                <input type="date" class="form-control" name="end_due" required>
                                <div class="invalid-feedback">
                                    Please select an end due date.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
                </form>

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
    });
</script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<!-- /Add Certification Modal -->
<!-- Select2 CSS (if needed) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (Required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JavaScript (if needed for any select fields) -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
