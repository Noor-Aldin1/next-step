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

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $jobs->links() }} <!-- Laravel pagination links -->
        </div>
    </div>
</section>
<!-- Job Section End -->
