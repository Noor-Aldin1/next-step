<!--**********************************
        Sidebar start
***********************************-->
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a class="" href="{{ route('mentor.dashboard') }}" aria-expanded="false">
                    <i class="la la-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="ai-icon" href="{{ route('mentor.events.index') }}" aria-expanded="false">
                    <i class="la la-calendar"></i>
                    <span class="nav-text">Event Management</span>
                </a>
            </li>
            <li>
                <a class="ai-icon" href="{{ route('mentor.students.index') }}" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Students</span></a> <!-- Fixed missing closing tag -->
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-graduation-cap"></i>
                    <span class="nav-text">Courses</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('courses.index') }}">All Courses</a></li>
                    <li><a href="{{ route('courses.student.create') }}">Add Course</a></li>
                    <!-- Changed "Add Courses" to "Add Course" for consistency -->
                </ul>
            </li>
            <li>
                <a class="ai-icon" href="{{ route('meetings.index') }}" aria-expanded="false">
                    <i class="fa-solid fa-handshake"></i>
                    <span class="nav-text">Meetings</span></a> <!-- Fixed missing closing tag -->
            </li>
        </ul>
    </div>
</div>
<!--**********************************
        Sidebar end
***********************************-->
