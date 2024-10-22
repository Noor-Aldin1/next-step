    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo h-30 w-25">

                <img class="brand-title" src="{{ url('mentors_css/images/logo.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="home_icon">
                                <a href="{{ route('home') }}" class="home-button" aria-label="Back to Home">
                                    <i class="mdi mdi-home"></i>
                                    <span>Back To Home</span>
                                </a>
                            </div>
                        </div>
                        <style>
                            .home-button {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                padding: 10px 15px;
                                /* Reduced padding */
                                box-shadow: rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
                                background-color: #e8e8e8;
                                border-color: #ffffff;
                                border-style: solid;
                                border-width: 6px;
                                /* Reduced border width */
                                border-radius: 20px;
                                /* Adjusted border radius */
                                font-size: 18px;
                                /* Reduced font size */
                                cursor: pointer;
                                font-weight: 700;
                                /* Slightly reduced font weight */
                                color: rgb(134, 124, 124);
                                font-family: monospace;
                                text-decoration: none;
                                /* Remove underline from link */
                                transition:
                                    transform 400ms cubic-bezier(0.68, -0.55, 0.27, 2.5),
                                    border-color 400ms ease-in-out,
                                    background-color 400ms ease-in-out;
                                word-spacing: -2px;
                            }

                            .home-button:hover {
                                background-color: #eee;
                                transform: scale(1.05);
                                /* Slightly smaller scale */
                            }

                            .home-button i {
                                margin-right: 5px;
                                /* Reduced margin */
                                fill: rgb(255, 110, 110);
                                transition: opacity 100ms ease-in-out;
                            }

                            .home-button span {
                                position: relative;
                                transition: opacity 100ms ease-in-out;
                            }

                            /* Optional: Add an animation for hover effect */


                            .home-button:hover {
                                color: #e61518;
                                animation: movingBorders 3s infinite;
                            }
                        </style>

                        <ul class="navbar-nav header-right">

                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" width="20"
                                        alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('profile.edit') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18"
                                            height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ml-2">Profile </span>
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}" class="d-inline"
                                        id="logout-form">
                                        @csrf
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="dropdown-item ai-icon">
                                            <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="18"
                                                height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-log-out">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12">
                                                </line>
                                            </svg>
                                            <span class="ml-2">Logout</span>
                                        </a>
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ********
