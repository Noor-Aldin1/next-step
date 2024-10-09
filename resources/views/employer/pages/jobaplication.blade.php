@extends('employer.pages.panel')

@section('maincontent')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-sm-flex d-block justify-content-between align-items-center mb-4">
                <div class="card-action coin-tabs mt-3 mt-sm-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#AllStatus">All Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Pending">Pending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Accepted">Acceptance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Rejected">Rejections</a>
                        </li>
                    </ul>
                </div>

                <!-- Sorting by Newest/Oldest -->
                <div class="d-flex mt-sm-0 mt-3">
                    <select class="default-select dashboard-select" id="sortSelect">
                        <option value="newest" selected>Newest</option>
                        <option value="oldest">Oldest</option>
                    </select>
                </div>
                {{-- Title Filter --}}
                <div class="d-flex">
                    <select class="default-select dashboard-select" id="titleFilter" onchange="toggleRemoveFilterButton()">
                        <option value="" selected>All Titles</option>
                        @foreach ($titles as $title)
                            <option value="{{ $title }}" {{ request('title') == $title ? 'selected' : '' }}>
                                {{ $title }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary ms-2" onclick="fetchApplications()">Apply</button>
                    <button id="removeFilterButton" class="btn btn-secondary ms-2" onclick="removeFilter()">Remove
                        Filter</button>
                </div>

                <script>
                    function fetchApplications() {
                        const title = document.getElementById('titleFilter').value; // Get the selected title
                        const url = new URL(window.location.href); // Get the current URL

                        // Append title parameter to the URL
                        if (title) {
                            url.searchParams.set('title', title); // Set the title parameter
                        } else {
                            url.searchParams.delete('title'); // Remove the title parameter if no title is selected
                        }

                        // Redirect to the updated URL
                        window.location.href = url.toString(); // Redirect to the new URL
                    }

                    function removeFilter() {
                        const url = new URL(window.location.href); // Get the current URL
                        url.searchParams.delete('title'); // Remove the title parameter
                        window.location.href = url.toString(); // Redirect to the new URL without the filter
                    }

                    function toggleRemoveFilterButton() {
                        const titleFilter = document.getElementById('titleFilter');
                        const removeFilterButton = document.getElementById('removeFilterButton');

                        // Enable the Remove Filter button if a title is selected, otherwise keep it disabled
                        removeFilterButton.style.display = titleFilter.value ? 'inline-block' : 'none';
                    }

                    // Initial call to toggle the Remove Filter button visibility
                    toggleRemoveFilterButton();
                </script>
                {{-- end filter --}}

            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="tab-content">
                        <!-- All Status Tab -->
                        <div class="tab-pane fade show active" id="AllStatus">
                            <div id="application-tbl1_wrapper" class="dataTables_wrapper no-footer">
                                {{-- main table  --}}
                                <table
                                    class="table display mb-4 dataTablesCard order-table card-table text-black application"
                                    id="application-tbl1">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check ms-2">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="checkAll4">
                                                    <label class="form-check-label" for="checkAll4"></label>
                                                </div>
                                            </th>
                                            <th>Application ID</th>
                                            <th>Date Applied</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Position</th>
                                            <th>CV</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="applicationTable">
                                        @foreach ($applications as $app)
                                            <tr data-status="{{ $app->status }}" data-date="{{ $app->applied_at }}">
                                                <td>
                                                    <div class="form-check ms-2">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="customCheckBox">
                                                        <label class="form-check-label" for="customCheckBox"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $app->id }}</td>
                                                <td class="wspace-no">
                                                    {{ \Carbon\Carbon::parse($app->applied_at)->format('l, F j, Y \a\t g:i A') }}
                                                </td>


                                                <td><a style="text-decoration: underline"
                                                        href='{{ route('employer.job_postings.show', $app->job_id) }}'>{{ $app->title }}</a>
                                                </td>
                                                <td>{{ $app->job_type }}</td>
                                                <td>{{ $app->position }}</td>
                                                <td class="wspace-no">
                                                    <span class="text-secoundry fs-14 font-w600">
                                                        @if ($app->cv)
                                                            <a href="{{ asset('storage/' . $app->cv) }}"
                                                                style="text-decoration: underline;" target="_blank">View
                                                                CV</a>
                                                        @else
                                                            <a style="text-decoration: underline;"
                                                                href="{{ route('resumes.show', $app->user_id) }}">Applicant
                                                                Profile</a>
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="btn btn-rounded btn-sm 
                                                        @if ($app->status == 'Pending') btn-warning 
                                                        @elseif($app->status == 'Accepted') btn-success 
                                                        @elseif($app->status == 'Rejected') btn-danger 
                                                        @else btn-outline-light @endif">
                                                        {{ $app->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($app->status !== 'Accepted')
                                                        <div class="dropdown text-end">
                                                            <div class="btn-link" data-bs-toggle="dropdown">
                                                                <a href="javascript:void(0);"><i style="font-size:30px"
                                                                        class="fas fa-ellipsis-h"></i></a>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item text-black"
                                                                    href="javascript:void(0);"
                                                                    onclick="updateApplicationStatus({{ $app->id }}, 'Accepted')">
                                                                    <i class="far fa-check-circle me-1 text-success"></i>
                                                                    Accept
                                                                </a>
                                                                <a class="dropdown-item text-black"
                                                                    href="javascript:void(0);"
                                                                    onclick="updateApplicationStatus({{ $app->id }}, 'Rejected')">
                                                                    <i class="far fa-times-circle me-1 text-danger"></i>
                                                                    Reject
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-success">Accepted</span>
                                                    @endif
                                                </td>





                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="mb-sm-0 mb-3">
                                        <p class="mb-0">Showing {{ $applications->firstItem() }} to
                                            {{ $applications->lastItem() }} of {{ $applications->total() }} entries</p>
                                    </div>
                                    <nav>
                                        <ul class="pagination pagination-circle">
                                            <!-- Previous Page Link -->
                                            <li
                                                class="page-item page-indicator {{ $applications->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $applications->previousPageUrl() }}"
                                                    tabindex="-1">
                                                    <i class="la la-angle-left"></i>
                                                </a>
                                            </li>

                                            <!-- Pagination Links -->
                                            @for ($i = 1; $i <= $applications->lastPage(); $i++)
                                                <li
                                                    class="page-item {{ $i == $applications->currentPage() ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $applications->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor

                                            <!-- Next Page Link -->
                                            <li
                                                class="page-item page-indicator {{ $applications->hasMorePages() ? '' : 'disabled' }}">
                                                <a class="page-link" href="{{ $applications->nextPageUrl() }}">
                                                    <i class="la la-angle-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>

                        <!-- Other Status Tabs -->
                        {{-- table pnding --}}
                        <div class="tab-pane fade" id="Pending">
                            <div class="table-responsive">
                                <table
                                    class="table display mb-4 dataTablesCard order-table card-table text-black application">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check ms-2">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="checkAllPending">
                                                    <label class="form-check-label" for="checkAllPending"></label>
                                                </div>
                                            </th>
                                            <th>Application ID</th>
                                            <th>Date Applied</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Position</th>
                                            <th>CV</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applications as $app)
                                            @if ($app->status == 'Pending')
                                                <tr data-status="{{ $app->status }}"
                                                    data-date="{{ $app->applied_at }}">
                                                    <td>
                                                        <div class="form-check ms-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" id="customCheckBoxPending">
                                                            <label class="form-check-label"
                                                                for="customCheckBoxPending"></label>
                                                        </div>
                                                    </td>
                                                    <td>{{ $app->id }}</td>
                                                    <td class="wspace-no">
                                                        {{ \Carbon\Carbon::parse($app->applied_at)->format('l, F j, Y \a\t g:i A') }}
                                                    </td>
                                                    <td><a style="text-decoration: underline"
                                                            href='{{ route('employer.job_postings.show', $app->job_id) }}'>{{ $app->title }}</a>
                                                    </td>
                                                    <td>{{ $app->job_type }}</td>
                                                    <td>{{ $app->position }}</td>
                                                    <td class="wspace-no">
                                                        <span class="text-secoundry fs-14 font-w600">
                                                            @if ($app->cv)
                                                                <a href="{{ asset('storage/' . $app->cv) }}"
                                                                    style="text-decoration: underline;"
                                                                    target="_blank">View CV</a>
                                                            @else
                                                                <a style="text-decoration: underline;"
                                                                    href="{{ route('resumes.show', $app->user_id) }}">Applicant
                                                                    Profile</a>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="btn btn-rounded btn-sm btn-warning">{{ $app->status }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($app->status !== 'Accepted')
                                                            <div class="dropdown text-end">
                                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                                    <a href="javascript:void(0);"><i
                                                                            style="font-size:30px"
                                                                            class="fas fa-ellipsis-h"></i></a>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item text-black"
                                                                        href="javascript:void(0);"
                                                                        onclick="updateApplicationStatus({{ $app->id }}, 'Accepted')">
                                                                        <i
                                                                            class="far fa-check-circle me-1 text-success"></i>
                                                                        Accept
                                                                    </a>
                                                                    <a class="dropdown-item text-black"
                                                                        href="javascript:void(0);"
                                                                        onclick="updateApplicationStatus({{ $app->id }}, 'Rejected')">
                                                                        <i
                                                                            class="far fa-times-circle me-1 text-danger"></i>
                                                                        Reject
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span class="text-success">Accepted</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- table Accepted --}}
                        <div class="tab-pane fade" id="Accepted">
                            <div class="table-responsive">
                                <table
                                    class="table display mb-4 dataTablesCard order-table card-table text-black application">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check ms-2">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="checkAllAccepted">
                                                    <label class="form-check-label" for="checkAllAccepted"></label>
                                                </div>
                                            </th>
                                            <th>Application ID</th>
                                            <th>Date Applied</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Position</th>
                                            <th>CV</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applications as $app)
                                            @if ($app->status == 'Accepted')
                                                <tr data-status="{{ $app->status }}"
                                                    data-date="{{ $app->applied_at }}">
                                                    <td>
                                                        <div class="form-check ms-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" id="customCheckBoxAccepted">
                                                            <label class="form-check-label"
                                                                for="customCheckBoxAccepted"></label>
                                                        </div>
                                                    </td>
                                                    <td>{{ $app->id }}</td>
                                                    <td class="wspace-no">
                                                        {{ \Carbon\Carbon::parse($app->applied_at)->format('l, F j, Y \a\t g:i A') }}
                                                    </td>
                                                    <td><a style="text-decoration: underline"
                                                            href='{{ route('employer.job_postings.show', $app->job_id) }}'>{{ $app->title }}</a>
                                                    </td>
                                                    <td>{{ $app->job_type }}</td>
                                                    <td>{{ $app->position }}</td>
                                                    <td class="wspace-no">
                                                        <span class="text-secoundry fs-14 font-w600">
                                                            @if ($app->cv)
                                                                <a href="{{ asset('storage/' . $app->cv) }}"
                                                                    style="text-decoration: underline;"
                                                                    target="_blank">View CV</a>
                                                            @else
                                                                <a style="text-decoration: underline;"
                                                                    href="{{ route('resumes.show', $app->user_id) }}">Applicant
                                                                    Profile</a>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="btn btn-rounded btn-sm btn-success">{{ $app->status }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($app->status !== 'Accepted')
                                                            <div class="dropdown text-end">
                                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                                    <a href="javascript:void(0);"><i
                                                                            style="font-size:30px"
                                                                            class="fas fa-ellipsis-h"></i></a>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item text-black"
                                                                        href="javascript:void(0);"
                                                                        onclick="updateApplicationStatus({{ $app->id }}, 'Accepted')">
                                                                        <i
                                                                            class="far fa-check-circle me-1 text-success"></i>
                                                                        Accept
                                                                    </a>
                                                                    <a class="dropdown-item text-black"
                                                                        href="javascript:void(0);"
                                                                        onclick="updateApplicationStatus({{ $app->id }}, 'Rejected')">
                                                                        <i
                                                                            class="far fa-times-circle me-1 text-danger"></i>
                                                                        Reject
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span class="text-success">Accepted</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- table rejected  --}}

                        <div class="tab-pane fade" id="Rejected">
                            <div class="table-responsive">
                                <table
                                    class="table display mb-4 dataTablesCard order-table card-table text-black application">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check ms-2">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="checkAllRejected">
                                                    <label class="form-check-label" for="checkAllRejected"></label>
                                                </div>
                                            </th>
                                            <th>Application ID</th>
                                            <th>Date Applied</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Position</th>
                                            <th>CV</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applications as $app)
                                            @if ($app->status == 'Rejected')
                                                <tr data-status="{{ $app->status }}"
                                                    data-date="{{ $app->applied_at }}">
                                                    <td>
                                                        <div class="form-check ms-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" id="customCheckBoxRejected">
                                                            <label class="form-check-label"
                                                                for="customCheckBoxRejected"></label>
                                                        </div>
                                                    </td>
                                                    <td>{{ $app->id }}</td>
                                                    <td class="wspace-no">
                                                        {{ \Carbon\Carbon::parse($app->applied_at)->format('l, F j, Y \a\t g:i A') }}
                                                    </td>
                                                    <td><a style="text-decoration: underline"
                                                            href='{{ route('employer.job_postings.show', $app->job_id) }}'>{{ $app->title }}</a>
                                                    </td>
                                                    <td>{{ $app->job_type }}</td>
                                                    <td>{{ $app->position }}</td>
                                                    <td class="wspace-no">
                                                        <span class="text-secoundry fs-14 font-w600">
                                                            @if ($app->cv)
                                                                <a href="{{ asset('storage/' . $app->cv) }}"
                                                                    style="text-decoration: underline;"
                                                                    target="_blank">View CV</a>
                                                            @else
                                                                <a style="text-decoration: underline;"
                                                                    href="{{ route('resumes.show', $app->user_id) }}">Applicant
                                                                    Profile</a>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="btn btn-rounded btn-sm btn-danger">{{ $app->status }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($app->status !== 'Accepted')
                                                            <div class="dropdown text-end">
                                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                                    <a href="javascript:void(0);"><i
                                                                            style="font-size:30px"
                                                                            class="fas fa-ellipsis-h"></i></a>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item text-black"
                                                                        href="javascript:void(0);"
                                                                        onclick="updateApplicationStatus({{ $app->id }}, 'Accepted')">
                                                                        <i
                                                                            class="far fa-check-circle me-1 text-success"></i>
                                                                        Accept
                                                                    </a>
                                                                    <a class="dropdown-item text-black"
                                                                        href="javascript:void(0);"
                                                                        onclick="updateApplicationStatus({{ $app->id }}, 'Rejected')">
                                                                        <i
                                                                            class="far fa-times-circle me-1 text-danger"></i>
                                                                        Reject
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span class="text-success">Accepted</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.getElementById('sortSelect');
            const tableRows = Array.from(document.querySelectorAll('#applicationTable tr'));

            // Sort by date
            sortSelect.addEventListener('change', function() {
                const sortedRows = tableRows.sort((a, b) => {
                    const dateA = new Date(a.getAttribute('data-date'));
                    const dateB = new Date(b.getAttribute('data-date'));
                    return sortSelect.value === 'newest' ? dateB - dateA : dateA - dateB;
                });
                const tableBody = document.getElementById('applicationTable');
                tableBody.innerHTML = ''; // Clear table body
                sortedRows.forEach(row => tableBody.appendChild(row)); // Append sorted rows
            });

            // Filter applications by status when tabs are clicked
            document.querySelectorAll('.nav-link').forEach(tab => {
                tab.addEventListener('click', function() {
                    const status = tab.getAttribute('href').replace('#', '');
                    tableRows.forEach(row => {
                        row.style.display = (status === 'AllStatus' || row.getAttribute(
                            'data-status') === status) ? '' : 'none';
                    });
                });
            });
        });
    </script>

    <script>
        function updateApplicationStatus(applicationId, status) {
            // Show a confirmation dialog using SweetAlert
            Swal.fire({
                title: `Are you sure you want to ${status} this application?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform AJAX request to update the status
                    $.ajax({
                        url: `/applications/update-status`, // Adjust URL based on your route
                        type: 'POST',
                        data: {
                            id: applicationId, // Include the application ID
                            status: status,
                            _token: '{{ csrf_token() }}' // Include CSRF token
                        },
                        success: function(response) {
                            // Handle success (e.g., refresh the page or update the status in the UI)
                            Swal.fire({
                                icon: 'success',
                                title: 'Status Updated!',
                                text: response.message // Show the success message
                            }).then(() => {
                                location.reload(); // Refresh the page to see updated data
                            });
                        },
                        error: function(xhr) {
                            // Handle error
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong: ' + (xhr.responseJSON.message ||
                                    'Please try again later.')
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
