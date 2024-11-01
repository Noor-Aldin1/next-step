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
                <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12 col-sm-12">

                    @if ($courses->isEmpty())
                        <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
                            <div class="text-center">
                                <h4 class="font-weight-bold">No Courses Available</h4>
                                <p class="text-muted">No courses have been downloaded by the mentor yet.
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            @foreach ($courses as $course)
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <div class="card shadow-sm">
                                        <img class="card-img-top img-fluid"
                                            src="{{ $course->photo ? asset('storage/' . $course->photo) : url('mentors_css/images/courses/pic1.jpg') }}"
                                            alt="{{ $course->title }}">
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $course->title }}</h4>
                                            <p class="card-text">{{ $course->description }}</p>
                                            <a href="{{ route('Usercourses.show', ['mentorId' => $mentorId, 'id' => $course->id]) }}"
                                                class="btn btn-primary">View Course</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>


        </div>
    </div>
    <!--**********************************
                                                                    Content body end
                                                                ***********************************-->
@endsection
