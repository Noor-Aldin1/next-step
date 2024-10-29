@extends('user.index')

@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg10">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Profile</h2>
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>Profile</li>
                </ul>
            </div>
        </div>
        <div class="lines">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </section>
    <!-- Page Title End -->

    <!-- Account Area Start -->
    <section class="account-section ptb-100 bg-light">
        <div class="container">
            <div class="row">
                {{-- Informational aspect --}}
                @include('user.pages.profile.side_info')

                <div class="col-md-8">
                    <div class="account-details bg-white border rounded shadow-sm p-4">
                        <header class="mb-4">
                            <h2 class="h4">Manage Your Video</h2>
                            <p class="text-muted">You can edit or delete your video here.</p>
                        </header>

                        @if (!$mentor->video)
                            <div class="alert alert-warning" role="alert">
                                No video found. Please Add video.
                            </div>
                        @else
                            <!-- Video Information -->
                            <div class="mb-3 text-center ">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body text-center p-4 bg-light border rounded">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <i class="bx bx-badge text-primary me-2" style="font-size: 24px;"></i>
                                                    <h6 class="mb-0 font-weight-bold">Status</h6>
                                                </div>
                                                <span
                                                    class="badge bg-{{ $mentor->status == 'active' ? 'success' : 'secondary' }} rounded-pill px-3 py-2 mt-2">
                                                    {{ ucfirst($mentor->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <h5>Current Video</h5>
                                <video width="100%" height="240" controls class="border rounded mb-3">
                                    <source src="{{ asset('storage/' . $mentor->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>


                            </div>

                            <div class="d-flex justify-content-between mb-3">



                                <button class="btn btn-warning mr-2" data-toggle="modal"
                                    data-target="#editVideoModal-{{ $mentor->id }}">Edit Video</button>

                            </div>

                            <!-- Edit Video Modal -->
                            <div class="modal fade" id="editVideoModal-{{ $mentor->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editVideoModalLabel-{{ $mentor->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <!-- Edit Video Modal -->
                                        <form action="{{ route('mentors.update', $mentor->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editVideoModalLabel-{{ $mentor->id }}">Edit
                                                    Video</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div style="display: none" class="form-group">
                                                    <label for="userId">User ID</label>
                                                    <input type="number" id="userId" name="user_id" class="form-control"
                                                        value="{{ $mentor->user_id }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="video">Upload New Video (optional)</label>
                                                    <input type="file" id="video" name="video" class="form-control"
                                                        accept="video/*">
                                                </div>

                                                <div style="display: none" class="form-group me-3">
                                                    <label for="availability">Availability</label>
                                                    <input type="text" id="availability" name="availability"
                                                        class="form-control" value="{{ $mentor->availability }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <br>
                                                    <select id="status" name="status" class="">
                                                        <option value="active"
                                                            {{ $mentor->status === 'active' ? 'selected' : '' }}>Active
                                                        </option>
                                                        <option value="inactive"
                                                            {{ $mentor->status === 'inactive' ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                </div>
                                                <br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Account Area End -->

    <!-- Subscribe Section Start -->
    <!-- Subscribe Section Start -->
    <section class="subscribe-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="section-title">
                        <h2>Get New Job Notifications</h2>
                        <p>Subscribe & get all related jobs notification</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <form class="newsletter-form" data-toggle="validator">
                        <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL"
                            required autocomplete="off">

                        <button class="default-btn sub-btn" type="submit">
                            Subscribe
                        </button>

                        <div id="validator-newsletter" class="form-result"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Subscribe Section End -->
    <!-- Subscribe Section End -->
@endsection
