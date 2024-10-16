@extends('employer.control_panel')
@section('content')

    <body class="vh-100">
        <div class="page-wraper">

            <!-- Content -->
            <div class="browse-job login-style3">
                <!-- Coming Soon -->
                <div class="bg-img-fix overflow-hidden"
                    style="background-image: url('https://dvsolicitors.com/wp-content/uploads/2022/11/What-Are-Your-Rights-as-a-Director-of-a-Company-min-scaled.jpg'); 
           background-size: cover; 
           background-position: center; 
          ">



                    <div class="row gx-0">
                        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 vh-100 bg-white ">
                            <div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside"
                                style="max-height: 653px;" tabindex="0">
                                <div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;"
                                    dir="ltr">
                                    <div class="login-form style-2">


                                        <div class="card-body">
                                            <div class="logo-header">
                                                <a href="index.html" class="logo"><img
                                                        src="{{ url('employer_css/images/logo.png') }}" alt="Logo"
                                                        class="mCS_img_loaded" style="background-color: rgb(10, 67, 116);">
                                                </a>
                                                <a href="index.html" class="logo-white">

                                                </a>
                                            </div>

                                            <nav>
                                                <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">

                                                    <div class="tab-content w-100" id="nav-tabContent">

                                                        {{-- create --}}
                                                        <div class="tab-pane fade show active" id="nav-sign"
                                                            role="tabpanel" aria-labelledby="nav-sign-tab">
                                                            <div class="scrollable-form-container">
                                                                <form class="dez-form py-5 needs-validation" method="POST"
                                                                    action="{{ route('employer.register.store') }}"
                                                                    novalidate>
                                                                    @csrf <!-- Add CSRF token for security -->
                                                                    <h3 class="form-title">Sign Up</h3>
                                                                    <div class="dez-separator-outer m-b5">
                                                                        <div class="dez-separator bg-primary style-liner">
                                                                        </div>
                                                                    </div>
                                                                    <p>Fill in your company information below:</p>

                                                                    <div class="form-group mt-3">
                                                                        <p>Username:</p>
                                                                        <input name="username" required class="form-control"
                                                                            placeholder="e.g Qusai Ali" type="text">
                                                                        <div class="invalid-feedback">Username is required
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Company Name:</p>
                                                                        <input name="company_name" required
                                                                            class="form-control" placeholder="e.g Microsoft"
                                                                            type="text">
                                                                        <div class="invalid-feedback">Company Name is
                                                                            required</div>
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Business Sector:</p>
                                                                        <input name="business_sector" required
                                                                            class="form-control"
                                                                            placeholder="e.g Healthcare, Retail"
                                                                            type="text">
                                                                        <div class="invalid-feedback">Business Sector is
                                                                            required</div>
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Employee Numbers:</p>
                                                                        <input required name="employee_num"
                                                                            class="form-control" placeholder="e.g 6"
                                                                            type="number" min="1">
                                                                        <div class="invalid-feedback">Please enter a valid
                                                                            number of employees</div>
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Account Manager:</p>
                                                                        <input name="account_manager" required
                                                                            class="form-control"
                                                                            placeholder="example@xyz.com" type="email">
                                                                        <div class="invalid-feedback">Please enter a valid
                                                                            email</div>
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>City:</p>
                                                                        <input name="city" required class="form-control"
                                                                            placeholder="Amman" type="text">
                                                                        <div class="invalid-feedback">City is required</div>
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Phone:</p>
                                                                        <input name="phone" required class="form-control"
                                                                            placeholder="07xxxxxxxx" type="tel"
                                                                            pattern="07[0-9]{8}">
                                                                        <div class="invalid-feedback">Please enter a valid
                                                                            phone number (e.g. 07xxxxxxxx)</div>
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Email Address:</p>
                                                                        <input name="email" required class="form-control"
                                                                            placeholder="youremail@xyz.com" type="email">
                                                                        <div class="invalid-feedback">Please enter a valid
                                                                            email address</div>
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Password:</p>
                                                                        <input name="password" required class="form-control"
                                                                            placeholder="" type="password" minlength="6">
                                                                        <div class="invalid-feedback">Password must be at
                                                                            least 6 characters long</div>
                                                                    </div>

                                                                    <div class="form-group mt-3 mb-3">
                                                                        <p>Re-type Your Password:</p>
                                                                        <input name="password_confirmation" required
                                                                            class="form-control" placeholder=""
                                                                            type="password" minlength="6">
                                                                        <div class="invalid-feedback">Passwords do not
                                                                            match</div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <span class="form-check float-start me-2">
                                                                            <input type="checkbox"
                                                                                class="form-check-input" id="check2"
                                                                                name="termsAgree" required>
                                                                            <label class="form-check-label d-unset"
                                                                                for="check2">I agree to the</label>
                                                                        </span>

                                                                        <label>
                                                                            <a href="#">Terms of Service</a> & <a
                                                                                href="#">Privacy Policy</a>
                                                                        </label>
                                                                        <br>
                                                                        <label>
                                                                            <a style="font-weight: bold"
                                                                                href="{{ route('login') }}">Already have an
                                                                                account</a>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group clearfix text-left">
                                                                        <a href="{{ route('home') }}">
                                                                            <button class="btn btn-primary outline gray"
                                                                                type="button">Back</button>
                                                                        </a>
                                                                        <button class="btn btn-primary float-end"
                                                                            type="submit">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>

                                                        <!-- CSS -->
                                                        <style>
                                                            .scrollable-form-container {
                                                                max-height: 500px;
                                                                /* Adjust height as needed */
                                                                overflow: auto;
                                                                padding-right: 13px;
                                                                /* To avoid scrollbar overlap with content */
                                                            }
                                                        </style>
                                                    </div>

                                                </div>
                                            </nav>
                                        </div>
                                        <div class="card-footer">
                                            <div class=" bottom-footer clearfix m-t10 m-b20 row text-center">
                                                <div class="col-lg-12 text-center">
                                                    <span> © Copyright by <span class="heart"></span>
                                                        <a href="javascript:void(0);">DexignLab </a> All rights
                                                        reserved.</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="mCSB_1_scrollbar_vertical"
                                    class="mCSB_scrollTools mCSB_1_scrollbar mCS-light mCSB_scrollTools_vertical"
                                    style="display: block;">
                                    <div class="mCSB_draggerContainer">
                                        <div id="mCSB_1_dragger_vertical" class="mCSB_dragger"
                                            style="position: absolute; min-height: 0px; display: block; height: 652px; max-height: 643px; top: 0px;">
                                            <div class="mCSB_dragger_bar" style="line-height: 0px;"></div>
                                            <div class="mCSB_draggerRail"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Full Blog Page Contant -->
            </div>
            <!-- Content END-->
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            (function() {
                'use strict';

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation');

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            // Perform custom validations here if necessary
                            var password = form.querySelector('input[name="password"]').value;
                            var passwordConfirmation = form.querySelector('input[name="password_confirmation"]')
                                .value;

                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Error',
                                    text: 'Please correct the highlighted errors before submitting.',
                                });
                            } else if (password !== passwordConfirmation) {
                                event.preventDefault();
                                event.stopPropagation();

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Password Mismatch',
                                    text: 'The password and confirmation do not match.',
                                });

                                form.querySelector('input[name="password_confirmation"]').classList.add(
                                    'is-invalid');
                            }

                            form.classList.add('was-validated');
                        }, false);
                    });
            })();
        </script>
    @endsection
