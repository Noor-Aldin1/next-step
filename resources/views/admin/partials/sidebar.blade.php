  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
      <div class="sidebar-inner slimscroll">
          <div id="sidebar-menu" class="sidebar-menu">
              <ul class="sidebar-vertical">
                  <li class="menu-title">
                      <span>Main</span>
                  </li>
                  <li class="active">
                      <a href="{{ route('admin.dashboard') }}"><i class="la la-dashcube"></i> <span> Dashboard</span>

                  </li>

                  <li class="menu-title">
                      <span>All Users</span>
                  </li>
                  <li class="submenu">
                      <a href="#"><i class="la la-user"></i> <span> Users</span>
                          <span class="menu-arrow"></span></a>
                      <ul>

                          <li>
                              <a href="#">All Employees</a>
                          </li>
                          <li><a href="departments.html">Employment Listings</a></li>
                          <li><a href="designations.html">Job Application</a></li>

                      </ul>
                  </li>
                  <li class="submenu">
                      <a href="#"><i class="la la-user"></i> <span> Employees</span>
                          <span class="menu-arrow"></span></a>
                      <ul>

                          <li>
                              <a href="{{ route('admin.employers.index') }}">All Employees</a>
                          </li>
                          <li><a href="departments.html">Employment Listings</a></li>
                          <li><a href="designations.html">Job Application</a></li>

                      </ul>
                  </li>

                  <li class="submenu">
                      <a href="#"><i class="la la-user"></i> <span> Mentors</span>
                          <span class="menu-arrow"></span></a>
                      <ul>

                          <li>
                              <a href="attendance-employee.html">All Employees</a>
                          </li>
                          <li><a href="departments.html">Employment Listings</a></li>
                          <li><a href="designations.html">Job Application</a></li>

                      </ul>
                  </li>
              </ul>
          </div>
      </div>
  </div>
  <!-- /Sidebar -->
