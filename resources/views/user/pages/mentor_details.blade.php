@extends('user.index')
@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg8">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Mentor Details</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Mentor Details</li>
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

    <!-- Candidate Details Start -->
    <section class="candidate-details pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="candidate-profile">



                        <img id="profileImage" src="{{ asset('storage/' . $results->photo) }}" alt="Profile Image"
                            class="rounded-circle img-fluid" style="width: 160px; height: 155px;">
                        <h3>{{ $results->username }}</h3>
                        <p>Web Developer</p>

                        <ul>

                            <li>
                                <a href="mailto:{{ $results->email }} ">
                                    <i class='bx bxs-envelope'></i>{{ $results->email }} </a>
                            </li>
                        </ul>

                        <div class="candidate-social">

                            <a href="{{ $results->github }}" target="_blank"><i class="bx bxl-github"></i>
                            </a>
                            <a href="{{ $results->linkedin }}" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                    <br>
                    <div class="candidate-profile">
                        <iframe id="mentor-video" width="100%" height="200"
                            src="{{ $mentor->video ? asset('storage/' . $mentor->video) : 'https://www.youtube.com/embed/tgbNymZ7vqY' }}"
                            frameborder="0" allowfullscreen></iframe>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="candidate-info-text">
                        <h3>About Me</h3>
                        <p>{{ $results->about_me }}</p>
                    </div>

                    <div class="candidate-info-text candidate-education">
                        <h3>Education</h3>

                        <div class="education-info">
                            <h4>{{ $results->university }}</h4>
                            <p>{{ $results->major }}</p>
                            <span>{{ $results->city }}</span>
                        </div>


                    </div>
                    <div class="candidate-info-text candidate-experience">
                        <h3>Experience</h3>

                        @if ($experience->isNotEmpty())
                            <div class="experience-list">
                                @foreach ($experience as $exp)
                                    <div class="experience-card">
                                        <h4>{{ $exp->position }} at {{ $exp->company_name }}</h4>
                                        <p><strong>Duration:</strong>
                                            {{ \Carbon\Carbon::parse($exp->start_due)->format('F j, Y') }} -
                                            {{ \Carbon\Carbon::parse($exp->end_due)->format('F j, Y') }}
                                        </p>
                                        <p><strong>Description:</strong> {{ $exp->description }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>No experience available.</p>
                        @endif
                    </div>




                    <div class="candidate-info-text candidate-skill">
                        <h3>Skills</h3>

                        <ul>
                            @foreach ($skills as $mentor)
                                @php
                                    // Split the skills_list into an array
                                    $skillsArray = explode(',', $mentor->skills_list);
                                @endphp

                                @foreach ($skillsArray as $skill)
                                    <li>{{ trim($skill) }}</li> <!-- Trim to remove any leading/trailing whitespace -->
                                @endforeach
                            @endforeach
                        </ul>

                    </div>

                    <div class="candidate-info-text text-center">
                        @if ($user && $user->subscriptions()->where('end_date', '>', now())->exists())
                            <!-- Condition to check if the user has an active subscription -->
                            <div class="theme-btn">
                                <a href="#" class="default-btn">Book a Intro Lecture</a>
                            </div>
                        @else
                            <div class="theme-btn">
                                <a href="{{ route('packages.index') }}" class="default-btn">Join now</a>

                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Candidate Details End -->

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
