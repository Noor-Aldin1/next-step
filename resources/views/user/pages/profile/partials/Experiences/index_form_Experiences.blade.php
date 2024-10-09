<div class="container" data-experience-count="{{ Auth::user()->experiences->count() }}">
    <form action="{{ route('experiences.store') }}" method="POST" id="experienceForm">
        @csrf <!-- Laravel CSRF token -->
        <div id="experienceContainer" class="accordion" id="accordionExperience">
            <!-- Existing Experiences (to edit) -->
            @foreach (Auth::user()->experiences as $experience)
                <div class="accordion-item">
                    <input type="hidden" name="experience_id[]" value="{{ $experience->id }}">
                    <h2 class="accordion-header" id="experienceHeading{{ $loop->index }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#experienceCollapse{{ $loop->index }}" aria-expanded="false"
                            aria-controls="experienceCollapse{{ $loop->index }}" onclick="toggleAccordion(this)">
                            {{ $experience->position }} at {{ $experience->company_name }}
                        </button>
                    </h2>
                    <div id="experienceCollapse{{ $loop->index }}" class="accordion-collapse collapse"
                        aria-labelledby="experienceHeading{{ $loop->index }}">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position_{{ $loop->index }}">Position</label>
                                        <input type="text" name="position[]" class="form-control"
                                            id="position_{{ $loop->index }}" value="{{ $experience->position }}"
                                            required disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_name_{{ $loop->index }}">Company Name</label>
                                        <input type="text" name="company_name[]" class="form-control"
                                            id="company_name_{{ $loop->index }}"
                                            value="{{ $experience->company_name }}" required disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_due_{{ $loop->index }}">Start Date</label>
                                        <input type="date" name="start_due[]" class="form-control"
                                            id="start_due_{{ $loop->index }}" value="{{ $experience->start_due }}"
                                            required disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_due_{{ $loop->index }}">End Date / Expected to End</label>
                                        <input type="date" name="end_due[]" class="form-control"
                                            id="end_due_{{ $loop->index }}" value="{{ $experience->end_due }}"
                                            required disabled>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description_{{ $loop->index }}">Description</label>
                                        <textarea name="description[]" class="form-control" id="description_{{ $loop->index }}" rows="3" required
                                            disabled>{{ $experience->description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <!-- Edit and Delete buttons -->
                                    <button type="button" class="btn btn-warning mt-2" data-id="{{ $experience->id }}"
                                        data-position="{{ $experience->position }}"
                                        data-company_name="{{ $experience->company_name }}"
                                        data-start_due="{{ $experience->start_due }}"
                                        data-end_due="{{ $experience->end_due }}"
                                        data-description="{{ $experience->description }}"
                                        onclick="openEditExperienceModal(this)">Edit</button>

                                    <button type="button" class="btn btn-danger mt-2"
                                        onclick="deleteExperience(this)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Dynamically added experiences will appear here -->
        <div id="newExperienceContainer"></div>

        <!-- Submit Form -->
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteExperience(button) {
        const experienceId = button.getAttribute('data-id'); // Get the experience ID from the button's data attribute
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
                // Send AJAX request to delete the experience
                fetch(`/experiences/{{ $experience->id ?? ' ' }}`, {
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
                                'Your experience has been deleted.',
                                'success'
                            );
                            location.reload(); // Reload the page to reflect changes
                        } else {
                            // Handle errors or unauthorized access
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting the experience.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        // Handle network errors
                        Swal.fire(
                            'Error!',
                            'Failed to delete the experience.',
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
