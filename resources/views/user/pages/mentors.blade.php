@extends('user.index')
@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg7">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Mentors</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
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

    <!-- Candidate Section Start -->
    <section class="candidate-style-two pt-50 pb-70">
        <!-- Find Section Start -->
        <div class="find-section ptb-100">
            <div class="container">
                {{-- Filter Section Start --}}
                <form class="find-form mt-0" onsubmit="return false;">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <input type="text" class="form-control" id="searchInput" placeholder="Monitor Name "
                                    onkeyup="filterMentors()">
                                <i class="bx bx-search-alt"></i>
                            </div>
                        </div>

                        <!-- Dynamic Specialization Dropdown -->
                        <div class="col-lg-3">
                            <select class="category" id="specializationDropdown" onchange="filterMentors()">
                                <option value="">Choose Specialization</option>
                                @foreach ($results->unique('job_title') as $mentor)
                                    <option value="{{ $mentor->job_title }}">{{ $mentor->job_title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3">
                            <button type="button" class="find-btn" onclick="filterMentors()">Find Your Mentor <i
                                    class='bx bx-search'></i></button>
                        </div>
                        <div class="col-lg-3">
                            <button type="button" class="find-btn" onclick="clearFilter()">Clear Filter <i
                                    class='bx bx-refresh'></i></button>
                        </div>
                    </div>
                </form>
                {{-- Filter Section End --}}
            </div>
        </div>
        <!-- Find Section End -->

        <!-- Mentors Display Start -->
        <div class="container">
            <div class="row" id="mentorsContainer">
                @foreach ($results as $mentor)
                    <div class="col-lg-3 col-sm-6 mentor-item" data-name="{{ $mentor->username }}"
                        data-specialization="{{ $mentor->job_title }}">
                        <div class="card candidate-card">
                            <div class="candidate-img">
                                <div class="image-container" style="cursor: pointer;">
                                    <a href="{{ route('mentors.show', $mentor->id) }}">
                                        <img id="mentor-image" width="100%" height="200"
                                            src="{{ $mentor->photo ? asset('storage/' . $mentor->photo) : 'http://mydomain.com/default-image.png' }}"
                                            alt="Mentor Image" style="object-fit: cover;">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body candidate-text text-center">
                                <h3 class="card-title">
                                    <a href="{{ route('mentors.show', $mentor->id) }}" class="text-danger font-weight-bold"
                                        style="text-decoration: underline;">
                                        {{ $mentor->username }}
                                    </a>
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

            <!-- No Results Message -->
            <div id="noResultsMessage" class="text-center mt-4" style="display: none;">
                <p>No mentors found with the selected criteria. Please try a different filter.</p>
            </div>
        </div>
        <!-- Mentors Display End -->

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
    </section>
    <!-- Candidate Section End -->

    <script>
        function filterMentors() {
            let searchInput = document.getElementById("searchInput").value.toLowerCase();
            let specialization = document.getElementById("specializationDropdown").value;
            let mentors = document.querySelectorAll(".mentor-item");
            let visibleMentors = 0;

            mentors.forEach(mentor => {
                let name = mentor.getAttribute("data-name").toLowerCase();
                let jobTitle = mentor.getAttribute("data-specialization");

                if ((name.includes(searchInput) || searchInput === "") &&
                    (jobTitle === specialization || specialization === "")) {
                    mentor.style.display = "block";
                    visibleMentors++;
                } else {
                    mentor.style.display = "none";
                }
            });

            // Display or hide the "no results" message based on visibleMentors count
            document.getElementById("noResultsMessage").style.display = visibleMentors ? "none" : "block";
        }

        function clearFilter() {
            document.getElementById("searchInput").value = "";
            document.getElementById("specializationDropdown").value = "";
            filterMentors();
        }
    </script>
@endsection
