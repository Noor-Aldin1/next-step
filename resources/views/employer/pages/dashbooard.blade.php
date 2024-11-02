@extends('employer.pages.panel')

@section('maincontent')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <!-- Job Statistics -->
                <div class="col-xl-6">
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
                                                <span class="fs-14 d-block mb-2">Total Jobs</span>
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

                            <div class="card-body">
                                <div class="card" id="user-activity">
                                    <div class="card-header border-0 pb-0 flex-wrap">
                                        <h4 class="fs-20 mb-0">Application Status Overview</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Doughnut Chart -->
                                            <div class="col-md-6">
                                                <h5 class="text-center">Doughnut Chart</h5>
                                                <canvas id="doughnutChart"></canvas>
                                            </div>
                                            <!-- Pie Chart -->
                                            <div class="col-md-6">
                                                <h5 class="text-center">Pie Chart</h5>
                                                <canvas id="pieChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Application Status Overview -->

                </div>

                <!-- Listed Job Postings -->
                <div class="col-xl-6">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header pb-0 border-0 flex-wrap">
                                    <h4 class="fs-20 mb-0">Your Listed Job Postings</h4>
                                </div>
                                <div class="card-body">
                                    <div class="owl-carousel owl-loaded front-view-slider">
                                        @if ($jobPostings->isEmpty())
                                            <div>No Found Jobs</div>
                                        @else
                                            @foreach ($jobPostings as $job)
                                                <div class="items">
                                                    <div class="jobs">
                                                        <div class="job">
                                                            <div class="text-center">
                                                                <h4 class="mb-0">
                                                                    <a
                                                                        href="{{ route('employer.job_postings.show', $job->id) }}">
                                                                        {{ $job->title }}
                                                                    </a>
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
                        </div> <!-- Keep this closing div for col-xl-12 -->
                    </div> <!-- Keep this closing div for row -->
                </div>

            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = {!! json_encode($statusLabels) !!};
        const data = {!! json_encode($statusData) !!};
        const backgroundColors = ['#FF6384', '#36A2EB', '#FFCE56'];

        // Doughnut Chart
        new Chart(document.getElementById('doughnutChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });

        // Pie Chart
        new Chart(document.getElementById('pieChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>
@endsection
