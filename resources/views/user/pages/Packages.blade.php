@extends('user.index')
@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg10">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Packages</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Pricing</li>
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

    <!-- Pricing Section Start -->
    <section class="pricing-section pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Unlock Exclusive Plans and Packages!</h2>

            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="price-card">
                        <div class="price-top">
                            <h3>Job Search Only</h3>
                            <i class='bx bx-search'></i>
                            <h2>0<sub>/Month</sub></h2>
                        </div>

                        <div class="price-feature">
                            <ul>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Access to job board
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Application tracking
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Saved jobs
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Job alerts
                                </li>
                            </ul>
                        </div>

                        <div class="price-btn">
                            <a href="#">Find A Job</a>
                        </div>
                    </div>
                </div>


                @if ($packages && $packages->isNotEmpty())
                    <!-- Check if packages is not null and not empty -->
                    @foreach ($packages as $package)
                        <div class="col-lg-4 col-sm-6">
                            <div class="price-card mt-12">
                                <div class="price-top">
                                    <h3>{{ $package->name }}</h3>
                                    <i class='bx bx-user'></i>
                                    <h2>{{ number_format($package->price, 2) }}<sub>JD/Month</sub></h2>
                                </div>

                                <div class="price-feature">
                                    <ul>
                                        @if ($package->attributes)
                                            @php
                                                // Check if attributes is already an array
                                                $attributes = is_array($package->attributes)
                                                    ? $package->attributes
                                                    : json_decode($package->attributes, true);

                                                $features = $attributes['features'] ?? [];
                                                $details = $attributes['details'] ?? [];
                                            @endphp

                                            @foreach ($features as $feature)
                                                @if (is_string($feature))
                                                    <!-- Ensure the feature is a string -->
                                                    <li>
                                                        <i class='bx bx-check'></i>
                                                        {{ $feature }}
                                                    </li>
                                                @endif
                                            @endforeach

                                            @foreach ($details as $detail)
                                                @if (is_string($detail))
                                                    <!-- Ensure the detail is a string -->
                                                    <li>
                                                        <i class='bx bx-info-circle'></i>
                                                        {{ $detail }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        @else
                                            <li>No features available.</li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="price-btn">
                                    <form action="{{ route('checkout.form') }}" method="GET" class="d-inline">
                                        @csrf <!-- Include CSRF token for security -->
                                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                                        <input type="hidden" name="numberOfMonths" value="1">
                                        <!-- Set default number of months -->
                                        <div class="price-btn">
                                            <a href="#"
                                                onclick="event.preventDefault(); this.closest('form').submit();"
                                                class="price-btn">
                                                Subscribe Now
                                            </a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No packages available.</p> <!-- Handle the case where no packages are found -->
                @endif








            </div>
        </div>
        </div>
    </section>
    <!-- Pricing Section End -->


@endsection
