<body>

    <!--*******************
                                Preloader start
                            ********************-->
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
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


        <!--**********************************
                        Nav header start
                    ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="logo">
                <img src="{{ url('employer_css/images/logo.png') }}" alt="" class="mCS_img_loaded"
                    style="background-color: rgb(10, 67, 116);">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>




        <!--**********************************
                                    Header start
                                ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                Dashboard
                            </div>
                            <div class="nav-item d-flex align-items-center">
                                <div class="input-group search-area">

                                </div>

                                <span style="padding-left: 10px ; ">Add new job</span>
                                <div class="plus-icon">

                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target=".bd-example-modal-lg"><i class="fas fa-plus"></i></a>

                                </div>
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">

                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell dz-theme-mode p-0" href="javascript:void(0);">
                                    <i id="icon-light" class="fas fa-sun"></i>
                                    <i id="icon-dark" class="fas fa-moon"></i>

                                </a>
                            </li>


                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" width="20"
                                        alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{ route('employer.profile.edit') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-user2" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ms-2">Profile </span>
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}" class="d-inline"
                                        id="logout-form">
                                        @csrf
                                        <a href="#" class="dropdown-item ai-icon"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12">
                                                </line>
                                            </svg>
                                            <span class="ms-2">Logout</span>
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
