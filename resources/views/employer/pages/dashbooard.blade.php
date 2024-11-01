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
                                                        <h2 class="mb-0 lh-1">{{ $jobCount }}</h2>

                                                    </div>
                                                    <span class="fs-14 d-block mb-2">Jobs Number</span>
                                                </div>
                                                <div id="NewCustomers"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="job-icon pb-4 pt-4 pt-sm-0 d-flex justify-content-between">
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <h2 class="mb-0 lh-1">{{ $jobApplicationCount }}</h2>
                                                    </div>
                                                    <span class="fs-14 d-block mb-2">Application Sent</span>
                                                </div>
                                                <div id="NewCustomers1"></div>
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
                                    <h4 class="fs-20 mb-0 "> Your Listed Job Postings </h4>

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
                                                                        href="{{ route('employer.job_postings.show', $job->id) }}">{{ $job->title }}</a>
                                                                </h4>
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
