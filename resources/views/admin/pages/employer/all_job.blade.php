@extends('admin.admin_panel')

@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h3 class="page-title">Contact</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Contact</li>
                        </ul>
                    </div>
                    <div class="col-md-8 float-end ms-auto">
                        <div class="d-flex title-head">
                            <div class="view-icons">
                                <span class="clear-filter-text">Clear filter</span>
                                <a href="javascript:void(0);" class="list-view btn btn-link" id="filter_search">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>


                            <script>
                                // Clear all filters when the filter button is clicked
                                document.getElementById('filter_search').addEventListener('click', function() {
                                    // Reset all checkboxes
                                    document.querySelectorAll('.category-checkbox, .city-checkbox').forEach(cb => cb.checked = false);

                                    // Clear search input
                                    document.getElementById('searchInput').value = '';

                                    // Reset displayed jobs
                                    filterJobPostings([], []); // Reset displayed jobs to show all

                                    // Optionally, you can log a message for testing
                                    console.log('All filters have been cleared.');
                                });
                            </script>
                            <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_contact"><i
                                    class="la la-plus-circle"></i> Add Contact</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <hr>
            <!-- /Search Filter -->
            <div class="filter-section">
                <ul>
                    <li>
                        <div class="form-sorts dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" id="table-filter">
                                <i class="las la-filter me-2"></i>Filter
                            </a>
                            <div class="filter-dropdown-menu">
                                <div class="filter-set-view">
                                    <div class="filter-set-head">
                                        <h4>Filter</h4>
                                    </div>
                                    <div class="accordion" id="accordionExample">
                                        <!-- Categories Section -->
                                        <div class="filter-set-content">
                                            <div class="filter-set-content-head">
                                                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    Categories <i class="las la-angle-right"></i>
                                                </a>
                                            </div>
                                            <div class="filter-set-contents accordion-collapse collapse" id="collapseThree"
                                                data-bs-parent="#accordionExample">
                                                <ul id="categoryList">
                                                    @foreach ($jobPostings as $job)
                                                        @foreach ($job->categories as $category)
                                                            <li>
                                                                <div class="filter-checks">
                                                                    <label class="checkboxs">
                                                                        <input type="checkbox" class="category-checkbox"
                                                                            value="{{ $category->id }}">
                                                                        <span class="checkmarks"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="collapse-inside-text">
                                                                    <h5>{{ $category->name }}</h5>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- City Filter Section -->
                                        <div class="filter-set-content">
                                            <div class="filter-set-content-head">
                                                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseCity"
                                                    aria-expanded="false" aria-controls="collapseCity">
                                                    City <i class="las la-angle-right"></i>
                                                </a>
                                            </div>
                                            <div class="filter-set-contents accordion-collapse collapse" id="collapseCity"
                                                data-bs-parent="#accordionExample">
                                                <ul id="cityList">
                                                    @foreach (['Amman', 'Irbid', 'Balqa', 'Karak', 'Ma\'an', 'Mafraq', 'Tafilah', 'Zarqa', 'Madaba', 'Jerash', 'Ajloun', 'Aqaba'] as $city)
                                                        <li>
                                                            <div class="filter-checks">
                                                                <label class="checkboxs">
                                                                    <input type="checkbox" class="city-checkbox"
                                                                        value="{{ $city }}">
                                                                    <span class="checkmarks"></span>
                                                                </label>
                                                            </div>
                                                            <div class="collapse-inside-text">
                                                                <h5>{{ $city }}</h5>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-reset-btns">
                                        <a href="#" class="btn btn-light" id="resetFilters">Reset</a>
                                        <a href="#" class="btn btn-primary" id="applyFilters">Filter</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="search-set">
                            <div class="search-input">
                                <a href="#" class="btn btn-searchset" id="searchButton">
                                    <i class="las la-search"></i>
                                </a>
                                <div class="dataTables_filter">
                                    <label>
                                        <input type="search" class="form-control form-control-sm" placeholder="Search"
                                            id="searchInput">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </li>

                    <script>
                        // Add event listener for the search button
                        document.getElementById('searchButton').addEventListener('click', function(event) {
                            event.preventDefault(); // Prevent the default action of the link
                            const searchTerm = document.getElementById('searchInput').value.toLowerCase(); // Get the search term

                            // Call the function to filter job postings based on the search term
                            filterJobPostingsBySearch(searchTerm);
                        });

                        // Function to filter job postings based on the search input
                        function filterJobPostingsBySearch(searchTerm) {
                            const jobPostings = document.querySelectorAll('.job-posting'); // Use your actual selector for job postings

                            jobPostings.forEach(job => {
                                const jobTitle = job.dataset.title.toLowerCase(); // Assuming you set a title data attribute
                                const employerName = job.dataset.name.toLowerCase(); // Assuming you set a name data attribute

                                // Show job if the search term matches either the job title or employer name
                                if (jobTitle.includes(searchTerm) || employerName.includes(searchTerm)) {
                                    job.style.display = 'block'; // Show job
                                } else {
                                    job.style.display = 'none'; // Hide job
                                }
                            });
                        }
                    </script>

                </ul>
            </div>

            <script>
                // JavaScript to handle the filtering
                document.getElementById('applyFilters').addEventListener('click', function() {
                    // Get selected categories
                    const selectedCategories = Array.from(document.querySelectorAll('.category-checkbox:checked')).map(cb =>
                        cb.value);
                    // Get selected cities
                    const selectedCities = Array.from(document.querySelectorAll('.city-checkbox:checked')).map(cb => cb
                        .value);

                    // Log the selected filters (for testing)
                    console.log('Selected Categories:', selectedCategories);
                    console.log('Selected Cities:', selectedCities);

                    // Filter the job postings based on selected categories and cities
                    filterJobPostings(selectedCategories, selectedCities);
                });

                // Function to filter job postings
                function filterJobPostings(categories, cities) {
                    const jobPostings = document.querySelectorAll('.job-posting'); // Use your actual selector for job postings

                    jobPostings.forEach(job => {
                        const jobCategories = job.dataset.categories ? job.dataset.categories.split(',') :
                    []; // Example: "1,2,3"
                        const jobCity = job.dataset.city || ''; // Example: "Amman"

                        const categoryMatch = categories.length ? categories.some(cat => jobCategories.includes(cat)) :
                            true;
                        const cityMatch = cities.length ? cities.includes(jobCity) : true;

                        if (categoryMatch && cityMatch) {
                            job.style.display = 'block'; // Show job
                        } else {
                            job.style.display = 'none'; // Hide job
                        }
                    });
                }

                // Reset filters
                document.getElementById('resetFilters').addEventListener('click', function() {
                    // Reset all checkboxes
                    document.querySelectorAll('.category-checkbox, .city-checkbox').forEach(cb => cb.checked = false);
                    document.getElementById('searchInput').value = ''; // Clear search input
                    filterJobPostings([], []); // Reset displayed jobs
                });
            </script>

            <div class="row mt-4" id="jobPostingsContainer">
                {{-- ------card list ------ --}}
                @foreach ($jobPostings as $job)
                    <div class="col-xxl-3 col-xl-4 col-md-6 mb-4 job-posting" data-name="{{ $job->employerUser->username }}"
                        data-title="{{ $job->title }}" data-city="{{ $job->city }}"
                        data-categories="{{ implode(',', $job->categories->pluck('id')->toArray()) }}">
                        <div class="card contact-grid shadow-sm border-0 rounded">
                            <div class="card-header bg-transparent d-flex justify-content-between align-items-center p-3">
                                <div class="users-profile">
                                    <h5 class="name-user mb-0">
                                        <a href="contact-details.html"
                                            class="text-decoration-none text-dark">{{ $job->employerUser->username }}</a>
                                        <br><small class="text-muted">{{ $job->title }}</small>
                                    </h5>
                                </div>
                                <div class="dropdown">
                                    <a href="#" class="action-icon text-secondary" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit_contact"><i
                                                    class="fa-solid fa-pencil me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#delete_contact"><i
                                                    class="fa-regular fa-trash-can me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="address-info mb-2">
                                    <p class="mb-1"><i class="la la-envelope-open me-2"></i><a
                                            href="mailto:{{ $job->employerUser->email }}"
                                            class="text-decoration-none">{{ $job->employerUser->email }}</a></p>
                                    <p class="mb-1"><i class="la la-briefcase me-2"></i>{{ $job->company_name }}</p>
                                    <p class="mb-1"><i class="la la-user-tie me-2"></i>{{ $job->position }}</p>
                                    <p class="mb-1"><i class="la la-business-time me-2"></i>{{ $job->job_type }}</p>
                                    <p class="mb-1"><i class="la la-certificate me-2"></i>{{ $job->experience }} years
                                    </p>
                                    <p class="mb-1"><i
                                            class="la la-graduation-cap me-2"></i>{{ $job->education_level }}</p>
                                    <p class="mb-1"><i class="la la-dollar-sign me-2"></i>${{ $job->salary }}</p>
                                    <p class="mb-1"><i class="la la-calendar me-2"></i>Apply by:
                                        {{ $job->last_date_to_apply }}</p>
                                    <p class="mb-1"><i class="la la-calendar-check me-2"></i>Posted on:
                                        {{ $job->created_at }}</p>
                                    <p class="mb-1"><i class="la la-map-marker-alt me-2"></i>{{ $job->city }},
                                        {{ $job->address }}</p>
                                </div>
                                <div class="custom-grid-badges">
                                    <div class="custom-badge custom-bg-danger"
                                        onclick="openModal('custom-des-form-{{ $job->id }}')">Description</div>
                                    <div class="custom-badge custom-bg-purple"
                                        onclick="openModal('custom-req-form-{{ $job->id }}')">Requirement</div>
                                </div>
                                <div id="custom-des-form-{{ $job->id }}" class="custom-modal">
                                    <h6>Description</h6>
                                    <p>{{ $job->description }}</p>
                                </div>
                                <div id="custom-req-form-{{ $job->id }}" class="custom-modal">
                                    <h6>Requirement</h6>
                                    <p>{{ $job->requirements }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
@endsection
