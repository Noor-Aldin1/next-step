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
                        <h3 class="page-title">Mentors</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Mentors</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_mentor">
                            <i class="fa-solid fa-plus"></i> Add Mentor
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
                        <input type="text" class="form-control floating" id="searchMentorName"
                            placeholder=" Search by Mentor Name">
                    </div>
                </div>
                {{-- <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3">
                        <select style="height: 50px;" class="form-control" id="searchRole" name="role_id">
                            <option value="" selected>Select role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}

                <div class="col-sm-6 col-md-3 d-flex">
                    <button class="btn btn-success w-50 me-2" onclick="filterMentors()">Search</button>
                    <button class="btn btn-secondary w-50" id="clearFilterButton" onclick="clearFilters()" disabled>Clear
                        Filter</button>
                </div>
            </div>
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable" id="mentorTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mentor ID</th>
                                    <th>Email</th>

                                    <th class="text-nowrap">Join Date</th>
                                    <th>Role</th>
                                    <th class="text-end no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mentors as $mentor)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ route('admin.mentors.show', $mentor->id) }}" class="avatar">
                                                    <img src="{{ $mentor->user->photo ? asset('storage/' . $mentor->user->photo) : url('assets/img/profiles/default-avatar.jpg') }}"
                                                        alt="Mentor Image">
                                                </a>
                                                <a
                                                    href="{{ route('admin.mentors.show', $mentor->id) }}">{{ ucfirst($mentor->user->username) }}</a>
                                            </h2>
                                        </td>
                                        <td>{{ $mentor->id }}</td>
                                        <td>{{ $mentor->user->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($mentor->user->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td>{{ $mentor->role->name ?? 'N/A' }}</td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.mentors.show', $mentor->id) }}">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="confirmDelete({{ $mentor->id }})">
                                                        <i class="fa-solid fa-trash m-r-5"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>{{ $mentors->links('vendor.pagination.custom') }}</div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->

        @include('admin.pages.mentors.partials.add_mentor')
        {{-- @include('admin.pages.mentor.partials.update_mentor') --}}

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Confirm Delete function
            function confirmDelete(mentorId) {
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
                            url: `{{ route('admin.mentors.destroy', '') }}/${mentorId}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('Deleted!', 'The mentor has been deleted.', 'success').then(
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

            // Filter Mentors function
            function filterMentors() {
                const mentorID = document.getElementById('searchMentorID').value.toLowerCase();
                const mentorName = document.getElementById('searchMentorName').value.toLowerCase();
                const role = document.getElementById('searchRole').value.toLowerCase();
                const table = document.getElementById('mentorTable');
                const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                let anyFilterActive = mentorID || mentorName || role;

                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName('td');
                    const idMatch = cells[1].textContent.toLowerCase().includes(mentorID);
                    const nameMatch = cells[0].textContent.toLowerCase().includes(mentorName);
                    const roleMatch = !role || cells[4].textContent.toLowerCase() === role;

                    rows[i].style.display = idMatch && nameMatch && roleMatch ? '' : 'none';
                }

                // Enable Clear Filter button if any filter is applied
                document.getElementById('clearFilterButton').disabled = !anyFilterActive;
            }

            // Clear Filters function
            function clearFilters() {
                document.getElementById('searchMentorID').value = '';
                document.getElementById('searchMentorName').value = '';
                document.getElementById('searchRole').value = '';

                // Reset all rows to visible
                const table = document.getElementById('mentorTable');
                const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                for (let i = 0; i < rows.length; i++) {
                    rows[i].style.display = '';
                }

                // Disable Clear Filter button
                document.getElementById('clearFilterButton').disabled = true;
            }

            // Enable Clear Filter button on input
            const filterInputs = ['searchMentorID', 'searchMentorName', 'searchRole'];
            filterInputs.forEach(id => {
                document.getElementById(id).addEventListener('input', () => {
                    const anyFilterActive = filterInputs.some(id => document.getElementById(id).value);
                    document.getElementById('clearFilterButton').disabled = !anyFilterActive;
                });
            });
        </script>

        {{-- @include('admin.pages.mentor.partials.profile.add_mentor') --}}
    </div>
    <!-- /Page Wrapper -->
@endsection
