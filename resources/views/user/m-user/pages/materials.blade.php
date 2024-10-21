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
                                    @forelse ($materials as $material)
                                        <div class="list-group-item border rounded mb-3 shadow-sm p-4">
                                            <!-- Material Title -->
                                            <h5 class="mb-2 font-weight-bold">{{ $material->title }}</h5>

                                            <!-- Material Description -->
                                            <p class="text-muted mb-3">{{ $material->description }}</p>

                                            <div class="d-flex justify-content-between align-items-center">

                                                <!-- Download Button -->
                                                <a href="{{ asset('storage/' . $material->file_path) }}"
                                                    class="btn btn-outline-primary btn-sm">
                                                    Download
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <!-- No Materials Found -->
                                        <p class="text-muted">No materials available for this course.</p>
                                    @endforelse
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
