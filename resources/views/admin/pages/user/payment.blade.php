@extends('admin.admin_panel')

@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Payments</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Payments</li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('admin.payments.index') }}" method="GET" id="paymentFilterForm">
                <div class="row filter-row mb-4">
                    <div class="col-sm-6 col-md-3">
                        <div class="input-block mb-3 form-focus">
                            <input type="text" class="form-control floating" name="searchUserID"
                                placeholder="Search by User ID" value="{{ request()->get('searchUserID') }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="input-block mb-3 form-focus">
                            <input type="text" class="form-control floating" name="searchUserName"
                                placeholder="Search by User Name" value="{{ request()->get('searchUserName') }}">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="input-block mb-3">
                            <select style="height: 50px;" class="form-control" name="searchPaymentStatus">
                                <option value="" selected>Select Payment Status</option>
                                <option value="completed"
                                    {{ request()->get('searchPaymentStatus') == 'completed' ? 'selected' : '' }}>Completed
                                </option>
                                <option value="pending"
                                    {{ request()->get('searchPaymentStatus') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="failed"
                                    {{ request()->get('searchPaymentStatus') == 'failed' ? 'selected' : '' }}>Failed
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 d-flex">
                        <button class="btn btn-success w-50 me-2" type="submit">Search</button>
                        <button class="btn btn-secondary w-50" type="button" id="clearFilterButton"
                            onclick="clearFilters()">Clear Filter</button>
                    </div>
                </div>
            </form>
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        @if ($payments->isEmpty())
                            <div class="alert alert-warning text-center">
                                No payments found.
                            </div>
                        @else
                            <table class="table table-striped custom-table datatable" id="paymentTable">
                                <thead>
                                    <tr>
                                        <th>Payment ID</th>
                                        <th>User Name</th>
                                        <th>User ID</th>
                                        <th>Package</th>
                                        <th>Amount</th>
                                        <th>Payment Date</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->id }}</td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $payment->subscription->user->id) }}">
                                                    {{ ucfirst($payment->subscription->user->username) }}
                                                </a>
                                            </td>
                                            <td>{{ $payment->subscription->user->id }}</td>
                                            <td>{{ $payment->subscription->package->name ?? 'N/A' }}</td>
                                            <td>${{ number_format($payment->amount, 2) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</td>
                                            <td>{{ ucfirst($payment->payment_status) }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>{{ $payments->links('vendor.pagination.custom') }}</div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

    <script>
        // Clear filter fields and reset the form
        function clearFilters() {
            // Clear filter values
            document.querySelector('input[name="searchUserID"]').value = '';
            document.querySelector('input[name="searchUserName"]').value = '';
            document.querySelector('select[name="searchPaymentStatus"]').value = '';

            // Submit the form to refresh the page with no filters
            document.getElementById('paymentFilterForm').submit();
        }
    </script>

@endsection
