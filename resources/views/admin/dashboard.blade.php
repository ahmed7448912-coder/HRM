@extends('admin.layouts.app')

@section('content')
<div class="app-content pt-4 pb-5">
    <div class="container-fluid">
        <!-- ROW 1: TOP SPARKLINE WIDGETS -->
        <div class="row g-4 mb-4">
            @php
                $widgets = [
                    ['label' => 'Total Employees', 'val' => $totalEmployees, 'id' => 'sparkline-employees', 'badge' => '+0.5%'],
                    ['label' => 'Departments', 'val' => $totalDepartments, 'id' => 'sparkline-departments', 'badge' => 'Active'],
                    ['label' => 'Pending Leaves', 'val' => $pendingLeaves, 'id' => 'sparkline-leaves', 'badge' => '-2.0%'],
                    ['label' => 'Monthly Payroll', 'val' => '$'.number_format($totalPayroll / 1000, 1).'k', 'id' => 'sparkline-payroll', 'badge' => 'Stable']
                ];
            @endphp

            @foreach($widgets as $w)
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <div class="dashboard-stat-number mb-0 text-dark">{{ $w['val'] }}</div>
                                <p class="text-muted small mb-0">{{ $w['label'] }}</p>
                            </div>
                            @php
                                $badgeClass = 'bg-primary-soft text-primary';
                                if (strpos($w['badge'], '+') !== false) $badgeClass = 'bg-success-soft text-success';
                                elseif (strpos($w['badge'], '-') !== false) $badgeClass = 'bg-danger-soft text-danger';
                            @endphp
                            <span class="badge {{ $badgeClass }} rounded-pill px-3">{{ $w['badge'] }}</span>
                        </div>
                        <div style="height: 50px; width: 100%;">
                            <canvas id="{{ $w['id'] }}"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- ROW 2: PROFILE & TRENDS -->
        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="rounded-4 shadow-sm me-3 border border-white" style="width: 80px; height: 80px; object-fit: cover;" alt="User">
                            <div class="flex-grow-1">
                                <h5 class="fw-bold mb-0 text-truncate text-dark" style="max-width: 120px;">{{ $user->name }}</h5>
                                <p class="text-danger small mb-1 fw-bold">Administrator</p>
                                <p class="text-muted extra-small mb-0"><i class="bi bi-geo-alt-fill me-1"></i> Toba Tek Singh, PK</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm border-0" style="background: linear-gradient(135deg, #ff4d4d, #f06b6b);">Update</a>
                        </div>
                        
                        <h6 class="fw-bold mb-3 text-dark">Real-Time Analytics</h6>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1 small">
                                <span class="text-muted">Payroll Processing</span><span class="fw-bold text-dark">{{ $moduleProgress['payroll'] }}%</span>
                            </div>
                            <div class="progress rounded-pill shadow-inner" style="height: 7px; background: rgba(0,0,0,0.03);">
                                <div class="progress-bar bg-primary rounded-pill" style="width: {{ $moduleProgress['payroll'] }}%;"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1 small">
                                <span class="text-muted">Performance Evaluation</span><span class="fw-bold text-dark">{{ $moduleProgress['evaluation'] }}%</span>
                            </div>
                            <div class="progress rounded-pill shadow-inner" style="height: 7px; background: rgba(0,0,0,0.03);">
                                <div class="progress-bar bg-danger rounded-pill" style="width: {{ $moduleProgress['evaluation'] }}%;"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-1 small">
                                <span class="text-muted">Today Attendance</span><span class="fw-bold text-dark">{{ $moduleProgress['attendance'] }}%</span>
                            </div>
                            <div class="progress rounded-pill shadow-inner" style="height: 7px; background: rgba(0,0,0,0.03);">
                                <div class="progress-bar bg-success rounded-pill" style="width: {{ $moduleProgress['attendance'] }}%;"></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-5">
                            <div style="height: 180px; width: 180px;">
                                <canvas id="profileDonutChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0">Attendance & Leave Status</h5>
                        <div class="btn-group bg-light rounded-pill p-1 shadow-inner border border-white">
                            <a href="{{ route('admin.dashboard', ['period' => 'today']) }}" class="btn btn-sm {{ $period == 'today' ? 'btn-primary shadow-sm' : 'btn-light' }} rounded-pill px-3">Daily</a>
                            <a href="{{ route('admin.dashboard', ['period' => 'week']) }}" class="btn btn-sm {{ $period == 'week' ? 'btn-primary shadow-sm' : 'btn-light' }} rounded-pill px-3">Weekly</a>
                            <a href="{{ route('admin.dashboard', ['period' => 'month']) }}" class="btn btn-sm {{ $period == 'month' ? 'btn-primary shadow-sm' : 'btn-light' }} rounded-pill px-3">Monthly</a>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="d-flex gap-4 mb-4 small fw-medium text-muted">
                            <span><i class="bi bi-circle-fill text-success me-2" style="font-size: 8px;"></i>Present</span>
                            <span><i class="bi bi-circle-fill text-primary me-2" style="font-size: 8px;"></i>Leaves</span>
                            <span><i class="bi bi-circle-fill text-danger me-2" style="font-size: 8px;"></i>Absent</span>
                        </div>
                        <div style="height: 350px; width: 100%;">
                            <canvas id="vacancyStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 3: INTERNAL VACANCIES -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-4 overflow-hidden">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Internal Vacancies</h5>
                            <p class="text-muted extra-small mb-0">Promote growth within your teams</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle rounded-pill px-3 shadow-inner border border-white" data-bs-toggle="dropdown">{{ ucfirst($sort) }}</button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-4">
                                <li><a class="dropdown-item small py-2" href="{{ route('admin.dashboard', ['period' => $period, 'sort' => 'newest']) }}">Newest First</a></li>
                                <li><a class="dropdown-item small py-2" href="{{ route('admin.dashboard', ['period' => $period, 'sort' => 'oldest']) }}">Oldest First</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex gap-4 overflow-auto pb-3 custom-scrollbar">
                        @forelse($internalVacancies as $job)
                        <a href="{{ route('departments.index') }}" class="card border-0 shadow-sm rounded-4 p-4 flex-shrink-0 text-decoration-none vacancy-card" style="min-width: 280px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="rounded-4 p-3 text-white shadow-sm" style="background-color: {{ $job['color'] }} !important; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-briefcase-fill fs-5"></i>
                                </div>
                                <span class="badge bg-danger-soft text-danger rounded-pill px-2 py-1 extra-small">HOT</span>
                            </div>
                            <h6 class="fw-bold mb-1 text-dark">{{ $job['title'] }}</h6>
                            <p class="text-danger small mb-3 fw-bold">{{ $job['dept'] }} Department</p>
                            <div class="d-flex flex-column gap-2">
                                <div class="text-muted extra-small d-flex align-items-center"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>{{ $job['location'] }}</div>
                                <div class="text-dark fw-bold small d-flex align-items-center"><i class="bi bi-currency-dollar me-2 text-success"></i>{{ $job['salary'] }}</div>
                            </div>
                        </a>
                        @empty
                        <p class="text-muted small w-100 text-center py-4">No vacancies available at the moment.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 4: ACTIVITY & PAYROLL -->
        <div class="row g-4 mb-4">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold text-dark mb-0">Company Activity</h5>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-pill px-3 shadow-inner border border-white dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-4">
                                <li><a class="dropdown-item small py-2" href="{{ route('attendances.index') }}">View Attendances</a></li>
                                <li><a class="dropdown-item small py-2" href="{{ route('leave.index') }}">View Leaves</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="timeline-container mb-4">
                        @forelse($recentActivity as $activity)
                        <div class="timeline-item d-flex mb-4">
                            <div class="timeline-dot-container me-3 position-relative">
                                <div class="timeline-dot {{ $loop->first ? 'bg-danger shadow-sm' : 'bg-secondary-soft' }}"></div>
                                @if(!$loop->last) <div class="timeline-line"></div> @endif
                            </div>
                            <div class="d-flex align-items-center bg-light rounded-4 p-3 flex-grow-1 border border-white shadow-xs">
                                <div class="rounded-3 p-2 me-3 text-white shadow-sm {{ $activity['color'] }}">
                                    <i class="bi {{ $activity['icon'] }} fs-5"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-bold small text-dark">{{ $activity['title'] }}</h6>
                                    <p class="text-muted extra-small mb-0">{{ \Carbon\Carbon::parse($activity['time'])->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted small text-center py-4">No recent activities found.</p>
                        @endforelse
                    </div>
                    <a href="{{ route('attendances.index') }}" class="btn btn-outline-danger btn-sm rounded-pill px-4 mt-auto shadow-sm">Full Analytics</a>
                </div>
            </div>
            
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0">Payroll Budget Analytics</h5>
                        <div class="btn-group bg-light rounded-pill p-1 shadow-inner border border-white">
                            <a href="{{ route('admin.dashboard', ['period' => 'week']) }}" class="btn btn-sm {{ $period == 'week' ? 'btn-primary shadow-sm' : 'btn-light' }} rounded-pill px-3">Weekly</a>
                            <a href="{{ route('admin.dashboard', ['period' => 'month']) }}" class="btn btn-sm {{ $period == 'month' ? 'btn-primary shadow-sm' : 'btn-light' }} rounded-pill px-3">Monthly</a>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="d-flex gap-4 mb-4 small fw-medium text-muted">
                            <span><i class="bi bi-square-fill text-danger me-2" style="font-size: 8px;"></i>Paid Salary</span>
                            <span class="ms-auto">Total: <strong class="text-dark">${{ number_format($totalPayrollExpense, 0) }}</strong></span>
                        </div>
                        <div style="height: 300px; width: 100%;">
                            <canvas id="payrollBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 5: DEPARTMENTS & CAPACITY -->
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold text-dark mb-0">Team Distribution</h5>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-pill shadow-inner border border-white dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-4">
                                <li><a class="dropdown-item small py-2" href="{{ route('departments.index') }}">Manage</a></li>
                                <li><a class="dropdown-item small py-2" href="{{ route('employees.index') }}">Staff</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        @forelse($featuredDepartments as $dept)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3 p-2 rounded-3 hover-bg-light transition-all">
                                <div class="rounded-3 p-2 me-3 text-white shadow-sm" style="background-color: {{ ['#0d6efd', '#6610f2', '#d63384', '#dc3545', '#fd7e14', '#198754', '#20c997', '#0dcaf0'][$loop->index % 8] }} !important;">
                                    <i class="bi bi-building fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold small text-truncate text-dark" style="max-width: 120px;">{{ $dept->name }}</h6>
                                    <p class="text-muted extra-small mb-0">{{ $dept->employees_count }} Members</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted small">No departments available.</p>
                        @endforelse
                    </div>
                    <a href="{{ route('departments.index') }}" class="btn btn-outline-danger btn-sm rounded-pill px-4 mt-auto shadow-sm">All Teams</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4 text-center">
                    <h5 class="fw-bold text-dark text-start mb-5">Hiring Capacity</h5>
                    <div class="row g-4 justify-content-center">
                        @forelse($staffingLevels as $level)
                        <div class="col-sm-3 col-6">
                            <div class="position-relative d-inline-block mb-3">
                                <canvas id="chart-capacity-{{ $loop->index }}" width="100" height="100"></canvas>
                                <div class="position-absolute top-50 start-50 translate-middle fw-bold text-dark" style="font-size: 0.75rem;">{{ $level['perc'] }}%</div>
                            </div>
                            <h6 class="fw-bold small mb-1 text-dark">{{ $level['role'] }}</h6>
                            <p class="text-muted extra-small">{{ number_format($level['vacancy']) }} Open</p>
                        </div>
                        @empty
                        <p class="text-muted small">Loading capacity data...</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Dynamic Data for JS Initialization --}}
<script id="dashboard-data" type="application/json">
    {
        "sparklineAttendance": {!! json_encode($sparklines['attendance']) !!},
        "sparklineLeaves": {!! json_encode($sparklines['leaves']) !!},
        "attendanceTrends": {!! json_encode($attendanceTrends) !!},
        "payrollTrends": {!! json_encode($payrollTrends) !!},
        "deptNames": {!! json_encode($deptNames) !!},
        "deptCounts": {!! json_encode($deptCounts) !!},
        "staffingLevels": {!! json_encode($staffingLevels) !!}
    }
</script>

@push('styles')
<style>
    .rounded-4 { border-radius: 1.25rem !important; }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-primary-soft { background-color: rgba(13, 110, 253, 0.1) !important; }
    .bg-danger-soft { background-color: rgba(220, 53, 69, 0.1) !important; }
    .bg-secondary-soft { background-color: rgba(108, 117, 125, 0.1) !important; }
    .extra-small { font-size: 10.5px; }
    .timeline-dot { width: 12px; height: 12px; border-radius: 50%; z-index: 2; position: relative; }
    .timeline-line { position: absolute; top: 12px; left: 5px; width: 2px; height: 100%; background: #f0f2f5; z-index: 1; }
    .shadow-xs { box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    .shadow-inner { box-shadow: inset 0 2px 4px rgba(0,0,0,0.06); }
    .custom-scrollbar::-webkit-scrollbar { height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
    .hover-bg-light:hover { background-color: rgba(0,0,0,0.02); }
    .transition-all { transition: all 0.3s ease; }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="{{ asset('assets/js/admin/dashboard.js') }}"></script>
@endpush
@endsection