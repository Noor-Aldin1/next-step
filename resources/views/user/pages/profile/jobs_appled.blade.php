@extends('user.index')

@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg10">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>My Applications</h2>
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>Applications</li>
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

    <!-- Applications Area Start -->
    <section class="applications-section ptb-100">
        <div class="container">
            <div class="row">
                {{-- Informational aspect --}}
                @include('user.pages.profile.side_info')

                <div class="col-md-8">
                    <div class="applications-details">
                        <section class="p-4 bg-white border rounded shadow">
                            <header class="mb-4">
                                <h2 class="h4">Your Applications</h2>
                                <p class="text-muted">Below is a list of your job applications.</p>
                            </header>

                            @if ($applications->isEmpty())
                                <p class="text-muted">You have not applied for any jobs yet.</p>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Job Title</th>
                                            <th>Application Date</th>
                                            <th>Status</th>
                                            <th>CV</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applications as $index => $application)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $application->jobPosting->title }}</td>
                                                <td>{{ \Carbon\Carbon::parse($application->applied_at)->format('d-m-Y') }}
                                                </td>
                                                <td>{{ ucfirst($application->status) }}</td>
                                                <td>
                                                    @if ($application->cv)
                                                        <a href="{{ asset('storage/' . $application->cv) }}"
                                                            target="_blank">View CV</a>
                                                    @else
                                                        <a href="{{ route('resumes.show', Auth::user()->id) }}"
                                                            class="">
                                                            <i class='bx bxs-file-doc'></i>
                                                            My Resume
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('job_postings.show', $application->job_id) }}"
                                                        class="btn btn-info btn-sm">View</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Applications Area End -->

    <!-- Subscribe Section Start -->
    <section class="subscribe-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="section-title">
                        <h2>Get New Job Notifications</h2>
                        <p>Subscribe & get all related job notifications</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <form class="newsletter-form" data-toggle="validator">
                        <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL" required
                            autocomplete="off">
                        <button class="btn btn-primary" type="submit">Subscribe</button>
                        <div id="validator-newsletter" class="form-result"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Subscribe Section End -->
@endsection
