<div class="container" data-skill-count="{{ Auth::user()->userSkills->count() }}">
    <form action="{{ route('skills.store') }}" method="POST" id="skillForm">
        @csrf <!-- Laravel CSRF token -->
        <div id="skillContainer" class="accordion" id="accordionSkill">
            <!-- Existing Skills (to edit) -->
            @foreach (Auth::user()->userSkills as $userSkill)
                <div class="accordion-item">
                    <input type="hidden" name="skill_id[]" value="{{ $userSkill->id }}">
                    <h2 class="accordion-header" id="skillHeading{{ $loop->index }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#skillCollapse{{ $loop->index }}" aria-expanded="false"
                            aria-controls="skillCollapse{{ $loop->index }}" onclick="toggleAccordion(this)">
                            {{ $userSkill->skill->name }} (Rate: {{ $userSkill->rate }})
                        </button>
                    </h2>
                    <div id="skillCollapse{{ $loop->index }}" class="accordion-collapse collapse"
                        aria-labelledby="skillHeading{{ $loop->index }}">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_{{ $loop->index }}">Skill Name</label>
                                        <input type="text" name="name[]" class="form-control"
                                            id="name_{{ $loop->index }}" value="{{ $userSkill->skill->name }}"
                                            required disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rate_{{ $loop->index }}">Skill Rate</label>
                                        <input type="number" name="rate[]" class="form-control"
                                            id="rate_{{ $loop->index }}" value="{{ $userSkill->rate }}"
                                            min="1" max="10" required disabled>
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
                </div>
            @endforeach
        </div>
        <!-- Dynamically added skills will appear here -->
        <div id="newSkillContainer"></div>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteSkill(button) {
        const skillId = button.getAttribute('data-id'); // Get the skill ID dynamically
        const accordionItem = button.closest('.accordion-item'); // Get the accordion item to be removed
        console.log(skillId);

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
                fetch(`/UserSkill/${skillId}`, {
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
                            // Remove the accordion item from the DOM
                            accordionItem.remove();

                            // Show success message
                            Swal.fire(
                                'Deleted!',
                                'Your skill has been deleted.',
                                'success'
                            );
                            location.reload(); // Reload the page to reflect changes
                        } else if (response.status === 403) {
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
                            'Failed to delete the skill due to a network error.',
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
