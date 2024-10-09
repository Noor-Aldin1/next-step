<!-- Modal -->
<div class="modal fade" id="skillModal" tabindex="-1" aria-labelledby="skillModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="skillModalLabel">Add Skill</h5>
                <button type="button" class="btn-close" onclick="closeModalSkill()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tab-content mt-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="skillTab" role="tabpanel" aria-labelledby="skill-tab">
                        <form action="{{ route('skills.store') }}" method="POST">
                            @csrf <!-- Laravel CSRF token -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Skill Name :<span style="font-size: 13px">
                                        Input a skill that hasn't existed before</span></label>
                                <br>
                                <select name="name" id="name_s" class="form-control" required>
                                    <option value="" disabled selected>Select a skill</option>
                                    @foreach ($skills as $skill)
                                        <option value="{{ $skill->name }}">{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <br>
                            <div class="mb-3">
                                <label for="rate" class="form-label">Skill Rating (1-10)</label>
                                <br>
                                <select name="rate" class="form-control" id="rate_s" required>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <br>
                            <br>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-pay-now">Add Skill</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openModalCreateSkill() {
        var modal = new bootstrap.Modal(document.getElementById('skillModal'));
        modal.show();
    }

    function closeModalSkill() {
        var modalEl = document.getElementById('skillModal');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();
        }
    }

    function showSkillTab(tabId) {
        var tabs = document.querySelectorAll('.tab-pane');
        tabs.forEach(function(tab) {
            tab.classList.remove('show', 'active');
        });
        document.getElementById(tabId).classList.add('show', 'active');
    }
</script>
