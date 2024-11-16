<!-- Job Section Start -->
<section class="job-style-two pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <h2>Jobs You May Be Interested In</h2>
        </div>

        <div class="row">
            @foreach ($jobs->take(3) as $job)
                <!-- Only take the first 4 jobs -->
                <div class="col-lg-12 mb-4">
                    <div class="job-card-two">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="job-info">
                                    <h3>
                                        <a href="{{ route('job_postings.show', $job->id) }}">
                                            {{ $job->title }} <!-- Job title from the database -->
                                        </a>
                                    </h3>
                                    <ul>
                                        <li>
                                            <i class='bx bx-briefcase'></i>
                                            @if ($job->categories->isNotEmpty())
                                                {{ $job->categories->pluck('name')->implode(', ') }}
                                                <!-- Job categories from the relationship -->
                                            @else
                                                No category
                                            @endif
                                        </li>
                                        <li>
                                            <i class='bx bx-dollar'></i>
                                            {{ $job->salary ?? 'Salary not specified' }} <!-- Salary field -->
                                        </li>
                                        <li>
                                            <i class='bx bx-location-plus'></i>
                                            {{ $job->city ?? 'Location not specified' }} <!-- Location field -->
                                        </li>
                                        <li>
                                            <i class='bx bx-stopwatch'></i>
                                            {{ optional($job->created_at)->diffForHumans() ?? 'Created at not specified' }}
                                            <!-- Date posted, using diffForHumans for relative time -->
                                        </li>
                                    </ul>
                                    <span>{{ $job->job_type ?? 'Employment type not specified' }}</span>
                                    <!-- Employment type -->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="theme-btn text-end">
                                    <a href="{{ route('job_postings.show', $job->id) }}" class="default-btn">
                                        Browse Job
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Custom Pagination Style -->
        <!-- Custom Pagination Style -->
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <!-- Previous Page Link -->
                    <li class="page-item {{ $jobs->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $jobs->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <!-- Loop through pages -->
                    @for ($i = 1; $i <= $jobs->lastPage(); $i++)
                        <li class="page-item {{ $i == $jobs->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $jobs->url($i) }}"
                                style="{{ $i == $jobs->currentPage() ? 'background-color: red; color: white;' : '' }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor

                    <!-- Next Page Link -->
                    <li class="page-item {{ $jobs->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $jobs->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>


    </div>
</section>
<!-- Job Section End -->
