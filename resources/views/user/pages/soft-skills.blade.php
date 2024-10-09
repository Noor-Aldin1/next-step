@extends('user.index')
@section('content')
    <!-- Blog Section Start -->
    <section class="blog-section blog-style-two pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Key Considerations for Success
                </h2>
                <p>Soft skills are interpersonal attributes that improve communication, collaboration, problem-solving, and
                    adaptability, complementing technical skills and essential for effective teamwork and leadership.</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <iframe width="420" height="345" src="https://www.youtube.com/embed/wexzvClUcUk?start=58"
                                    frameborder="0" allowfullscreen>
                                </iframe>

                            </a>
                        </div>
                        <div class="blog-text">

                            <h3>
                                <a href="blog-details.html">
                                    How to Indroduce in Yourself in Job Interview?
                                </a>
                            </h3>
                            <p>Learn how to introduce yourself in a job interview with tips on making a great first
                                impression and highlighting your key skills!.
                            </p>


                        </div>
                    </div>
                </div>
                {{-- end 1  --}}
                <div class="col-lg-4 col-sm-6">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <iframe width="420" height="345" src="https://www.youtube.com/embed/5v-wyR5emRw"
                                    frameborder="0" allowfullscreen></iframe>


                            </a>
                        </div>
                        <div class="blog-text">

                            <h3>
                                <a href="blog-details.html">
                                    How to prepare yourself for an interview ?
                                </a>
                            </h3>
                            <p>Master your interview preparation with tips on company research, practicing questions,
                                dressing well.
                            </p>


                        </div>
                    </div>
                </div>
                {{-- end 2 --}}
                <div class="col-lg-4 col-sm-6">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <iframe width="420" height="345" src="https://www.youtube.com/embed/Tiy2LONr050"
                                    frameborder="0" allowfullscreen></iframe>


                            </a>
                        </div>
                        <div class="blog-text">

                            <h3>
                                <a href="blog-details.html">
                                    What Are Soft Skills?
                                </a>
                            </h3>
                            <p>Explore the importance of soft skills in your career development. Understand how they
                                contribute to your professional success and facilitate effective workplace interactions.
                            </p>


                        </div>
                    </div>
                </div>
                {{-- end 3 --}}
                <div class="col-lg-4 col-sm-6">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <iframe width="420" height="345" src="https://www.youtube.com/embed/M2NFhwHyNhc"
                                    frameborder="0" allowfullscreen></iframe>

                            </a>
                        </div>
                        <div class="blog-text">

                            <h3>
                                <a href="blog-details.html">
                                    What are nonverbal communication specialists?
                                </a>
                            </h3>
                            <p>Explore the insights of nonverbal communication specialists and learn how body language can
                                impact interactions and convey messages effectively!.
                            </p>


                        </div>
                    </div>
                </div>
                {{-- end 4  --}}
                <div class="col-lg-4 col-sm-6">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <iframe width="420" height="345" src="https://www.youtube.com/embed/wIjK-6Do6lg"
                                    frameborder="0" allowfullscreen></iframe>

                            </a>
                        </div>
                        <div class="blog-text">

                            <h3>
                                <a href="blog-details.html">
                                    Interview Guidelines: What to Do and What to Avoid
                                </a>
                            </h3>
                            <p>Learn the essential dos and don'ts of interviewing to ensure you make a great impression and
                                maximize your chances of success!
                            </p>


                        </div>
                    </div>
                </div>
                {{-- end 5  --}}
                <div class="col-lg-4 col-sm-6">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <iframe width="420" height="345" src="https://www.youtube.com/embed/FIzqhQsTos4"
                                    frameborder="0" allowfullscreen></iframe>






                            </a>
                        </div>
                        <div class="blog-text">

                            <h3>
                                <a href="blog-details.html">
                                    Tips for Creating a Positive First Impression in an Interview
                                </a>
                            </h3>
                            <p>Discover effective strategies for making a great first impression in interviews and setting
                                yourself up for success!
                            </p>


                        </div>
                    </div>
                </div>
            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <i class='bx bx-chevrons-left bx-fade-left'></i>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link active" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class='bx bx-chevrons-right bx-fade-right'></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
    <!-- Blog Section End -->

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
