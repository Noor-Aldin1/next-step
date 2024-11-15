@extends('user.index')
@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg6">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Job Details</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Job Details</li>
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

    <!-- Job Details Section Start -->
    <section class="job-details ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="job-details-text">
                                <div class="job-card">
                                    <div class="row align-items-center">

                                        <div class="col-md-10">
                                            <div class="job-info">
                                                <h3>{{ $jobPosting->title }}</h3>
                                                <ul>
                                                    <li>
                                                        <i class='bx bx-location-plus'></i>
                                                        {{ $jobPosting->city }}
                                                    </li>
                                                    <li>
                                                        <i class='bx bx-filter-alt'></i>
                                                        @if ($categories_name->isNotEmpty())
                                                            @foreach ($categories_name as $category)
                                                                {{ htmlspecialchars($category->name) }}@if (!$loop->last)
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            No Categories Found
                                                        @endif
                                                    </li>

                                                    <li>
                                                        <i class='bx bx-briefcase'></i>
                                                        {{ $jobPosting->job_type }}
                                                    </li>
                                                </ul>

                                                <span>
                                                    <i class='bx bx-paper-plane'></i>
                                                    Apply Before:
                                                    {{ \Carbon\Carbon::parse($jobPosting->last_date_to_apply)->format('F j, Y') }}
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="details-text">
                                    <h3>Description</h3>
                                    <p>{{ $jobPosting->description }}</p>


                                </div>

                                <div class="details-text">
                                    <h3>Requirements</h3>
                                    <p> {{ $jobPosting->requirements }}
                                    </p>


                                </div>

                                <div class="details-text">
                                    <h3>Job Details</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><span>Company :</span></td>
                                                        <td class="ps-2">
                                                            {{ htmlspecialchars($jobPosting->company_name ?? 'N/A') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Location :</span></td>
                                                        <td class="ps-2">
                                                            {{ htmlspecialchars($jobPosting->city ?? 'N/A') }}</td>
                                                    </tr>
                                                    <td><span>Address :</span></td>
                                                    <td class="ps-2">
                                                        @if (!empty($jobPosting->address))
                                                            {{ htmlspecialchars($jobPosting->address) }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <tr>
                                                        <td><span>Job Type :</span></td>
                                                        <td class="ps-2">
                                                            {{ htmlspecialchars($jobPosting->job_type ?? 'N/A') }}</td>
                                                    </tr>
                                                    <tr>

                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><span>Experience:</span></td>
                                                        <td class="ps-2">{{ $jobPosting->experience ?? 'N/A' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <td><span>Education Level: </span></td>
                                                        <td class="ps-2">{{ $jobPosting->education_level ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Salary: </span></td>
                                                        <td class="ps-2"> ${{ number_format($jobPosting->salary, 2) }}
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td><span>Email :</span></td>
                                                        <td class="ps-2">
                                                            @if (!empty($employer_name))
                                                                @foreach ($employer_name as $employ)
                                                                    <a
                                                                        href="mailto:{{ htmlspecialchars($employ->account_manager) }}">{{ htmlspecialchars($employ->account_manager) }}</a>
                                                                @endforeach
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="theme-btn">
                                    @php
                                        $hasApplied = $applications->contains('job_id', $jobPosting->id);
                                    @endphp

                                    @if (auth()->check())
                                        @if (!$hasApplied)
                                            <a href="#" onclick="openModal()" class="default-btn">
                                                Apply Now
                                            </a>
                                        @else
                                            <a href="{{ route('applications.index') }}" class="default-btn">
                                                View My Applications
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="default-btn">
                                            Login to Apply
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @include('user.pages.application')

                <div class="col-lg-4">
                    <div class="job-sidebar">
                        <h3>Posted By</h3>
                        <div class="posted-by">

                            <h4>
                                @if ($employer_name->isNotEmpty())
                                    @foreach ($employer_name as $employer)
                                        {{ ucfirst(htmlspecialchars($employer->username)) }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                @else
                                    No Employer Found
                                @endif
                            </h4>
                            <span> From {{ htmlspecialchars($jobPosting->company_name ?? 'N/A') }}</span>
                        </div>
                    </div>
                    {{-- <div class="job-sidebar">
                        <div class="posted-by">

                            <image
                                src="https://cdn.dribbble.com/users/4415359/screenshots/12483759/media/8262513d57658cc7c053ba9c68024438.gif"
                                alt="job " class="img-responsive ">
                        </div>
                    </div> --}}






                </div>







            </div>

        </div>
        </div>
    </section>
    <!-- Job Details Section End -->




@endsection
