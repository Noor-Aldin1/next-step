@extends('employer.pages.panel')

@section('maincontent')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                @include('employer.pages.profile.sid_info')
                <div class="col-xl-9 col-lg-8">
                    <div class="card card-bx m-b30">
                        <div class="card-header">
                            <h6 class="title">Profile</h6>
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
                        <!-- Update Form -->
                        <form class="profile-form" action="{{ route('employer.profile.update', $employer->user_id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username"
                                            value="{{ old('username', $user->username) }}">
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ old('phone', $employer->phone) }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" class="form-control" name="company_name"
                                            value="{{ old('company_name', $employer->company_name) }}">
                                        @error('company_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Account Manager</label>
                                        <input type="text" class="form-control" name="account_manager"
                                            value="{{ old('account_manager', $employer->account_manager) }}">
                                        @error('account_manager')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Business Sector</label>
                                        <input type="text" class="form-control" name="business_sector"
                                            value="{{ old('business_sector', $employer->business_sector) }}">
                                        @error('business_sector')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Employees Numbers</label>
                                        <input type="text" class="form-control" name="employee_num"
                                            value="{{ old('employee_num', $employer->employee_num) }}">
                                        @error('employee_num')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" name="city"
                                            value="{{ old('city', $employer->city) }}">
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">UPDATE</button>
                                <a href="{{ route('employer.profile.delete') }}" class="text-primary btn-link">Forgot your
                                    password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
