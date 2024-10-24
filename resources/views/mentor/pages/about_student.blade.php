@extends('mentor.master_page')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>About Student</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Students</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">About Student</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-xxl-4 col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="text-center p-3 overlay-box"
                                    style="background-image: url(images/big/img1.jpg);">
                                    <div class="profile-photo">
                                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Avatar"
                                            class="rounded-circle" style="width: 100px; height: 105px;">
                                    </div>
                                    <h3 class="mt-3 mb-1 text-white">
                                        {{ $profile->full_name ? $profile->full_name : $user->username }}</h3>

                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">about me</h2>
                                </div>
                                <div class="card-body pb-0">
                                    <p>{{ $profile->about_me ?? ' No information' }}</p>

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Gender</strong>
                                            <span class="mb-0">{{ $profile->gender ?? 'N/A' }}</span>
                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Major</strong>
                                            <span class="mb-0">{{ $profile->major }}</span>
                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Email</strong>
                                            <span class="mb-0">{{ $profile->email ?? $user->email }}</span>

                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Phone</strong>
                                            <span class="mb-0">{{ $profile->phone }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer pt-0 pb-0 text-center">
                                    <div class="row">
                                        <div class="col-4 pt-3 pb-3 border-right">
                                            <h3 class="mb-1 text-primary">{{ $projectsCount }}</h3>
                                            <span>Projects</span>
                                        </div>
                                        <div class="col-4 pt-3 pb-3 border-right">
                                            <h3 class="mb-1 text-primary">{{ $certificationsCount }}</h3>
                                            <span>Certs</span>
                                        </div>
                                        <div class="col-4 pt-3 pb-3">
                                            <h3 class="mb-1 text-primary">{{ $userTasksCount }}</h3>
                                            <span>Tasks done </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-9 col-xxl-8 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-tab">
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a href="#about-me" data-toggle="tab"
                                                class="nav-link active show">About Me</a></li>

                                    </ul>
                                    <div class="tab-content">
                                        <div id="about-me" class="tab-pane fade active show">
                                            <div class="profile-personal-info pt-4">
                                                <h4 class="text-primary mb-4">Personal Information</h4>
                                                <div class="row mb-4">
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                        <h5 class="f-w-500">Name <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>
                                                            {{ $profile->full_name ? $profile->full_name : $user->username }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                        <h5 class="f-w-500 mb-0">Email <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                        <span class="mb-0">{{ $profile->email ?? $user->email }}</span>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                        <h5 class="f-w-500">Age <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                        <span>{{ $profile->age }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-4">
                                                        <h5 class="f-w-500">Location <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                        @if ($profile->country || $profile->country)
                                                            <span>

                                                                {{ $profile->country }} ,{{ $profile->city }} </span>
                                                        @else
                                                            <span>No information</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="profile-skills pt-2 border-bottom-1 pb-2">
                                                <h4 class="text-primary mb-4">Skills</h4>
                                                @foreach ($skill_name as $skill)
                                                    @php
                                                        // Split the skill name by commas
                                                        $skills = explode(',', $skill->name);
                                                    @endphp

                                                    @if (!empty($skills))
                                                        @foreach ($skills as $singleSkill)
                                                            <a href="javascript:void()"
                                                                class="btn btn-outline-dark btn-rounded px-4 my-3 my-sm-0 mr-3 m-b-10">
                                                                {{ trim($singleSkill) }}
                                                            </a>
                                                        @endforeach
                                                    @else
                                                        <p>No skills available.</p> <!-- Fallback message if no skills -->
                                                    @endif
                                                @endforeach


                                            </div>
                                            <div class="profile-lang pt-5 border-bottom-1 pb-5">
                                                <h4 class="text-primary mb-4">Language</h4><a href="javascript:void()"
                                                    class="text-muted pr-3 f-s-16"><i class="flag-icon flag-icon-us"></i>
                                                    {{ $profile->language ?? 'No Languges ' }}</a>

                                            </div>

                                            <!-- Certifications Section -->
                                            <div class="profile-lang py-5 border-bottom">
                                                <h4 class="text-primary mb-4">Certifications</h4>

                                                <div class="certifications-section"
                                                    style="max-height: 200px; overflow-y: auto;">
                                                    @if ($certifications->isEmpty())
                                                        <p class="text-muted">No Certifications found.</p>
                                                    @else
                                                        @foreach ($certifications as $certification)
                                                            <div
                                                                class="mb-3 p-3 border rounded bg-light d-flex justify-content-between align-items-start">
                                                                <div>
                                                                    <h5 class="mb-1">{{ $certification->name }}</h5>
                                                                </div>
                                                                <h5 class="text-muted fw-bold">
                                                                    {{ \Carbon\Carbon::parse($certification->start_due)->format('F j, Y') }}
                                                                    -
                                                                    {{ \Carbon\Carbon::parse($certification->end_due)->format('F j, Y') }}
                                                                </h5>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Projects Section -->
                                            <div class="profile-projects py-5 border-bottom">
                                                <h4 class="text-primary mb-4">Projects</h4>

                                                <div class="projects-section"
                                                    style="max-height: 200px; overflow-y: auto;">
                                                    @if ($projects->isEmpty())
                                                        <p class="text-muted">No Projects found.</p>
                                                    @else
                                                        @foreach ($projects as $project)
                                                            <div class="mb-3 p-3 border rounded bg-light">
                                                                <h5 class="mb-1">{{ $project->name }}</h5>
                                                                <small class="text-muted float-end fw-bold">
                                                                    {{ \Carbon\Carbon::parse($project->start_due)->format('F j, Y') }}
                                                                    -
                                                                    {{ \Carbon\Carbon::parse($project->end_due)->format('F j, Y') }}
                                                                </small>
                                                                <p class="mt-2">{{ $project->description }}</p>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Experiences Section -->
                                            <div class="profile-experiences py-5">
                                                <h4 class="text-primary mb-4">Experiences</h4>

                                                <div class="experiences-section"
                                                    style="max-height: 200px; overflow-y: auto;">
                                                    @if ($experiences->isEmpty())
                                                        <p class="text-muted">No Experiences found.</p>
                                                    @else
                                                        @foreach ($experiences as $experience)
                                                            <div
                                                                class="mb-3 p-3 border rounded bg-light d-flex justify-content-between align-items-start">
                                                                <div>
                                                                    <h5 class="mb-1">{{ $experience->title }}</h5>
                                                                    <p class="mt-2">{{ $experience->description }}</p>
                                                                </div>
                                                                <h5 class="text-muted fw-bold">
                                                                    {{ \Carbon\Carbon::parse($experience->start_due)->format('F j, Y') }}
                                                                    -
                                                                    {{ \Carbon\Carbon::parse($experience->end_due)->format('F j, Y') }}
                                                                </h5>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>





                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
