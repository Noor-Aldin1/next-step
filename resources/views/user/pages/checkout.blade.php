@extends('user.index')
@section('content')
    <div class="container">
        <div class="py-5 text-center">
            <h2 style="color: #010c29; font-size: 24px; font-weight: bold; text-align: center; margin-top: 20px;">
                You're just one step away from unlocking your future success! <br>
                <span style="color: #fd1616;">Complete your payment to get started!</span>
            </h2>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill" id="cart-items-count">1</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{ $package->name }}</h6>
                            <small class="text-muted">{{ $package->description }}</small>
                        </div>
                        <span class="text-muted" id="monthly-payment">${{ $package->price }}</span>
                    </li>
                </ul>
                <h5 class="text-muted">Total: <span id="total-amount">$0</span></h5>
            </div>

            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>

                <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST" class="needs-validation"
                    novalidate>
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="username">Username</label>
                            <input disabled value="{{ auth()->user()->username }}" type="text" name="username"
                                class="form-control" id="username" placeholder="" required>
                            <div class="invalid-feedback">Valid Username is required.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="numberOfMonths">Number of Months</label>
                            <input type="number" name="numberOfMonths" class="form-control" id="numberOfMonths"
                                placeholder="e.g 5" value="1" min="1" required>
                            <div class="invalid-feedback">Valid number of months is required.</div>
                        </div>
                    </div>

                    <h4 class="mb-3">Payment</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked
                                required>
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="paypal">Paypal</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" name="cc-name" class="form-control" id="cc-name" placeholder=""
                                required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">Name on card is required.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" name="cc-number" class="form-control" id="cc-number" placeholder=""
                                required pattern="\d{16}">
                            <div class="invalid-feedback">Credit card number must be 16 digits.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" name="cc-expiration" class="form-control" id="cc-expiration"
                                placeholder="MM/YYYY" required pattern="^(0[1-9]|1[0-2])\/\d{4}$">
                            <div class="invalid-feedback">Expiration date required in MM/YYYY format.</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" name="cc-cvv" class="form-control" id="cc-cvv" placeholder=""
                                required pattern="\d{3}">
                            <div class="invalid-feedback">Security code must be 3 digits.</div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="agree-terms" required>
                        <label class="custom-control-label" for="agree-terms">I agree to the <a
                                href="{{ route('Terms') }}" class="text-primary">terms and conditions</a></label>
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit"> Checkout</button>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>

                <br><br>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script>
        (function() {
            'use strict';

            // Fetch the number of months and monthly payment
            const monthlyPayment = {{ $package->price }};
            const numberOfMonthsInput = document.getElementById('numberOfMonths');
            const totalAmountDisplay = document.getElementById('total-amount');

            // Function to calculate total amount
            function calculateTotal() {
                const numberOfMonths = parseInt(numberOfMonthsInput.value) || 0;
                const total = numberOfMonths * monthlyPayment;
                totalAmountDisplay.innerText = `$${total}`;
            }

            // Event listener for input change
            numberOfMonthsInput.addEventListener('input', calculateTotal);

            // Initialize total on page load
            calculateTotal();

            // Form validation
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');

                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            });
        })();
    </script>

    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('checkoutForm').addEventListener('submit', function(event) {
            // Prevent form submission
            event.preventDefault();

            // Get form values
            const username = document.getElementById('username').value;
            const numberOfMonths = document.getElementById('numberOfMonths').value;
            const ccName = document.getElementById('cc-name').value;
            const ccNumber = document.getElementById('cc-number').value;
            const ccExpiration = document.getElementById('cc-expiration').value;
            const ccCVV = document.getElementById('cc-cvv').value;

            // Regex patterns
            const ccNumberPattern = /^[0-9]{16}$/; // 16 digits
            const ccExpirationPattern = /^(0[1-9]|1[0-2])\/\d{4}$/; // MM/YYYY format
            const ccCVVPattern = /^[0-9]{3}$/; // 3 digits

            let isValid = true;
            let errorMessage = '';

            // Validate fields
            if (!ccNumberPattern.test(ccNumber)) {
                isValid = false;
                errorMessage += 'Invalid credit card number.\n';
            }
            if (!ccExpirationPattern.test(ccExpiration)) {
                isValid = false;
                errorMessage += 'Invalid expiration date format. Use MM/YYYY.\n';
            }
            if (!ccCVVPattern.test(ccCVV)) {
                isValid = false;
                errorMessage += 'Invalid CVV. It should be 3 digits.\n';
            }

            // Show error message if invalid
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: errorMessage,
                });
            } else {
                // If valid, submit the form
                this.submit();
            }
        });
    </script>
    </div>
@endsection
