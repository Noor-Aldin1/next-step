@extends('user.index')
@section('content')
    <!-- Banner Section Start -->
    <div class="banner-style-three">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="banner-text">
                        <span>Discover Career Opportunities and Job Openings</span>
                        <h1> welcome in NextStep </h1>

                        <p>Unlock your potential with personalized mentorship, skill development, and access to a wide range
                            of job opportunities designed to help you succeed.</p>

                        <div class="theme-btn">
                            <a href="{{ route('profile.edit') }} " class="default-btn active">Get Started with Us</a>
                            <a href="contact.html" class="default-btn">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Find Section Start -->
    <div class="find-section pb-100">
        <div class="container">
            @include('user.partials.form_filter')
        </div>
    </div>
    <!-- Find Section End -->

    <!-- Job Category Section Start -->
    <div class="category-style-two pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Popular Jobs Category</h2>

            </div>

            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <a href="job-list.html">
                        <div class="category-item">
                            <i class="flaticon-wrench-and-screwdriver-in-cross"></i>
                            <h3>Construction</h3>
                            <p>6 new Job</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <a href="job-list.html">
                        <div class="category-item">
                            <i class="flaticon-accounting"></i>
                            <h3>Finance</h3>
                            <p>8 new Job</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <a href="job-list.html">
                        <div class="category-item">
                            <i class="flaticon-heart"></i>
                            <h3>Healthcare</h3>
                            <p>9 new Job</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <a href="job-list.html">
                        <div class="category-item">
                            <i class="flaticon-computer-1"></i>
                            <h3>Graphic Design</h3>
                            <p>6 new Job</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <a href="job-list.html">
                        <div class="category-item">
                            <i class="flaticon-research"></i>
                            <h3>Banking Jobs</h3>
                            <p>5 new Job</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <a href="job-list.html">
                        <div class="category-item">
                            <i class="flaticon-worker"></i>
                            <h3>Automotive</h3>
                            <p>12 new Job</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <a href="job-list.html">
                        <div class="category-item">
                            <i class="flaticon-graduation-cap"></i>
                            <h3>Education</h3>
                            <p>15 new Job</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <a href="job-list.html">
                        <div class="category-item">
                            <i class="flaticon-computer"></i>
                            <h3>Data Analysis</h3>
                            <p>5 new Job</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Job Category Section End -->


    <!-- Process Video Start -->
    <div class="video-section ptb-100">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="video-text text-center">
                        <h2>How to use NextStep</h2>
                        <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="popup-youtube">
                            <i class='bx bx-play'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Process Video End -->


    @include('user.partials.job_list_10')
    <!-- Counter Section Start -->
    <div class="counter-section pt-100 pb-70">
        <div class="container">
            <div class="row counter-area">
                <div class="col-lg-3 col-6">
                    <div class="counter-text">
                        <i class="flaticon-resume"></i>
                        <h2><span>1225</span></h2>
                        <p>Job Posted</p>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="counter-text">
                        <i class="flaticon-recruitment"></i>
                        <h2><span>145</span></h2>
                        <p>Job Filed</p>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="counter-text">
                        <i class="flaticon-portfolio"></i>
                        <h2><span>170</span></h2>
                        <p>Company</p>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="counter-text">
                        <i class="flaticon-employee"></i>
                        <h2><span>125</span></h2>
                        <p>Members</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Counter Section End -->

    <!-- Testimonial Section Start -->
    <div class="testimonial-style-two ptb-100">
        <div class="container">
            <div class="section-title text-center">
                <h2>What Client’s Say About Us</h2>

            </div>

            <div class="row">
                <div class="testimonial-slider-two owl-carousel owl-theme">
                    <div class="testimonial-items">
                        <div class="testimonial-text">
                            <i class='flaticon-left-quotes-sign'></i>
                            <p>Working with this team has been a fantastic experience! They provided continuous support and
                                helped me achieve my career goals. I highly recommend their services.</p>
                        </div>
                        <div class="testimonial-info-text">
                            <h3>Sarah Johnson</h3>
                            <p>Marketing Manager</p>
                        </div>
                    </div>

                    <div class="testimonial-items">
                        <div class="testimonial-text">
                            <i class='flaticon-left-quotes-sign'></i>
                            <p>The platform is intuitive and the features have made my job search much easier. The
                                mentorship opportunities are invaluable. Thank you for an amazing experience!</p>
                        </div>
                        <div class="testimonial-info-text">
                            <h3>James Miller</h3>
                            <p>Software Engineer</p>
                        </div>
                    </div>

                    <div class="testimonial-items">
                        <div class="testimonial-text">
                            <i class='flaticon-left-quotes-sign'></i>
                            <p>This service exceeded my expectations! I found the guidance I needed to transition into a new
                                career. The team is professional and responsive. Highly recommended.</p>
                        </div>
                        <div class="testimonial-info-text">
                            <h3>Emily Davis</h3>
                            <p>Product Designer</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Testimonial Section End -->

    <!-- Why Choose Section Start -->
    <section class="why-choose">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 p-0">
                    <div class="why-choose-text pt-100 pb-70">
                        <div class="section-title text-center">
                            <h2>Why You Choose NextStep?</h2>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="media">
                                    <i class="flaticon-group align-self-center mr-3"></i>
                                    <div class="media-body">
                                        <h5 class="mt-0">Best Talented People</h5>
                                        <p>Connect with a community of skilled professionals, mentors, and candidates,
                                            ensuring you find the right fit for your career or organization.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="media">
                                    <i class="flaticon-research align-self-center mr-3"></i>
                                    <div class="media-body">
                                        <h5 class="mt-0">Easy to Find Candidates</h5>
                                        <p>Effortlessly search for and connect with qualified candidates who match your job
                                            requirements, simplifying the hiring process.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="media">
                                    <i class="flaticon-discussion align-self-center mr-3"></i>
                                    <div class="media-body">
                                        <h5 class="mt-0">Easy to Communicate</h5>
                                        <p>Seamlessly connect and communicate with mentors, candidates, and employers using
                                            integrated tools that make staying in touch simple and efficient.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="media">
                                    <i class="flaticon-recruitment align-self-center mr-3"></i>
                                    <div class="media-body">
                                        <h5 class="mt-0">Global Recruitment Options</h5>
                                        <p>Access a diverse talent pool from around the world, opening doors to global job
                                            opportunities and expanding your career or company’s reach.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row counter-area">
                            <div class="col-md-3 col-6">
                                <div class="counter-text">
                                    <h2><span>127</span></h2>
                                    <p>Job Posted</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <div class="counter-text">
                                    <h2><span>137</span></h2>
                                    <p>Job Filed</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <div class="counter-text">
                                    <h2><span>180</span></h2>
                                    <p>Company</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <div class="counter-text">
                                    <h2><span>144</span></h2>
                                    <p>Members</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 p-0">
                    <div class="why-choose-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Choose Section End -->


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
@endsection
