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
                    <form class="signup-form needs-validation" method="POST" action="{{ route('register') }}"
                        id="signupForm" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input id="name" type="text" class="form-control" name="name"
                                placeholder="e.g Ali_12" value="{{ old('name') }}" required autofocus>
                            <div class="invalid-feedback">
                                Username must be at least 3 alphanumeric characters.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email"
                                placeholder="e.g example@gmail.com" value="{{ old('email') }}" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address like example@xyz.com.

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required
                                minlength="8">
                            <div class="invalid-feedback">
                                Password must be at least 8 characters long.
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required>
                            <div class="invalid-feedback">
                                Password confirmation must match.
                            </div>
                        </div>

                        <div class="signup-btn text-center">
                            <button type="submit">Sign Up</button>
                        </div>

                        <div class="create-btn text-center">
                            <p>
                                Have an Account?
                                <a href="{{ route('login') }}">
                                    Login
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
        (function() {
            'use strict';

            var forms = document.querySelectorAll('.needs-validation');

            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    var username = form.querySelector('input[name="name"]').value.trim();
                    var email = form.querySelector('input[name="email"]').value.trim();
                    var password = form.querySelector('input[name="password"]').value;
                    var passwordConfirmation = form.querySelector('input[name="password_confirmation"]')
                        .value;

                    // Regular Expressions
                    var usernamePattern = /^[a-zA-Z0-9]{3,}$/; // At least 3 alphanumeric characters
                    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email format

                    // Validate username
                    if (!usernamePattern.test(username)) {
                        event.preventDefault();
                        event.stopPropagation();
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: 'Username must be at least 3 alphanumeric characters.',
                        });
                        form.querySelector('input[name="name"]').classList.add('is-invalid');
                    }

                    // Validate email
                    else if (!emailPattern.test(email)) {
                        event.preventDefault();
                        event.stopPropagation();
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: 'Please enter a valid email address.',
                        });
                        form.querySelector('input[name="email"]').classList.add('is-invalid');
                    }

                    // Validate password length
                    else if (password.length < 8) {
                        event.preventDefault();
                        event.stopPropagation();
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: 'Password must be at least 8 characters long.',
                        });
                        form.querySelector('input[name="password"]').classList.add('is-invalid');
                    }

                    // Validate password confirmation
                    else if (password !== passwordConfirmation) {
                        event.preventDefault();
                        event.stopPropagation();
                        Swal.fire({
                            icon: 'error',
                            title: 'Password Mismatch',
                            text: 'Password and confirmation do not match.',
                        });
                        form.querySelector('input[name="password_confirmation"]').classList.add(
                            'is-invalid');
                    }

                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                        Swal.fire({
                            icon: 'error',
                            title: 'Form Error',
                            text: 'Please fix the errors in the form.',
                        });
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection
