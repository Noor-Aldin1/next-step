<!-- Include SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal for Submitting an Application -->
<div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applicationModalLabel">Submit Application</h5>
                <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="true">
                            <img src="https://cdn-icons-png.freepik.com/512/13011/13011240.png" width="80"
                                alt="Profile">
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="cv-tab" data-bs-toggle="tab" href="#cv" role="tab"
                            aria-controls="cv" aria-selected="false">
                            <img src="https://cdn-icons-png.freepik.com/512/13530/13530512.png" width="80"
                                alt="CV">
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-4" id="myTabContent">
                    <!-- Profile Tab -->
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="text-center mb-3">
                            <h5>Your Profile</h5>
                        </div>
                        <form method="POST" action="{{ route('applications.store') }}" class="application-form">
                            @csrf
                            <div class="mb-3">
                                <label style="font-weight: bold">{{ $jobPosting->title }}</label>
                                <input type="hidden" name="job_id" value="{{ $jobPosting->id }}">
                            </div>
                            <div class="mb-3">
                                @auth


                                    <label for="profileDetails" class="form-label">Your Resume (Profile)</label>
                                    <input type="text" class="form-control" id="profileDetails"
                                        value="{{ auth()->user()->name }}" disabled>
                                @endauth
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit Application</button>
                            </div>
                        </form>
                    </div>

                    <!-- CV Upload Tab -->
                    <div class="tab-pane fade" id="cv" role="tabpanel" aria-labelledby="cv-tab">
                        <div class="text-center mb-3">
                            <h5>Upload Your CV</h5>
                        </div>
                        <form method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data"
                            class="application-form">
                            @csrf
                            <div class="mb-3">
                                <label style="font-weight: bold">{{ $jobPosting->title }}</label>
                                <input type="hidden" name="job_id" value="{{ $jobPosting->id }}">
                            </div>
                            <div class="mb-3">
                                <label for="cvUpload" class="form-label">Upload Your CV</label>
                                <input type="file" class="form-control" id="cvUpload" name="cv" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Open Modal
    function openModal() {
        var modal = new bootstrap.Modal(document.getElementById('applicationModal'));
        modal.show();
    }

    // Close Modal
    function closeModal() {
        var modalEl = document.getElementById('applicationModal');
        var modal = bootstrap.Modal.getInstance(modalEl);
        modal.hide();
    }

    // Show Tab
    function showTab(tabId) {
        var tabs = document.querySelectorAll('.tab-pane');
        tabs.forEach(function(tab) {
            tab.classList.remove('show', 'active');
        });
        document.getElementById(tabId).classList.add('show', 'active');
    }

    // Handle Form Submission
    document.querySelectorAll('.application-form').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Create FormData object from the form
            const formData = new FormData(this);

            // Submit the form using fetch
            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Application Submitted',
                            text: data.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            closeModal(); // Close the modal after showing the alert
                            location
                                .reload(); // Optional: reload the page to see updated applications
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Something went wrong. Please try again.',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.',
                        confirmButtonText: 'OK'
                    });
                });
        });
    });
</script>
