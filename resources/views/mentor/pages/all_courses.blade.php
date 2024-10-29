@extends('mentor.master_page')
@section('content')
    <style>
        /* CSS Styling */
        .img-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .img-container img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 100%;
            min-height: 100%;
        }

        .filter-container {
            display: flex;
            align-items: center;
        }

        .filter-container .input-group {
            margin-right: 10px;
        }

        .page-titles {
            padding: 1rem 0;
            /* Adjusts padding for the title area */
        }

        .input-group input {
            min-width: 200px;
            /* Ensures input field has a minimum width */
        }
    </style>

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0 mb-3">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 mr-3">All Courses :</h4>
                        <h4 class="mb-0 mr-3" style="text-transform: uppercase;">
                            <span id="selectedUsername">{{ request('username') ?? 'All' }}</span>
                        </h4>

                    </div>

                    <div class="d-flex align-items-center">
                        <div class="form-group mr-3 mb-0">
                            <label for="usernameSelect" class="sr-only">Filter by Student Name:</label>
                            <select class="form-control" id="usernameSelect" name="username"
                                onchange="location = this.value;">
                                <option value="">Filter by Student Name:</option>
                                <option value="{{ route('courses.index', ['username' => 'all']) }}">All Courses</option>
                                @foreach ($usernames as $username)
                                    <option value="{{ route('courses.index', ['username' => $username]) }}">
                                        {{ $username }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group mr-3">
                            <input type="text" id="titleSearch" class="form-control" placeholder="Search by Title"
                                aria-label="Search by Title">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button" id="searchButton">Search</button>
                            </div>
                        </div>

                        <button class="btn btn-danger" type="button" id="clearFilterButton" disabled>Reset</button>
                    </div>
                </div>
            </div>


        </div>


        <!-- Courses Content Section -->
        <div class="row">
            <div class="col-xl-12">
                @if ($courses->isEmpty())
                    <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
                        <div class="text-center">
                            <h4 class="font-weight-bold">No Courses Available</h4>
                            <p class="text-muted">No courses have been downloaded by the mentor yet.</p>
                        </div>
                    </div>
                @else
                    <div class="row">
                        @foreach ($courses as $course)
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4 course-item" data-title="{{ $course->title }}">
                                <div class="card shadow-sm">
                                    <div class="img-container">
                                        <img class="card-img-top img-fluid"
                                            src="{{ $course->photo ? asset('storage/' . $course->photo) : url('mentors_css/images/courses/pic1.jpg') }}"
                                            alt="{{ $course->title }}">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $course->title }}</h4>
                                        <p class="card-text">{{ $course->description }}</p>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('courses.student.show1', $course->id) }}"
                                                class="btn btn-primary">View Course</a>

                                            <a href="{{ route('courses.student.edit', $course->id) }}"
                                                class="btn btn-primary m-3">Edit Course</a>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination Section -->
                    <nav>
                        <ul class="pagination pagination-gutter justify-content-center">
                            <li class="page-item page-indicator {{ $courses->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $courses->previousPageUrl() }}" tabindex="-1"
                                    aria-disabled="{{ $courses->onFirstPage() ? 'true' : 'false' }}">
                                    <i class="icon-arrow-left"></i>
                                </a>
                            </li>
                            @foreach (range(1, $courses->lastPage()) as $page)
                                <li class="page-item {{ $page == $courses->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $courses->url($page) }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item page-indicator {{ !$courses->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $courses->nextPageUrl() }}">
                                    <i class="icon-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function toggleResetButton() {
                const isFiltered = $('#titleSearch').val().trim() !== '' || $('#usernameSelect').val() !==
                    "{{ route('courses.index', ['username' => 'all']) }}";
                $('#clearFilterButton').prop('disabled', !isFiltered);
            }

            $('#searchButton').on('click', function() {
                const searchValue = $('#titleSearch').val().toLowerCase();
                $('.course-item').each(function() {
                    const title = $(this).data('title').toLowerCase();
                    $(this).toggle(title.includes(searchValue));
                });
                toggleResetButton();
            });

            $('#clearFilterButton').on('click', function() {
                $('#titleSearch').val('');
                $('#usernameSelect').val(
                    "{{ route('courses.index', ['username' => 'all']) }}"); // Reset to 'All'
                $('.course-item').show();
                toggleResetButton();
            });

            $('#titleSearch').on('input', function() {
                toggleResetButton();
            });
        });
    </script>
@endsection
