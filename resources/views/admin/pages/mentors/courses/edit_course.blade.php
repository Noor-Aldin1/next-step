@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- Edit Course Modal -->
<div id="edit_course" class="modal custom-modal fade" role="dialog" style="height: 61%;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Course ID (hidden input) -->
                    <input type="hidden" id="course_id" name="course_id">
                    <input type="hidden" name="mentor_id" id="mentorId" value="{{ $course->mentor_id }}">
                    <div class="row">
                        <!-- Course Title -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Course Title<span class="text-danger">*</span></label>
                                <input type="text" name="title" id="course_title" class="form-control" required>
                                <div class="invalid-feedback">Please enter the course title.</div>
                            </div>
                        </div>

                        <!-- Course Photo Upload -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Course Photo<span class="text-danger">*</span></label>
                                <input type="file" name="photo" id="course_photo" class="form-control">
                                <div class="invalid-feedback">Please upload a valid photo.</div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Description<span class="text-danger">*</span></label>
                                <textarea name="description" id="course_description" class="form-control" rows="3" required></textarea>
                                <div class="invalid-feedback">Please provide a description.</div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Populate Modal Fields and Set Form Action -->
<script>
    document.querySelectorAll('.deleteCourseBtn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            const courseId = this.getAttribute(
                'data-id'); // Get the course ID from the data-id attribute

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
                    const url = `{{ route('admin.courses.destroy', ':id') }}`.replace(':id',
                        courseId);
                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Deleted!', 'The course has been deleted.',
                                        'success')
                                    .then(() => location
                                        .reload()); // Reload the page after deletion
                            } else {
                                Swal.fire('Error!',
                                    'There was a problem deleting the course.',
                                    'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error!',
                                'There was a problem deleting the course.', 'error');
                        });
                }
            });
        });
    });
</script>

<!-- Delete Course Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
