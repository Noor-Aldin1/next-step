<div class="container" data-certification-count="{{ Auth::user()->certifications->count() }}">
    <form action="{{ route('certifications.store') }}" method="POST" id="certificationForm">
        @csrf <!-- Laravel CSRF token -->
        <div id="certificationContainer" class="accordion" id="accordionCertification">
            <!-- Existing Certifications (to edit) -->
            @foreach (Auth::user()->certifications as $certification)
                <div class="accordion-item">
                    <input type="hidden" name="certification_id[]" value="{{ $certification->id }}">
                    <h2 class="accordion-header" id="certificationHeading{{ $loop->index }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#certificationCollapse{{ $loop->index }}" aria-expanded="false"
                            aria-controls="certificationCollapse{{ $loop->index }}" onclick="toggleAccordion(this)">
                            {{ $certification->name }}
                        </button>
                    </h2>
                    <div id="certificationCollapse{{ $loop->index }}" class="accordion-collapse collapse"
                        aria-labelledby="certificationHeading{{ $loop->index }}">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_{{ $loop->index }}">Certification Name</label>
                                        <input type="text" name="name[]" class="form-control"
                                            id="name_{{ $loop->index }}" value="{{ $certification->name }}" required
                                            disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_due_{{ $loop->index }}">Start Date</label>
                                        <input type="date" name="start_due[]" class="form-control"
                                            id="start_due_{{ $loop->index }}" value="{{ $certification->start_due }}"
                                            required disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_due_{{ $loop->index }}">End Date / Expected to End</label>
                                        <input type="date" name="end_due[]" class="form-control"
                                            id="end_due_{{ $loop->index }}" value="{{ $certification->end_due }}"
                                            required disabled>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <!-- Edit and Delete buttons -->
                                    <button type="button" class="btn btn-warning mt-2"
                                        data-id="{{ $certification->id }}" data-name="{{ $certification->name }}"
                                        data-start_due="{{ $certification->start_due }}"
                                        data-end_due="{{ $certification->end_due }}"
                                        onclick="openEditModal(this)">Edit</button>

                                    <button type="button" class="btn btn-danger mt-2"
                                        onclick="deleteCertification(this)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Dynamically added certifications will appear here -->
        <div id="newCertificationContainer"></div>

        <!-- Submit Form -->
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteCertification(button) {
        const projectId = button.getAttribute('data-id'); // Get the project ID from the button's data attribute
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

                // Send AJAX request to delete the project
                fetch(`/certifications/{{ $certification->id ?? null }}`, {
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
                                'Your project has been deleted.',
                                'success'
                            );
                            location.reload();
                        } else {
                            // Handle errors or unauthorized access
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting the project.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        // Handle network errors
                        Swal.fire(
                            'Error!',
                            'Failed to delete the project.',
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
