@extends('user.m-user.main')
@section('content')
    <!--**********************************
                                Content body start
                            ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>All Courses</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Courses</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">All Courses</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-xxl-4 col-lg-4 col-md-6 col-sm-6">
                    @foreach ($courses as $course)
                        <div class="card">
                            <img class="img-fluid" src="{{ url('mentors_css/images/courses/pic1.jpg') }}" alt="">
                            <div class="card-body">
                                <h4>{{ $course->title }}</h4>
                                <ul class="list-group mb-3 list-group-flush">
                                    <li class="list-group-item px-0 border-top-0 d-flex justify-content-between"><span
                                            class="mb-0 text-muted">April 23</span>
                                        <a href="javascript:void(0);"><i
                                                class="la la-heart-o mr-1"></i><strong>230</strong></a>
                                    </li>
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span class="mb-0">Duration :</span><strong>12 Months</strong>
                                    </li>
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span class="mb-0">Professor :</span><strong>Jack Ronan</strong>
                                    </li>
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span><i
                                                class="fa fa-graduation-cap text-primary mr-2"></i>Student</span><strong>+120</strong>
                                    </li>
                                </ul>
                                <a href="about-courses.html" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>
    <!--**********************************
                                Content body end
                            ***********************************-->
@endsection
