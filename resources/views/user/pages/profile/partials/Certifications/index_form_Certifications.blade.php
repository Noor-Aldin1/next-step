<style>
    /* Container for the custom accordion */
    #certificationContainer {
        margin: 20px 0;
    }

    /* Button style for certification toggle */
    .toggle-certification-btn {
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

    .toggle-certification-btn:hover {
        background-color: #e2e6ea;
    }

    /* Active state button when expanded */
    .toggle-certification-btn.active {
        background-color: #e2e6ea;
        color: #000;
    }

    /* Certification details section (hidden by default) */
    .certification-details {
        border: 1px solid #dee2e6;
        border-top: none;
        padding: 15px;
        display: none;
    }

    /* Transition for showing/hiding details */
    .certification-details.show {
        display: block;
    }

    /* Certification item spacing */
    .certification-item {
        margin-bottom: 15px;
    }

    /* Form group style for input fields */
    .form-group {
        margin-bottom: 15px;
    }

    /* Edit and Delete button styles */
    .btn {
        margin-top: 10px;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
</style>
<div class="container" data-certification-count="{{ Auth::user()->certifications->count() }}">
    <form action="{{ route('certifications.store') }}" method="POST" id="certificationForm">
        @csrf <!-- Laravel CSRF token -->
        <div id="certificationContainer">
            <!-- Loop through existing certifications -->
            @foreach (Auth::user()->certifications as $certification)
                <div class="certification-item">
                    <input type="hidden" name="certification_id[]" value="{{ $certification->id }}">
                    <h2 class="certification-header">
                        <button type="button" class="toggle-certification-btn" onclick="toggleCertification(this)">
                            <span>{{ $certification->name }}</span>
                            <span class="toggle-icon">▼</span>
                        </button>
                    </h2>
                    <div class="certification-details">
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
                                <button type="button" class="btn btn-warning mt-2" data-id="{{ $certification->id }}"
                                    data-name="{{ $certification->name }}"
                                    data-start_due="{{ $certification->start_due }}"
                                    data-end_due="{{ $certification->end_due }}"
                                    onclick="openEditModalCertification(this)">Edit</button>

                                <button type="button" class="btn btn-danger mt-2" data-id="{{ $certification->id }}"
                                    onclick="deleteCertification(this)">Delete</button>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Dynamically added certifications will appear here -->
        <div id="newCertificationContainer"></div>
    </form>
</div>
<script>
    function toggleCertification(button) {
        // Toggle the active class on the button
        button.classList.toggle('active');

        // Find the associated certification details
        const certificationDetails = button.closest('.certification-item').querySelector('.certification-details');

        // Toggle the 'show' class to show/hide details
        certificationDetails.classList.toggle('show');

        // Toggle the icon
        const icon = button.querySelector('.toggle-icon');
        if (certificationDetails.classList.contains('show')) {
            icon.textContent = '▼'; // Down arrow when open
        } else {
            icon.textContent = '▲'; // Up arrow when closed
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteCertification(button) {
        const certificationId = button.getAttribute(
        'data-id'); // Get the certification ID from the button's data attribute
        const certificationItem = button.closest(
        '.certification-item'); // Find the parent certification item to be removed

        // Check if the certificationItem is found
        if (!certificationItem) {
            console.error('Certification item not found!');
            return; // Exit function if item is not found
        }

        console.log('Deleting certification with ID:', certificationId);

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
                // Send AJAX request to delete the certification
                fetch(`/certifications/${certificationId}`, { // Dynamically insert certification ID
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Accept': 'application/json' // Ensure JSON response is expected
                        }
                    })
                    .then(response => response.json()) // Parse the JSON response
                    .then(data => {
                        if (data.success) {
                            // Remove the certification item from the DOM
                            certificationItem.remove();

                            // Show success message
                            Swal.fire(
                                'Deleted!',
                                'Your certification has been deleted.',
                                'success'
                            );
                            location.reload(); // Reload the page to reflect changes
                        } else {
                            // Handle unauthorized access or other errors
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting the certification.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        // Handle network or other errors
                        Swal.fire(
                            'Error!',
                            'Failed to delete the certification.',
                            'error'
                        );
                    });
            }
        });
    }
</script>
