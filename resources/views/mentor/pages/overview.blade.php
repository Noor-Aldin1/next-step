@extends('mentor.master_page')
@section('content')
    <!--**********************************
                                                                                                                                                                                                                        Content body start
                                                                                                                                                                                                                    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row">
                {{-- All charts --}}
                @auth




                    <div class="col-xl-3 col-xxl-3 col-sm-6">
                        <div class="widget-stat card bg-primary overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title text-white">Total Students</h3>
                                <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{ $studentsCount }}</h5>
                            </div>
                            <div class="card-body text-center mt-3">
                                <div class="ico-sparkline">
                                    <div id="sparkline122"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-xxl-3 col-sm-6">
                        <div class="widget-stat card bg-success overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title text-white">New Students</h3>
                                <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{ $newStudentsCount }}</h5>
                            </div>
                            <div class="card-body text-center mt-4 p-0">
                                <div class="ico-sparkline">
                                    <div id="spark-bar-22"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-xxl-3 col-sm-6">
                        <div class="widget-stat card bg-secondary overflow-hidden">
                            <div class="card-header pb-3">
                                <h3 class="card-title text-white">Total Courses</h3>
                                <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{ $coursesCount }}</h5>
                            </div>
                            <div class="card-body p-0 mt-2">
                                <div class="px-4">
                                    <span class="bar1" data-peity='{ "fill": ["rgb(0, 0, 128)", "rgb(7, 135, 234)"]}'>
                                        {{ json_encode($coursesCountData) ?? 'not available' }} <!-- Display as JSON -->
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-xxl-3 col-sm-6">
                        <div style="background: #3ADF99" class="widget-stat card  overflow-hidden">
                            <div class="card-header pb-3">
                                <h3 class="card-title text-white">Tasks Completed</h3>
                                <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{ $taskCompletedCount }}</h5>
                            </div>
                            <div class="card-body p-0 mt-1">
                                <span class="peity-line-2" data-width="100%">
                                    {{ json_encode($completedTasksData) ?? 'not available' }} <!-- Display as JSON -->
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Include jQuery and Peity scripts -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.peity/3.3.0/jquery.peity.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sparkline/2.1.2/jquery.sparkline.min.js"></script>

                    <script>
                        $(document).ready(function() {
                            // Get the data passed from the backend
                            var totalStudentsData = {!! json_encode($totalStudentsData) !!};
                            var newStudentsData = {!! json_encode($newStudentsData) !!};
                            var coursesCountData = {!! json_encode($coursesCountData) !!}; // Ensure this is set in your controller
                            var completedTasksData = {!! json_encode($completedTasksData) !!}; // Ensure this is set in your controller

                            // Initialize Sparkline for Total Students
                            $('#sparkline122').sparkline(totalStudentsData, {
                                type: 'line',
                                width: '100%',
                                height: '50',
                                lineColor: '#ffffff',
                                fillColor: 'rgba(255, 255, 255, 0.3)',
                                spotColor: '#ffcc00',
                                minSpotColor: '#ffcc00',
                                maxSpotColor: '#ffcc00',
                                highlightSpotColor: '#ffcc00',
                                highlightLineColor: '#ffcc00'
                            });

                            // Initialize Sparkline for New Students
                            $('#spark-bar-22').sparkline(newStudentsData, {
                                type: 'bar',
                                width: '100%',
                                height: '50',
                                barColor: '#ffffff',
                                negBarColor: '#ff0000',
                                stackedBarColor: ['#00ff00', '#ffcc00', '#ff0000'],
                                tooltipFormat: function(value) {
                                    return value + ' New Student';
                                },
                            });

                            // Initialize Peity chart for Courses Count
                            $('.bar1').peity("bar", {
                                fill: ["rgb(0, 0, 128)", "rgb(7, 135, 234)"]
                            });

                            // Initialize Peity chart for Completed Tasks
                            $('.peity-line-2').peity("line", {
                                fill: "#00ff00",
                                stroke: "#ffcc00",
                            });
                        });
                    </script>

                @endauth


                {{-- Assign Task --}}
                <div class="col-12 col-lg-8 col-xl-12 col-xxl-8">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Assign Task</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table header-border table-hover verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Task</th>
                                            <th scope="col">Assigned Professors</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>1</th>
                                            <td>Working Design report</td>
                                            <td>Herman Beck</td>
                                            <td><span class="badge badge-rounded badge-primary">DONE</span></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 70%;" role="progressbar">
                                                        <span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>2</th>
                                            <td>Fees Collection report</td>
                                            <td>Emma Watson</td>
                                            <td><span class="badge badge-rounded badge-warning">Panding</span></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" style="width: 70%;"
                                                        role="progressbar">
                                                        <span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>3</th>
                                            <td>Management report</td>
                                            <td>Mary Adams</td>
                                            <td><span class="badge badge-rounded badge-warning">Panding</span></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" style="width: 70%;"
                                                        role="progressbar">
                                                        <span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>4</th>
                                            <td>Library book status</td>
                                            <td>Caleb Richards</td>
                                            <td><span class="badge badge-rounded badge-danger">Suspended</span></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-danger" style="width: 70%;"
                                                        role="progressbar">
                                                        <span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>5</th>
                                            <td>Placement status</td>
                                            <td>June Lane</td>
                                            <td><span class="badge badge-rounded badge-warning">Panding</span></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" style="width: 70%;"
                                                        role="progressbar">
                                                        <span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>6</th>
                                            <td>Working Design report</td>
                                            <td>Herman Beck</td>
                                            <td><span class="badge badge-rounded badge-primary">DONE</span></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 70%;" role="progressbar">
                                                        <span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!--**********************************
                                                                                                                                                                                                                        Content body end
                                                                                                                                                                                                                    ***********************************-->
@endsection
