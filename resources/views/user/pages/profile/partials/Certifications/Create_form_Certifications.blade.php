<!-- Modal -->
<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subscriptionModalLabel">Certifications</h5>
                <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tab-content mt-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="visa" role="tabpanel" aria-labelledby="visa-tab">
                        <form action="{{ route('certifications.store') }}" method="POST">
                            @csrf <!-- Laravel CSRF token -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Certification Name</label>
                                <input type="text" name="name" class="form-control" id="name1" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_due" class="form-label">Start Date</label>
                                    <input type="date" name="start_due" class="form-control" id="start_due1" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="end_due" class="form-label">End Date / Expected to End</label>
                                    <input type="date" name="end_due" class="form-control" id="end_due1" required>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-pay-now">Add Certification</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openModalcreate() {
        var modal = new bootstrap.Modal(document.getElementById('subscriptionModal'));
        modal.show();
    }

    function closeModal() {
        var modalEl = document.getElementById('subscriptionModal');
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
