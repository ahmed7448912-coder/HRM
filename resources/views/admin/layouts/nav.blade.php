<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">

        <!-- Left Navbar -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>

        <!-- Right Navbar -->
        <ul class="navbar-nav ms-auto">

            <!-- User Menu -->
            <li class="nav-item dropdown user-menu">

                @php
                $name = Auth::user()->name ?? 'User';

                // Generate initials (e.g., "Ali Khan" → "AK")
                $nameParts = explode(' ', $name);
                $initials = strtoupper(substr($nameParts[0], 0, 1));
                if (isset($nameParts[1])) {
                $initials .= strtoupper(substr($nameParts[1], 0, 1));
                }

                // Random color based on email (consistent)
                $colors = ['#0d6efd','#6610f2','#198754','#dc3545','#fd7e14','#20c997','#6f42c1'];
                $color = $colors[crc32(Auth::user()->email ?? 'default') % count($colors)];
                @endphp

                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">

                    <!-- Avatar -->
                    <div class="avatar-circle me-2" style="background-color: {{ $color }}">
                        {{ $initials }}
                    </div>

                    <!-- Name -->
                    <span class="d-none d-md-inline">{{ $name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

                    <!-- User Info -->
                    <li class="user-header text-center p-3">
                        <div class="avatar-circle mx-auto mb-2" style="width:50px;height:50px;background-color: {{ $color }}">
                            {{ $initials }}
                        </div>
                        <p class="mb-0">{{ $name }}</p>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                    </li>

                    <!-- Menu Body -->
                    <li class="user-body p-3">
                        <div class="d-grid gap-2">
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-person-fill me-2"></i> Profile
                            </a>

                            <a href="#" class="btn btn-outline-danger btn-sm"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Sign out
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
</nav>