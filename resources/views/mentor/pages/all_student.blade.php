@extends('mentor.master_page')
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
                        <h4>All Student</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Students</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">All Student</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12">
                    <div class="row tab-content">

                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="card card-profile">

                                        <div class="card-body pt-2">
                                            @foreach ($studentAll as $student)
                                                <div class="text-center">
                                                    <div class="profile-photo">
                                                        <img id="profileImage"
                                                            src="{{ $student->photo ? asset('storage/' . $student->photo) : asset('images/profile/small/default.jpg') }}"
                                                            alt="{{ $student->pro_full_name ? $student->pro_full_name : $student->name ?? 'N/A' }}"
                                                            class="rounded-circle img-fluid"
                                                            style="width: 160px; height: 155px;">
                                                        </img>
                                                    </div>

                                                    <h3 class="mt-4 mb-1">{{ $student->name }}</h3>
                                                    <!-- Use the aliased name -->
                                                    <p class="text-muted">{{ $student->major ?? 'N/A' }}</p>
                                                    <!-- Use major from profiles -->

                                                    <ul class="list-group mb-3 list-group-flush">
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span>Date of Joining</span>
                                                            <strong>{{ \Carbon\Carbon::parse($student->created_at)->format('d M Y') }}</strong>
                                                            <!-- Format the joining date -->
                                                        </li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Phone No.:</span>
                                                            <strong>{{ $student->phone ?? 'N/A' }}</strong>
                                                        </li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Email:</span>
                                                            <strong>{{ $student->pro_email ? $student->pro_email : $student->user_email ?? 'N/A' }}</strong>
                                                            <!-- Access the aliased user_email -->
                                                        </li>

                                                    </ul>
                                                    <a class="btn btn-outline-primary btn-rounded mt-3 px-4"
                                                        href="#">Read More</a>
                                                </div>
                                            @endforeach
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
                                                                                                                                                                                Content body end
                                                                                                                                                                            ***********************************-->
@endsection
