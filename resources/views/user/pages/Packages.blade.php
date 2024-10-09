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
                <h2>Buy Our Plans & Packages</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>
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

                <div class="col-lg-4 col-sm-6">
                    <div class="price-card mt-12">
                        <div class="price-top">
                            <h3>Mentor Subscription</h3>
                            <i class='bx bx-user'></i>
                            <h2>30<sub>JD/Month</sub></h2>
                        </div>

                        <div class="price-feature">
                            <ul>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Includes Job Search Only features
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Mentor matching
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Live chat with mentors
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Access to course materials
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Assignment submission and feedback
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Lecture scheduling
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Free trial period
                                </li>
                            </ul>
                        </div>

                        <div class="price-btn">
                            <a href="#" onclick="openModal()">Subscribe</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="price-card mt-12">
                        <div class="price-top">
                            <h3>Combined Plan</h3>
                            <i class='bx bx-star'></i>
                            <h2>50<sub>JD/Month</sub></h2>
                        </div>

                        <div class="price-feature">
                            <ul>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Includes all features of Job Search Only and Mentor Subscription plans
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Priority job applications
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Premium job listings
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Interview preparation resources
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Certification upon course completion
                                </li>

                                <li>
                                    <i class='bx bx-check'></i>
                                    Advanced profile customization
                                </li>
                            </ul>
                        </div>

                        <div class="price-btn">
                            <a href="#" onclick="openModal()">Subscribe</a>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="subscriptionModalLabel">Subscribe</h5>
                                <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="visa-tab" data-bs-toggle="tab" href="#visa"
                                            role="tab" aria-controls="visa" aria-selected="true">
                                            <img src="https://wallpapers.com/images/hd/visa-mastercard-logos-wh429a8o742pgm38.jpg"
                                                width="80" alt="Visa">
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="paypal-tab" data-bs-toggle="tab" href="#paypal"
                                            role="tab" aria-controls="paypal" aria-selected="false">
                                            <img src="https://seeklogo.com/images/P/paypal-logo-CA814C6B42-seeklogo.com.png"
                                                width="80" alt="PayPal">
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-4" id="myTabContent">
                                    <div class="tab-pane fade show active" id="visa" role="tabpanel"
                                        aria-labelledby="visa-tab">
                                        <div class="text-center mb-3">
                                            <h5>Credit Card</h5>
                                        </div>
                                        <form>
                                            <div class="mb-3">
                                                <label for="cardholderName" class="form-label">Cardholder Name</label>
                                                <input type="text" class="form-control" id="cardholderName" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="cardNumber" class="form-label">Card Number</label>
                                                <input type="text" class="form-control" id="cardNumber" required>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="expiryDate" class="form-label">Expiration Date</label>
                                                    <input type="text" class="form-control" id="expiryDate" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="cvv" class="form-label">CVV</label>
                                                    <input type="text" class="form-control" id="cvv" required>
                                                </div>
                                            </div>
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-pay-now">Pay Now</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="paypal" role="tabpanel"
                                        aria-labelledby="paypal-tab">
                                        <div class="text-center mb-3">
                                            <h5>PayPal</h5>
                                        </div>
                                        <form>
                                            <div class="mb-3">
                                                <label for="paypalEmail" class="form-label">PayPal Email Address</label>
                                                <input type="email" class="form-control" id="paypalEmail" required>
                                            </div>
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Pay Now</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function openModal() {
                        var modal = new bootstrap.Modal(document.getElementById('subscriptionModal'));
                        modal.show();
                    }

                    function closeModal() {
                        var modalEl = document.getElementById('subscriptionModal');
                        var modal = bootstrap.Modal.getInstance(modalEl);
                        modal.hide();
                    }

                    function showTab(tabId) {
                        var tabs = document.querySelectorAll('.tab-pane');
                        tabs.forEach(function(tab) {
                            tab.classList.remove('show', 'active');
                        });
                        document.getElementById(tabId).classList.add('show', 'active');
                    }
                </script>

            </div>
        </div>
        </div>
    </section>
    <!-- Pricing Section End -->

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
                        <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL"
                            required autocomplete="off">

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
