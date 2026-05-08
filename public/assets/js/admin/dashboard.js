/**
 * Professional Dashboard Analytics Initialization
 * Handles charts, sparklines, and dynamic data rendering.
 */
function initDashboard() {
    console.log("Initializing Dashboard Analytics...");

    const dataContainer = document.getElementById('dashboard-data');
    if (!dataContainer) {
        console.warn("Dashboard data container not found.");
        return;
    }

    let data;
    try {
        data = JSON.parse(dataContainer.textContent);
    } catch (e) {
        console.error("Failed to parse dashboard data:", e);
        return;
    }

    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#6c757d';

    // Helper: Create Sparklines
    const createSparkline = (id, dataArr, color) => {
        const el = document.getElementById(id);
        if (!el || !dataArr) return;
        
        new Chart(el.getContext('2d'), {
            type: 'line',
            data: {
                labels: dataArr.map((_, i) => i),
                datasets: [{ data: dataArr, borderColor: color, backgroundColor: 'transparent', fill: false, tension: 0.4, borderWidth: 2 }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                scales: { x: { display: false }, y: { display: false } },
                elements: { point: { radius: 0 } }
            }
        });
    };

    // Initialize Sparklines
    createSparkline('sparkline-employees', [30, 45, 35, 50, 40, 60, 55], '#ff4d4d');
    createSparkline('sparkline-departments', [10, 15, 12, 18, 14, 20, 18], '#0d6efd');
    createSparkline('sparkline-leaves', data.sparklineLeaves, '#0dcaf0');
    createSparkline('sparkline-payroll', [100, 120, 110, 130, 125, 140, 135], '#6f42c1');

    // Profile Donut Chart
    const profileCtx = document.getElementById('profileDonutChart');
    if (profileCtx && data.deptNames) {
        new Chart(profileCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: data.deptNames,
                datasets: [{
                    data: data.deptCounts,
                    backgroundColor: ['#0d6efd', '#6f42c1', '#0dcaf0', '#198754', '#ffc107', '#dc3545'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: { legend: { display: false } }
            }
        });
    }

    // Attendance & Leave Status Chart (Enhanced with Tooltips)
    const vacancyCtx = document.getElementById('vacancyStatusChart');
    if (vacancyCtx && data.attendanceTrends) {
        const ctx = vacancyCtx.getContext('2d');
        const getGradient = (color) => {
            const g = ctx.createLinearGradient(0, 0, 0, 400);
            g.addColorStop(0, color.replace('1)', '0.15)'));
            g.addColorStop(1, color.replace('1)', '0)'));
            return g;
        };

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.attendanceTrends.labels,
                datasets: [
                    { label: 'Present', data: data.attendanceTrends.present, borderColor: '#198754', backgroundColor: getGradient('rgba(25, 135, 84, 1)'), fill: true, tension: 0.4, borderWidth: 3, pointRadius: 4, pointBackgroundColor: '#fff', pointBorderWidth: 2 },
                    { label: 'Leaves', data: data.attendanceTrends.leaves, borderColor: '#0d6efd', backgroundColor: getGradient('rgba(13, 110, 253, 1)'), fill: true, tension: 0.4, borderWidth: 3, pointRadius: 4, pointBackgroundColor: '#fff', pointBorderWidth: 2 },
                    { label: 'Absent', data: data.attendanceTrends.absent, borderColor: '#dc3545', backgroundColor: getGradient('rgba(220, 53, 69, 1)'), fill: true, tension: 0.4, borderWidth: 3, pointRadius: 4, pointBackgroundColor: '#fff', pointBorderWidth: 2 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#1a1a1a',
                        bodyColor: '#444',
                        borderColor: '#e0e0e0',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 10,
                        displayColors: true,
                        usePointStyle: true,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y + ' Employees';
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.03)', borderDash: [5, 5] }, border: { display: false } },
                    x: { grid: { display: false }, border: { display: false } }
                }
            }
        });
    }

    // Payroll Bar Chart
    const barCtx = document.getElementById('payrollBarChart');
    if (barCtx && data.payrollTrends) {
        new Chart(barCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: data.payrollTrends.labels,
                datasets: [{
                    label: 'Monthly Expense',
                    data: data.payrollTrends.data,
                    backgroundColor: '#ff4d4d',
                    borderRadius: 8,
                    barThickness: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#fff',
                        titleColor: '#000',
                        bodyColor: '#444',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: (ctx) => `$${ctx.parsed.y.toLocaleString()}`
                        }
                    }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.03)', borderDash: [5, 5] }, border: { display: false } },
                    x: { grid: { display: false }, border: { display: false } }
                }
            }
        });
    }

    // Circular Capacity Progress Bars
    if (data.staffingLevels) {
        data.staffingLevels.forEach((level, i) => {
            const ctx = document.getElementById(`chart-capacity-${i}`);
            if (!ctx) return;
            new Chart(ctx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [level.perc, 100 - level.perc],
                        backgroundColor: ['#ff4d4d', '#f0f2f5'],
                        borderWidth: 0,
                        circumference: 360,
                        rotation: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '80%',
                    plugins: { legend: { display: false }, tooltip: { enabled: false } }
                }
            });
        });
    }
}

// Ensure initialization on load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDashboard);
} else {
    initDashboard();
}
