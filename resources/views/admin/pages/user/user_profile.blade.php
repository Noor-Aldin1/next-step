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
            {{-- main Component --}}
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img src="{{ asset('storage/' . $user->photo) }}"
                                                alt="User Image"></a>

                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">
                                                    {{ $user->profile->full_name ?? ($user->username ?? 'N/A') }} </h3>
                                                <h6 class="text-muted">{{ $user->profile->job_title ?? 'N/A' }}</h6>
                                                <small class="text-muted">Age: {{ $user->profile->age ?? 'N/A' }}</small>
                                                <div class="staff-id">User ID : {{ $user->id ?? 'N/A' }}</div>
                                                <div class="small doj text-muted">Date of Join:
                                                    {{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y, g:i a') ?? 'N/A' }}
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Phone:</div>
                                                    <div class="text"><a
                                                            href="#">{{ $user->profile->phone ?? 'N/A' }}</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text"><a
                                                            href="#"><span>{{ $user->email ?? 'N/A' }}</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Country / City:</div>
                                                    <div class="text">
                                                        {{ $user->profile->country ?? 'N/A' }}/{{ $user->profile->city ?? 'N/A' }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Language:</div>
                                                    <div class="text">{{ $user->profile->language ?? 'N/A' }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Gender:</div>
                                                    <div class="text">{{ $user->profile->gender ?? 'N/A' }}</div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit"><a class="edit-icon"
                                        href="{{ route('admin.profileEdit.show', $user->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- / main Component --}}
            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab"
                                    class="nav-link active">Profile</a></li>
                            <li class="nav-item"><a href="#emp_projects" data-bs-toggle="tab" class="nav-link">Projects</a>
                            </li>
                            <li class="nav-item"><a href="#emp_Experiences" data-bs-toggle="tab"
                                    class="nav-link">Experiences</a>
                            </li>
                            <li class="nav-item"><a href="#Certificates" data-bs-toggle="tab" class="nav-link">Certificates
                                </a></li>
                            <li class="nav-item"><a href="#emp_assets" data-bs-toggle="tab" class="nav-link">Skills</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content">

                <!-- Profile Info Tab -->
                <div id="emp_profile" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Another Informations </h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">University: </div>
                                            <div class="text">{{ $user->profile->university }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Major:</div>
                                            <div class="text">{{ $user->profile->major }}</div>
                                        </li>
                                        <li>
                                            <div class="title">GAP : </div>
                                            <div class="text">{{ $user->profile->gap }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Linkedin : </div>
                                            <div class="text"><a href="{{ $user->profile->linkedin }}">Linkedin</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Github : </div>
                                            <div class="text"><a href="{{ $user->profile->github }}">github</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Experience</h3>
                                    <div class="experience-box" style="max-height: 300px; overflow-y: auto;">
                                        <ul class="experience-list">
                                            @foreach ($user->experience->sortByDesc('end_due')->sortByDesc('start_due') as $experience)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">{{ $experience->position }}
                                                                at {{ $experience->company_name }}</a>
                                                            <span class="time">
                                                                {{ \Carbon\Carbon::parse($experience->start_due)->format('F Y') }}
                                                                -
                                                                {{ $experience->end_due ? \Carbon\Carbon::parse($experience->end_due)->format('F Y') : 'Present' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <!-- /Profile Info Tab -->

                <!-- Projects Tab -->
                <div class="tab-pane fade" id="emp_projects">
                    <div class="mb-3">

                        <a href="#add_project" data-bs-toggle="modal" class="btn btn-primary">Add Project</a>
                    </div>
                    <div class="{{ $user->certifications->isEmpty() ? ' ' : 'overflow-auto' }}"
                        style="max-height: 400px;"> <!-- Set max-height for overflow -->
                        <div class="row">
                            @if ($user->projects->isEmpty())
                                <div class="col-12 text-center">
                                    <p>No projects added yet.</p>
                                </div>
                            @else
                                @foreach ($user->projects as $project)
                                    <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dropdown profile-action">
                                                    <a aria-expanded="false" data-bs-toggle="dropdown"
                                                        class="action-icon dropdown-toggle" href="#">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a data-bs-target="#edit_project{{ $project->id }}"
                                                            data-bs-toggle="modal" href="#" class="dropdown-item">
                                                            <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                        </a>
                                                        <a data-bs-target="#delete_project{{ $project->id }}"
                                                            data-bs-toggle="modal" href="#" class="dropdown-item">
                                                            <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                                <h4 class="project-title"><a
                                                        href="project-view.html">{{ $project->name }}</a></h4>
                                                <p class="text-muted">{{ $project->description }}</p>
                                                <div class="pro-deadline m-b-15">
                                                    <div class="sub-title">Deadline:</div>
                                                    <div class="text-muted">
                                                        {{ \Carbon\Carbon::parse($project->start_due)->format('F Y') }} -
                                                        {{ $project->end_due ? \Carbon\Carbon::parse($project->end_due)->format('F Y') : 'Ongoing' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /Projects Tab -->

                <!-- emp_Experiences Tab -->
                <div class="tab-pane fade" id="emp_Experiences">
                    <div class="mb-3">
                        <a href="#add_experience" data-bs-toggle="modal" class="btn btn-primary">Add Experience</a>
                    </div>
                    <div class="{{ $user->certifications->isEmpty() ? ' ' : 'overflow-auto' }}"
                        style="max-height: 400px;"> <!-- Set max-height for overflow -->
                        <div class="row">
                            @if ($user->experience->isEmpty())
                                <div class="col-12 text-center">
                                    <p>No experience added yet.</p>
                                </div>
                            @else
                                @foreach ($user->experience->sortByDesc('end_due')->sortByDesc('start_due') as $experience)
                                    <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dropdown profile-action">
                                                    <a aria-expanded="false" data-bs-toggle="dropdown"
                                                        class="action-icon dropdown-toggle" href="#">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a data-bs-target="#edit_experience{{ $experience->id }}"
                                                            data-bs-toggle="modal" href="#" class="dropdown-item">
                                                            <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                        </a>
                                                        <a data-bs-target="#delete_experience{{ $experience->id }}"
                                                            data-bs-toggle="modal" href="#" class="dropdown-item">
                                                            <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                                <h4 class="project-title"><a
                                                        href="experience-view.html">{{ $experience->position }} at
                                                        {{ $experience->company_name }}</a></h4>
                                                <p class="text-muted">{{ $experience->description }}</p>
                                                <div class="pro-deadline m-b-15">
                                                    <div class="sub-title">Duration:</div>
                                                    <div class="text-muted">
                                                        {{ \Carbon\Carbon::parse($experience->start_due)->format('F Y') }}
                                                        -
                                                        {{ $experience->end_due ? \Carbon\Carbon::parse($experience->end_due)->format('F Y') : 'Present' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /emp_Experiences Tab -->


                <!-- Certificates Tab -->
                <div class="tab-pane fade" id="Certificates">
                    <div class="mb-3">
                        <a href="#add_certificate" data-bs-toggle="modal" class="btn btn-primary">Add Certificate</a>
                    </div>
                    <div class=" {{ $user->certifications->isEmpty() ? ' ' : 'overflow-auto' }}"
                        style="max-height: 400px;"> <!-- Set max-height for overflow -->
                        <div class="row">
                            @if ($user->certifications->isEmpty())
                                <div class="col-12 text-center">
                                    <p>No certifications added yet.</p>
                                </div>
                            @else
                                @foreach ($user->certifications as $certification)
                                    <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dropdown profile-action">
                                                    <a aria-expanded="false" data-bs-toggle="dropdown"
                                                        class="action-icon dropdown-toggle" href="#">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a data-bs-target="#edit_certificate{{ $certification->id }}"
                                                            data-bs-toggle="modal" href="#" class="dropdown-item">
                                                            <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                        </a>
                                                        <a data-bs-target="#delete_certificate{{ $certification->id }}"
                                                            data-bs-toggle="modal" href="#" class="dropdown-item">
                                                            <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                                <h4 class="project-title"><a
                                                        href="certificate-view.html">{{ $certification->name }}</a></h4>
                                                <div class="pro-deadline m-b-15">
                                                    <div class="sub-title">Validity:</div>
                                                    <div class="text-muted ">
                                                        {{ $certification->start_due }} - {{ $certification->end_due }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /Certificates Tab -->

                <!-- Skills -->
                <div class="tab-pane fade" id="emp_assets">
                    <div class="mb-3">
                        <a data-bs-toggle="modal" data-bs-target="#add_skill" class="btn btn-primary">Add skill</a>
                    </div>
                    <div class="table-responsive table-newdatatable" style="max-height: 400px; overflow-y: auto;">
                        <!-- Set max-height for overflow -->
                        <table class="table table-new custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Ratings out of 10</th>
                                    <th>Action</th> <!-- New Action Column -->
                                </tr>
                            </thead>
                            <tbody>
                                @if ($user->userSkills->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No skills added yet.</td>
                                    </tr>
                                @else
                                    @foreach ($user->userSkills as $index => $userSkill)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $userSkill->skill->name }}</td>
                                            <td>{{ $userSkill->rate }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="actionMenu{{ $index }}" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="actionMenu{{ $index }}">
                                                        <li>
                                                            <a class="dropdown-item" href="#edit_skill"
                                                                data-bs-toggle="modal"
                                                                data-id="{{ $userSkill->skill->id }}"
                                                                data-name="{{ $userSkill->skill->name }}"
                                                                data-rating="{{ $userSkill->rate }}"
                                                                data-user-id="{{ $userSkill->user_id }}">
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item deleteSkillBtn"
                                                                href="javascript:void(0);"
                                                                data-id="{{ $userSkill->id }}">
                                                                Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <!-- Include SweetAlert2 -->
                        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.css"
                            rel="stylesheet">
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.js"></script>

                    </div>
                </div>
                <!-- /Skills -->



            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

    @include('admin.pages.user.partials.skills.add_skill')
    @include('admin.pages.user.partials.skills.update_skill')


    <script>
        // Add event listener to all "Delete" buttons
        document.querySelectorAll('.deleteSkillBtn').forEach(button => {
            button.addEventListener('click', function() {
                // Get the skill ID from the button's data-id attribute
                var skillId = this.getAttribute('data-id');
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
