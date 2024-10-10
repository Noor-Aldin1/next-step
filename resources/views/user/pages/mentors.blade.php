@extends('user.index')
@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg7">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Candidates</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Candidates</li>
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
                <div class="col-lg-3 col-sm-6">
                    <div class="card candidate-card">
                        <div class="candidate-img">
                            <iframe width="100%" height="200"
                                src="https://www.youtube.com/embed/Jb2cyr5qxrw?si=9OYRzeex88s-NHC0" frameborder="0"
                                allowfullscreen></iframe>
                        </div>
                        <div class="card-body candidate-text text-center">
                            <h3 class="card-title">
                                <a href="candidate-details.html" class="text-dark">Mibraj Alex</a>
                            </h3>
                            <ul class="list-unstyled">
                                <li>Web Developer</li>
                            </ul>
                        </div>

                        <div class="card-footer candidate-social text-center">
                            <a href="#" target="_blank" class="text-primary"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank" class="text-info"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank" class="text-danger"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/2.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Felica Kareon</a>
                            </h3>
                            <ul>
                                <li>
                                    PHP Developer
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/3.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Malisa Petel</a>
                            </h3>
                            <ul>
                                <li>
                                    Business Consultant
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/4.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Quence Joes</a>
                            </h3>
                            <ul>
                                <li>
                                    Graphics Designer
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/5.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Mary Mainor</a>
                            </h3>
                            <ul>
                                <li>
                                    Technical Writter
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/6.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Jack Hallock</a>
                            </h3>
                            <ul>
                                <li>
                                    Marketing Expert
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/7.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Lucas Mason</a>
                            </h3>
                            <ul>
                                <li>
                                    UX Designer
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/8.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Jerry Hudson</a>
                            </h3>
                            <ul>
                                <li>
                                    Video Editor
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
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
