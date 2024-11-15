@extends('user.index')
@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>About Us</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>About Us</li>
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
                            <h2>How We Started</h2>
                        </div>

                        <p>It is a long established fact that a reader will be distracted by the readable content of a page
                            when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                            distribution of letters, as opposed to using 'Content here, content here', making it look like
                            readable English.</p>

                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="https://inspireacademy.com.np/wp-content/uploads/2020/08/managers-management.jpg"
                            alt="about image">
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Way To Use Section Start -->
    <section class="use-section pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Easiest Way To Use</h2>
            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="use-text">
                        <span>1</span>
                        <i class='flaticon-website'></i>
                        <h3>Browse Job</h3>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="use-text">
                        <span>2</span>
                        <i class='flaticon-recruitment'></i>
                        <h3>Find Your Vaccancy</h3>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6 offset-sm-3 offset-lg-0">
                    <div class="use-text">
                        <span>3</span>
                        <i class='flaticon-login'></i>
                        <h3>Submit Resume</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Way To Use Section End -->

    <!-- Why Choose Section Start -->
    <section class="why-choose-two pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Why You Choose Us Among Other Job Site?</h2>
                <p>We ignite career potential by connecting inexperienced individuals with seasoned mentors, delivering
                    tailored guidance and skills development to unlock exciting job opportunities.</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="choose-card">
                        <i class="flaticon-resume"></i>
                        <h3>Advertise Job</h3>
                        <p>Unlock your company's potential by advertising your job openings with us, where you can connect
                            with eager talent and help shape the careers of the next generation! </p>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="choose-card">
                        <i class="flaticon-recruitment"></i>
                        <h3>Recruiter Profiles</h3>
                        <p>Create a standout recruiter profile that highlights your strengths and connects you with top
                            talent to attract the ideal candidates for your organization!</p>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6 offset-sm-3 offset-lg-0">
                    <div class="choose-card">
                        <i class="flaticon-employee"></i>
                        <h3>Find Your Dream Job</h3>
                        <p>Embark on your journey to success and discover your dream job with us, where opportunities await
                            to match your skills and passions with the perfect career path!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Choose Section End -->




    <!-- Testimonial Section Start -->
    <div class="testimonial-style-two ptb-100">
        <div class="container">
            <div class="section-title text-center">
                <h2>What Our Clients Say</h2>
                <p>Discover how our services have made a difference for our clients. Here’s what they have to say!</p>
            </div>

            <div class="row">
                <div class="testimonial-slider-two owl-carousel owl-theme">
                    <div class="testimonial-items">
                        <div class="testimonial-text">
                            <i class='flaticon-left-quotes-sign'></i>
                            <p>Working with this team transformed our approach to recruitment. Their insights and support
                                were invaluable!</p>
                        </div>

                        <div class="testimonial-info-text">
                            <h3>Alisa Meair</h3>
                            <p>CEO of Company</p>
                        </div>
                    </div>

                    <div class="testimonial-items">
                        <div class="testimonial-text">
                            <i class='flaticon-left-quotes-sign'></i>
                            <p>Their platform helped us find the perfect candidates efficiently. Highly recommended for any
                                business!</p>
                        </div>

                        <div class="testimonial-info-text">
                            <h3>Adam Smith</h3>
                            <p>Web Developer</p>
                        </div>
                    </div>

                    <div class="testimonial-items">
                        <div class="testimonial-text">
                            <i class='flaticon-left-quotes-sign'></i>
                            <p>Amazing experience! They provided great support and the results were fantastic.</p>
                        </div>

                        <div class="testimonial-info-text">
                            <h3>John Doe</h3>
                            <p>Graphics Designer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial Section End -->
@endsection
