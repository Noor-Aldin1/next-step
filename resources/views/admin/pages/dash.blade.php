@extends('admin.admin_panel')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid pb-0">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Admin!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- count each part -->
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $studenCount }}</h3>
                                <span>Users</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $MentorsCount }}</h3>
                                <span>Menetors</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $AdminCount }}</h3>
                                <span>Admins</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $EmployerCount }}</h3>
                                <span>Employees</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-subscript"></i></span>

                            <div class="dash-widget-info">
                                <h3>{{ $count_BasicPlain }}</h3>
                                <span>Basic Plan Subscribers </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-dollar-sign"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $count_BasicPremium }}</h3>
                                <span> Pro Plan Subscribers </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- chart -->
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Monthly Revenue by Package</h3>
                                    <canvas id="monthlyRevenueChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Top 5 Mentors</h3>
                                    <div id="bar-chart-container" style="position: relative; width: 100%; height: 300px;">
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card-group m-b-30">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">New Employees</span>
                                    </div>

                                </div>
                                <h3 class="mb-3">{{ $newEmployerCount }}</h3>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">New Users </span>
                                    </div>

                                </div>
                                <h3 class="mb-3">{{ $newstudenCount }}</h3>

                            </div>
                        </div>



                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">Overall Revenue</span>
                                    </div>

                                </div>
                                <h3 class="mb-3">${{ $totalRevenue }}</h3>

                                <p class="mb-0">
                                    Previous Month <span class="text-muted">${{ $totalRevenueLastMonth }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">


                                    <!-- New Mentor Status Chart -->
                                    <h4 class="mt-4">Mentor Status</h4>
                                    <div class="chart-container" style="width: 100%; max-width: 300px; margin: 0 auto;">
                                        <canvas id="mentorStatusChart"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ------deatails--- --}}
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="card-group m-b-30">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">New Employees</span>
                                    </div>
                                    <div>
                                        <span class="text-success">+10%</span>
                                    </div>
                                </div>
                                <h3 class="mb-3">{{ $newEmployerCount }}</h3>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">Earnings</span>
                                    </div>
                                    <div>
                                        <span class="text-success">+12.5%</span>
                                    </div>
                                </div>
                                <h3 class="mb-3">$1,42,300</h3>
                                <div class="progress height-five mb-2">
                                    <div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">
                                    Previous Month <span class="text-muted">$1,15,852</span>
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">Expenses</span>
                                    </div>
                                    <div>
                                        <span class="text-danger">-2.8%</span>
                                    </div>
                                </div>
                                <h3 class="mb-3">$8,500</h3>
                                <div class="progress height-five mb-2">
                                    <div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">
                                    Previous Month <span class="text-muted">$7,500</span>
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">Profit</span>
                                    </div>
                                    <div>
                                        <span class="text-danger">-75%</span>
                                    </div>
                                </div>
                                <h3 class="mb-3">$1,12,000</h3>
                                <div class="progress height-five mb-2">
                                    <div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">
                                    Previous Month <span class="text-muted">$1,42,000</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}


            <!-- Statistics Widget -->

            <!-- /Statistics Widget -->
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mentor Status Chart Data
            const mentorStatusLabels = ['Active Mentors', 'Inactive Mentors'];
            const mentorStatusData = [{{ $activeMentors }}, {{ $inactiveMentors }}];
            const mentorStatusColors = ['#36A2EB', '#FF6384'];

            // Mentor Status Chart
            new Chart(document.getElementById('mentorStatusChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: mentorStatusLabels,
                    datasets: [{
                        data: mentorStatusData,
                        backgroundColor: mentorStatusColors,
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

            // Top Mentors Chart Data
            const topMentors = @json($topMentors);
            const topMentorLabels = topMentors.map(mentor => mentor.username);
            const topMentorData = topMentors.map(mentor => mentor.mention_count);

            // Top Mentors Bar Chart
            new Chart(document.getElementById('barChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: topMentorLabels,
                    datasets: [{
                        label: 'Mentions',
                        data: topMentorData,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Mentions'
                            },
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : ''; // Show only integers
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Mentors'
                            }
                        }
                    }
                }
            });

            // Monthly Revenue Chart Data
            const monthlyRevenue = @json($monthlyRevenue);
            const months = [...new Set(monthlyRevenue.map(item => item.month))];
            const packageNames = [...new Set(monthlyRevenue.map(item => item.package_name))];

            // Prepare datasets for each package
            const monthlyRevenueDatasets = packageNames.map(packageName => {
                const data = months.map(month => {
                    const record = monthlyRevenue.find(item => item.package_name === packageName &&
                        item.month === month);
                    return record ? record.total_revenue : 0;
                });
                return {
                    label: packageName,
                    data: data,
                    borderColor: getRandomColor(),
                    backgroundColor: getRandomColor(0.5),
                    fill: false,
                    tension: 0.1
                };
            });

            // Utility function to get random colors for each line
            function getRandomColor(alpha = 1) {
                const r = Math.floor(Math.random() * 255);
                const g = Math.floor(Math.random() * 255);
                const b = Math.floor(Math.random() * 255);
                return `rgba(${r}, ${g}, ${b}, ${alpha})`;
            }

            // Monthly Revenue Line Chart
            new Chart(document.getElementById('monthlyRevenueChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: months,
                    datasets: monthlyRevenueDatasets
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Revenue'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
