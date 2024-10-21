@extends('user.m-user.main')

@section('content')
    <!--**********************************
                Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">

            @include('user.m-user.partials.nav-course')

            <div class="row">
                @include('user.m-user.partials.sideinfo')

                <div class="col-xl-9 col-xxl-8 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-primary mb-4">Materials</h4>

                            <!-- Scrollable container for materials -->
                            <div class="overflow-auto" style="max-height: 400px;">
                                <div class="list-group mb-4">
                                    <!-- Material 1 -->
                                    <div class="list-group-item border rounded mb-3 shadow-sm p-4">
                                        <h5 class="mb-2 font-weight-bold">Material 1: Early Education Overview</h5>
                                        <p class="text-muted mb-3">A comprehensive introduction to early education, focusing
                                            on foundational theories and practices that shape modern teaching strategies.
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted">File Size: 1.2MB</span>
                                            <a href="material-1-download-link.html"
                                                class="btn btn-outline-primary btn-sm">Download</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End of scrollable container -->

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
