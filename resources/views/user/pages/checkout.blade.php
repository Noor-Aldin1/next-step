@extends('user.index')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                            <h6 class="my-0">{{ $newPackage->name }}</h6>
                            <small class="text-muted">{{ $newPackage->description }}</small>
                        </div>
                        <span class="text-muted" id="monthly-payment">${{ $newPackage->price }}</span>
                    </li>
                </ul>

                <h5 class="text-muted">Total: <span id="total-amount">${{ $totalAmount ?? $newPackage->price }}</span></h5>

                @if (isset($remainingBalance) && $remainingBalance > 0)
                    <small class="text-muted">Remaining balance from previous subscription: ${{ $remainingBalance }}</small>
                @endif
            </div>

            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>

                <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST" class="needs-validation"
                    novalidate>
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $newPackage->id }}">
                    <input type="hidden" name="remaining_balance" id="remaining_balance"
                        value="{{ $remainingBalance ?? 0 }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="username">Username</label>
                            <input disabled value="{{ auth()->user()->username }}" type="text" name="username"
                                class="form-control" id="username" required>
                            <div class="invalid-feedback">Valid Username is required.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="numberOfMonths">Number of Months</label>
                            <input type="number" name="numberOfMonths" class="form-control" id="numberOfMonths"
                                placeholder="e.g 5" value="1" min="1" required>
                            <div class="invalid-feedback">Valid number of months is required (must be at least 1).</div>
                        </div>
                    </div>
                    <h4 class="mb-3">Payment</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" name="cc-name" class="form-control" id="cc-name" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">Name on card is required.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" name="cc-number" class="form-control" id="cc-number" required>
                            <div class="invalid-feedback">Credit card number is required.</div>
                        </div>
                    </div>




                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" name="cc-expiration" class="form-control" id="cc-expiration"
                                placeholder="MM/YY" required pattern="^(0[1-9]|1[0-2])\/?([0-9]{2})$">
                            <div class="invalid-feedback">Expiration date required (format: MM/YY).</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" name="cc-cvv" class="form-control" id="cc-cvv" required
                                pattern="^[0-9]{3,4}$">
                            <div class="invalid-feedback">Security code required (3 or 4 digits).</div>
                        </div>
                    </div>
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

                    </div>
                    <hr class="mb-4">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const numberOfMonthsInput = document.getElementById('numberOfMonths');
            const monthlyPayment = {{ $newPackage->price }};
            const remainingBalance = {{ $remainingBalance ?? 0 }};
            const totalAmountDisplay = document.getElementById('total-amount');
            const checkoutForm = document.getElementById('checkoutForm');
            const expirationInput = document.getElementById('cc-expiration');

            function calculateTotal() {
                const numberOfMonths = parseInt(numberOfMonthsInput.value, 10);
                const newPackageTotal = monthlyPayment * numberOfMonths;
                const finalAmount = Math.max(0, newPackageTotal - remainingBalance);
                totalAmountDisplay.innerText = `$${finalAmount.toFixed(2)}`;
            }

            // Helper function to validate expiration date
            function validateExpirationDate() {
                const currentDate = new Date();
                const currentYear = currentDate.getFullYear() % 100; // Extract last 2 digits of the year (YY)
                const currentMonth = currentDate.getMonth() + 1; // Months are zero-indexed

                const expirationValue = expirationInput.value.trim();
                const [expMonth, expYear] = expirationValue.split('/').map(Number);

                if (
                    expYear < currentYear ||
                    (expYear === currentYear && expMonth < currentMonth)
                ) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Expiration Date',
                        text: 'The expiration date must be from the current month or later.'
                    });
                    return false;
                }
                return true;
            }

            // Event listener for number of months input change
            numberOfMonthsInput.addEventListener('input', calculateTotal);
            calculateTotal();

            checkoutForm.addEventListener('submit', function(event) {
                if (!checkoutForm.checkValidity() || !validateExpirationDate()) {
                    event.preventDefault();
                    event.stopPropagation();

                    if (!checkoutForm.checkValidity()) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Form validation error',
                            text: 'Please make sure all fields are filled out correctly.'
                        });
                    }
                } else {
                    event.preventDefault(); // For demo purposes, you can remove this in production

                    Swal.fire({
                        title: 'Processing...',
                        text: 'Please wait while we process your payment.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Simulate form submission after SweetAlert success (you can remove this in production)
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Payment Successful!',
                            text: 'Your payment has been processed successfully.'
                        }).then(() => {
                            checkoutForm.submit(); // Submit the form after success
                        });
                    }, 2000);
                }

                checkoutForm.classList.add('was-validated');
            });
        });
    </script>
@endsection
