@extends('user.index')
@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg11">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Resume</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Resume</li>
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

    <!-- Resume Area Start -->
    <section class="resume-section ptb-100">
        <div class="container">
            <div class="resume-area">
                <div class="row">
                    <div class="col-md-12">
                        <div class="resume-thumb-area text-center">
                            <img id="profileImage" src="{{ asset('storage/' . $user->photo) }}" alt="Profile Image"
                                class="rounded-circle img-fluid" style="width: 160px; height: 155px;">
                            <h3>{{ $profiles->full_name }}</h3>
                            <p>{{ $profiles->job_title }}</p>
                            <p style="font-weight: bold;">{{ $profiles->email ?? 'N/A' }}/{{ $profiles->phone ?? 'N/A' }}
                            </p>

                            <div class="social-links">

                                <a href="{{ $profiles->github }}" target="-blank">
                                    <i class="bx bxl-github"></i>
                                </a>
                                <a href="{{ $profiles->linkedin }}" target="-blank">
                                    <i class="bx bxl-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="resume-content about-text">
                            <h3>
                                <i class='bx bx-user-circle'></i>
                                About Me
                            </h3>
                            <p>{{ $profiles->about_me ?? ' N/A' }}
                            </p>
                        </div>

                        <div class="resume-content basic-info-text">
                            <h3>
                                <i class='bx bx-book-alt'></i>
                                Basic Info
                            </h3>
                            <ul>
                                <li>
                                    <span>Age:</span>
                                    {{ $profiles->age ?? 'N/A' }}
                                </li>
                                <li>
                                    <span>Location:</span>
                                    {{ $profiles->country ?? 'N/A' }} ,{{ $profiles->city ?? 'N/A' }}
                                </li>

                                <li>
                                    <span>Gender:</span>
                                    {{ $profiles->gender ?? 'N/A' }}

                                </li>

                                <li>
                                    <span>languages:</span>
                                    {{ $profiles->language ?? 'N/A' }}
                                </li>
                            </ul>
                        </div>
                        {{-- Education Background --}}
                        <div class="resume-content education-text">
                            <h3>
                                <i class='bx bx-book-reader'></i>
                                Education Background
                            </h3>
                            <br>

                            <div class="education-info">
                                <h5>{{ $profiles->major ?? 'N/A' }}</h5>
                                <h4>{{ $profiles->university ?? 'N/A' }}</h4>
                                <span>GAP : {{ $profiles->gap ?? 'N/A' }}</span>

                            </div>

                        </div>
                        {{-- end  Education Background --}}
                        <br>
                        <hr>
                        <br>
                        {{-- Work Expericence --}}
                        <div class="resume-content  experience-text">
                            <h3>
                                <i class='bx bx-briefcase'></i>
                                Work Expericence
                            </h3>
                            <div class="experiences-section">
                                @if ($experiences->isEmpty())
                                    <p>No experiences found.</p> <!-- Show this message if no experiences are available -->
                                @else
                                    @foreach ($experiences as $experience)
                                        <div class="experience-info">
                                            <span>{{ \Carbon\Carbon::parse($experience->start_due)->format('F j, Y') }} -
                                                {{ \Carbon\Carbon::parse($experience->end_due)->format('F j, Y') }}</span>
                                            <h5>{{ $experience->position }}</h5>
                                            <h4>{{ $experience->company_name }}</h4>
                                            <p>{{ $experience->description }}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                        {{-- skills --}}
                        <div class="resume-content skill">
                            <h3>
                                <i class='bx bx-check-shield'></i>
                                Skills
                            </h3>
                            @if ($skill_name->isEmpty())
                                <p>No Skills Found</p>
                            @else
                                @foreach ($skill_name as $skill)
                                    <div class="skill-item">
                                        <span>{{ $skill->name }}</span>
                                        <div class="progress">
                                            @php
                                                // Determine the progress bar color based on the skill rate
                                                $barColor = 'bg-success'; // Default to green for max rating
                                                if ($skill->rate < 5) {
                                                    $barColor = 'bg-danger'; // Red for rates less than 5
                                                } elseif ($skill->rate >= 5 && $skill->rate < 7) {
                                                    $barColor = 'bg-warning'; // Yellow for rates between 5 and 6
                                                }
                                            @endphp
                                            <div class="progress-bar {{ $barColor }}" role="progressbar"
                                                style="width: {{ $skill->rate * 10 }}%; font-size:20px; color :black"
                                                aria-valuenow="{{ $skill->rate * 10 }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                {{ $skill->rate }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        {{-- End skills --}}

                        {{-- projects --}}
                        <div class="resume-content  experience-text">
                            <h3>
                                <i class='bx bx-grid-alt'></i>
                                Projects
                            </h3>
                            <div class="experiences-section">
                                @if ($projects->isEmpty())
                                    <p>No Projects found.</p> <!-- Show this message if no experiences are available -->
                                @else
                                    @foreach ($projects as $pro)
                                        <div class="experience-info">
                                            <span>{{ \Carbon\Carbon::parse($pro->start_due)->format('F j, Y') }} -
                                                {{ \Carbon\Carbon::parse($pro->end_due)->format('F j, Y') }}</span>
                                            <h5>{{ $pro->name }}</h5>

                                            <p>{{ $pro->description }}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                        {{-- end projects --}}

                        {{-- Certifications --}}

                        <div class="resume-content  experience-text">
                            <h3>
                                <i class='bx bxs-award'></i>


                                Certifications
                            </h3>
                            <div class="experiences-section">
                                @if ($Certification->isEmpty())
                                    <p>No Projects found.</p> <!-- Show this message if no experiences are available -->
                                @else
                                    @foreach ($Certification as $cer)
                                        <div class="experience-info">
                                            <h5> {{ $cer->name }}</h5>
                                            <span>{{ \Carbon\Carbon::parse($cer->start_due)->format('F j, Y') }} -
                                                {{ \Carbon\Carbon::parse($cer->end_due)->format('F j, Y') }}</span>


                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                        {{-- end certifications --}}
                        <div class="theme-btn">
                            <a href="{{ route('resumes.download', $user->id) }}" class="default-btn">
                                Download
                                <i class='bx bx-download bx-fade-down'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Resume Area End -->


@endsection
