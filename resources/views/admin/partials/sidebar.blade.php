<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="la la-dashcube"></i> <span> Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">
                    <span>All Users</span>
                </li>
                <li class="submenu">
                    <a href="#"
                        class="{{ request()->routeIs('admin.users.index') || request()->routeIs('admin.user_mentors.index') || request()->routeIs('admin.subscriptions.index') || request()->routeIs('admin.payments.index') ? 'active' : '' }}">
                        <i class="la la-user"></i> <span> Users</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                                class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">All Users</a>
                        </li>
                        <li class="submenu">
                            <a href="#"
                                class="{{ request()->routeIs('admin.subscriptions.index') || request()->routeIs('admin.payments.index') ? 'active' : '' }}">
                                <span>Subscriptions</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ route('admin.subscriptions.index') }}"
                                        class="{{ request()->routeIs('admin.subscriptions.index') ? 'active' : '' }}">All
                                        Subscriptions</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.payments.index') }}"
                                        class="{{ request()->routeIs('admin.payments.index') ? 'active' : '' }}">Payment</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('admin.user_mentors.index') }}"
                                class="{{ request()->routeIs('admin.user_mentors.index') ? 'active' : '' }}">Mentors</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"
                        class="{{ request()->routeIs('admin.employers.index') || request()->routeIs('admin.jobs.index') ? 'active' : '' }}">
                        <i class="la la-user"></i> <span> Employer</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.employers.index') }}"
                                class="{{ request()->routeIs('admin.employers.index') ? 'active' : '' }}">All
                                Employers</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.jobs.index') }}"
                                class="{{ request()->routeIs('admin.jobs.index') ? 'active' : '' }}">Job list</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"
                        class="{{ request()->routeIs('admin.employees*') || request()->routeIs('admin.departments*') || request()->routeIs('admin.designations*') ? 'active' : '' }}">
                        <i class="la la-user"></i> <span> Mentors</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.mentors.index') }}"
                                class="{{ request()->routeIs('admin.mentors.index') ? 'active' : '' }}">All Mentors</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.courses.index') }}"
                                class="{{ request()->routeIs('admin.courses.index') ? 'active' : '' }}">Courses</a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
