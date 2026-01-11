@extends('tenant.layout.app')

@push('style')
    <style>
        /* Custom styles for the app-like layout */
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

        /* Style for the active sidebar item */
        .sidebar-nav li a.active {
            background-color: #e7f1ff;
            color: #0d6efd;
            border-left-color: #0d6efd;
            font-weight: 500;
        }

        .menu-heading {
            padding: 15px 15px 5px;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .main-content-wrapper {
            background-color: #fff;
            min-height: 100vh;
        }

        .content-tabs-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .content-tabs-header .nav-link {
            color: #6c757d;
            font-weight: 500;
            border: none;
            padding: 12px 20px;
            position: relative;
        }

        .content-tabs-header .nav-link.active {
            color: #0d6efd;
            background-color: transparent;
        }

        .content-tabs-header .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #0d6efd;
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

        .quick-links {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .sidebar-nav {
                width: 220px;
            }
        }

        @media (max-width: 768px) {
            .app-layout {
                flex-direction: column;
            }

            .sidebar-nav {
                width: 100%;
                height: auto;
                position: relative;
            }

            .action-bar {
                flex-direction: column;
                gap: 15px;
            }

            .action-bar>div {
                width: 100%;
            }

            .action-bar .btn-group {
                width: 100%;
            }

            .action-bar .dropdown-toggle {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="app-layout d-flex">
        {{-- 1. Left Navigation/Sidebar --}}
        <aside class="sidebar-nav">
            <ul>
                {{-- Top Link (Currently Active) --}}
                <li><a href="#" class="active"><i class="fas fa-layer-group me-2"></i> Groups & Devices</a></li>

                <li class="menu-heading">Manage</li>
                <li><a href="#"><i class="fas fa-user-circle me-2"></i> Profiles</a></li>
                <li><a href="#"><i class="fas fa-box me-2"></i> App Repository</a></li>
                <li><a href="#"><i class="fas fa-sync-alt me-2"></i> App Update Policy</a></li>
                <li><a href="#"><i class="fas fa-chart-line me-2"></i> Telecom Expense Mgmt</a></li>
                <li><a href="#"><i class="fas fa-certificate me-2"></i> Certificates</a></li>
                <li><a href="#"><i class="fas fa-bell me-2"></i> Alerts</a></li>
                <li><a href="#"><i class="fas fa-file-alt me-2"></i> Content Management</a></li>
                <li><a href="#"><i class="fas fa-robot me-2"></i> Automate OS Updates</a></li>

                <li class="menu-heading">Tools</li>
                <li><a href="#"><i class="fas fa-bullhorn me-2"></i> Announcements</a></li>
                <li><a href="#"><i class="fas fa-desktop me-2"></i> Remote Control</a></li>

                <li class="menu-heading">Conditional Access</li>
                <li><a href="#"><i class="fab fa-microsoft me-2"></i> Office 365</a></li>
                <li><a href="#"><i class="fas fa-shield-alt me-2"></i> Office 365 MAM policy</a></li>

                <li class="menu-heading">Geofencing</li>
                <li><a href="#"><i class="fas fa-map-marker-alt me-2"></i> Fence Policy</a></li>
                <li><a href="#"><i class="fas fa-database me-2"></i> Fence Repository</a></li>
            </ul>
        </aside>

        {{-- 2. Main Content Wrapper --}}
        <main class="main-content-wrapper flex-grow-1">
            {{-- Top Tabs/Header for Main Content --}}
            <div class="content-tabs-header">
                <ul class="nav nav-tabs border-0 px-3 pt-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-users me-1"></i> Groups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-mobile-alt me-1"></i> Devices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user me-1"></i> Users</a>
                    </li>
                </ul>
            </div>

            {{-- Main Content Area --}}
            <div class="p-3">
                {{-- Action Bar --}}
                <div class="action-bar">
                    <div class="d-flex align-items-center flex-wrap">
                        <button class="btn btn-primary me-2 mb-2">
                            <i class="fas fa-plus me-1"></i> Create Group
                        </button>
                        <button class="btn btn-outline-secondary me-2 mb-2">
                            <i class="fas fa-trash-alt me-1"></i> Delete Group
                        </button>
                        <div class="btn-group me-2 mb-2">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog me-1"></i> Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-1"></i> Edit Selected</a>
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-copy me-1"></i> Duplicate</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-archive me-1"></i> Archive</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <span class="input-group-text bg-white border-end-0"><i
                                    class="fas fa-search text-muted"></i></span>
                            <input type="text" class="form-control border-start-0" placeholder="Search groups...">
                        </div>
                    </div>
                </div>

                {{-- Groups Table --}}
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="40"><input class="form-check-input" type="checkbox"></th>
                                    <th>Group Name</th>
                                    <th>Group Type</th>
                                    <th>Members</th>
                                    <th>Profile Count</th>
                                    <th>Apps Count</th>
                                    <th>Content Count</th>
                                    <th width="100">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-folder text-warning me-2"></i>
                                            <span>Unlock Androids</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark">Device Group</span></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td><span class="status-badge status-inactive">Inactive</span></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-folder text-info me-2"></i>
                                            <span>Windows Group Devices</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark">Device Group</span></td>
                                    <td>1</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td><span class="status-badge status-active">Active</span></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-folder text-success me-2"></i>
                                            <span>Windows Group</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary">User Group</span></td>
                                    <td>2</td>
                                    <td>1</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td><span class="status-badge status-active">Active</span></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-folder text-danger me-2"></i>
                                            <span>Android Group</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark">Device Group</span></td>
                                    <td>10</td>
                                    <td>1</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td><span class="status-badge status-active">Active</span></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-folder text-primary me-2"></i>
                                            <span>iOS Testing Group</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark">Device Group</span></td>
                                    <td>5</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>1</td>
                                    <td><span class="status-badge status-active">Active</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="quick-links">
                    <h6 class="text-secondary mb-2"><i class="fas fa-link me-1"></i> Quick Links</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="#" class="btn btn-sm btn-outline-primary">How To's</a>
                        <a href="#" class="btn btn-sm btn-outline-primary">Documentation</a>
                        <a href="#" class="btn btn-sm btn-outline-primary">Support</a>
                        <a href="#" class="btn btn-sm btn-outline-primary">API Reference</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('script')
    {{-- Bootstrap JS and any additional scripts would go here --}}
    <script>
        // Simple script to handle table row selection
        document.addEventListener('DOMContentLoaded', function () {
            const checkAll = document.querySelector('thead .form-check-input');
            const rowCheckboxes = document.querySelectorAll('tbody .form-check-input');

            if (checkAll) {
                checkAll.addEventListener('change', function () {
                    const isChecked = this.checked;
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = isChecked;
                    });
                });
            }

            // Update "check all" checkbox based on individual selections
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
                    const someChecked = Array.from(rowCheckboxes).some(cb => cb.checked);

                    if (checkAll) {
                        checkAll.checked = allChecked;
                        checkAll.indeterminate = someChecked && !allChecked;
                    }
                });
            });
        });
    </script>
@endpush