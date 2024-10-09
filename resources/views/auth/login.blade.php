@extends('user.index')
@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg12">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Sign In</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Sign In</li>
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

    <!-- Sign In Section Start -->
    <div class="signin-section ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 offset-md-2 offset-lg-3">
                    <form method="POST" action="{{ route('login') }}" class="signin-form">
                        @csrf

                        <div class="form-group">
                            <label for="email">Enter Email</label>
                            <input id="email" type="email" class="form-control" name="email"
                                placeholder="Enter Your Email" value="{{ old('email') }}" required autofocus
                                autocomplete="username">
                            @error('email')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Enter Password</label>
                            <input id="password" type="password" class="form-control" name="password"
                                placeholder="Enter Your Password" required autocomplete="current-password">
                            @error('password')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group text-center">
                            <label for="remember_me" class="form-check-label">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                Remember me
                            </label>
                        </div>

                        <div class="signin-btn text-center">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>

                        <div class="create-btn text-center">
                            <p>Not have an account?
                                <a href="{{ route('register') }}">
                                    Create an account
                                    <i class='bx bx-chevrons-right bx-fade-right'></i>
                                </a>
                            </p>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center mt-3">
                                <a href="{{ route('password.request') }}">Forgot your password?</a>
                            </div>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Sign In Section End -->

    <!-- Subscribe Section Start -->
    <section class="subscribe-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="section-title">
                        <h2>Get New Job Notifications</h2>
                        <p>Subscribe & get all related jobs notification</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <form class="newsletter-form" data-toggle="validator">
                        <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL" required
                            autocomplete="off">

                        <button class="default-btn sub-btn" type="submit">
                            Subscribe
                        </button>

                        <div id="validator-newsletter" class="form-result"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Subscribe Section End -->
@endsection
