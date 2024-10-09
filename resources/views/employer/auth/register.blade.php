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
                                                        <div class="tab-pane fade show active" id="nav-personal"
                                                            role="tabpanel" aria-labelledby="nav-personal-tab">
                                                            <form class=" dez-form pb-3">
                                                                <h3 class="form-title m-t0">Employer Information</h3>
                                                                <div class="dez-separator-outer m-b5">
                                                                    <div class="dez-separator bg-primary style-liner"></div>
                                                                </div>
                                                                <p>Enter your e-mail address and your password. </p>
                                                                <div class="form-group mb-3">
                                                                    <input name="dzName" required=""
                                                                        class="form-control" placeholder="User Name"
                                                                        type="text">
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <input name="dzName" required=""
                                                                        class="form-control " placeholder="Type Password"
                                                                        type="password">
                                                                </div>
                                                                <div class="form-group text-left mb-5">
                                                                    <button
                                                                        class="btn btn-primary dz-xs-flex me-3">login</button>
                                                                    <span class="form-check d-inline-block">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            id="check1" name="example1">
                                                                        <label class="form-check-label"
                                                                            for="check1">Remember me</label>
                                                                    </span>
                                                                    <button
                                                                        class="nav-link m-auto btn tp-btn-light btn-primary"
                                                                        id="nav-forget-tab" data-bs-toggle="tab"
                                                                        data-bs-target="#nav-forget" type="button"
                                                                        role="tab" aria-controls="nav-forget"
                                                                        aria-selected="false">Forget Password ?</button>
                                                                </div>
                                                                <div class="dz-social ">
                                                                    <h5 class="form-title fs-20">Sign In With</h5>
                                                                    <ul
                                                                        class="dez-social-icon dez-border dez-social-icon-lg text-white">
                                                                        <li><a target="_blank"
                                                                                href="https://www.facebook.com/"
                                                                                class="fab fa-facebook-f btn-facebook"></a>
                                                                        </li>
                                                                        <li><a target="_blank"
                                                                                href="https://www.google.com/"
                                                                                class="fab fa-google-plus-g btn-google-plus"></a>
                                                                        </li>
                                                                        <li><a target="_blank"
                                                                                href="https://www.linkedin.com/"
                                                                                class="fab fa-linkedin-in btn-linkedin"></a>
                                                                        </li>
                                                                        <li><a target="_blank" href="https://twitter.com/"
                                                                                class="fab fa-twitter btn-twitter"></a></li>
                                                                    </ul>
                                                                </div>
                                                            </form>
                                                            <div class="text-center bottom">
                                                                <button class="btn btn-primary button-md btn-block"
                                                                    id="nav-sign-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#nav-sign" type="button" role="tab"
                                                                    aria-controls="nav-sign" aria-selected="false">Create an
                                                                    account</button>

                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="nav-forget" role="tabpanel"
                                                            aria-labelledby="nav-forget-tab">
                                                            <form class="dez-form">
                                                                <h3 class="form-title m-t0">Forget Password ?</h3>
                                                                <div class="dez-separator-outer m-b5">
                                                                    <div class="dez-separator bg-primary style-liner"></div>
                                                                </div>
                                                                <p>Enter your e-mail address below to reset your password.
                                                                </p>
                                                                <div class="form-group mb-4">
                                                                    <input name="dzName" required=""
                                                                        class="form-control" placeholder="Email Address"
                                                                        type="text">
                                                                </div>
                                                                <div class="form-group clearfix text-left">
                                                                    <button class=" active btn btn-primary"
                                                                        id="nav-personal-tab" data-bs-toggle="tab"
                                                                        data-bs-target="#nav-personal" type="button"
                                                                        role="tab" aria-controls="nav-personal"
                                                                        aria-selected="true">Back</button>
                                                                    <button
                                                                        class="btn btn-primary float-end">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane fade" id="nav-sign" role="tabpanel"
                                                            aria-labelledby="nav-sign-tab">
                                                            <div class="scrollable-form-container">
                                                                <form class="dez-form py-5" method="POST"
                                                                    action="{{ route('employer.register.store') }}">
                                                                    @csrf <!-- Add CSRF token for security -->
                                                                    <h3 class="form-title">Sign Up</h3>
                                                                    <div class="dez-separator-outer m-b5">
                                                                        <div class="dez-separator bg-primary style-liner">
                                                                        </div>
                                                                    </div>
                                                                    <p>Fill in your company information below:</p>

                                                                    <div class="form-group mt-3">
                                                                        <p>Username:</p>
                                                                        <input name="username" required
                                                                            class="form-control"
                                                                            placeholder="e.g Qusai Ali" type="text">
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Company Name:</p>
                                                                        <input name="company_name" required
                                                                            class="form-control"
                                                                            placeholder="e.g Microsoft" type="text">
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Business Sector:</p>
                                                                        <input name="business_sector" required
                                                                            class="form-control"
                                                                            placeholder="e.g Healthcare, Retail"
                                                                            type="text">
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Employee Numbers:</p>
                                                                        <input name="employee_num" class="form-control"
                                                                            placeholder="e.g 6" type="number">
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Account Manager:</p>
                                                                        <input name="account_manager" required
                                                                            class="form-control"
                                                                            placeholder="example@xyz.com" type="text">
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>City:</p>
                                                                        <input name="city" required
                                                                            class="form-control" placeholder="Amman"
                                                                            type="text">
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Phone:</p>
                                                                        <input name="phone" required
                                                                            class="form-control" placeholder="07xxxxxxxx"
                                                                            type="tel">
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Email Address:</p>
                                                                        <input name="email" required
                                                                            class="form-control"
                                                                            placeholder="youremail@xyz.com"
                                                                            type="email">
                                                                    </div>

                                                                    <div class="form-group mt-3">
                                                                        <p>Password:</p>
                                                                        <input name="password" required
                                                                            class="form-control" placeholder=""
                                                                            type="password">
                                                                    </div>

                                                                    <div class="form-group mt-3 mb-3">
                                                                        <p>Re-type Your Password:</p>
                                                                        <input name="password_confirmation" required
                                                                            class="form-control" placeholder=""
                                                                            type="password">
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
                                                                            <a href="#">Terms of Service</a> &amp; <a
                                                                                href="#">Privacy Policy</a>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group clearfix text-left">
                                                                        <button class="btn btn-primary outline gray"
                                                                            data-bs-toggle="tab"
                                                                            data-bs-target="#nav-personal" type="button"
                                                                            role="tab" aria-controls="nav-personal"
                                                                            aria-selected="true">Back</button>
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
    @endsection
