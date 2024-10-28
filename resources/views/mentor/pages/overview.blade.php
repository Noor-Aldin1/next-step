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
                            <div class="d-flex justify-content-between mb-3" style="gap: 10px">
                                <div class="flex-fill me-2 text-secondary">
                                    <select style="color:#000  " id="courseFilter"
                                        class="form-control btn text-secondary btn-secondary ">
                                        <option value="">All Courses</option>
                                        @foreach ($assignTask->unique('course_title') as $task)
                                            <option value="{{ $task->course_title }}">{{ $task->course_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-fill">
                                    <select id="studentFilter" class="form-control">
                                        <option value="">All Students</option>
                                        @foreach ($assignTask->unique('student_username') as $task)
                                            <option value="{{ $task->student_username }}">{{ $task->student_username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table header-border table-hover verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Task</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Course Name</th>
                                            {{-- <th scope="col">show Task</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody id="taskTable">
                                        @foreach ($assignTask as $index => $task)
                                            <tr>
                                                <th>{{ $index + 1 }}</th>
                                                <td>{{ $task->task_title }}</td>
                                                <td class="student-name">{{ $task->student_username }}</td>
                                                <td>
                                                    @if ($task->submission_status)
                                                        <span class="badge badge-rounded badge-primary">DONE</span>
                                                    @else
                                                        <span class="badge badge-rounded badge-warning">PENDING</span>
                                                    @endif
                                                </td>
                                                <td class="course-name">{{ $task->course_title }}</td>
                                                <td class="course-name"><button
                                                        onclick="window.location.href='{{ route('courses.student.show', $task->course_id) }}'"
                                                        style="background:#5D6771; color:#fff" class="btn">
                                                        View Task
                                                    </button>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- JavaScript to filter table rows based on selected course and student -->
                    <script>
                        const courseFilter = document.getElementById('courseFilter');
                        const studentFilter = document.getElementById('studentFilter');

                        function filterTasks() {
                            const courseValue = courseFilter.value.toLowerCase();
                            const studentValue = studentFilter.value.toLowerCase();
                            const rows = document.querySelectorAll('#taskTable tr');

                            rows.forEach(row => {
                                const studentName = row.querySelector('.student-name').textContent.toLowerCase();
                                const courseName = row.querySelector('.course-name').textContent.toLowerCase();

                                const matchesCourse = courseValue === "" || courseName === courseValue;
                                const matchesStudent = studentValue === "" || studentName === studentValue;

                                if (matchesCourse && matchesStudent) {
                                    row.style.display = ''; // Show the row
                                } else {
                                    row.style.display = 'none'; // Hide the row
                                }
                            });
                        }

                        courseFilter.addEventListener('change', filterTasks);
                        studentFilter.addEventListener('change', filterTasks);
                    </script>
                </div>



            </div>
        </div>
    </div>
    <!--**********************************
                                                                                                                                                                                                                                                                                                                                                                                            Content body end
                                                                                                                                                                                                                                                                                                                                                                                        ***********************************-->
@endsection
