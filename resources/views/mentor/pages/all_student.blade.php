@extends('mentor.master_page')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>All Students</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active">
                            <a href="{{ route('mentor.students.index', ['order' => 'oldest']) }}"
                                class="btn btn-link {{ request('order') === 'oldest' ? 'active' : '' }}">
                                Oldest
                            </a> |
                            <a href="{{ route('mentor.students.index', ['order' => 'newest']) }}"
                                class="btn btn-link {{ request('order') === 'newest' ? 'active' : '' }}">
                                Newest
                            </a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="row">
                                @foreach ($studentAll as $student)
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-profile">
                                            <div class="card-body pt-2">
                                                <div class="text-center">
                                                    <div class="profile-photo">
                                                        <img id="profileImage"
                                                            src="{{ $student->photo ? asset('storage/' . $student->photo) : asset('images/profile/small/default.jpg') }}"
                                                            alt="{{ $student->pro_full_name ?? ($student->name ?? 'N/A') }}"
                                                            class="rounded-circle img-fluid"
                                                            style="width: 160px; height: 155px;">
                                                    </div>
                                                    <h3 class="mt-4 mb-1">{{ $student->name }}</h3>
                                                    <p class="text-muted">{{ $student->major ?? 'N/A' }}</p>
                                                    <ul class="list-group mb-3 list-group-flush">
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span>Date of Joining</span>
                                                            <strong>{{ \Carbon\Carbon::parse($student->created_at)->format('d M Y') }}</strong>
                                                        </li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Phone No.:</span>
                                                            <strong>{{ $student->phone ?? 'N/A' }}</strong>
                                                        </li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Email:</span>
                                                            <strong>{{ $student->pro_email ?? ($student->user_email ?? 'N/A') }}</strong>
                                                        </li>
                                                    </ul>
                                                    <a class="btn btn-outline-primary btn-rounded mt-3 px-4"
                                                        href="{{ route('mentor.students.show', $student->user_id) }}">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Custom Pagination Section -->
                            <nav>
                                <ul class="pagination pagination-gutter justify-content-center">
                                    <!-- Previous Button -->
                                    <li
                                        class="page-item page-indicator {{ $studentAll->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $studentAll->previousPageUrl() }}" tabindex="-1"
                                            aria-disabled="{{ $studentAll->onFirstPage() ? 'true' : 'false' }}">
                                            <i class="icon-arrow-left"></i>
                                        </a>
                                    </li>

                                    <!-- Dynamic Page Numbers -->
                                    @foreach (range(1, $studentAll->lastPage()) as $page)
                                        <li class="page-item {{ $page == $studentAll->currentPage() ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ $studentAll->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Next Button -->
                                    <li
                                        class="page-item page-indicator {{ !$studentAll->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $studentAll->nextPageUrl() }}">
                                            <i class="icon-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
