@extends('user.index')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Page Title Start -->
    <section class="page-title title-bg13">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Sign Up</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Sign Up</li>
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

    <!-- Sign up Section Start -->
    <div class="signup-section ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 offset-md-2 offset-lg-3">
                    <div id="alert" class="alert alert-warning" role="alert" style="display: none;"></div>
                    <form class="signup-form" method="POST" action="{{ route('register') }}" id="signupForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Enter Username</label>
                            <input id="name" type="text" class="form-control" name="name"
                                placeholder="Enter Username" value="{{ old('name') }}" required autofocus
                                autocomplete="name">
                            @error('name')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Enter Email</label>
                            <input id="email" type="email" class="form-control" name="email"
                                placeholder="Enter Your Email" value="{{ old('email') }}" required autocomplete="username">
                            @error('email')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Enter Password</label>
                            <input id="password" type="password" class="form-control" name="password"
                                placeholder="Enter Your Password" required autocomplete="new-password">
                            @error('password')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" placeholder="Confirm Your Password" required
                                autocomplete="new-password">
                            @error('password_confirmation')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="signup-btn text-center">
                            <button type="submit">Sign Up</button>
                        </div>

                        <div class="create-btn text-center">
                            <p>
                                Have an Account?
                                <a href="{{ route('login') }}">
                                    Sign In
                                    <i class='bx bx-chevrons-right bx-fade-right'></i>
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign Up Section End -->

    <script>
        // Show success alert after registration
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        // Client-side validation
        document.getElementById('signupForm').addEventListener('submit', function(event) {
            let alertBox = document.getElementById('alert');
            alertBox.style.display = 'none'; // Hide the alert initially

            // Get values
            const username = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const passwordConfirmation = document.getElementById('password_confirmation').value.trim();

            // Regular expressions
            const usernamePattern = /^[a-zA-Z0-9]{3,}$/; // At least 3 alphanumeric characters
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email pattern

            // Simple validation for empty fields
            if (!username || !email || !password || !passwordConfirmation) {
                event.preventDefault(); // Prevent form submission
                alertBox.innerText = 'All fields are required.';
                alertBox.style.display = 'block'; // Show the alert
                return;
            }

            // Validate username
            if (!usernamePattern.test(username)) {
                event.preventDefault(); // Prevent form submission
                alertBox.innerText = 'Username must be at least 3 alphanumeric characters.';
                alertBox.style.display = 'block'; // Show the alert
                return;
            }

            // Validate email
            if (!emailPattern.test(email)) {
                event.preventDefault(); // Prevent form submission
                alertBox.innerText = 'Please enter a valid email address.';
                alertBox.style.display = 'block'; // Show the alert
                return;
            }

            // Validate password length
            if (password.length < 8) {
                event.preventDefault(); // Prevent form submission
                alertBox.innerText = 'The password field must be at least 8 characters.';
                alertBox.style.display = 'block'; // Show the alert
                return;
            }

            // Validate password confirmation
            if (password !== passwordConfirmation) {
                event.preventDefault(); // Prevent form submission
                alertBox.innerText = 'Passwords do not match.';
                alertBox.style.display = 'block'; // Show the alert
                return;
            }
        });
    </script>

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
