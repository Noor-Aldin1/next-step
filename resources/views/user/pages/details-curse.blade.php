@extends('user.index')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Course Details</h4>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-xl-3 col-xxl-4 col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <img class="img-fluid"
                                    src="https://images.shiksha.com/mediadata/ugcDocuments/images/wordpressImages/2022_08_MicrosoftTeams-image-13-2-1.jpg"
                                    alt="Course Image">
                                <div class="card-body">
                                    <h4 class="mb-0">Why is Early Education Essential</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">About Course</h2>
                                </div>
                                <div class="card-body pb-0">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Duration</strong>
                                            <span class="mb-0">3 Years</span>
                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Professor</strong>
                                            <span class="mb-0">Jimmy Morris</span>
                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Price</strong>
                                            <span class="mb-0">$1500</span>
                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Date</strong>
                                            <span class="mb-0">07 August 2020</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer pt-0 pb-0 text-center">
                                    <div class="row">
                                        <div class="col-4 pt-3 pb-3 border-right">
                                            <h3 class="mb-1 text-primary">07</h3>
                                            <span>Years</span>
                                        </div>
                                        <div class="col-4 pt-3 pb-3 border-right">
                                            <h3 class="mb-1 text-primary">240</h3>
                                            <span>Students</span>
                                        </div>
                                        <div class="col-4 pt-3 pb-3">
                                            <h3 class="mb-1 text-primary">05</h3>
                                            <span>Batches</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-xxl-8 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It has been the
                                industry's standard dummy text ever since the 1500s. It survived not only five centuries but
                                also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                                passages and more recently with desktop publishing software like Aldus PageMaker including
                                versions of Lorem Ipsum.</p>
                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of
                                spring which I enjoy with my whole heart. I am alone and feel the charm of existence was
                                created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the
                                exquisite sense of mere tranquil existence, that I neglect my talents.</p>
                            <p class="mb-5">A collection of textile samples lay spread out on the table. Samsa was a
                                travelling salesman. Above it hung a picture that he had recently cut out of an illustrated
                                magazine and housed in a nice, gilded frame.</p>
                            <div class="card">
                                <div class="card-body">
                                    <!-- Upcoming Lecture Periods -->
                                    <h4 class="text-primary">Upcoming Lecture Periods</h4>
                                    <div class="list-group">
                                        <!-- Example Event -->
                                        <div class="list-group-item d-flex align-items-center justify-content-between rounded-pill border-0 mb-2"
                                            style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-primary me-3">09:00 AM</span>
                                                <span>Introduction to Early Education</span>
                                            </div>
                                            <button class="btn btn-link text-primary" data-bs-toggle="modal"
                                                data-bs-target="#lectureModal"
                                                data-details="Details about Introduction to Early Education"
                                                data-link="lecture-1-link.html">View Details</button>
                                        </div>
                                        <!-- Repeat for more events -->
                                        <div class="list-group-item d-flex align-items-center justify-content-between rounded-pill border-0 mb-2"
                                            style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-primary me-3">11:00 AM</span>
                                                <span>Child Development Theories</span>
                                            </div>
                                            <button class="btn btn-link text-primary" data-bs-toggle="modal"
                                                data-bs-target="#lectureModal"
                                                data-details="Details about Child Development Theories"
                                                data-link="lecture-2-link.html">View Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for displaying lecture details -->
                            <div class="modal fade" id="lectureModal" tabindex="-1" aria-labelledby="lectureModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="lectureModalLabel">Lecture Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p id="lectureDetails">Loading...</p>
                                            <a id="lectureLink" href="#" target="_blank">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- Modal for displaying lecture details -->
                            <div class="modal fade" id="lectureModal" tabindex="-1" aria-labelledby="lectureModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="lectureModalLabel">Lecture Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p id="lectureDetails">Loading...</p>
                                            <a id="lectureLink" href="#" target="_blank">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-lang pt-5 border-bottom-1 pb-5">
                                <h4 class="text-primary mb-4">Language</h4>
                                <a href="javascript:void(0);" class="text-muted pr-3 f-s-16"><i
                                        class="flag-icon flag-icon-us"></i> English</a>
                                <a href="javascript:void(0);" class="text-muted pr-3 f-s-16"><i
                                        class="flag-icon flag-icon-fr"></i> French</a>
                                <a href="javascript:void(0);" class="text-muted pr-3 f-s-16"><i
                                        class="flag-icon flag-icon-bd"></i> Bangla</a>
                            </div>
                            <h4 class="text-primary">Assignments</h4>
                            <ul class="list-group mb-3 list-group-flush">
                                <li class="list-group-item border-0 px-0">
                                    <a href="assignment-1-link.html" class="text-primary">Assignment 1: Introduction to
                                        Early Education</a>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <a href="assignment-2-link.html" class="text-primary">Assignment 2: Child Development
                                        Theories</a>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <a href="assignment-3-link.html" class="text-primary">Assignment 3: Designing Early
                                        Education Programs</a>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <a href="assignment-4-link.html" class="text-primary">Assignment 4: Educational
                                        Psychology for Young Children</a>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <a href="assignment-5-link.html" class="text-primary">Assignment 5: Practical
                                        Approaches to Early Education</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
