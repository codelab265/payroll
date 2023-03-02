<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation">
            <li class="nav-item">
                <a class="nav-link active" href="dashboard.html">
                    <i class="link-icon" data-feather="trello"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="menu-title">Employees</span>

                </a>
                <div class="submenu">
                    <ul class="submenu-item">

                        <li class="nav-item"><a class="nav-link"
                                href="{{ route('admin.departments.index') }}">Department</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.employees.index') }}">Employee
                                list</a>
                        </li>
                        <li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="link-icon" data-feather="clock"></i>
                    <span class="menu-title">Attendance</span>

                </a>
                <div class="submenu">
                    <ul class="submenu-item">

                        <li class="nav-item"><a class="nav-link"
                                href="{{ route('admin.schedules.index') }}">Schedules</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.attendance') }}">
                                Attendance
                            </a>
                        </li>
                        <li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.payroll') }}">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="menu-title">Payroll</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.users') }}">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="menu-title">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="menu-title">Settings</span>

                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.deduction.index') }}">Deductions</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.tax.index') }}">Tax</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="pages/email/read.html">Profile</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="/" target="_blank" class="nav-link">
                    <i data-feather="log-out"></i>
                    <span class="menu-title">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
