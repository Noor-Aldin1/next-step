@extends('employer.pages.panel')

@section('maincontent')
    <div class="content-body">
        <div class="container-fluid">
            <!-- Search Filters -->
            <div class="d-flex align-items-center flex-wrap search-job bg-white mb-4">
                <!-- Location Filter -->
                <div class="col-xl-2 col-xxl-3 col-lg-3 col-sm-6 col-12 search-dropdown d-flex align-items-center">
                    <select class="form-control border-0 default-select dashboard-select-1 wide h-auto" id="locationFilter">
                        <option value="">Choose Location</option>
                        <option value="Amman">Amman</option>
                        <option value="France">France</option>
                    </select>
                </div>
                <!-- Salary Filter -->
                <div class="col-xl-2 col-xxl-3 col-lg-3 col-sm-6 col-12 search-dropdown d-flex align-items-center">
                    <select class="form-control border-0 default-select dashboard-select-1 wide h-auto" id="salaryFilter">
                        <option value="">Salary Range</option>
                        <option value="1000">Under $1,000</option>
                        <option value="20000">Under $20,000</option>
                        <option value="30000">Under $30,000</option>
                    </select>
                </div>
                <!-- Job Title Search -->
                <div class="col-xl-8 col-xxl-6 col-lg-6 col-12 d-md-flex job-title-search pe-0">
                    <div class="input-group search-area">
                        <input type="text" class="form-control h-auto" placeholder="Search job title here..."
                            id="titleFilter">
                        <span class="input-group-text">
                            <button id="searchBtn" class="btn btn-primary btn-rounded">Search<i
                                    class="flaticon-381-search-2 ms-2"></i></button>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="row">
                <div class="col-xl-9">
                    <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap">
                        <div class="mb-4">
                            <p class="mb-2">Showing {{ $jobs->count() }} of {{ $jobs->total() }} Job Results</p>
                            <span>Based on your preferences</span>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="default-tab job-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#Boxed">
                                            <i class="fas fa-th-large"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#List1">
                                            <i class="fas fa-list"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-lg-3 col-sm-6 col-12 d-flex align-items-center">
                                <select class="default-select dashboard-select border-0" id="sortSelect">
                                    <option data-display="Newest" value="newest">Newest</option>
                                    <option value="oldest">Oldest</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="Boxed" role="tabpanel">
                            <div class="row" id="jobList">
                                @if ($jobs->isEmpty())
                                    <div class="col-12 text-center">
                                        <p>No job postings found.</p>
                                    </div>
                                @else
                                    @foreach ($jobs as $job)
                                        <div class="col-xl-3 col-xxl-4 col-md-4 col-sm-6 job-listing"
                                            data-date="{{ $job->created_at }}" data-title="{{ $job->title }}"
                                            data-location="{{ $job->city }}"
                                            data-salary="{{ number_format($job->salary ?? 0, 2) }}">
                                            <div class="card">
                                                <div class="jobs2 card-body">
                                                    <div class="text-center">
                                                        <h4 class="mb-0">
                                                            <a href="{{ route('employer.job_postings.show', $job->id) }}"
                                                                class="text-black">{{ $job->title }}</a>
                                                        </h4>
                                                        <span
                                                            class="text-primary mb-3 d-block">{{ $job->company_name }}</span>
                                                    </div>
                                                    <div class="text-center">
                                                        <span class="d-block mb-1"><i
                                                                class="fas fa-map-marker-alt me-2"></i>{{ $job->city }},
                                                            {{ $job->address }}</span>
                                                        <span><i
                                                                class="fas fa-comments-dollar me-2"></i>{{ number_format($job->salary ?? 0, 2) }}$</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <div class="mb-sm-0 mb-3">
                                    <p class="mb-0">Showing {{ $jobs->count() }} of {{ $jobs->total() }} Data</p>
                                </div>
                                <nav>
                                    <ul class="pagination pagination-circle">
                                        <li class="page-item page-indicator">
                                            <a class="page-link" href="{{ $jobs->previousPageUrl() }}">
                                                <i class="la la-angle-left"></i>
                                            </a>
                                        </li>
                                        @for ($i = 1; $i <= $jobs->lastPage(); $i++)
                                            <li class="page-item {{ $i == $jobs->currentPage() ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $jobs->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item page-indicator">
                                            <a class="page-link" href="{{ $jobs->nextPageUrl() }}">
                                                <i class="la la-angle-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <!-- List View -->
                        <div class="tab-pane fade" id="List1">
                            <div class="row">
                                @if ($jobs->isEmpty())
                                    <div class="col-12 text-center">
                                        <p>No job postings found.</p>
                                    </div>
                                @else
                                    @foreach ($jobs as $job)
                                        <div class="col-xl-12" data-date="{{ $job->created_at }}"
                                            data-title="{{ $job->title }}" data-location="{{ $job->city }}"
                                            data-salary="{{ number_format($job->salary ?? 0, 2) }}">
                                            <div
                                                class="d-flex flex-wrap search-row bg-white p-3 mb-3 rounded justify-content-between align-items-center">
                                                <div class="d-flex col-xl-3 col-xxl-4 col-lg-4 col-sm-6 align-items-center">
                                                    <div>
                                                        <h2 class="title">
                                                            <a href="javascript:void(0);"
                                                                class="text-black">{{ $job->title }}</a>
                                                        </h2>
                                                        <span class="text-primary">{{ $job->company_name }}</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex col-xl-3 col-xxl-4 col-lg-4 col-sm-6 align-items-center">
                                                    <div>
                                                        <h4 class="sub-title text-black">
                                                            {{ number_format($job->salary ?? 0, 2) }}$</h4>
                                                        <span>Monthly Salary</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex col-xl-3 col-xxl-4 col-lg-4 col-sm-6 align-items-center">
                                                    <svg class="me-3" width="54" height="54"
                                                        viewBox="0 0 54 54" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="54" height="54" rx="15"
                                                            fill="#FBA556"></rect>
                                                        <path
                                                            d="M27 15C21.934 15 17.8125 19.1215 17.8125 24.1875C17.8125 25.8091 18.2409 27.4034 19.0515 28.7979C19.2404 29.123 19.4516 29.4398 19.6793 29.7396L26.6008 39H27.3991L34.3207 29.7397C34.5483 29.4398 34.7595 29.1231 34.9485 28.7979C35.7591 27.4034 36.1875 25.8091 36.1875 24.1875C36.1875 19.1215 32.066 15 27 15Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <div>
                                                        <h4 class="sub-title text-black">{{ $job->city }}</h4>
                                                        <span>Location</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-xl-3 col-xxl-4 col-lg-4 col-sm-6 mt-lg-0 mt-3 align-items-center">
                                                    <a href="javascript:void(0);" class="btn btn-primary btn-rounded">View
                                                    </a>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jobList = document.getElementById('jobList');
            const locationFilter = document.getElementById('locationFilter');
            const salaryFilter = document.getElementById('salaryFilter');
            const titleFilter = document.getElementById('titleFilter');
            const searchBtn = document.getElementById('searchBtn');

            function filterJobs() {
                const location = locationFilter.value.toLowerCase();
                const salary = salaryFilter.value;
                const title = titleFilter.value.toLowerCase();

                const jobItems = jobList.querySelectorAll('.job-listing');

                jobItems.forEach(job => {
                    const jobLocation = job.getAttribute('data-location').toLowerCase();
                    const jobSalary = parseFloat(job.getAttribute('data-salary'));
                    const jobTitle = job.getAttribute('data-title').toLowerCase();
                    let showJob = true;

                    // Filter by location
                    if (location && !jobLocation.includes(location)) {
                        showJob = false;
                    }

                    // Filter by salary
                    if (salary && jobSalary > parseFloat(salary)) {
                        showJob = false;
                    }

                    // Filter by job title
                    if (title && !jobTitle.includes(title)) {
                        showJob = false;
                    }

                    job.style.display = showJob ? 'block' : 'none';
                });
            }

            // Event listeners for filters
            locationFilter.addEventListener('change', filterJobs);
            salaryFilter.addEventListener('change', filterJobs);
            titleFilter.addEventListener('input', filterJobs);
            searchBtn.addEventListener('click', filterJobs);
        });
    </script>
@endsection
