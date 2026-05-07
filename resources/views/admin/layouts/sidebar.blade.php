<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <div class="m4-brand-ring">PD</div>
        <div class="m4-brand-name">PeopleDesk</div>
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <div class="sidebar-search-container">
                <input class="m4-search" placeholder="Search employees..." />
            </div>

            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">
                <!-- MAIN SECTION -->
                <div class="m4-group-label">MAIN</div>

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="m4-nav-link active">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Employees</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('departments.index') }}" class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                        <i class="bi bi-building"></i>
                        <span>Departments</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('attendances.index') }}" class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check-fill"></i>
                        <span>Attendance</span>
                    </a>
                </li>

                <!-- FINANCE SECTION -->
                <div class="m4-group-label m4-mt-3">FINANCE</div>

                <li class="nav-item">
                    <a href="{{ route('leave.index') }}" class="nav-link {{ request()->routeIs('leave.*') ? 'active' : '' }}">
                        <i class="bi bi-hourglass-split"></i>
                        <span>Leave</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('payroll.index')}}" class="nav-link {{ request()->routeIs('payroll.index') ? 'active' : '' }}">
                        <i class="bi bi-cash-stack"></i>
                        <span>Payroll</span>
                    </a>
                </li>

                <!-- GROWTH SECTION -->
                <div class="m4-group-label m4-mt-3">GROWTH</div>

                <li class="nav-item">
                    <a href="./widgets/cards.html" class="m4-nav-link">
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>Performance</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="./layout/unfixed-sidebar.html" class="m4-nav-link">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i>
                        <span>Reports</span>
                        <span class="ms-auto badge rounded-pill bg-danger" style="font-size: 10px;">6</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>