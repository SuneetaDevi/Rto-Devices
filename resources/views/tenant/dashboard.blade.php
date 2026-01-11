@extends('tenant.layout.app')
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .stat-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .chart-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            height: 100%;
        }

        .audit-feed {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            height: 100%;
            max-height: 600px;
            overflow-y: auto;
        }

        .audit-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .audit-item:last-child {
            border-bottom: none;
        }

        .audit-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .audit-content {
            flex: 1;
        }

        .audit-description {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .audit-user {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .chart-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #343a40;
        }

        .dashboard-header {
            margin-bottom: 30px;
        }
    </style>
    <style>
        .stat-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 25px 20px;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-item {
            padding: 0 10px;
            min-width: 120px;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 5px;
            line-height: 1.2;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.85rem;
            line-height: 1.3;
        }

        .stat-divider {
            color: #dee2e6;
            font-weight: 300;
            font-size: 1.8rem;
            padding: 0 5px;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .stat-value {
                font-size: 1.6rem;
            }

            .stat-label {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 992px) {
            .stat-divider {
                display: none;
            }

            .stat-item {
                flex: 0 0 33.333%;
                margin-bottom: 15px;
            }
        }

        @media (max-width: 576px) {
            .stat-item {
                flex: 0 0 50%;
                margin-bottom: 15px;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .stat-label {
                font-size: 0.75rem;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="dashboard-header">
            <h1 class="h3 mb-0">Device Management Dashboard</h1>
            <p class="text-muted">Overview of enrolled devices and user activities</p>
        </div>

        <div class="row">
            <!-- Left Column (80%) -->
            <div class="col-lg-8">
                <!-- Row 1 - Key Stats -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="stat-card">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <!-- Enrolled Devices -->
                                <div class="stat-item text-center flex-fill">
                                    <div class="stat-value text-primary" id="enrolled-devices">0</div>
                                    <div class="stat-label">Enrolled Devices</div>
                                </div>

                                <div class="stat-divider">|</div>

                                <!-- Enrolled Users -->
                                <div class="stat-item text-center flex-fill">
                                    <div class="stat-value text-success" id="enrolled-users">0</div>
                                    <div class="stat-label">Enrolled Users</div>
                                </div>

                                <div class="stat-divider">|</div>

                                <!-- Enrollment Pending -->
                                <div class="stat-item text-center flex-fill">
                                    <div class="stat-value text-warning" id="pending-enrollment">0</div>
                                    <div class="stat-label">Enrollment Pending</div>
                                </div>

                                <div class="stat-divider">|</div>

                                <!-- Inactive Devices -->
                                <div class="stat-item text-center flex-fill">
                                    <div class="stat-value text-secondary" id="inactive-devices">0</div>
                                    <div class="stat-label">Inactive Devices</div>
                                </div>

                                <div class="stat-divider">|</div>

                                <!-- Blocklisted Apps -->
                                <div class="stat-item text-center flex-fill">
                                    <div class="stat-value text-danger" id="blocklisted-apps">0</div>
                                    <div class="stat-label">Devices with Blocklisted Apps</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row 2 - Graphs -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="chart-container">
                            <div class="chart-title">Last Contact Summary</div>
                            <canvas id="contactChart" height="250"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="chart-container">
                            <div class="chart-title">Platform Distribution</div>
                            <canvas id="platformChart" height="250"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Row 3 - App & Data Usage -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="chart-container">
                            <div class="chart-title">App Compliance Status</div>
                            <canvas id="complianceChart" height="250"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="chart-container">
                            <div class="chart-title">Data Usage by App Category</div>
                            <canvas id="dataUsageChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column (20%) -->
            <div class="col-lg-4">
                <div class="audit-feed">
                    <h5 class="mb-3">Recent Activity</h5>
                    <div id="audit-feed-container">
                        <!-- Audit feed items will be populated here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dummy data
        const dashboardData = {
            stats: {
                enrolledDevices: 1247,
                enrolledUsers: 892,
                pendingEnrollment: 56,
                inactiveDevices: 89,
                blocklistedApps: 34,
                compliantDevices: 1120
            },
            contactData: {
                labels: ['Today', '1 Day', '2 Days', '3 Days', '4 Days', '5 Days', '6 Days', '1 Week+'],
                datasets: [{
                    label: 'Devices',
                    data: [320, 280, 210, 180, 120, 80, 40, 17],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.4
                }]
            },
            platformData: {
                labels: ['iOS', 'Android', 'Windows', 'macOS'],
                datasets: [{
                    data: [45, 35, 12, 8],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            complianceData: {
                labels: ['Compliant', 'Non-Compliant', 'Pending Review'],
                datasets: [{
                    data: [75, 15, 10],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 206, 86, 0.7)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            dataUsageData: {
                labels: ['Productivity', 'Communication', 'Entertainment', 'System', 'Other'],
                datasets: [{
                    data: [40, 25, 15, 12, 8],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            auditLog: [
                {
                    icon: 'mobile-alt',
                    iconColor: 'primary',
                    description: 'Device enrolled successfully',
                    user: 'John Smith',
                    time: '2 minutes ago'
                },
                {
                    icon: 'shield-alt',
                    iconColor: 'success',
                    description: 'Security policy updated',
                    user: 'IT Admin',
                    time: '15 minutes ago'
                },
                {
                    icon: 'exclamation-triangle',
                    iconColor: 'warning',
                    description: 'Blocklisted app detected',
                    user: 'Sarah Johnson',
                    time: '1 hour ago'
                },
                {
                    icon: 'sync',
                    iconColor: 'info',
                    description: 'Device synchronized data',
                    user: 'Michael Brown',
                    time: '2 hours ago'
                },
                {
                    icon: 'download',
                    iconColor: 'primary',
                    description: 'App installed remotely',
                    user: 'Emily Davis',
                    time: '3 hours ago'
                },
                {
                    icon: 'ban',
                    iconColor: 'danger',
                    description: 'Device quarantined',
                    user: 'Robert Wilson',
                    time: '5 hours ago'
                },
                {
                    icon: 'check-circle',
                    iconColor: 'success',
                    description: 'Compliance check passed',
                    user: 'Lisa Anderson',
                    time: '6 hours ago'
                },
                {
                    icon: 'wifi',
                    iconColor: 'info',
                    description: 'Network settings updated',
                    user: 'David Miller',
                    time: '8 hours ago'
                }
            ]
        };

        // Initialize stats with animation
        function animateValue(id, start, end, duration) {
            const obj = document.getElementById(id);
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerHTML = Math.floor(progress * (end - start) + start).toLocaleString();
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Initialize charts
        document.addEventListener('DOMContentLoaded', function () {
            // Animate stats
            animateValue('enrolled-devices', 0, dashboardData.stats.enrolledDevices, 1000);
            animateValue('enrolled-users', 0, dashboardData.stats.enrolledUsers, 1000);
            animateValue('pending-enrollment', 0, dashboardData.stats.pendingEnrollment, 1000);
            animateValue('inactive-devices', 0, dashboardData.stats.inactiveDevices, 1000);
            animateValue('blocklisted-apps', 0, dashboardData.stats.blocklistedApps, 1000);

            // Last Contact Chart
            const contactCtx = document.getElementById('contactChart').getContext('2d');
            new Chart(contactCtx, {
                type: 'line',
                data: dashboardData.contactData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Devices'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Last Contact Time'
                            }
                        }
                    }
                }
            });

            // Platform Distribution Chart
            const platformCtx = document.getElementById('platformChart').getContext('2d');
            new Chart(platformCtx, {
                type: 'doughnut',
                data: dashboardData.platformData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Compliance Chart
            const complianceCtx = document.getElementById('complianceChart').getContext('2d');
            new Chart(complianceCtx, {
                type: 'doughnut',
                data: dashboardData.complianceData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Data Usage Chart
            const dataUsageCtx = document.getElementById('dataUsageChart').getContext('2d');
            new Chart(dataUsageCtx, {
                type: 'pie',
                data: dashboardData.dataUsageData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Populate audit feed
            const auditContainer = document.getElementById('audit-feed-container');
            dashboardData.auditLog.forEach(item => {
                const auditItem = document.createElement('div');
                auditItem.className = 'audit-item';
                auditItem.innerHTML = `
                                                            <div class="audit-icon bg-${item.iconColor} bg-opacity-10 text-${item.iconColor}">
                                                                <i class="fas fa-${item.icon}"></i>
                                                            </div>
                                                            <div class="audit-content">
                                                                <div class="audit-description">${item.description}</div>
                                                                <div class="audit-user">${item.user} • ${item.time}</div>
                                                            </div>
                                                        `;
                auditContainer.appendChild(auditItem);
            });
        });
    </script>
@endpush