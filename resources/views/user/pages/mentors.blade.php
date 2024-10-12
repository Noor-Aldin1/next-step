@extends('user.index')
@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg7">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Mentors</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Mentors</li>
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


    <!-- Candidates Section Start -->
    <section class="candidate-style-two pt-50 pb-70">
        <!-- Find Section Start -->
        <div class="find-section ptb-100">
            <div class="container">
                <form class="find-form mt-0">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder=" Monitor Name or Specialization">
                                <i class="bx bx-search-alt"></i>
                            </div>
                        </div>



                        <div class="col-lg-3">
                            <select class="category">
                                <option value="" disabled selected>Choose Specialization</option>
                                <option value="1">Web Development</option>
                                <option value="2">Graphics Design</option>
                                <option value="4">Data Entry</option>
                                <option value="5">Visual Editor</option>
                                <option value="6">Office Assistant</option>
                            </select>
                        </div>

                        <div class="col-lg-3">
                            <button type="submit" class="find-btn">
                                Find Your Monitor
                                <i class='bx bx-search'></i>
                            </button>
                        </div>
                        <div class="col-lg-3">
                            <button type="submit" class="find-btn">
                                clear filter
                                <i class='bx bx-refresh'></i>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- Find Section End -->
        <div class="container">
            <div class="row">
                @foreach ($results as $mentor)
                    <div class="col-lg-3 col-sm-6">
                        <div class="card candidate-card">
                            <div class="candidate-img">
                                <div class="video-container" style="cursor: pointer;">
                                    <iframe id="mentor-video" width="100%" height="200"
                                        src="{{ $mentor->video ? asset('storage/' . $mentor->video) : 'https://www.youtube.com/embed/tgbNymZ7vqY' }}"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>

                            <script>
                                document.querySelector('.video-container').addEventListener('click', function() {
                                    const videoSrc =
                                        "{{ $mentor->video ? asset('storage/' . $mentor->video) : 'https://www.youtube.com/embed/tgbNymZ7vqY' }}";
                                    document.getElementById('mentor-video').src = videoSrc;
                                });
                            </script>


                            <div class="card-body candidate-text text-center">
                                <h3 class="card-title">
                                    <a href="#" class="text-dark">{{ $mentor->username }}</a>
                                </h3>
                                <ul class="list-unstyled">
                                    <li>{{ $mentor->job_title }}</li>
                                </ul>
                            </div>

                            <div class="card-footer candidate-social text-center">
                                <a href="{{ $mentor->github }}" target="_blank" class="text-primary"><i
                                        class="bx bxl-github"></i></a>
                                <a href="{{ $mentor->linkedin }}" target="_blank" class="text-danger"><i
                                        class="bx bxl-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Custom Pagination Section -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <!-- Previous Button -->
                    <li class="page-item {{ $results->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $results->previousPageUrl() }}" tabindex="-1"
                            aria-disabled="{{ $results->onFirstPage() ? 'true' : 'false' }}">
                            <i class='bx bx-chevrons-left bx-fade-left'></i>
                        </a>
                    </li>

                    <!-- Dynamic Page Numbers -->
                    @foreach (range(1, $results->lastPage()) as $page)
                        <li class="page-item {{ $page == $results->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $results->url($page) }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    <!-- Next Button -->
                    <li class="page-item {{ !$results->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $results->nextPageUrl() }}">
                            <i class='bx bx-chevrons-right bx-fade-right'></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </section>
    <!-- Candidates Section End -->

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
                        <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL" required
                            autocomplete="off">

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
@endsection
