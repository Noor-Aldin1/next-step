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
        <a href="{{ route('home') }}" class="logo">

            <img src="{{ url('customer_css/assets/img/logo.png') }}"alt="logo'">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            @if (Auth::user()->role_id != 2)


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
                                    class="nav-link {{ request()->routeIs('jobs.felter') ? 'active' : '' }}">Jobs</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('mentors.index') }}"
                                    class="nav-link {{ request()->routeIs('mentors.index') ? 'active' : '' }}">Mentors</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('soft') }}"
                                    class="nav-link {{ request()->routeIs('soft') ? 'active' : '' }}">Soft Skills</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('packages.index') }}"
                                    class="nav-link {{ request()->routeIs('packages.index') ? 'active' : '' }}">Packages</a>
                            </li>

                            <li class="nav-item">
                                @if (Auth::check() && Auth::user()->subscriptions()->where('end_date', '>', now())->exists())
                                    <a href="{{ route('usermentor.index') }}"
                                        class="nav-link rainbow-hover {{ request()->routeIs('usermentor.index') ? 'shine' : '' }}">
                                        <span
                                            class="sp">{{ Auth::user()->subscriptions()->first()->package_id == 1 ? 'Basic Plan' : 'Pro Plan ' }}
                                        </span>
                                    </a>
                                @else
                                    <!-- No button or link shown if not a subscriber -->
                                @endif
                            </li>

                            <style>
                                .nav-link {
                                    text-decoration: none;
                                    /* Remove underline */
                                    transition: color 0.3s ease;
                                    /* Smooth transition for color */
                                }

                                .rainbow-hover {
                                    font-size: 16px;
                                    font-weight: 700;
                                    color: #ff7576;
                                    /* Default text color */
                                    background-color: #2B3044;
                                    /* Background color */
                                    border: none;
                                    outline: none;
                                    cursor: pointer;
                                    padding: 12px 24px;
                                    position: relative;
                                    line-height: 24px;
                                    border-radius: 9px;
                                    box-shadow: 0px 1px 2px #2B3044, 0px 4px 16px #2B3044;
                                    transform-style: preserve-3d;
                                    transform: scale(var(--s, 1)) perspective(600px) rotateX(var(--rx, 0deg)) rotateY(var(--ry, 0deg));
                                    perspective: 600px;
                                    transition: transform 0.1s, color 0.3s;
                                }

                                .sp {
                                    background: linear-gradient(90deg, #866ee7, #ea60da, #ed8f57, #fbd41d, #2cca91);
                                    -webkit-background-clip: text;
                                    -webkit-text-fill-color: transparent;
                                    background-clip: text;
                                    text-fill-color: transparent;
                                    display: block;
                                    position: relative;
                                }

                                .shine {
                                    position: relative;
                                    color: #fff;
                                    /* Change this to your desired text color */
                                    text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000, 0 0 15px #ff0000;
                                    /* Red glow effect */
                                    transition: text-shadow 0.3s ease-in-out;
                                }

                                .shine:hover {
                                    text-shadow: 0 0 10px #ff0000, 0 0 20px #ff0000, 0 0 30px #ff0000;
                                    /* Intensified glow on hover */
                                }

                                .rainbow-hover:hover {
                                    transform: scale(1.05);
                                    /* Slightly grow on hover */
                                    transition: transform 0.2s;
                                    /* Smooth grow transition */
                                }

                                .rainbow-hover:active {
                                    transition: 0.3s;
                                    transform: scale(0.93);
                                }

                                /* Add sparkle effect using pseudo-elements */
                                .sp:after {
                                    content: '✨';
                                    /* Star emoji */
                                    position: absolute;
                                    left: 100%;
                                    /* Position it to the right */
                                    animation: sparkle 1.5s infinite;
                                    /* Animation effect */
                                    opacity: 0;
                                    /* Start invisible */
                                }

                                @keyframes sparkle {
                                    0% {
                                        opacity: 0;
                                        transform: translateX(0);
                                    }

                                    50% {
                                        opacity: 1;
                                        transform: translateX(-10px);
                                        /* Move it a bit */
                                    }

                                    100% {
                                        opacity: 0;
                                        transform: translateX(-20px);
                                        /* Move it a bit more */
                                    }
                                }
                            </style>

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
            @else
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src=" {{ url('customer_css/assets/img/logo.png') }}" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto">

                            <li class="nav-item">
                                <a href="{{ route('mentor.dashboard') }}"
                                    class="nav-link {{ request()->routeIs('mentor.dashboard') ? 'active' : '' }}">Back
                                    to Dashboard</a>
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
            @endif


        </div>
    </div>
</div>
<!-- Navbar Area End -->
