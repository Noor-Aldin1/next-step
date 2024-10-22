@extends('user.index')

@section('content')
    <!-- Custom Section Start -->
    <section class="custom-section pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Why is Early Education Essential?</h2>
                <p>Early education provides a strong foundation for lifelong learning, critical thinking, and social
                    development.</p>
            </div>
            <style>
                .custom-card {
                    border-radius: 10px;
                    /* Rounded corners for the card */
                    overflow: hidden;
                    /* Ensures content doesn’t overflow */
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                    transition: transform 0.3s ease;
                    /* Add a slight shadow for depth */
                }

                .custom-card:hover {
                    transform: translateY(-5px);
                    /* Raise the card on hover */
                }

                .custom-img {
                    position: relative;
                    overflow: hidden;
                    /* Hide any overflow */
                }

                .custom-text {
                    background-color: #fff;
                    /* White background for text */
                    border-top: 1px solid #e0e0e0;
                    /* Top border to separate image from text */
                    padding: 20px;
                    /* Padding for better spacing */
                    text-align: left;
                    /* Align text to the left */
                }

                .custom-btn {
                    transition: background-color 0.3s ease, transform 0.2s ease;
                    /* Smooth transition for button */
                }

                .custom-btn:hover {
                    background-color: #0056b3;
                    /* Darker shade on hover */
                    transform: scale(1.05);
                    /* Slightly enlarge button on hover */
                }

                .custom-text ul {
                    margin: 0;
                    /* Remove default margin */
                    padding: 0;
                    /* Remove default padding */
                    list-style: none;
                    /* Remove bullet points */
                }

                .custom-text ul li {
                    margin-bottom: 10px;
                    /* Space out list items */
                }

                /* Responsive adjustments */
                @media (max-width: 768px) {
                    .custom-text {
                        text-align: center;
                    }
                }
            </style>
            <div class="row justify-content-center">
                <!-- Loop through each mentor -->
                @foreach ($mentors as $index => $mntor)
                    <div class="col-lg-4 col-sm-6 mb-4 d-flex justify-content-center">
                        <div class="custom-card h-100 shadow-sm d-flex flex-column">
                            <div class="custom-img position-relative">
                                <a href="{{ route('courses.index', ['mentorId' => $mntor->id]) }}" class="d-block">
                                    <img src="{{ isset($users[$index]) && $users[$index]->photo ? asset('storage/' . $users[$index]->photo) : 'http://mydomain.com/default-image.png' }}"
                                        alt="Image description" class="img-fluid rounded-top"
                                        style="object-fit: cover; height: 200px; width: 100%;">
                                </a>
                            </div>
                            <div class="custom-text p-4 d-flex flex-column flex-grow-1">
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-2">
                                        <i class="bx bx-calendar"></i>
                                        <strong>Booking Date: </strong>
                                        @foreach ($relationships as $rr)
                                            @if ($rr->mentor_id == $mntor->id)
                                                {{ $rr->created_at->format('F j, Y') }} <!-- Formats the date -->
                                            @endif
                                        @endforeach
                                    </li>
                                    <li>
                                        <i class='bx bxs-user'></i>
                                        <strong>Mentor:</strong> {{ $users[$index]->username ?? 'Unknown' }}
                                    </li>
                                </ul>
                                <div class="text-center mt-auto">
                                    <a href="details-page.html"
                                        class="custom-btn btn btn-primary d-inline-flex align-items-center">
                                        Let's get started
                                        <i style="padding-left: 10px;" class='bx bx-book-open'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Custom Section End -->
@endsection
