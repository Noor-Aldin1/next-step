<style>
    /* Container for the custom accordion */
    #experienceContainer {
        margin: 20px 0;
    }

    /* Header button style for experiences */
    .toggle-experience-btn {
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

    .toggle-experience-btn:hover {
        background-color: #e2e6ea;
    }

    /* Button when expanded */
    .toggle-experience-btn.active {
        background-color: #e2e6ea;
        color: #000;
    }

    /* Content section (hidden by default) */
    .experience-details {
        border: 1px solid #dee2e6;
        border-top: none;
        padding: 15px;
        display: none;
    }

    /* Transition for opening/closing */
    .experience-details.show {
        display: block;
    }
</style>

<div class="container"
    data-experience-count="{{ Auth::check() && Auth::user()->experience ? Auth::user()->experience->count() : 0 }}">
    <form action="{{ route('experiences.store') }}" method="POST" id="experienceForm">
        @csrf <!-- Laravel CSRF token -->
        <div id="experienceContainer">
            <!-- Existing Experiences (to edit) -->
            @if (Auth::check() && Auth::user()->experience && Auth::user()->experience->isNotEmpty())
                @foreach (Auth::user()->experience as $experience)
                    <div class="experience-item">
                        <input type="hidden" name="experience_id[]" value="{{ $experience->id }}">
                        <h2 class="experience-header">
                            <button type="button" class="toggle-experience-btn" onclick="toggleExperience(this)">
                                <span>{{ $experience->position }} at {{ $experience->company_name }}</span>
                                <span class="toggle-icon">▼</span>
                            </button>
                        </h2>
                        <div class="experience-details">
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

                                    <button type="button" class="btn btn-danger mt-2" data-id="{{ $experience->id }}"
                                        onclick="deleteExperience(this)">Delete</button>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No experiences available.</p> <!-- Add a fallback message for no experiences -->
            @endif
        </div>
        <!-- Dynamically added experiences will appear here -->
        <div id="newExperienceContainer"></div>
    </form>
</div>

<script>
    function toggleExperience(button) {
        // Toggle the active class on the button
        button.classList.toggle('active');

        // Find the associated experience details
        const experienceDetails = button.closest('.experience-item').querySelector('.experience-details');

        // Toggle the 'show' class for experience details
        experienceDetails.classList.toggle('show');

        // Toggle the icon
        const icon = button.querySelector('.toggle-icon');
        if (experienceDetails.classList.contains('show')) {
            icon.textContent = '▼'; // Change to downward arrow when open
        } else {
            icon.textContent = '▲'; // Change to upward arrow when closed
        }
    }
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteExperience(button) {
        const experienceId = button.getAttribute('data-id'); // Get the experience ID from the button's data attribute
        const accordionItem = button.closest('.experience-item'); // Get the accordion item to be removed

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
                fetch(`/experiences/${experienceId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Content-Type': 'application/json',
                        },
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
                                data.message || 'There was a problem deleting the experience.',
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
