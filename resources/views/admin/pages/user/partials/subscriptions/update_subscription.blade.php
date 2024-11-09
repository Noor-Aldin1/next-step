@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Update User Subscription Modal -->
<div style="height: 73%;" id="update_subscription" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update User Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($subscription))
                    <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST"
                        class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT') <!-- Method Spoofing for PUT request -->

                        <input type="number" name="user_id" id="user_id" value="{{ $subscription->user_id }}" hidden>

                        <div class="row">
                            <!-- User Selection -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">User <span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="" selected>Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $user->id == $subscription->user_id ? 'selected' : '' }}>
                                                {{ $user->username }}
                                            </option>
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
                                            <option value="{{ $package->id }}"
                                                {{ $package->id == $subscription->package_id ? 'selected' : '' }}>
                                                {{ $package->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a package.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Number of Months -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Number of Months <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="number_month" min="1"
                                        id="number_month" value="{{ $subscription->number_month }}" required>
                                    <div class="invalid-feedback">
                                        Please enter the number of months.
                                    </div>
                                </div>
                            </div>

                            <!-- Start Date -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" name="start_date" id="start_date"
                                        value="{{ $subscription->start_date }}" required>
                                    <div class="invalid-feedback">
                                        Please select a start date.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- End Date -->
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">End Date <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" name="end_date" id="end_date"
                                        value="{{ $subscription->end_date }}" required>
                                    <div class="invalid-feedback">
                                        Please select an end date.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Update</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-info">No subscription data found.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize Select2 on elements with the 'select2' class (if needed for other fields)
        $('.select2').select2({
            width: '100%', // Ensures it takes full width of container
            placeholder: 'Please select', // Placeholder text
            allowClear: true // Allows clear functionality
        });

        // Example script to populate modal fields with data when an edit button is clicked
        $('a[data-bs-toggle="modal"]').on('click', function() {
            const subscriptionId = $(this).data('id');
            const userId = $(this).data('user_id');
            const packageId = $(this).data('package_id');
            const numberOfMonths = $(this).data('number_month');
            const startDate = $(this).data('start_date');
            const endDate = $(this).data('end_date');

            // Set the value of the hidden fields or inputs in the modal
            $('#update_subscription #user_id').val(userId);
            $('#update_subscription #package_id').val(packageId);
            $('#update_subscription #number_month').val(numberOfMonths);
            $('#update_subscription #start_date').val(startDate);
            $('#update_subscription #end_date').val(endDate);
        });

        // Handle the number of months change event
        $('#number_month').on('input', function() {
            var numberOfMonths = parseInt($(this).val());
            if (numberOfMonths > 0) {
                var startDate = new Date($('#start_date').val());
                var endDate = new Date(startDate);

                // Add the number of months to the start date to calculate the end date
                endDate.setMonth(endDate.getMonth() + numberOfMonths);

                // Format dates to the required format (Y-m-d\TH:i:s)
                $('#end_date').val(endDate.toISOString().slice(0, 19)); // Set the end date
            }
        });
    });

    // Bootstrap form validation
    (function() {
        'use strict'
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
