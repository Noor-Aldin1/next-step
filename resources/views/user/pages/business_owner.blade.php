@extends('user.index')
@section('content')
    <!-- Page Title Start -->
    <section class="page-title"
        style="background-image: url({{ url('https://www.shutterstock.com/image-photo/happy-diverse-different-aged-business-600nw-2012728106.jpg') }});">

        <div class="d-table">
            <div class="d-table-cell">
                <h2>Business Owner</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Business Owner</li>
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

    <!-- About Section Start -->
    <section class="about-section ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            <h2>Who qualifies as a Business Owner?</h2>
                        </div>

                        <p>A business owner is someone who owns and runs a business, taking charge of hiring employees and
                            overseeing operations. Within our job search application, these individuals serve as employers
                            by posting job openings, assessing applications, and making hiring choices.</p>

                        <p>They are essential in shaping the workforce by creating job opportunities and leveraging various
                            tools to simplify the hiring process.</p>



                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-img">
                        <div class="d-flex justify-content-end align-items-center" style="height: 100%;">
                            <!-- Align items side by side -->

                            <div class=""> <!-- Spacing between the animation and button -->
                                <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                                <dotlottie-player
                                    src="https://lottie.host/41c2a889-5164-4eb4-97e2-4ddcaa727151/i9R6lKi4ei.json"
                                    background="transparent" speed="1" style="width: 100px; height: 80px"
                                    direction="1" playMode="normal" loop autoplay></dotlottie-player>
                            </div>

                            <a href="{{ route('employer.register') }}" class="btn btn-danger">
                                Join Now and Empower Your Workforce!
                            </a>
                        </div>

                        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

                        <dotlottie-player src="https://lottie.host/b34b79b1-e206-4d12-bf11-c1fd7eb9ce4d/eC5zTVhyL3.json"
                            background="transparent" speed="1" style="width: 600px; height: 600px;" loop
                            autoplay></dotlottie-player>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->


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
