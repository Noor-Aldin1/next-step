@extends('admin.admin_panel')

@section('content')
    <style>
        /* style model in job list  */
        .custom-grid-badges {
            display: flex;
            gap: 10px;
            margin-top: 1rem;
        }

        .custom-badge {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
        }

        .custom-bg-danger {
            background-color: #dc3545;
            color: white;
        }

        .custom-bg-purple {
            background-color: #6f42c1;
            color: white;
        }

        .custom-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            padding: 2rem;
            border-radius: 8px;
            max-width: 700px;
            width: 90%;
            z-index: 1000;
        }

        .custom-modal h6 {
            margin-top: 0;
        }

        .custom-modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* ------------ */
        .view-icons {
            display: flex;
            /* Use flexbox for alignment */
            align-items: center;
            /* Center items vertically */
            gap: 8px;
            /* Add space between text and icon */
        }

        .clear-filter-text {
            font-weight: bold;
            /* Make the text bold */
            font-size: 14px;
            /* Adjust font size as needed */
            color: #333;
            /* Change text color as desired */
        }
    </style>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Courses</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Courses</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                            <i class="fa-solid fa-plus"></i> Add Course
                        </a>
                    </div>
                </div>
            </div>

            <!-- Search Filter -->
            <div class="row filter-row mb-4">
                <div class="col-sm-6 col-md-3">
                    <input type="text" class="form-control floating" id="searchCourseID"
                        placeholder="Search by Course ID">
                </div>
                <div class="col-sm-6 col-md-3">
                    <input type="text" class="form-control floating" id="searchCourseTitle"
                        placeholder="Search by Course Title">
                </div>
                <div class="col-sm-6 col-md-3 d-flex">
                    <button id="clearFilterBtn" class="btn btn-secondary w-50">Clear Filter</button>
                </div>
            </div>

            <!-- Course Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable" id="courseTable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Course ID</th>
                                    <th>Mentor</th>
                                    <th>Created Date</th>
                                    <th class="text-end no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ route('admin.courses.show', $course->id) }}" class="avatar">
                                                    <img src="{{ $course->photo ? asset('storage/' . $course->photo) : url('assets/img/profiles/default-avatar.jpg') }}"
                                                        alt="Course Image"
                                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 2px solid #ccc;">
                                                </a>
                                                <a href="{{ route('admin.courses.show', $course->id) }}">
                                                    {{ ucfirst($course->title) }}
                                                </a>
                                            </h2>
                                        </td>
                                        <td>{{ $course->id }}</td>
                                        <td>{{ $course->mentor->user->username ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($course->created_at)->format('d-m-Y h:i A') }}</td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.courses.show', $course->id) }}">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit Course
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="confirmDelete({{ $course->id }})">
                                                        <i class="fa-solid fa-trash m-r-5"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>{{ $courses->links('vendor.pagination.custom') }}</div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.pages.mentors.courses.add_course')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchCourseID = document.getElementById('searchCourseID');
            const searchCourseTitle = document.getElementById('searchCourseTitle');
            const clearFilterBtn = document.getElementById('clearFilterBtn');
            const tableRows = document.querySelectorAll('#courseTable tbody tr');

            function filterTable() {
                const courseIDValue = searchCourseID.value.toLowerCase();
                const courseTitleValue = searchCourseTitle.value.toLowerCase();

                tableRows.forEach(row => {
                    const courseID = row.children[1].textContent.toLowerCase();
                    const courseTitle = row.children[0].textContent.toLowerCase();

                    if (
                        (courseID.includes(courseIDValue) || !courseIDValue) &&
                        (courseTitle.includes(courseTitleValue) || !courseTitleValue)
                    ) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchCourseID.addEventListener('input', filterTable);
            searchCourseTitle.addEventListener('input', filterTable);

            clearFilterBtn.addEventListener('click', () => {
                searchCourseID.value = '';
                searchCourseTitle.value = '';
                filterTable();
            });
        });
    </script>

    <!-- Add Course Modal -->
    {{-- @include('admin.pages.courses.partials.add_course') --}}

    <!-- Update Course Modal -->
    {{-- @include('admin.pages.courses.partials.update_course') --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(courseId) {

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('admin.courses.destroy', '') }}/${courseId}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Deleted!', 'The course has been deleted.', 'success').then(
                                    () => location.reload());
                            } else {
                                Swal.fire('Error!', response.message ||
                                    'Something went wrong. Please try again later.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong. Please try again later.',
                                'error');
                        }
                    });
                }
            });
        }
    </script>


    </div>
@endsection
