<div class="container" data-project-count="{{ Auth::user()->projects->count() }}">
    <form action="{{ route('projects.store') }}" method="POST" id="projectForm">
        @csrf <!-- Laravel CSRF token -->
        <div id="projectContainer" class="accordion" id="accordionProject">
            <!-- Existing Projects (to edit) -->
            @foreach (Auth::user()->projects as $project)
                <div class="accordion-item">
                    <input type="hidden" name="project_id[]" value="{{ $project->id }}">
                    <h2 class="accordion-header" id="projectHeading{{ $loop->index }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#projectCollapse{{ $loop->index }}" aria-expanded="false"
                            aria-controls="projectCollapse{{ $loop->index }}" onclick="toggleAccordion(this)">
                            {{ $project->name }}
                        </button>
                    </h2>
                    <div id="projectCollapse{{ $loop->index }}" class="accordion-collapse collapse"
                        aria-labelledby="projectHeading{{ $loop->index }}">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_{{ $loop->index }}">Project Name</label>
                                        <input type="text" name="name[]" class="form-control"
                                            id="name_{{ $loop->index }}" value="{{ $project->name }}" required
                                            disabled>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description_{{ $loop->index }}">Description</label>
                                        <textarea name="description[]" class="form-control" id="description_{{ $loop->index }}" rows="3" required
                                            disabled>{{ $project->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_due_{{ $loop->index }}">Start Date</label>
                                        <input type="date" name="start_due[]" class="form-control"
                                            id="start_due_{{ $loop->index }}" value="{{ $project->start_due }}"
                                            required disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_due_{{ $loop->index }}">End Date / Expected to End</label>
                                        <input type="date" name="end_due[]" class="form-control"
                                            id="end_due_{{ $loop->index }}" value="{{ $project->end_due }}" required
                                            disabled>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <!-- Edit and Delete buttons -->
                                    <button type="button" class="btn btn-warning mt-2" data-id="{{ $project->id }}"
                                        data-name="{{ $project->name }}" data-start_due="{{ $project->start_due }}"
                                        data-end_due="{{ $project->end_due }}"
                                        data-description="{{ $project->description }}"
                                        onclick="openEditModal_p(this)">Edit</button>

                                    <button type="button" class="btn btn-danger mt-2"
                                        onclick="deleteProject(this)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Dynamically added projects will appear here -->
        <div id="newProjectContainer"></div>

    
        
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteProject(button) {
        const projectId = button.getAttribute('data-id'); // Get the project ID from the button's data attribute
        const accordionItem = button.closest('.accordion-item'); // Get the accordion item to be removed

        // Show SweetAlert2 confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                // Send AJAX request to delete the project
                fetch(`/projects/{{ $project->id ?? null }}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the accordion item from the DOM
                            accordionItem.remove();

                            // Show success message
                            Swal.fire(
                                'Deleted!',
                                'Your project has been deleted.',
                                'success'
                            );
                            location.reload();
                        } else {
                            // Handle errors or unauthorized access
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting the project.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        // Handle network errors
                        Swal.fire(
                            'Error!',
                            'Failed to delete the project.',
                            'error'
                        );
                    });
            }
        });
    }

    function toggleAccordion(button) {
        // Optional: add any additional logic you need for accordion toggling
    }
</script>
