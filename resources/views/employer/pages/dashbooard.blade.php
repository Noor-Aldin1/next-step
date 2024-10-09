@extends('employer.pages.panel')
@section('maincontent')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row separate-row">
                                        <div class="col-sm-6">
                                            <div class="job-icon pb-4 d-flex justify-content-between">
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <h2 class="mb-0 lh-1">342</h2>
                                                        <span class="text-success ms-3">+0.5 %</span>
                                                    </div>
                                                    <span class="fs-14 d-block mb-2">Interview Schedules</span>
                                                </div>
                                                <div id="NewCustomers"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="job-icon pb-4 pt-4 pt-sm-0 d-flex justify-content-between">
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <h2 class="mb-0 lh-1">984</h2>
                                                    </div>
                                                    <span class="fs-14 d-block mb-2">Application Sent</span>
                                                </div>
                                                <div id="NewCustomers1"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="job-icon pt-4 pb-sm-0 pb-4 pe-3 d-flex justify-content-between">
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <h2 class="mb-0 lh-1">1,567k</h2>
                                                        <span class="text-danger ms-3">-2 % </span>
                                                    </div>
                                                    <span class="fs-14 d-block mb-2">Profile Viewed</span>
                                                </div>
                                                <div id="NewCustomers2"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="job-icon pt-4  d-flex justify-content-between">
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <h2 class="mb-0 lh-1">437</h2>
                                                    </div>
                                                    <span class="fs-14 d-block mb-2">Unread Messages</span>
                                                </div>
                                                <div id="NewCustomers3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="card " id="user-activity">
                                <div class="card-header border-0 pb-0 flex-wrap">
                                    <h4 class="fs-20 mb-0">Vacany Start</h4>
                                    <div class="card-action coin-tabs mt-3 mt-sm-0">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link " data-bs-toggle="tab" href="#Daily"
                                                    role="tab">Daily</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " data-bs-toggle="tab" href="#Daily"
                                                    role="tab">Weekly</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#Daily"
                                                    role="tab">Monthly</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="pb-4 d-flex flex-wrap">
                                        <span class="d-flex align-items-center">
                                            <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13"
                                                height="13" viewBox="0 0 13 13">
                                                <rect width="13" height="13" rx="6.5" fill="#35c556" />
                                            </svg>
                                            Application Sent
                                        </span>
                                        <span class="application d-flex align-items-center">
                                            <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13"
                                                height="13" viewBox="0 0 13 13">
                                                <rect width="13" height="13" rx="6.5" fill="#3f4cfe" />
                                            </svg>

                                            Interviews
                                        </span>
                                        <span class="application d-flex align-items-center">
                                            <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13"
                                                height="13" viewBox="0 0 13 13">
                                                <rect width="13" height="13" rx="6.5" fill="#f34040" />
                                            </svg>

                                            Rejected
                                        </span>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="Daily">
                                            <canvas id="activity" height="115"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="row">

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header pb-0 border-0 flex-wrap">
                                    <h4 class="fs-20 mb-0 "> Your Job Postings </h4>
                                    <div>
                                        <select class="default-select dashboard-select">
                                            <option data-display="Newest">Newest</option>

                                            <option value="2">oldest</option>
                                        </select>
                                        <div class="dropdown custom-dropdown mb-0">
                                            <div class="btn sharp tp-btn dark-btn" data-bs-toggle="dropdown">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z"
                                                        stroke="#342E59" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z"
                                                        stroke="#342E59" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z"
                                                        stroke="#342E59" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="owl-carousel owl-carousel owl-loaded front-view-slider ">
                                        @if ($jobPostings->isEmpty())
                                            <div>No Found Jobs</div>
                                        @else
                                            @foreach ($jobPostings as $job)
                                                <div class="items">

                                                    <div class="jobs">

                                                        <div class="job">
                                                            <div class="text-center">
                                                                <h4 class="mb-0"><a
                                                                        href="#">{{ $job->title }}</a></h4>
                                                                <span
                                                                    class="text-primary mb-3 d-block">{{ $job->company_name }}</span>
                                                            </div>
                                                            <div class="text-center">
                                                                <span class="d-block mb-1">
                                                                    <i
                                                                        class="fas fa-map-marker-alt me-2"></i>{{ $job->city }},
                                                                    {{ $job->address }}
                                                                </span>
                                                                <span>
                                                                    <i
                                                                        class="fas fa-comments-dollar me-2"></i>{{ number_format($job->salary ?? 0, 2) }}$
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>

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


    <!--**********************************
                                                                                                                                                                                                                                        Main wrapper end
                                                                                                                                                                                                                                    ***********************************-->
  
@endsection
