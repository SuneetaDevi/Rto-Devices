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

        /* Status Tabs Styling */
        .status-tabs-container {
            background-color: #fff;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .status-tab {
            border-bottom: 3px solid transparent;
            padding: 8px 16px;
            color: #6c757d;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            margin-right: 20px;
        }

        .status-tab:hover {
            color: #0d6efd;
            border-bottom-color: #0d6efd;
        }

        .status-tab.active {
            border-bottom-color: #0d6efd;
            color: #0d6efd;
            background-color: transparent;
        }

        .status-badge {
            font-size: 0.7rem;
            margin-left: 6px;
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

        .enrollment-status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-enrolled {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-staged {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        .badge-retired {
            background-color: #f3f4f6;
            color: #374151;
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

        .pagination-info {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .warning-banner {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border: 1px solid #ffecb5;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .copyright-footer {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-top: 30px;
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

            .status-tabs-container {
                padding: 1rem;
            }

            .status-tab {
                margin-right: 10px;
                padding: 6px 12px;
                font-size: 0.875rem;
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
                {{-- Enrollment Section --}}
                <li><a href="#" class="active"><i class="fas fa-user-plus me-2"></i> Enroll</a></li>
                <li><a href="#" class="ps-4"><i class="fas fa-mobile-alt me-2"></i> Devices</a></li>
                <li><a href="#" class="ps-4"><i class="fas fa-users me-2"></i> Users</a></li>
                <li><a href="#" class="ps-4"><i class="fas fa-user-check me-2"></i> Self Enrollment</a></li>
                <li><a href="#" class="ps-4"><i class="fas fa-cog me-2"></i> Enrollment Settings</a></li>
                <li><a href="#" class="ps-4"><i class="fas fa-address-book me-2"></i> Directory Services</a></li>

                <li class="menu-heading">Apple</li>
                <li><a href="#"><i class="fab fa-apple me-2"></i> Apple Enrollment (ABM/ASM)</a></li>
                <li><a href="#"><i class="fas fa-sliders-h me-2"></i> Apple Configurator</a></li>
                <li><a href="#"><i class="fas fa-certificate me-2"></i> APNs certificate</a></li>
                <li><a href="#"><i class="fas fa-mobile me-2"></i> ME MDM App</a></li>

                <li class="menu-heading">Android</li>
                <li><a href="#"><i class="fas fa-qrcode me-2"></i> QR Code Enrollment</a></li>
                <li><a href="#"><i class="fas fa-bolt me-2"></i> Zero-touch Enrollment</a></li>
                <li><a href="#"><i class="fas fa-shield-alt me-2"></i> Knox Mobile Enrollment</a></li>
                <li><a href="#"><i class="fas fa-wifi me-2"></i> NFC Enrollment</a></li>
                <li><a href="#"><i class="fab fa-google-play me-2"></i> Managed Google Play</a></li>
                <li><a href="#"><i class="fas fa-mobile me-2"></i> ME MDM App</a></li>

                <li class="menu-heading">Windows</li>
                <li><a href="#"><i class="fas fa-laptop me-2"></i> Enroll Laptop/Surface Pro</a></li>
                <li><a href="#"><i class="fab fa-microsoft me-2"></i> Azure Enrollment (AutoPilot)</a></li>
                <li><a href="#"><i class="fas fa-desktop me-2"></i> Smart Devices</a></li>
                <li><a href="#"><i class="fas fa-mobile me-2"></i> ME MDM App</a></li>

                <li class="menu-heading">Chrome OS</li>
                <li><a href="#"><i class="fas fa-chrome me-2"></i> Chromebook Enrollment</a></li>
            </ul>
        </aside>

        {{-- 2. Main Content Wrapper --}}
        <main class="main-content-wrapper flex-grow-1 p-3">

            {{-- Page Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">Device Enrollment</h4>
                    <p class="text-muted mb-0">Manage device enrollment across all platforms</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-sync-alt me-1"></i> Refresh
                    </button>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-question-circle me-1"></i> Help
                    </button>
                </div>
            </div>

            {{-- Warning Banner --}}
            <div class="warning-banner d-flex align-items-center">
                <i class="fas fa-exclamation-triangle text-warning me-3 fs-5"></i>
                <div class="flex-grow-1">
                    <strong class="d-block mb-1">Windows Notification Service (WNS) is not Reachable!</strong>
                    <span class="text-muted">MDM is not able to reach WNS. Contact Support with the server logs.</span>
                </div>
                <button class="btn btn-sm btn-outline-warning">
                    <i class="fas fa-times me-1"></i> Dismiss
                </button>
            </div>

            {{-- Status Tabs and Enhancement Link --}}
            <div class="status-tabs-container d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex flex-wrap">
                    <div class="status-tab active">
                        Managed <span class="status-badge badge bg-primary rounded-pill">5</span>
                    </div>
                    <div class="status-tab">
                        Staged <span class="status-badge badge bg-secondary rounded-pill">33</span>
                    </div>
                    <div class="status-tab">
                        Enrollment Pending <span class="status-badge badge bg-secondary rounded-pill">1</span>
                    </div>
                    <div class="status-tab">
                        Retired <span class="status-badge badge bg-secondary rounded-pill">0</span>
                    </div>
                </div>
                <a href="#" class="text-primary small text-decoration-none d-flex align-items-center">
                    <i class="fas fa-lightbulb me-1"></i> Want more enhancements
                </a>
            </div>

            <p class="text-muted small mb-3">
                <i class="fas fa-info-circle me-1 text-primary"></i>
                Devices enrolled and already being managed are listed here.
            </p>

            {{-- Action Bar --}}
            <div class="action-bar d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex flex-wrap gap-2">
                    <div class="btn-group">
                        <button class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-plus me-1"></i> Enroll Device
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fab fa-apple me-1"></i> Apple Device</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fab fa-android me-1"></i> Android Device</a>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fab fa-windows me-1"></i> Windows Device</a>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fab fa-chrome me-1"></i> Chrome OS Device</a>
                            </li>
                        </ul>
                    </div>
                    <button class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-file-export me-1"></i> Export
                    </button>
                    <div class="btn-group">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-1"></i> Bulk Edit</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-archive me-1"></i> Archive Selected</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-1"></i> Delete Selected</a></li>
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

            {{-- Enrollment Data Table --}}
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="40"><input class="form-check-input" type="checkbox" id="select-all"></th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Device Name</th>
                                <th>Requested Time</th>
                                <th>Enrolled Time</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th width="60">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input class="form-check-input row-checkbox" type="checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width: 32px; height: 32px;">
                                            <span class="text-white fw-semibold">A</span>
                                        </div>
                                        <span>admin</span>
                                    </div>
                                </td>
                                <td>--</td>
                                <td>admin_A369i</td>
                                <td>Aug 25, 2025 02:47</td>
                                <td>Aug 25, 2025 02:47</td>
                                <td><span class="enrollment-status-badge badge-enrolled">Enrolled</span></td>
                                <td class="text-muted small">The device is marked inactive.</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-1"></i> View
                                                    Details</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-sync me-1"></i>
                                                    Re-enroll</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="#"><i
                                                        class="fas fa-trash me-1"></i> Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input row-checkbox" type="checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-success rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width: 32px; height: 32px;">
                                            <span class="text-white fw-semibold">L</span>
                                        </div>
                                        <span>Liam</span>
                                    </div>
                                </td>
                                <td>--</td>
                                <td>admin_Y7</td>
                                <td>Aug 25, 2025 02:47</td>
                                <td>Aug 25, 2025 02:47</td>
                                <td><span class="enrollment-status-badge badge-enrolled">Enrolled</span></td>
                                <td class="text-muted small">The device is marked inactive.</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-1"></i> View
                                                    Details</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-sync me-1"></i>
                                                    Re-enroll</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="#"><i
                                                        class="fas fa-trash me-1"></i> Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input row-checkbox" type="checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-warning rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width: 32px; height: 32px;">
                                            <span class="text-white fw-semibold">N</span>
                                        </div>
                                        <span>Noah</span>
                                    </div>
                                </td>
                                <td>Noah@zo...</td>
                                <td>admin_Primo_RX...</td>
                                <td>Aug 25, 2025 02:47</td>
                                <td>Aug 25, 2025 02:47</td>
                                <td><span class="enrollment-status-badge badge-enrolled">Enrolled</span></td>
                                <td class="text-muted small">The device is marked inactive.</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-1"></i> View
                                                    Details</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-sync me-1"></i>
                                                    Re-enroll</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="#"><i
                                                        class="fas fa-trash me-1"></i> Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input row-checkbox" type="checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-info rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width: 32px; height: 32px;">
                                            <span class="text-white fw-semibold">J</span>
                                        </div>
                                        <span>James</span>
                                    </div>
                                </td>
                                <td>James@z...</td>
                                <td>admin_ELUGA_Ra...</td>
                                <td>Aug 25, 2025 02:47</td>
                                <td>Aug 25, 2025 02:47</td>
                                <td><span class="enrollment-status-badge badge-enrolled">Enrolled</span></td>
                                <td class="text-muted small">The device is marked inactive.</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-1"></i> View
                                                    Details</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-sync me-1"></i>
                                                    Re-enroll</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="#"><i
                                                        class="fas fa-trash me-1"></i> Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input row-checkbox" type="checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width: 32px; height: 32px;">
                                            <span class="text-white fw-semibold">L</span>
                                        </div>
                                        <span>Logan</span>
                                    </div>
                                </td>
                                <td>Logan@z...</td>
                                <td>admin_Tele2_Midi...</td>
                                <td>Aug 25, 2025 02:47</td>
                                <td>Aug 25, 2025 02:47</td>
                                <td><span class="enrollment-status-badge badge-enrolled">Enrolled</span></td>
                                <td class="text-muted small">The device is marked inactive.</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-1"></i> View
                                                    Details</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-sync me-1"></i>
                                                    Re-enroll</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="#"><i
                                                        class="fas fa-trash me-1"></i> Remove</a></li>
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
                    <span class="text-muted me-3">Showing 1-5 of 5 enrollments</span>
                    <div class="form-group mb-0">
                        <select class="form-select form-select-sm" style="width: auto;">
                            <option>500 per page</option>
                            <option>100 per page</option>
                            <option>50 per page</option>
                            <option>25 per page</option>
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
                </ul>

                <ul class="list-unstyled small">
                    <li class="mb-2"><i class="fas fa-chevron-right text-primary me-2"></i> How to generate and add an APNs
                        Certificate?</li>
                    <li class="mb-2"><i class="fas fa-chevron-right text-primary me-2"></i> How to prevent users from
                        revoking management?</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#" class="small text-decoration-none text-primary">
                        <i class="fas fa-plus me-1"></i> More Articles
                    </a>
                    <div class="d-flex align-items-center">
                        <a href="#" class="small text-decoration-none text-primary me-3">
                            <i class="fas fa-road me-1"></i> Roadmap
                        </a>
                        <span class="text-muted">|</span>
                        <a href="#" class="small text-decoration-none text-primary ms-3">
                            <i class="fas fa-life-ring me-1"></i> Support
                        </a>
                    </div>
                </div>
            </div>

            {{-- Copyright Footer --}}
            <div class="copyright-footer text-center text-muted">
                <i class="fas fa-copyright me-1"></i> Copyright 2025. Vivate Limited. All rights reserved.
            </div>

        </main>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select all functionality
            const selectAll = document.getElementById('select-all');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            if (selectAll) {
                selectAll.addEventListener('change', function () {
                    const isChecked = this.checked;
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = isChecked;
                    });
                });
            }

            // Update "select all" checkbox based on individual selections
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
                    const someChecked = Array.from(rowCheckboxes).some(cb => cb.checked);

                    if (selectAll) {
                        selectAll.checked = allChecked;
                        selectAll.indeterminate = someChecked && !allChecked;
                    }
                });
            });

            // Status tab switching
            const statusTabs = document.querySelectorAll('.status-tab');
            statusTabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    statusTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    // In a real application, you would load different data based on the selected status
                    console.log('Switched to:', this.textContent.trim());
                });
            });
        });
    </script>
@endpush