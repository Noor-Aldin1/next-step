@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Add Subscription Modal -->
<div style="height: 73%;" id="add_subscription" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="subscriptionForm" action="{{ route('admin.subscriptions.store') }}" method="POST"
                    class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="row">
                        <!-- User Selection -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">User <span class="text-danger">*</span></label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option value="" selected>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select a user.
                                </div>
                            </div>
                        </div>

                        <!-- Package Selection -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Package <span class="text-danger">*</span></label>
                                <select name="package_id" class="form-control" required>
                                    <option value="" selected>Select Package</option>
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select a package.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Number of Months -->
                    <div class="col-sm-6">
                        <div class="input-block mb-3">
                            <label class="col-form-label">Number of Months <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="number_month" min="1"
                                id="number_month" required>
                            <div class="invalid-feedback">
                                Please enter the number of months.
                            </div>
                        </div>
                    </div>

                    <!-- Start and End Dates -->
                    <div class="row">
                        <!-- Start Date (Calculated Automatically) -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Start Date <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="start_date" id="start_date"
                                    readonly required>
                                <div class="invalid-feedback">
                                    Please select a start date.
                                </div>
                            </div>
                        </div>

                        <!-- End Date (Calculated Automatically) -->
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">End Date <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="end_date" id="end_date"
                                    readonly required>
                                <div class="invalid-feedback">
                                    Please select an end date.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // When the page is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Get elements
        var numberMonthInput = document.getElementById('number_month');
        var startDateInput = document.getElementById('start_date');
        var endDateInput = document.getElementById('end_date');
        var subscriptionForm = document.getElementById('subscriptionForm');

        // Function to format a date to Y-m-d\TH:i:s (e.g., 2024-11-09T15:30:00)
        function formatDate(date) {
            var year = date.getFullYear();
            var month = String(date.getMonth() + 1).padStart(2, '0');
            var day = String(date.getDate()).padStart(2, '0');
            var hours = String(date.getHours()).padStart(2, '0');
            var minutes = String(date.getMinutes()).padStart(2, '0');
            var seconds = String(date.getSeconds()).padStart(2, '0');
            return `${year}-${month}-${day}T${hours}:${minutes}:${seconds}`;
        }

        // Function to update start and end dates
        function updateDates() {
            var numberOfMonths = parseInt(numberMonthInput.value);
            if (numberOfMonths > 0) {
                // Get current date
                var startDate = new Date();
                var endDate = new Date(startDate);

                // Format and set start date
                startDateInput.value = formatDate(startDate);

                // Add the number of months to the current date to calculate the end date
                endDate.setMonth(endDate.getMonth() + numberOfMonths);
                endDateInput.value = formatDate(endDate);

                // Log the values for debugging
                console.log("Start Date: " + startDateInput.value);
                console.log("End Date: " + endDateInput.value);
            }
        }

        // Trigger calculation of dates when number of months is changed
        numberMonthInput.addEventListener('input', updateDates);

        // Handle form submission
        subscriptionForm.addEventListener('submit', function(e) {
            var numberOfMonths = parseInt(numberMonthInput.value);

            if (numberOfMonths <= 0) {
                e.preventDefault();
                alert("Please enter a valid number of months.");
                return;
            }

            // Ensure start and end date are set before submission
            if (!startDateInput.value || !endDateInput.value) {
                e.preventDefault();
                alert("Please ensure that the start and end dates are correctly populated.");
                return;
            }

            // Log values before submission
            console.log("Start Date Before Submit: " + startDateInput.value);
            console.log("End Date Before Submit: " + endDateInput.value);
        });
    });
</script>
<script>
    // JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';

        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery and Select2 JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
