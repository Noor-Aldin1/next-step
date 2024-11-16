@extends('user.index')
@section('content')
    <style>
        /* Base styles for the clear button */
        .clear-btn {
            background-color: #fd1616;
            /* Button background color */
            color: white;
            /* Button text color */
            border: none;
            /* Remove default border */
            border-radius: 5px;
            /* Rounded corners */
            padding: 10px 15px;
            /* Padding around the text */
            font-size: 16px;
            /* Font size */
            cursor: pointer;
            /* Pointer cursor on hover */
            transition: background-color 0.3s, transform 0.3s;
            /* Smooth transition */
        }

        /* Hover effect */
        .clear-btn:hover {
            background-color: #c11212;
            /* Darker shade of red on hover */
            transform: scale(1.05);
            /* Slightly enlarge the button on hover */
        }

        /* Disabled button styles */
        .clear-btn:disabled {
            background-color: #c0c0c0;
            /* Gray background for disabled */
            color: #7d7d7d;
            /* Gray text for disabled */
            cursor: not-allowed;
            /* Not allowed cursor for disabled */
        }

        /* Optional: Focus styles */
        .clear-btn:focus {
            outline: none;
            /* Remove outline on focus */
            box-shadow: 0 0 5px rgba(253, 22, 22, 0.5);
            /* Add shadow for accessibility */
        }
    </style>
    <!-- Page Title Start -->
    <section class="page-title title-bg5">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Job Board</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Job Board</li>
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

    <!-- Jobs Section Start -->
    <section class="job-section jobs-grid-section pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Jobs You May Be Interested In</h2>
                <!-- Find Section Start -->
                <div class="find-section ptb-100">
                    <div class="container">
                        @include('user.partials.form_filter')



                        <script>
                            function toggleClearButton() {
                                const searchInput = document.querySelector('input[name="search"]').value.trim();
                                const citySelect = document.querySelector('select[name="city"]').value;
                                const categorySelect = document.querySelector('select[name="category"]').value;

                                // Enable or disable the Clear Filter button based on the input values
                                const clearFilterButton = document.getElementById('clear-filter');
                                clearFilterButton.disabled = !(searchInput || citySelect || categorySelect);
                            }

                            function clearFilters() {
                                // Clear the inputs
                                document.querySelector('input[name="search"]').value = '';
                                document.querySelector('select[name="city"]').selectedIndex = 0;
                                document.querySelector('select[name="category"]').selectedIndex = 0;

                                // Disable the Clear Filter button
                                document.getElementById('clear-filter').disabled = true;

                                // Optionally submit the form to refresh the page with cleared filters
                                document.getElementById('filter-form').submit();
                            }

                            // Optional: Call toggleClearButton on page load to set initial state
                            window.onload = toggleClearButton;
                        </script>


                    </div>


                </div>
                <!-- Find Section End -->

            </div>

            @if ($noJobsFound)
                <div class="alert alert-warning mt-3">
                    Based on the selected filters, there are currently no job openings available.
                </div>
            @else
                <!-- Jobs List -->
                <div class="row">
                    @foreach ($jobs as $job)
                        <div class="col-md-6">
                            <div class="job-card">
                                <div class="row align-items-center">
                                    <!-- Job Information Section -->
                                    <div class="col-lg-7">
                                        <div class="job-info">
                                            <h3>
                                                <a href="{{ route('job_postings.show', $job->id) }}">{{ $job->title }}</a>
                                            </h3>
                                            <ul>
                                                <li>Via <a href="#">{{ $job->company_name }}</a></li>
                                                <li>
                                                    <i class='bx bx-location-plus'></i>
                                                    {{ $job->city }}
                                                </li>
                                                <li>
                                                    <i class='bx bx-filter-alt'></i>
                                                    @foreach ($job->categories as $category)
                                                        {{ $category->name }}
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Job Save and Time Section -->
                                    <div class="col-lg-3">
                                        <div class="job-save">
                                            <span>{{ $job->job_type }}</span>
                                            <p>
                                                <i class='bx bx-stopwatch'></i>
                                                Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
            @endif
        </div>

        <!-- Custom Pagination Section -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <!-- Previous Button -->
                <li class="page-item {{ $jobs->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $jobs->previousPageUrl() }}" tabindex="-1"
                        aria-disabled="{{ $jobs->onFirstPage() ? 'true' : 'false' }}">
                        <i class='bx bx-chevrons-left bx-fade-left'></i>
                    </a>
                </li>

                <!-- Dynamic Page Numbers -->
                @foreach (range(1, $jobs->lastPage()) as $page)
                    <li class="page-item {{ $page == $jobs->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $jobs->url($page) }}">{{ $page }}</a>
                    </li>
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$jobs->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $jobs->nextPageUrl() }}">
                        <i class='bx bx-chevrons-right bx-fade-right'></i>
                    </a>
                </li>
            </ul>
        </nav>
        </div>
    </section>
    <!-- Jobs Section End -->


    <script>
        function myFunction() {
            document.getElementById("myForm").submit();
        }
    </script>


    <script>
        // Function to enable the Clear Filter button
        function enableClearButton() {
            document.getElementById('clear-filter').disabled = false;
        }

        // Function to reset filters
        document.getElementById('clear-filter').addEventListener('click', function() {
            // Reset all filter inputs to their default values
            const filters = document.querySelectorAll('input[type="text"], select');

            filters.forEach(filter => {
                if (filter.tagName === 'SELECT') {
                    filter.selectedIndex = 0; // Reset select to the first option
                } else {
                    filter.value = ''; // Clear text inputs
                }
            });

            // Disable the Clear Filter button after clearing the filters
            this.disabled = true;

            // Optionally, you can also submit the form if needed
            // document.getElementById('your-form-id').submit(); // Uncomment if needed
        });

        // Example of enabling the button when a filter is applied
        const filterInputs = document.querySelectorAll('input[type="text"], select');

        filterInputs.forEach(input => {
            input.addEventListener('change', enableClearButton); // Enable button on filter change
        });

        // Example for filtering function to indicate a filter has occurred
        function applyFilters() {
            // Your filtering logic here

            // After applying filters, enable the clear button
            enableClearButton();
        }

        // Example of how to trigger the filter application (this could be your form submission or button click)
        document.getElementById('apply-filters').addEventListener('click', applyFilters);
    </script>
@endsection
