  <!-- Header -->
  <div class="header">
      <!-- Logo -->
      <div class="header-left">
          <a href="admin-dashboard.html" class="logo">
              <img src="{{ url('mentors_css/images/logo.png') }}" alt="Logo" />
          </a>
          <a href="admin-dashboard.html" class="logo collapse-logo">
              <img src="{{ url('mentors_css/images/logo.png') }}" alt="Logo" />
          </a>
          <a href="admin-dashboard.html" class="logo2">
              <img src="assets/img/logo2.png" width="40" height="40" alt="Logo" />
          </a>
      </div>
      <!-- /Logo -->

      <a id="toggle_btn" href="javascript:void(0);">
          <span class="bar-icon">
              <span></span>
              <span></span>
              <span></span>
          </span>
      </a>

      <!-- Header Title -->
      <div class="page-title-box">
          <h3>Dreams Technologies</h3>
      </div>
      <!-- /Header Title -->

      <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>

      <!-- Header Menu -->
      <ul class="nav user-menu">
          <!-- Search -->
          <li class="nav-item">
              <div class="top-nav-search">
                  <a href="javascript:void(0);" class="responsive-search">
                      <i class="fa-solid fa-magnifying-glass"></i>
                  </a>
                  <form action="https://smarthr.dreamstechnologies.com/html/template/search.html">
                      <input class="form-control" type="text" placeholder="Search here" />
                      <button class="btn" type="submit">
                          <i class="fa-solid fa-magnifying-glass"></i>
                      </button>
                  </form>
              </div>
          </li>
          <!-- /Search -->

          <!-- ----profile-- -->
          <li class="nav-item dropdown has-arrow main-drop">
              <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                  <span class="user-img"><img width="40"
                          height="40"src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Image" />
                      <span class="status online"></span></span>
                  <span>Admin</span>
              </a>
              <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a>
                  <a class="dropdown-item" href="settings.html">Settings</a>
                  <a class="dropdown-item" href="index.html">Logout</a>
              </div>
          </li>
      </ul>
      <!-- /Header Menu -->

      <!-- Mobile Menu -->
      <div class="dropdown mobile-user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                  class="fa-solid fa-ellipsis-vertical"></i></a>
          <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="profile.html">My Profile</a>
              <a class="dropdown-item" href="settings.html">Settings</a>
              <form method="POST" action="{{ route('logout') }}" class="d-inline" id="logout-form">
                  @csrf
                  <a class="dropdown-item"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
              </form>
          </div>
      </div>
      <!-- /Mobile Menu -->
  </div>
  <!-- /Header -->
