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
        <div class="content container-fluid pb-0">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"> <img
                                                src="{{ $course->photo ? asset('storage/' . $course->photo) : url('assets/img/profiles/default-avatar.jpg') }}"
                                                alt="Course Image"
                                                style="width: 170px; height: 160px; object-fit: cover; border-radius: 8px; border: 2px solid #ccc;"></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ ucfirst($course->title) }}</h3>

                                                <div class="staff-id">Mentor :
                                                    {{ $course->mentor->user->username ?? 'N/A' }}</div>
                                                <div class="small doj text-muted">Created Date :
                                                    {{ \Carbon\Carbon::parse($course->created_at)->format('d-m-Y h:i A') }}
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <p class="personal-info">

                                                {{ ucfirst($course->description) }} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit d-flex align-items-center">
                                    <!-- Edit Icon (Existing) -->
                                    <a data-bs-target="#edit_course" data-bs-toggle="modal" class="edit-icon me-3"
                                        href="#" data-id="{{ $course->id }}" data-title="{{ $course->title }}"
                                        data-description="{{ $course->description }}" data-photo="{{ $course->photo }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>

                                    <!-- Delete Icon (New) -->
                                    <a class="delete-icon deleteCourseBtn" href="#" data-id="{{ $course->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab"
                                    class="nav-link active">Luctures</a></li>
                            <li class="nav-item"><a href="#emp_projects" data-bs-toggle="tab" class="nav-link">Tasks</a>
                            </li>

                            <li class="nav-item"><a href="#emp_assets" data-bs-toggle="tab" class="nav-link">Materials</a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content">

                <!-- Lectures Info Tab -->
                <div id="emp_profile" class="pro-overview tab-pane fade show active">
                    <div class="d-flex justify-content-between mb-3">
                        <div></div>

                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#scheduleLectureModal">
                            <i class="fa-solid fa-plus"></i> Add Lecture
                        </a>
                    </div>
                    <div class="table-responsive table-newdatatable">
                        <table class="table table-new custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Duration</th>
                                    <th>Start Session</th>
                                    <th>Lecture Link</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lectures->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">No lectures available for this course.</td>
                                    </tr>
                                @else
                                    @foreach ($lectures as $courseLecture)
                                        @php
                                            $lecture = $courseLecture->lecture; // Access the actual lecture through the CourseLecture
                                            $start = \Carbon\Carbon::parse($lecture->start_session);
                                            $end = \Carbon\Carbon::parse($lecture->end_session);
                                            $now = \Carbon\Carbon::now(); // Current time
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="assets-details.html" class="table-imgname">
                                                    <span>{{ $lecture->title }}</span>
                                                </a>
                                            </td>
                                            <td>
                                                @php
                                                    $duration = $start->diff($end); // Duration between start and end
                                                    $startFormatted = $start->format('h:i A'); // 12-hour format with AM/PM
                                                    $endFormatted = $end->format('h:i A'); // 12-hour format with AM/PM
                                                @endphp
                                                <div>
                                                    <strong>Start Time:</strong> {{ $startFormatted }}
                                                </div>
                                                <div>
                                                    <strong>End Time:</strong> {{ $endFormatted }}
                                                </div>
                                                <div>
                                                    <strong>Duration:</strong>
                                                    {{ $duration->format('%H hours %I minutes') }}
                                                </div>
                                            </td>
                                            <td>{{ $start->format('d M, Y h:i A') }}</td>
                                            <td><a class="text-primary" href="{{ $lecture->linke_lecture }}"
                                                    target="_blank">View Link</a></td>

                                            <!-- Display Status -->
                                            <td>
                                                @if ($now->gt($end))
                                                    <!-- If current time is after the end time -->
                                                    Ended
                                                @elseif ($now->lt($start))
                                                    <!-- If current time is before the start time -->
                                                    Scheduled
                                                @else
                                                    <!-- If current time is between start and end time -->
                                                    Ongoing
                                                @endif
                                            </td>

                                            <td>
                                                <!-- Pass the lecture description to the modal -->
                                                <button data-bs-toggle="modal" data-bs-target="#description"
                                                    class="btn btn-primary" type="button"
                                                    data-description="{{ $lecture->description }}">
                                                    Description
                                                </button>
                                            </td>

                                            <td>
                                                <div>
                                                    <!-- Delete Button -->
                                                    <button class="btn btn-danger me-2" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div>{{ $lectures->links('vendor.pagination.custom') }}</div>
                    </div>
                </div>
                <!-- /Lectures Info Tab -->



                <!-- Tasks Tab -->
                <div class="tab-pane fade" id="emp_projects">
                    <!-- Add Task Button -->
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="mb-0">Tasks</h5>

                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                            <i class="fa-solid fa-plus"></i> Add Task
                        </a>
                    </div>

                    <div class="row" style="max-height: 400px; overflow-y: auto;">
                        @if ($course->tasks->isEmpty())
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    No tasks available for this course.
                                </div>
                            </div>
                        @else
                            @foreach ($course->tasks as $task)
                                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="dropdown profile-action">
                                                <a aria-expanded="false" data-bs-toggle="dropdown"
                                                    class="action-icon dropdown-toggle" href="#">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a data-bs-target="#edit_task" data-bs-toggle="modal" href="#"
                                                        class="dropdown-item" data-id="{{ $task->task->id }}"
                                                        data-title="{{ $task->task->title }}"
                                                        data-description="{{ $task->task->description }}"
                                                        data-due-date="{{ $task->task->due_date }}">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                    </a>

                                                    <!-- Delete Task Button with Data Attribute -->
                                                    <a href="#" class="dropdown-item deleteTaskBtn"
                                                        data-id="{{ $task->task->id }}">
                                                        <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                    </a>

                                                </div>
                                            </div>
                                            <h4 class="project-title">
                                                <a href="project-view.html">{{ $task->task->title ?? 'N/A' }}</a>
                                            </h4>
                                            <small class="block text-ellipsis m-b-15">
                                                <span class="text-muted">{{ $task->task->status }}</span>
                                            </small>
                                            <p style="max-height: 60px; overflow-y: auto;" class="text-muted">
                                                {{ $task->task->description }}</p>
                                            <div class="pro-deadline m-b-15">
                                                <div class="sub-title">
                                                    Deadline:
                                                </div>
                                                <div class="text-muted">
                                                    {{ \Carbon\Carbon::parse($task->task->due_date)->format('d M, Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- /Tasks Tab -->
                <!-- Materials Tab -->
                <div class="tab-pane fade" id="emp_assets">
                    <!-- Add Material Button -->
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="mb-0">Materials</h5>

                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addMaterialModal">
                            <i class="fa-solid fa-plus"></i> Add Material
                        </a>
                    </div>

                    <div class="row" style="max-height: 400px; overflow-y: auto;">
                        @if ($course->materials->isEmpty())
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    No materials available for this course.
                                </div>
                            </div>
                        @else
                            @foreach ($course->materials as $courseMaterial)
                                @php $material = $courseMaterial->material; @endphp
                                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="dropdown profile-action">
                                                <a aria-expanded="false" data-bs-toggle="dropdown"
                                                    class="action-icon dropdown-toggle" href="#">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- Edit Material Button with Data Attributes -->
                                                    <a data-bs-target="#edit_material" data-bs-toggle="modal"
                                                        href="#" class="dropdown-item"
                                                        data-id="{{ $material->id }}"
                                                        data-title="{{ $material->title }}"
                                                        data-description="{{ $material->description }}">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                    </a>

                                                    <!-- Delete Material Button with Data Attribute -->
                                                    <a href="#" class="dropdown-item deleteMaterialBtn"
                                                        data-id="{{ $material->id }}">
                                                        <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                    </a>

                                                </div>
                                            </div>
                                            <h4 class="project-title">
                                                <a href="project-view.html">{{ $material->title ?? 'N/A' }}</a>
                                            </h4>

                                            <p style="max-height: 60px; overflow-y: auto;" class="text-muted">
                                                {{ $material->description }}
                                            </p>
                                            <a type="button" href="{{ asset('storage/' . $material->file_path) }}"
                                                class="btn btn-primary" download>
                                                Download File
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- /Materials Tab -->




            </div>
        </div>
        <!-- /Page Content -->



    </div>
    <!-- /Page Wrapper -->
    {{-- -------------Section INclude ---------- --}}

    {{-- -----------------Tasks---------------------- --}}
    {{-- //-----------add Task ------- --}}
    @include('admin.pages.mentors.courses.tasks.add_task')
    {{-- //-----------edit Task ------- --}}
    @include('admin.pages.mentors.courses.tasks.edit_task')

    {{-- -----------------Material---------------------- --}}

    {{-- //-----------add Material ------- --}}

    @include('admin.pages.mentors.courses.materials.add_material')

    {{-- //-----------edit Material ------- --}}


    @include('admin.pages.mentors.courses.materials.edit_material')


    {{-- -----------------/Material---------------------- --}}

    {{-- ------------edit courser -----------  --}}
    @include('admin.pages.mentors.courses.edit_course')
    {{-- -------------------add Lectures---------------- --}}
    @include('admin.pages.mentors.courses.Lectures.add_Lecture')



    {{-- ------modal description--- --}}
    <div style="height:auto;" id="description" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <p class="border border-primary p-4" id="lecture-description"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            $('#description').on('show.bs.modal', function(event) {
                // Get the button that triggered the modal
                var button = $(event.relatedTarget);
                // Extract the description from the data-description attribute
                var description = button.data('description');
                // Update the modal content with the description
                var modalBody = $(this).find('.modal-body #lecture-description');
                modalBody.text(description);
            });
        });
    </script>

    <script>
        // Add event listener to all "Delete" buttons
        document.querySelectorAll('.deleteSkillBtn').forEach(button => {
            button.addEventListener('click', function() {
                // Get the skill ID from the button's data-id attribute
                var course = this.getAttribute('data-id');
                console.log(skillId);

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
                        fetch(`/user/skills/${skillId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Show success alert and reload the page to reflect the change
                                    Swal.fire('Deleted!', 'The skill has been deleted.',
                                        'success').then(() => {
                                        location
                                            .reload(); // Reload the page to update the table
                                    });
                                } else {
                                    Swal.fire('Error!',
                                        'There was a problem deleting the skill.', 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error!', 'There was a problem deleting the skill.',
                                    'error');
                            });
                    }
                });
            });
        });
    </script>

@endsection
