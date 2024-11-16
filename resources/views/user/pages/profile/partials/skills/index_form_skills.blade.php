<style>
    /* Container for the custom accordion */
    #skillContainer {
        margin: 20px 0;
    }

    /* Header button style */
    .toggle-skill-btn {
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

    .toggle-skill-btn:hover {
        background-color: #e2e6ea;
    }

    /* Button when expanded */
    .toggle-skill-btn.active {
        background-color: #e2e6ea;
        color: #000;
    }

    /* Content section (hidden by default) */
    .skill-details {
        border: 1px solid #dee2e6;
        border-top: none;
        padding: 15px;
        display: none;
    }

    /* Transition for opening/closing */
    .skill-details.show {
        display: block;
    }

    /* Add some spacing between skill items */
    .skill-item {
        margin-bottom: 10px;
    }
</style>
<div class="container" data-skill-count="{{ Auth::user()->userSkills->count() }}">
    <form action="{{ route('skills.store') }}" method="POST" id="skillForm">
        @csrf <!-- Laravel CSRF token -->
        <div id="skillContainer">
            @foreach (Auth::user()->userSkills as $userSkill)
                <div class="skill-item">
                    <input type="hidden" name="skill_id[]" value="{{ $userSkill->id }}">
                    <h2 class="skill-header">
                        <button type="button" class="toggle-skill-btn" onclick="toggleSkill(this)">
                            <span>{{ $userSkill->skill->name }} (Rate: {{ $userSkill->rate }})</span>
                            <span class="toggle-icon">▼</span>
                        </button>
                    </h2>
                    <div class="skill-details">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_{{ $loop->index }}">Skill Name</label>
                                    <input type="text" name="name[]" class="form-control"
                                        id="name_{{ $loop->index }}" value="{{ $userSkill->skill->name }}" required
                                        disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rate_{{ $loop->index }}">Skill Rate</label>
                                    <input type="number" name="rate[]" class="form-control"
                                        id="rate_{{ $loop->index }}" value="{{ $userSkill->rate }}" min="1"
                                        max="10" required disabled>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <!-- Edit and Delete buttons -->
                                <button type="button" class="btn btn-warning mt-2" data-id="{{ $userSkill->id }}"
                                    data-name="{{ $userSkill->skill->name }}" data-rate="{{ $userSkill->rate }}"
                                    onclick="openEditModalSkill(this)">Edit</button>
                                <button type="button" class="btn btn-danger mt-2" data-id="{{ $userSkill->id }}"
                                    onclick="deleteSkill(this)">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Dynamically added skills will appear here -->
        <div id="newSkillContainer"></div>
    </form>
</div>

<script>
    function toggleSkill(button) {
        // Toggle the active class on the button
        button.classList.toggle('active');

        // Find the associated skill details
        const skillDetails = button.closest('.skill-item').querySelector('.skill-details');

        // Toggle the 'show' class for skill details
        skillDetails.classList.toggle('show');

        // Toggle the icon
        const icon = button.querySelector('.toggle-icon');
        if (skillDetails.classList.contains('show')) {
            icon.textContent = '▼'; // Change to downward arrow
        } else {
            icon.textContent = '▲'; // Change to upward arrow
        }
    }

    function deleteSkill(button) {
        const skillId = button.getAttribute('data-id'); // Get the skill ID dynamically
        const skillItem = button.closest('.skill-item'); // Get the skill item to be removed

        // Check if the skillItem is found
        if (!skillItem) {
            console.error('Skill item not found!');
            return; // Exit function if item is not found
        }

        console.log('Deleting skill with ID:', skillId);

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
                // Send AJAX request to delete the skill
                fetch(`/UserSkill/${skillId}`, { // Correct URL to match route
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Accept': 'application/json' // Ensure the response is in JSON format
                        }
                    })
                    .then(response => response.json()) // Parse the JSON response
                    .then(data => {
                        if (data.success) {
                            // Remove the skill item from the DOM
                            skillItem.remove();

                            // Show success message
                            Swal.fire(
                                'Deleted!',
                                'Your skill has been deleted.',
                                'success'
                            );
                            location.reload(); // Reload the page to reflect changes
                        } else if (data.message && data.message === 'Unauthorized action.') {
                            // Handle unauthorized access
                            Swal.fire(
                                'Unauthorized!',
                                'You are not authorized to delete this skill.',
                                'error'
                            );
                        } else {
                            // Handle other errors
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting the skill.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        // Handle network or other errors
                        Swal.fire(
                            'Error!',
                            error.message || 'Failed to delete the skill due to a network error.',
                            'error'
                        );
                    });
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
