<!-- Modal -->
<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Add Project</h5>
                <button type="button" class="btn-close" onclick="closeModal_p()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tab-content mt-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="projectTab" role="tabpanel"
                        aria-labelledby="project-tab">
                        <form action="{{ route('projects.store') }}" method="POST">
                            @csrf <!-- Laravel CSRF token -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Project Name</label>
                                <input type="text" name="name" class="form-control" id="namep" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Project Description</label>
                                <textarea name="description" class="form-control" id="descriptionp" rows="3" required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_due" class="form-label">Start Date</label>
                                    <input type="date" name="start_due" class="form-control" id="start_duep"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="end_due" class="form-label">End Date / Expected to End</label>
                                    <input type="date" name="end_due" class="form-control" id="end_duep" required>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-pay-now">Add Project</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openModalcreate_p() {
        var modal = new bootstrap.Modal(document.getElementById('projectModal'));
        modal.show();
    }

    function closeModal_p() {
        var modalEl = document.getElementById('projectModal');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();
        }
    }

    function showTab(tabId) {
        var tabs = document.querySelectorAll('.tab-pane');
        tabs.forEach(function(tab) {
            tab.classList.remove('show', 'active');
        });
        document.getElementById(tabId).classList.add('show', 'active');
    }
</script>
