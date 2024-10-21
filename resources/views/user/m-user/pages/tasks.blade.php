@extends('user.m-user.main')

@section('content')
    <!--**********************************
                Content body start
        ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            @include('user.m-user.partials.nav-course')

            <div class="row">
                @include('user.m-user.partials.sideinfo')

                <div class="col-xl-9 col-xxl-8 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-primary mb-4">Assignments</h4>

                            <!-- Scrollable container for assignments -->
                            <div class="overflow-auto" style="max-height: 400px;">
                                <ul class="list-group mb-3 list-group-flush">
                                    <!-- Assignment 1 -->
                                    <li class="list-group-item border-0 px-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="assignment-1-download-link.html" class="text-primary">
                                                Assignment 1: Introduction to Early Education
                                            </a>
                                            <span class="badge badge-pill badge-primary">Due: 25th Oct 2024</span>
                                        </div>
                                        <small class="text-muted">Submit to: <a href="delivery-location-1.html">Online
                                                Submission</a></small>

                                        <!-- Upload file -->
                                        <form action="#" method="POST" enctype="multipart/form-data" class="mt-2">
                                            @csrf
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control-file" name="assignment_file">
                                                <button type="submit" class="btn btn-success btn-sm ml-2">Upload</button>
                                            </div>
                                        </form>
                                    </li>

                                    <!-- You can add more assignments here following the same structure -->
                                </ul>
                            </div>
                            <!-- End scrollable container -->

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
