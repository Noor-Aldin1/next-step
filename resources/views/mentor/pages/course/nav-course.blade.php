<div class="row page-titles mx-0" style="background-color: #6673fd;">
    <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-light px-3" style="background-color: #6673fd;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
                <div>
                    <ul class="navbar-nav ms-auto">
                        @php
                            // Determine active states for each link
                            $lectureActive = request()->routeIs('courses.student.show1') ? 'active' : '';
                            $taskActive = request()->routeIs('mentor.tasks.index') ? 'active' : '';
                            $materialActive = request()->routeIs('mentor.materials.course') ? 'active' : '';
                            $solveActive = request()->routeIs('mentor.AnswerTask') ? 'active' : '';

                            // Check if none are active to set the default state
                            $defaultActive =
                                $lectureActive == '' && $taskActive == '' && $materialActive == '' && $solveActive == ''
                                    ? 'active'
                                    : '';
                        @endphp

                        <li class="nav-item">
                            <a class="nav-link text-white {{ $lectureActive }} {{ $defaultActive }}"
                                href="{{ route('courses.student.show1', $course->id) }}">
                                Lectures
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white {{ $taskActive }}"
                                href="{{ route('mentor.tasks.index', $course->id) }}">
                                Tasks
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white {{ $materialActive }}"
                                href="{{ route('mentor.materials.course', $course->id) }}">
                                Materials
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white {{ $solveActive }}"
                                href="{{ route('mentor.AnswerTask', $course->id) }}">
                                Task Answers
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Delete Button -->
                <div class="ms-3">
                    <button class="btn btn-danger" id="delete-course-btn">
                        Delete Course
                    </button>

                </div>
            </div>
        </nav>
    </div>
</div>

<style>
    .nav-link.active {
        text-decoration: underline;
        font-weight: bold;
        color: #f8f9fa;
        /* Change color if needed */
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('delete-course-btn').addEventListener('click', function() {
        const courseId = "{{ $course->id }}"; // Get course ID

        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a form to submit the delete request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action =
                    `{{ route('courses.student.destroy', '') }}/${courseId}`; // Form action URL
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}'; // CSRF token
                form.appendChild(csrfInput);
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE'; // Method override for DELETE
                form.appendChild(methodInput);
                document.body.appendChild(form); // Append form to body
                form.submit(); // Submit the form
            }
        });
    });
</script>
