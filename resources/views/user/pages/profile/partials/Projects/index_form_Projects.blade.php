<style>
    /* Container for the custom accordion */
    #projectContainer {
        margin: 20px 0;
    }

    /* Header button style (similar to Bootstrap accordion button) */
    .toggle-project-btn {
        width: 100%;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        text-align: left;
        padding: 10px 15px;
        font-size: 1rem;
        font-weight: bold;
        color: #000;
        outline: none;
        cursor: pointer;
        transition: background-color 0.2s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .toggle-project-btn:hover {
        background-color: #e2e6ea;
    }

    /* Button when expanded */
    .toggle-project-btn.active {
        background-color: #e2e6ea;
        color: #000;
    }

    /* Content section (hidden by default) */
    .project-details {
        border: 1px solid #dee2e6;
        border-top: none;
        padding: 15px;
        display: none;
    }

    /* Transition for opening/closing */
    .project-details.show {
        display: block;
    }

    /* Add some spacing between project items */
    .project-item {
        margin-bottom: 10px;
    }
</style>

<div class="container" data-project-count="{{ Auth::user()->projects->count() }}">
    <form action="{{ route('projects.store') }}" method="POST" id="projectForm">
        @csrf <!-- Laravel CSRF token -->
        <div id="projectContainer">
            @foreach (Auth::user()->projects as $project)
                <div class="project-item">
                    <input type="hidden" name="project_id[]" value="{{ $project->id }}">
                    <h2 class="project-header">
                        <button type="button" class="toggle-project-btn" onclick="toggleProject(this)">
                            <span>{{ $project->name }}</span>
                            <span class="toggle-icon">▼</span>
                        </button>
                    </h2>
                    <div class="project-details">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_{{ $loop->index }}">Project Name</label>
                                    <input type="text" name="name[]" class="form-control"
                                        id="name_{{ $loop->index }}" value="{{ $project->name }}" required disabled>
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
                                        id="start_due_{{ $loop->index }}" value="{{ $project->start_due }}" required
                                        disabled>
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
                                <button type="button" class="btn btn-warning mt-2" data-id="{{ $project->id }}"
                                    data-name="{{ $project->name }}" data-start_due="{{ $project->start_due }}"
                                    data-end_due="{{ $project->end_due }}"
                                    data-description="{{ $project->description }}"
                                    onclick="openEditModal_p(this)">Edit</button>
                                <button data-id="{{ $project->id }}" type="button" class="btn btn-danger mt-2"
                                    onclick="deleteProject(this)">Delete</button>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div id="newProjectContainer"></div>
    </form>
</div>

<script>
    function toggleProject(button) {
        // Toggle the active class on the button
        button.classList.toggle('active');

        // Find the associated project details
        const projectDetails = button.closest('.project-item').querySelector('.project-details');

        // Toggle the 'show' class for project details
        projectDetails.classList.toggle('show');

        // Toggle the icon
        const icon = button.querySelector('.toggle-icon');
        if (projectDetails.classList.contains('show')) {
            icon.textContent = '▼'; // Change to upward arrow
        } else {
            icon.textContent = '▲'; // Change to downward arrow
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteProject(button) {
        const projectId = button.getAttribute('data-id'); // Get the project ID from the button's data attribute
        const projectItem = button.closest('.project-item'); // Find the parent project item to be removed

        // Check if the projectItem is found
        if (!projectItem) {
            console.error('Project item not found!');
            return; // Exit function if item is not found
        }

        console.log('Deleting project with ID:', projectId);

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
                fetch(`/projects/${projectId}`, { // Dynamically insert project ID into the URL
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Accept': 'application/json' // Ensure JSON response is expected
                        }
                    })
                    .then(response => response.json()) // Parse the JSON response
                    .then(data => {
                        if (data.success) {
                            // Remove the project item from the DOM
                            projectItem.remove();

                            // Show success message
                            Swal.fire(
                                'Deleted!',
                                'Your project has been deleted.',
                                'success'
                            );
                            location.reload(); // Reload the page to reflect changes
                        } else {
                            // Handle unauthorized access or other errors
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting the project.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        // Handle network or other errors
                        Swal.fire(
                            'Error!',
                            'Failed to delete the project due to a network error.',
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
