<!-- Modal -->
<div class="modal fade" id="editSkillModal" tabindex="-1" aria-labelledby="editSkillModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSkillModalLabel">Edit Skill</h5>
                <button type="button" class="btn-close" onclick="closeEditModalSkill()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('skills.update', 0) }}" method="POST" id="editSkillForm">
                    @csrf <!-- Laravel CSRF token -->
                    @method('PUT') <!-- Specify that this is a PUT request for updating -->

                    <div class="mb-3">
                        <label for="skill_name" class="form-label">Skill Name</label>
                        <input type="text" name="name" class="form-control" id="skill_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="rate" class="form-label">Skill Rating (1-10)</label>
                        <br>
                        <select name="rate" class="form-control" id="rate" required>
                            <option value="" disabled selected>Select Rating</option> <!-- Placeholder option -->
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Update Skill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openEditModalSkill(button) {
        // Get values from the button's data attributes
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const rate = button.getAttribute('data-rate');

        // Set the values in the modal's input fields
        document.getElementById('skill_name').value = name;
        document.getElementById('rate').value = rate || ''; // Reset to empty if rate is undefined

        // Set the form action to the route with the skill ID
        const form = document.querySelector('#editSkillForm');
        form.action = `{{ url('skills') }}/${id}`; // Set the form action dynamically to the correct update URL

        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('editSkillModal'));
        modal.show();
    }

    function closeEditModalSkill() {
        const modalEl = document.getElementById('editSkillModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();
        }

        // Reset form fields when modal is closed
        document.getElementById('editSkillForm').reset();
    }
</script>
