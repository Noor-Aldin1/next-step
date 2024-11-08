@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Add Experience Modal -->
<div style="height: 93%;" id="add_experience" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.experiences.store') }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="number" name="user_id" id="user_id" value="{{ $id }}" hidden>

                    <div class="row">
                        <!-- Position -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="position" placeholder="Enter position"
                                    required>
                                <div class="invalid-feedback">
                                    Please enter a position.
                                </div>
                            </div>
                        </div>

                        <!-- Company Name -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="company_name"
                                    placeholder="Enter company name" required>
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
                                <input type="date" class="form-control" name="start_due" required>
                                <div class="invalid-feedback">
                                    Please select a start due date.
                                </div>
                            </div>
                        </div>

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

                    <div class="row">
                        <!-- Description -->
                        <div class="col-sm-12">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Description</label>
                                <textarea class="form-control" name="description" placeholder="Enter a description" rows="3"></textarea>
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
