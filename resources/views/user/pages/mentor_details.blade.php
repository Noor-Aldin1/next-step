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
                        <video id="mentor-video" width="100%" height="200" controls>
                            <source src="{{ $mentor->video ? asset('storage/' . $mentor->video) : '' }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                        @if (!$mentor->video)
                            <p>No video available. Watch this <a href="https://www.youtube.com/embed/tgbNymZ7vqY"
                                    target="_blank">YouTube video</a> instead.</p>
                        @endif
                    </div>
                    <div class="candidate-profile">
                        @if ($user && $user->subscriptions()->where('end_date', '>', now())->exists())
                            <!-- Condition to check if the user has an active subscription -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Check if the user has already subscribed to this mentor -->
                            @if ($hasSubscribed)
                                <!-- If already subscribed, show a button to go to the mentor's content -->
                                <div class="theme-btn">
                                    {{-- {{ route('mentor.view', ['mentor_id' => $results->id]) }} --}}
                                    <a href="#" class="default-btn">Go and Watch</a>
                                </div>
                            @else
                                <!-- If not subscribed, show the form to book an intro lecture -->
                                <form method="post" action="{{ route('usermentor.store') }}">
                                    @csrf <!-- Include CSRF token for security -->

                                    <!-- Add hidden input for mentor_id -->
                                    <input type="hidden" name="mentor_id" value="{{ $results->id }}">

                                    <!-- Add hidden input for student_id -->
                                    <input type="hidden" name="student_id" value="{{ auth()->id() }}">

                                    <div class="theme-btn">
                                        <button type="submit" class="default-btn">Book Now</button>
                                    </div>
                                </form>
                            @endif
                        @else
                            <div class="theme-btn">
                                <a href="{{ route('packages.index') }}" class="default-btn">Join now</a>

                            </div>
                        @endif
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



                </div>
            </div>
        </div>
    </section>
    <!-- Candidate Details End -->


@endsection
