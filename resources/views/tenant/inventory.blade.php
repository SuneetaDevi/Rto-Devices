@extends('tenant.layout.app')

@push('style')
    <style>
        .app-layout {
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .sidebar-nav {
            width: 250px;
            background-color: #fff;
            border-right: 1px solid #e9ecef;
            padding: 0;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .sidebar-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #495057;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-nav li a:hover {
            background-color: #f1f3f5;
            color: #0d6efd;
        }

        .sidebar-nav li a.active {
            background-color: #e7f1ff;
            color: #0d6efd;
            border-left-color: #0d6efd;
            font-weight: 500;
        }

        .sidebar-nav li a.ps-4 {
            padding-left: 2.5rem !important;
        }

        .menu-heading {
            padding: 15px 15px 5px;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .chart-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1.25rem;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .chart-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 600;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .action-bar {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .table-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            font-weight: 600;
            color: #495057;
            padding: 12px 15px;
            font-size: 0.875rem;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-color: #f1f3f5;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .platform-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-android {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-ios {
            background-color: #e7f1ff;
            color: #0d6efd;
        }

        .badge-windows {
            background-color: #fff3cd;
            color: #856404;
        }

        .device-type-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
            background-color: #f8f9fa;
            color: #495057;
        }

        .quick-links {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .quick-link-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 8px 16px;
            margin-right: 10px;
            border-radius: 6px;
        }

        .quick-link-tabs .nav-link.active {
            background-color: #e7f1ff;
            color: #0d6efd;
        }

        .feature-request-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 8px;
            padding: 15px;
            margin: 15px;
        }

        .pagination-info {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .app-layout {
                flex-direction: column;
            }

            .sidebar-nav {
                width: 100%;
                height: auto;
                position: relative;
            }

            .chart-placeholder {
                width: 120px;
                height: 120px;
                font-size: 1.5rem;
            }

            .action-bar {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="app-layout d-flex">
        {{-- 1. Left Navigation/Sidebar --}}
        <aside class="sidebar-nav">
            <ul>
                {{-- Inventory Section --}}
                <li><a href="#"><i class="fas fa-boxes me-2"></i> Inventory</a></li>
                <li><a href="#" class="active ps-4"><i class="fas fa-mobile-alt me-2"></i> Devices</a></li>
                <li><a href="#" class="ps-4"><i class="fas fa-app-store-ios me-2"></i> Apps</a></li>
                <li><a href="#" class="ps-4"><i class="fas fa-map-marker-alt me-2"></i> Location Data</a></li>
                <li><a href="#" class="ps-4"><i class="fas fa-search me-2"></i> Scan Devices</a></li>

                <li class="menu-heading">Inventory Settings</li>
                <li><a href="#"><i class="fas fa-calendar-alt me-2"></i> Schedule Device Scan</a></li>
                <li><a href="#"><i class="fas fa-globe-americas me-2"></i> Geo-Tracking</a></li>
                <li><a href="#"><i class="fas fa-battery-half me-2"></i> Battery Level Tracking</a></li>
                <li><a href="#"><i class="fas fa-wifi me-2"></i> Network Performance Tracking</a></li>

                {{-- Feature Request Card --}}
                <div class="feature-request-card mt-3">
                    <h6 class="mb-2">Need new features?</h6>
                    <p class="small mb-3 opacity-75">Share a new idea or prioritize your requirement in our roadmap</p>
                    <button class="btn btn-sm btn-light w-100">
                        <i class="fas fa-road me-1"></i> View Roadmap
                    </button>
                </div>
            </ul>
        </aside>

        {{-- 2. Main Content Wrapper --}}
        <main class="main-content-wrapper flex-grow-1 p-3">

            {{-- Page Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">Device Inventory</h4>
                    <p class="text-muted mb-0">Manage and monitor all your organization's devices</p>
                </div>
                <button class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Add Device
                </button>
            </div>

            {{-- Charts Section --}}
            <div class="row mb-4">
                {{-- Device Type Chart --}}
                <div class="col-md-6 mb-3">
                    <div class="chart-card">
                        <h5 class="mb-1">Device Type</h5>
                        <p class="text-muted small mb-3">Summary of managed devices based on device type</p>
                        <div class="d-flex align-items-center">
                            <div class="chart-placeholder me-4" style="background: conic-gradient(#28a745 0% 60%, #ffc107 60% 80%, #6c757d 80% 100%);">
                                5
                            </div>
                            <ul class="list-unstyled small flex-grow-1">
                                <li class="d-flex justify-content-between align-items-center py-1">
                                    <span><span class="badge bg-success me-2"></span> Smartphone</span>
                                    <span class="fw-semibold">3</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center py-1">
                                    <span><span class="badge bg-warning me-2"></span> Tablet</span>
                                    <span class="fw-semibold">2</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center py-1">
                                    <span><span class="badge bg-primary me-2"></span> Laptop</span>
                                    <span class="fw-semibold">0</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center py-1">
                                    <span><span class="badge bg-secondary me-2"></span> Desktop</span>
                                    <span class="fw-semibold">0</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center py-1">
                                    <span><span class="badge bg-dark me-2"></span> TV</span>
                                    <span class="fw-semibold">0</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Platform Type Chart --}}
                <div class="col-md-6 mb-3">
                    <div class="chart-card">
                        <h5 class="mb-1">Platform Type</h5>
                        <p class="text-muted small mb-3">Summary of managed devices based on platform</p>
                        <div class="d-flex align-items-center">
                            <div class="chart-placeholder me-4" style="background: conic-gradient(#28a745 0% 80%, #ffc107 80% 100%);">
                                5
                            </div>
                            <ul class="list-unstyled small flex-grow-1">
                                <li class="d-flex justify-content-between align-items-center py-1">
                                    <span><span class="badge bg-success me-2"></span> Android</span>
                                    <span class="fw-semibold">4</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center py-1">
                                    <span><span class="badge bg-warning me-2"></span> iOS</span>
                                    <span class="fw-semibold">1</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center py-1">
                                    <span><span class="badge bg-info me-2"></span> Windows</span>
                                    <span class="fw-semibold">0</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center py-1">
                                    <span><span class="badge bg-dark me-2"></span> macOS</span>
                                    <span class="fw-semibold">0</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center py-1">
                                    <span><span class="badge bg-secondary me-2"></span> Chrome OS</span>
                                    <span class="fw-semibold">0</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Bar --}}
            <div class="action-bar d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-edit me-1"></i> Bulk Edit
                    </button>
                    <button class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-sync-alt me-1"></i> Refresh
                    </button>
                    <div class="btn-group">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-download me-1"></i> Export</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-print me-1"></i> Print</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-archive me-1"></i> Archive Selected</a></li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-2 mt-md-0">
                    <span class="text-primary fw-semibold me-3">Total: 5 Devices</span>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-outline-secondary" title="Sort">
                            <i class="fas fa-sort"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" title="Filter">
                            <i class="fas fa-filter"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" title="Settings">
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Data Table --}}
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="40"><input class="form-check-input" type="checkbox" id="select-all"></th>
                                <th>Username</th>
                                <th>Device Name</th>
                                <th>Email</th>
                                <th>Device Type</th>
                                <th>Platform</th>
                                <th>OS Version</th>
                                <th>Device Model</th>
                                <th>Free Space</th>
                                <th>Carrier</th>
                                <th width="40">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input class="form-check-input row-checkbox" type="checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <span class="text-white fw-semibold">L</span>
                                        </div>
                                        <span>Logan</span>
                                    </div>
                                </td>
                                <td>admin_Tele2_Midi...</td>
                                <td>Logan@zo...</td>
                                <td><span class="device-type-badge">Smartphone</span></td>
                                <td><span class="platform-badge badge-android">Android</span></td>
                                <td>12.1</td>
                                <td>Midi 1.1</td>
                                <td><span class="text-success">0.00 GB</span></td>
                                <td>--</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-1"></i> View Details</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-1"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-sync me-1"></i> Sync</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-1"></i> Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input row-checkbox" type="checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-success rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <span class="text-white fw-semibold">J</span>
                                        </div>
                                        <span>James</span>
                                    </div>
                                </td>
                                <td>admin_ELUGA_RA...</td>
                                <td>James@zo...</td>
                                <td><span class="device-type-badge">Smartphone</span></td>
                                <td><span class="platform-badge badge-android">Android</span></td>
                                <td>15.4</td>
                                <td>ELUGA Ray 500</td>
                                <td><span class="text-success">0.00 GB</span></td>
                                <td>--</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-1"></i> View Details</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-1"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-sync me-1"></i> Sync</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-1"></i> Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input row-checkbox" type="checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-warning rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <span class="text-white fw-semibold">N</span>
                                        </div>
                                        <span>Noah</span>
                                    </div>
                                </td>
                                <td>admin_Primo_RXB...</td>
                                <td>Noah@zo...</td>
                                <td><span class="device-type-badge">Tablet</span></td>
                                <td><span class="platform-badge badge-android">Android</span></td>
                                <td>16</td>
                                <td>Primo RXB Mini</td>
                                <td><span class="text-success">0.00 GB</span></td>
                                <td>--</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-1"></i> View Details</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-1"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-sync me-1"></i> Sync</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-1"></i> Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input row-checkbox" type="checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-info rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <span class="text-white fw-semibold">L</span>
                                        </div>
                                        <span>Liam</span>
                                    </div>
                                </td>
                                <td>admin_Y7</td>
                                <td>Liam@zo...</td>
                                <td><span class="device-type-badge">Smartphone</span></td>
                                <td><span class="platform-badge badge-android">Android</span></td>
                                <td>14</td>
                                <td>N10</td>
                                <td><span class="text-success">0.00 GB</span></td>
                                <td>--</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-1"></i> View Details</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-1"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-sync me-1"></i> Sync</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-1"></i> Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input row-checkbox" type="checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <span class="text-white fw-semibold">A</span>
                                        </div>
                                        <span>admin</span>
                                    </div>
                                </td>
                                <td>admin_A369i</td>
                                <td>--</td>
                                <td><span class="device-type-badge">Tablet</span></td>
                                <td><span class="platform-badge badge-android">Android</span></td>
                                <td>15</td>
                                <td>A369i</td>
                                <td><span class="text-success">0.00 GB</span></td>
                                <td>--</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-1"></i> View Details</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-1"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-sync me-1"></i> Sync</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-1"></i> Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="pagination-info d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <span class="text-muted me-3">Showing 1-5 of 5 devices</span>
                    <div class="form-group mb-0">
                        <select class="form-select form-select-sm" style="width: auto;">
                            <option>5 per page</option>
                            <option>10 per page</option>
                            <option>25 per page</option>
                            <option>50 per page</option>
                        </select>
                    </div>
                </div>
                <div class="btn-group">
                    <button class="btn btn-sm btn-outline-secondary" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            {{-- Quick Links / Knowledge Base --}}
            <div class="quick-links mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0"><i class="fas fa-link me-1 text-primary"></i> Quick Links</h6>
                    <button class="btn btn-sm btn-link text-decoration-none p-0 text-muted">
                        <i class="fas fa-times me-1"></i> Hide
                    </button>
                </div>

                <ul class="nav quick-link-tabs mb-3">
                    <li class="nav-item"><a class="nav-link active" href="#">How To's</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Knowledge Base</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
                </ul>

                <ul class="list-unstyled small">
                    <li class="mb-2"><i class="fas fa-chevron-right text-primary me-2"></i> How to wipe devices?</li>
                    <li class="mb-2"><i class="fas fa-chevron-right text-primary me-2"></i> How to perform corporate/selective wipe on devices?</li>
                    <li class="mb-2"><i class="fas fa-chevron-right text-primary me-2"></i> How to remotely reset/clear device passcode?</li>
                </ul>
                <div class="d-flex justify-content-end">
                    <a href="#" class="small text-decoration-none text-primary">
                        View More <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

        </main>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all functionality
            const selectAll = document.getElementById('select-all');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    const isChecked = this.checked;
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = isChecked;
                    });
                });
            }

            // Update "select all" checkbox based on individual selections
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
                    const someChecked = Array.from(rowCheckboxes).some(cb => cb.checked);

                    if (selectAll) {
                        selectAll.checked = allChecked;
                        selectAll.indeterminate = someChecked && !allChecked;
                    }
                });
            });

            // Simple chart data update (in a real app, this would come from an API)
            function updateChartData() {
                // This would be replaced with actual chart library integration
                console.log('Chart data would be updated here');
            }

            updateChartData();
        });
    </script>
@endpush