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
                        <h3 class="page-title">Subscriptions</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Subscriptions</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_subscription">
                            <i class="fa-solid fa-plus"></i> Add Subscription
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="row filter-row mb-4">
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating" id="searchUserID"
                            placeholder="Search by User ID">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating" id="searchUserName"
                            placeholder="Search by User Name">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3">
                        <select style="height: 50px;" class="form-control" id="searchPackage" name="package_id">
                            <option value="" selected>Select Package</option>
                            @foreach ($packages as $package)
                                <option value="{{ $package->name }}">{{ $package->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 d-flex">
                    <button class="btn btn-success w-50 me-2" onclick="filterSubscriptions()">Search</button>
                    <button class="btn btn-secondary w-50" id="clearFilterButton" onclick="clearFilters()" disabled>Clear
                        Filter</button>
                </div>
            </div>
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        @if ($subscriptions->isEmpty())
                            <div class="alert alert-warning text-center">
                                No subscriptions found.
                            </div>
                        @else
                            <table class="table table-striped custom-table datatable" id="subscriptionTable">
                                <thead>
                                    <tr>
                                        <th>Subscription ID</th>
                                        <th>User Name</th>
                                        <th>User ID</th>
                                        <th>Package</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Months</th>
                                        <th class="text-end no-sort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscriptions as $subscription)
                                        <tr>
                                            <td>{{ $subscription->id }}</td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $subscription->user->id) }}">
                                                    {{ ucfirst($subscription->user->username) }}
                                                </a>
                                            </td>
                                            <td>{{ $subscription->user->id }}</td>
                                            <td>{{ $subscription->package->name ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($subscription->start_date)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($subscription->end_date)->format('d-m-Y') }}</td>
                                            <td>{{ $subscription->number_month }}</td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#update_subscription"
                                                            data-id="{{ $subscription->id }}"
                                                            data-user_id="{{ $subscription->user_id }}"
                                                            data-package_id="{{ $subscription->package_id }}"
                                                            data-number_month="{{ $subscription->number_month }}"
                                                            data-start_date="{{ $subscription->start_date }}"
                                                            data-end_date="{{ $subscription->end_date }}">
                                                            <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                        </a>

                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $subscription->id }})">
                                                            <i class="fa-solid fa-trash m-r-5"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>{{ $subscriptions->links('vendor.pagination.custom') }}</div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Confirm Delete function
            function confirmDelete(subscriptionId) {
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
                            url: `{{ route('admin.subscriptions.destroy', '') }}/${subscriptionId}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('Deleted!', 'The subscription has been deleted.', 'success')
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

            // Filter Subscriptions function
            function filterSubscriptions() {
                const userID = document.getElementById('searchUserID').value.toLowerCase();
                const userName = document.getElementById('searchUserName').value.toLowerCase();
                const packageName = document.getElementById('searchPackage').value.toLowerCase();
                const table = document.getElementById('subscriptionTable');
                const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                let anyFilterActive = userID || userName || packageName;

                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName('td');
                    const idMatch = cells[1].textContent.toLowerCase().includes(userID);
                    const nameMatch = cells[0].textContent.toLowerCase().includes(userName);
                    const packageMatch = !packageName || cells[2].textContent.toLowerCase() === packageName;

                    rows[i].style.display = idMatch && nameMatch && packageMatch ? '' : 'none';
                }

                // Enable Clear Filter button if any filter is applied
                document.getElementById('clearFilterButton').disabled = !anyFilterActive;
            }

            // Clear Filters function
            function clearFilters() {
                document.getElementById('searchUserID').value = '';
                document.getElementById('searchUserName').value = '';
                document.getElementById('searchPackage').value = '';

                // Reset all rows to visible
                const table = document.getElementById('subscriptionTable');
                const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                for (let i = 0; i < rows.length; i++) {
                    rows[i].style.display = '';
                }

                // Disable Clear Filter button
                document.getElementById('clearFilterButton').disabled = true;
            }

            // Enable Clear Filter button on input
            const filterInputs = ['searchUserID', 'searchUserName', 'searchPackage'];
            filterInputs.forEach(id => {
                document.getElementById(id).addEventListener('input', () => {
                    const anyFilterActive = filterInputs.some(id => document.getElementById(id).value);
                    document.getElementById('clearFilterButton').disabled = !anyFilterActive;
                });
            });
        </script>

        @include('admin.pages.user.partials.subscriptions.add_subscription')
        @include('admin.pages.user.partials.subscriptions.update_subscription')
    </div>
    <!-- /Page Wrapper -->
@endsection
