@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Update Project Modal -->
<div style="height: 93%;" id="update_project" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($project))
                    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST"
                        class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT') <!-- Method Spoofing for PUT request -->

                        <input type="number" name="user_id" id="user_id" value="{{ $project->user_id }}" hidden>

                        <div class="row">
                            <!-- Project Name -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Project Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $project->name }}" placeholder="Enter project name" required>
                                    <div class="invalid-feedback">
                                        Please enter a project name.
                                    </div>
                                </div>
                            </div>

                            <!-- Start Due Date -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Start Due <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="start_due" id="start_due"
                                        value="{{ $project->start_due }}" required>
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
                                        value="{{ $project->end_due }}">
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
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter description">{{ $project->description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Update</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-info">No project selected for editing.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            placeholder: 'Please select',
            allowClear: true
        });

        $('a[data-bs-toggle="modal"]').on('click', function() {
            const projectId = $(this).data('id');
            const projectName = $(this).data('name');
            const projectStartDue = $(this).data('start_due');
            const projectEndDue = $(this).data('end_due');
            const projectDescription = $(this).data('description');

            $('#update_project #name').val(projectName);
            $('#update_project #start_due').val(projectStartDue);
            $('#update_project #end_due').val(projectEndDue);
            $('#update_project #description').val(projectDescription);
        });
    });

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

{{-- "Delete" buttons for projects --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.deleteProjectBtn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                var projectId = this.getAttribute('data-id');
                console.log(projectId);

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
                        fetch(`/admin/projects/${projectId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Deleted!',
                                        'The project has been deleted.',
                                        'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Error!',
                                        'There was a problem deleting the project.',
                                        'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error!',
                                    'There was a problem deleting the project.',
                                    'error');
                            });
                    }
                });
            });
        });
    });
</script>
