<!-- Display Errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Edit Skill Modal -->
<div id="edit_skill" class="modal custom-modal fade" role="dialog" style="height: 61%;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($userSkill))


                    <form action="{{ isset($userSkill) ? route('admin.user.skills.update', $userSkill->id) : '#' }}"
                        method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>

                        @csrf
                        @method('PUT')
                        <input hidden type="hidden" name="user_id" id="user_id" value="{{ $id }}">

                        <div class="row">
                            <!-- Skill Dropdown with Select2 (Pre-filled with existing skill) -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Skill<span class="text-danger">*</span></label>
                                    <div class="custom-select-wrapper">
                                        <select class="form-control select2" name="skill_id" id="skill_id" required>
                                            <option selected disabled>Select Skill</option>
                                            @foreach ($skills as $skill)
                                                <option value="{{ $skill->id }}"
                                                    @if ($userSkill->skill_id == $skill->id) selected @endif>
                                                    {{ $skill->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="invalid-feedback">Please select a skill.</div>
                                </div>
                            </div>

                            <!-- Rating Dropdown with Select2 (Pre-filled with existing rating) -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Rating out of 10 <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control select2" name="rate" id="rate" required>
                                        <option selected disabled>Select Rating</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}"
                                                @if ($userSkill->rate == $i) selected @endif>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    <div class="invalid-feedback">Please select a valid rating.</div>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Update</button>
                        </div>
                    </form>
                @else
                    <form></form>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Include Select2 and jQuery -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<!-- Initialize Select2 and Form Validation -->
<script>
    $(document).ready(function() {
        // Initialize Select2 on elements with the 'select2' class
        $('.select2').select2({
            width: '100%', // Full width of the container
            placeholder: 'Please select', // Placeholder text
            allowClear: true // Allow clearing the selection
        });

        // Example script to populate modal fields with data when an edit button is clicked
        $('a[data-bs-toggle="modal"]').on('click', function() {
            const skillId = $(this).data('id');
            const skillName = $(this).data('name');
            const skillRating = $(this).data('rating');

            // Set the value of the hidden fields or inputs in the modal
            // $('#user_id').val($(this).data('user-id'));
            $('#skill_id').val(skillId).trigger('change'); // Trigger change to update select2
            $('#rate').val(skillRating).trigger('change'); // Trigger change to update select2
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


{{-- -----------delete button ------------------- --}}
{{-- delete skills from --}}
<script>
    // Add event listener to all "Delete" buttons
    document.querySelectorAll('.deleteSkillBtn').forEach(button => {
        button.addEventListener('click', function() {
            // Get the skill ID from the button's data-id attribute
            var skillId = this.getAttribute('data-id');
            console.log(skillId);

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
                    fetch(`/user/skills/${skillId}`, {
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
                                Swal.fire('Deleted!', 'The skill has been deleted.',
                                    'success').then(() => {
                                    location
                                        .reload(); // Reload the page to update the table
                                });
                            } else {
                                Swal.fire('Error!',
                                    'There was a problem deleting the skill.', 'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error!', 'There was a problem deleting the skill.',
                                'error');
                        });
                }
            });
        });
    });
</script>
