<!-- Pre-loader Start -->
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

            <img src="{{ url('customer_css/assets/img/logo.png') }}"alt="logo'">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="{{ route('home') }}">

                    <img src=" {{ url('customer_css/assets/img/logo.png') }}" alt="logo">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a href="{{ route('home') }}"
                                class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about') }}"
                                class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jobs.felter') }}"
                                class="nav-link {{ request()->is('jobs.felter') ? 'active' : '' }}">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a href="candidate.html"
                                class="nav-link {{ request()->is('candidate.html') ? 'active' : '' }}">Monitors</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('soft') }}"
                                class="nav-link {{ request()->routeIs('soft') ? 'active' : '' }}">Soft Skills</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Packages') }}"
                                class="nav-link {{ request()->routeIs('Packages') ? 'active' : '' }}">Packages</a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link dropdown-toggle">More</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{ route('contact') }}"
                                        class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact
                                        Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('FAQ') }}"
                                        class="nav-link {{ request()->routeIs('FAQ') ? 'active' : '' }}">FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Privacy') }}"
                                        class="nav-link {{ request()->routeIs('Privacy') ? 'active' : '' }}">Privacy
                                        & Policy</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Terms') }}"
                                        class="nav-link {{ request()->routeIs('Terms') ? 'active' : '' }}">Terms &
                                        Conditions</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('business_owner') }}"
                                class="nav-link {{ request()->routeIs('business_owner') ? 'active' : '' }}"
                                style=" font-weight: bold; text-decoration: underline;"
                                title="Uncover benefits created exclusively for business owners">
                                Business
                                <span
                                    style="color:
                                #ffcb14; font-style: italic;">Owner</span>
                            </a>
                        </li>
                    </ul>



                    <div class="other-option">
                        <a href="{{ route('register') }}" class="signup-btn">Sign Up</a>
                        <a href="{{ route('login') }}" class="signin-btn">Login</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar Area End -->
