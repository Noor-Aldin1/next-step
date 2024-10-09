@extends('user.index')

@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg10">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Profile</h2>
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>Profile</li>
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

    <!-- Account Area Start -->
    <section class="account-section ptb-100">
        <div class="container">
            <div class="row">
                {{-- Informational aspect --}}
                @include('user.pages.profile.side_info')

                <div class="col-md-8">
                    <div class="account-details">
                        <section class="p-4 bg-white border rounded shadow">
                            <header class="mb-4">
                                <h2 class="h4">{{ __('Update Password') }}</h2>
                                <p class="text-muted">
                                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                                </p>
                            </header>

                            <form method="post" action="{{ route('password.update') }}" class="space-y-3">
                                @csrf
                                @method('put')

                                <div class="mb-3">
                                    <label for="update_password_current_password"
                                        class="form-label">{{ __('Current Password') }}</label>
                                    <input id="update_password_current_password" name="current_password" type="password"
                                        class="form-control" required autocomplete="current-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-danger mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label for="update_password_password"
                                        class="form-label">{{ __('New Password') }}</label>
                                    <input id="update_password_password" name="password" type="password"
                                        class="form-control" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="text-danger mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label for="update_password_password_confirmation"
                                        class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="update_password_password_confirmation" name="password_confirmation"
                                        type="password" class="form-control" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="text-danger mt-2" />
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                                    @if (session('status') === 'password-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                            class="text-success mb-0">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Account Area End -->

    <!-- Subscribe Section Start -->
    <section class="subscribe-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="section-title">
                        <h2>Get New Job Notifications</h2>
                        <p>Subscribe & get all related job notifications</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <form class="newsletter-form" data-toggle="validator">
                        <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL" required
                            autocomplete="off">
                        <button class="btn btn-primary" type="submit">Subscribe</button>
                        <div id="validator-newsletter" class="form-result"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Subscribe Section End -->
@endsection
