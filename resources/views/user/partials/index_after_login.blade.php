<!-- Pre-loader Start -->
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<div class="loader-content">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="sk-circle">
                <div class="sk-circle1 sk-child"></div>
                <div class="sk-circle2 sk-child"></div>
                <div class="sk-circle3 sk-child"></div>
                <div class="sk-circle4 sk-child"></div>
                <div class="sk-circle5 sk-child"></div>
                <div class="sk-circle6 sk-child"></div>
                <div class="sk-circle7 sk-child"></div>
                <div class="sk-circle8 sk-child"></div>
                <div class="sk-circle9 sk-child"></div>
                <div class="sk-circle10 sk-child"></div>
                <div class="sk-circle11 sk-child"></div>
                <div class="sk-circle12 sk-child"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader End -->

<!-- Navbar Area Start -->
<div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="index.html" class="logo">
            <img src="customer_css/assets/img/logo.png" alt="logo">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="index.html">
                    <img src=" {{ url('customer_css/assets/img/logo.png') }}" alt="logo">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about') }}" class="nav-link">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jobs.felter') }}" class="nav-link">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('mentors.index') }}" class="nav-link">Monitors</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('soft') }}" class="nav-link">Soft Skills</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link dropdown-toggle">More</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{ route('packages.index') }}" class="nav-link">Packages</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('FAQ') }}" class="nav-link">FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Privacy') }}" class="nav-link">Privacy & Policy</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Terms') }}" class="nav-link">Terms & Conditions</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <div class="other-option">
                        <!-- Avatar Profile after Login -->
                        <div class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="avatarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Avatar"
                                    class="rounded-circle" width="40" height="40">
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="avatarDropdown">
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>

                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Log Out
                                    </a>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar Area End -->
