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
          <h3 id="pageTitle">Empowering Your Success with Technology</h3>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>


      <script>
          gsap.from("#pageTitle", {
              duration: 2, // Total animation duration in seconds
              opacity: 0, // Start with opacity 0 (invisible)
              y: 50, // Start 50px below its final position
              ease: "power3.out", // Ease-out effect for smooth landing
              color: "#3498db", // Initial color before it animates to the original color
              stagger: 0.2 // Adds a small delay to each character for a slight wave effect
          });

          gsap.to("#pageTitle", {
              duration: 2, // Matches duration for continuity
              color: "#fff", // Final color for added visual effect
              delay: 2 // Delays color change until the slide-in completes
          });
      </script>
      <!-- /Header Title -->

      <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>

      <!-- Header Menu -->
      <ul class="nav user-menu">


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

                  <a class="dropdown-item" href="#"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>

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

              <form method="POST" action="{{ route('logout') }}" class="d-inline" id="logout-form">
                  @csrf
                  <a href="#" class="dropdown-item"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Logout
                  </a>
              </form>

          </div>
      </div>
      <!-- /Mobile Menu -->
  </div>
  <!-- /Header -->
