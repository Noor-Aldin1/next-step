@extends('admin.admin_panel')

@section('content')
    <div class="page-wrapper">
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

            <!-- Search Filter -->
            <form method="GET" action="{{ route('admin.mentors.index') }}">
                <div class="row filter-row mb-4">
                    <div class="col-sm-6 col-md-3">
                        <input type="text" class="form-control floating" name="mentor_id" id="searchMentorID"
                            placeholder="Search by Mentor ID">
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <input type="text" class="form-control floating" name="mentor_name" id="searchMentorName"
                            placeholder="Search by Mentor Name">
                    </div>
                    <div class="col-sm-6 col-md-3 d-flex">
                        <button type="submit" class="btn btn-success w-50 me-2">Search</button>
                        <a href="{{ route('admin.mentors.index') }}" class="btn btn-secondary w-50">Clear Filter</a>
                    </div>
                </div>
            </form>

            <!-- Mentor Table -->
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
                                    <th>Status</th>
                                    <th class="text-end no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mentors as $mentor)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ route('admin.users.show', $mentor->user->id) }}" class="avatar">
                                                    <img src="{{ $mentor->user->photo ? asset('storage/' . $mentor->user->photo) : url('assets/img/profiles/default-avatar.jpg') }}"
                                                        alt="Mentor Image">
                                                </a>
                                                <a
                                                    href="{{ route('admin.users.show', $mentor->user->id) }}">{{ ucfirst($mentor->user->username) }}</a>
                                            </h2>
                                        </td>
                                        <td>{{ $mentor->id }}</td>
                                        <td>{{ $mentor->user->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($mentor->user->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td class="{{ $mentor->status == 'active' ? 'text-success' : 'text-warning' }}">
                                            {{ $mentor->status ?? 'N/A' }}
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#edit_mentor" data-status="{{ $mentor->status }}"
                                                        data-id="{{ $mentor->id }}" data-video="{{ $mentor->video }}">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Status & Video
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.users.show', $mentor->user->id) }}">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit Profile
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

        <!-- Add Mentor Modal -->
        @include('admin.pages.mentors.partials.add_mentor')

        <!-- Update Mentor Modal -->
        @include('admin.pages.mentors.partials.update_mentor')

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
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
