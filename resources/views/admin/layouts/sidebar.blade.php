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
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">
                <!-- MAIN SECTION -->
                <div class="m4-group-label">MAIN</div>

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="m4-nav-link active">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @can('employee.view')
                <li class="nav-item">
                    <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Employees</span>
                    </a>
                </li>
                @endcan

                <li class="nav-item">
                    <a href="{{ route('departments.index') }}" class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                        <i class="bi bi-building"></i>
                        <span>Departments</span>
                    </a>
                </li>
                @can('attendance.view')
                <li class="nav-item">
                    <a href="{{ route('attendances.index') }}" class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check-fill"></i>
                        <span>Attendance</span>
                    </a>
                </li>
                @endcan
                <!-- FINANCE SECTION -->
                <div class="m4-group-label m4-mt-3">FINANCE</div>
                @can('leave.view')
                <li class="nav-item">
                    <a href="{{ route('leave.index') }}" class="nav-link {{ request()->routeIs('leave.*') ? 'active' : '' }}">
                        <i class="bi bi-hourglass-split"></i>
                        <span>Leave</span>
                    </a>
                </li>
                @endcan

                @can('payroll.manage')
                <li class="nav-item">
                    <a href="{{ route('payroll.index')}}" class="nav-link {{ request()->routeIs('payroll.index') ? 'active' : '' }}">
                        <i class="bi bi-cash-stack"></i>
                        <span>Payroll</span>
                    </a>
                </li>
                @endcan
                <!-- GROWTH SECTION -->
                <div class="m4-group-label m4-mt-3">GROWTH</div>

                <li class="nav-item">
                    <a href="{{ route('performance.index') }}" class="nav-link {{ request()->routeIs('performance.*') ? 'active' : '' }}">
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>Performance</span>
                    </a>
                </li>

                @can('reports.view')
                <li class="nav-item">
                    <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i>
                        <span>Reports</span>
                    </a>
                </li>
                @endcan

                {{-- Roles & Permissions (ONLY ADMIN) --}}
                @role('Admin')
                <li>
                    <a href="#">

                    </a>
                </li>
                @endrole

            </ul>
        </nav>
    </div>

</aside>