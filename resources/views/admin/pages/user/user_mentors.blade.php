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
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">User Mentors</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User Mentors</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_user_mentor">
                            <i class="fa-solid fa-plus"></i> Add User Mentor
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="row filter-row mb-4">
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating" id="searchMentorID"
                            placeholder="Search by Mentor ID">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating" id="searchStudentID"
                            placeholder="Search by Student ID">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating" id="searchStudentName"
                            placeholder="Search by Student Name">
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 d-flex">
                    <button class="btn btn-success w-50 me-2" onclick="filterUserMentors()">Search</button>
                    <button class="btn btn-secondary w-50" id="clearFilterButton" onclick="clearFilters()" disabled>Clear
                        Filter</button>
                </div>
            </div>
            <!-- /Search Filter -->

            <!-- Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        @if ($userMentors->isEmpty())
                            <div class="alert alert-warning text-center">
                                No user-mentor relationships found.
                            </div>
                        @else
                            <table class="table table-striped custom-table datatable" id="userMentorTable">
                                <thead>
                                    <tr>
                                        <th>Mentor Name</th>
                                        <th>Mentor ID</th>
                                        <th>Student Name</th>
                                        <th>Student ID</th>
                                        <th class="text-end no-sort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userMentors as $userMentor)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.users.show', $userMentor->mentor->id) }}">
                                                    {{ ucfirst($userMentor->mentor->user->username) }}
                                                </a>
                                            </td>
                                            <td>{{ $userMentor->mentor->id }}</td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $userMentor->student->id) }}">
                                                    {{ ucfirst($userMentor->student->username) }}
                                                </a>
                                            </td>
                                            <td>{{ $userMentor->student->id }}</td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#edit_user_mentor"
                                                            data-id="{{ $userMentor->id }}"
                                                            data-mentor_id="{{ $userMentor->mentor_id }}"
                                                            data-student_id="{{ $userMentor->student_id }}">
                                                            <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                        </a>

                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $userMentor->id }})">
                                                            <i class="fa-solid fa-trash m-r-5"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>{{ $userMentors->links('vendor.pagination.custom') }}</div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Confirm Delete function
            function confirmDelete(userMentorId) {
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
                            url: `{{ route('admin.user_mentors.destroy', '') }}/${userMentorId}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('Deleted!', 'The user-mentor relationship has been deleted.',
                                            'success')
                                        .then(
                                            () => {
                                                location.reload();
                                            });
                                } else {
                                    Swal.fire('Error!', response.message ||
                                        'Something went wrong. Please try again later.', 'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', 'Something went wrong. Please try again later.',
                                    'error');
                            }
                        });
                    }
                });
            }

            // Filter User Mentors function
            function filterUserMentors() {
                const mentorID = document.getElementById('searchMentorID').value.toLowerCase();
                const studentID = document.getElementById('searchStudentID').value.toLowerCase();
                const studentName = document.getElementById('searchStudentName').value.toLowerCase();
                const table = document.getElementById('userMentorTable');
                const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                let anyFilterActive = mentorID || studentID || studentName;

                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName('td');
                    const mentorMatch = !mentorID || cells[1].textContent.toLowerCase().includes(mentorID);
                    const studentMatch = !studentID || cells[3].textContent.toLowerCase().includes(studentID);
                    const studentNameMatch = !studentName || cells[2].textContent.toLowerCase().includes(studentName);

                    rows[i].style.display = mentorMatch && studentMatch && studentNameMatch ? '' : 'none';
                }

                // Enable Clear Filter button if any filter is applied
                document.getElementById('clearFilterButton').disabled = !anyFilterActive;
            }

            // Clear Filters function
            function clearFilters() {
                document.getElementById('searchMentorID').value = '';
                document.getElementById('searchStudentID').value = '';
                document.getElementById('searchStudentName').value = '';

                // Reset all rows to visible
                const table = document.getElementById('userMentorTable');
                const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                for (let i = 0; i < rows.length; i++) {
                    rows[i].style.display = '';
                }

                // Disable Clear Filter button
                document.getElementById('clearFilterButton').disabled = true;
            }

            // Enable Clear Filter button on input
            const filterInputs = ['searchMentorID', 'searchStudentID', 'searchStudentName'];
            filterInputs.forEach(id => {
                document.getElementById(id).addEventListener('input', () => {
                    const anyFilterActive = filterInputs.some(id => document.getElementById(id).value);
                    document.getElementById('clearFilterButton').disabled = !anyFilterActive;
                });
            });
        </script>

        @include('admin.pages.user.partials.user_mentors.add_user_mentors')
        @include('admin.pages.user.partials.user_mentors.update_user_mentors')
    </div>
    <!-- /Page Wrapper -->

@endsection
