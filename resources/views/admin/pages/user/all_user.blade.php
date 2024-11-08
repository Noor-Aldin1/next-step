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
                        <h3 class="page-title">Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_user">
                            <i class="fa-solid fa-plus"></i> Add User
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="row filter-row mb-4">
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating" id="searchEmployeeID"
                            placeholder="Search by Employee ID">

                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating" id="searchEmployeeName"
                            placeholder=" Search by Employee Name">

                    </div>
                </div>

                <div class="col-sm-6 col-md-3 d-flex">
                    <button class="btn btn-success w-50 me-2" onclick="filterEmployees()">Search</button>
                    <button class="btn btn-secondary w-50" id="clearFilterButton" onclick="clearFilters()" disabled>Clear
                        Filter</button>
                </div>
            </div>
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable" id="employeeTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>User ID</th>
                                    <th>Email</th>

                                    <th class="text-nowrap">Join Date</th>
                                    <th>Role</th>
                                    <th class="text-end no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ route('admin.users.show', $user->id) }}" class="avatar">
                                                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : url('assets/img/profiles/default-avatar.jpg') }}"
                                                        alt="User Image">
                                                </a>
                                                <a
                                                    href="{{ route('admin.users.show', $user->id) }}">{{ ucfirst($user->username) }}</a>
                                            </h2>
                                        </td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y h:i A') }}</td>
                                        </td>
                                        <td>{{ $user->role->name ?? 'N/A' }}</td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.users.show', $user->id) }}">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="confirmDelete({{ $user->id }})">
                                                        <i class="fa-solid fa-trash m-r-5"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>{{ $users->links('vendor.pagination.custom') }}</div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->

        {{-- // @include('admin.pages.employer.partials.add_employer') --}}
        {{-- @include('admin.pages.employer.partials.update_employer') --}}

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // Confirm Delete function
            function confirmDelete(userId) {
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
                            url: `{{ route('admin.users.destroy', '') }}/${userId}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('Deleted!', 'The employee has been deleted.', 'success').then(
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

            // Filter Employees function
            function filterEmployees() {
                const employeeID = document.getElementById('searchEmployeeID').value.toLowerCase();
                const employeeName = document.getElementById('searchEmployeeName').value.toLowerCase();
                const designation = document.getElementById('searchDesignation').value.toLowerCase();
                const table = document.getElementById('employeeTable');
                const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                let anyFilterActive = employeeID || employeeName || designation;

                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName('td');
                    const idMatch = cells[1].textContent.toLowerCase().includes(employeeID);
                    const nameMatch = cells[0].textContent.toLowerCase().includes(employeeName);
                    const designationMatch = !designation || cells[5].textContent.toLowerCase().includes(designation);

                    rows[i].style.display = idMatch && nameMatch && designationMatch ? '' : 'none';
                }

                // Enable Clear Filter button if any filter is applied
                document.getElementById('clearFilterButton').disabled = !anyFilterActive;
            }

            // Clear Filters function
            function clearFilters() {
                document.getElementById('searchEmployeeID').value = '';
                document.getElementById('searchEmployeeName').value = '';
                document.getElementById('searchDesignation').value = '';

                // Reset all rows to visible
                const table = document.getElementById('employeeTable');
                const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                for (let i = 0; i < rows.length; i++) {
                    rows[i].style.display = '';
                }

                // Disable Clear Filter button
                document.getElementById('clearFilterButton').disabled = true;
            }

            // Enable Clear Filter button on input
            const filterInputs = ['searchEmployeeID', 'searchEmployeeName', 'searchDesignation'];
            filterInputs.forEach(id => {
                document.getElementById(id).addEventListener('input', () => {
                    const anyFilterActive = filterInputs.some(id => document.getElementById(id).value);
                    document.getElementById('clearFilterButton').disabled = !anyFilterActive;
                });
            });
        </script>

        @include('admin.pages.user.partials.profile.add_user')
    </div>
    <!-- /Page Wrapper -->
@endsection
