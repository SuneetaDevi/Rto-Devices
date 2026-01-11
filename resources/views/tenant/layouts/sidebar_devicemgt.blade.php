<!-- Device Management Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('tenant.dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light">
            <img src="{{ getIcon(DB::table('settings')->value('site_logo')) }}" alt="Logo" style="height: 30px;">
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                {{-- Active Top Link --}}
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Groups & Devices</p>
                    </a>
                </li>

                {{-- Manage Section --}}
                <li class="nav-header">MANAGE</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>Profiles</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>App Repository</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>App Update Policy</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Telecom Expense Mgmt</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p>Certificates</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Alerts</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Content Management</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-robot"></i>
                        <p>Automate OS Updates</p>
                    </a>
                </li>

                {{-- Tools Section --}}
                <li class="nav-header">TOOLS</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Announcements</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>Remote Control</p>
                    </a>
                </li>

                {{-- Conditional Access --}}
                <li class="nav-header">CONDITIONAL ACCESS</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-microsoft"></i>
                        <p>Office 365</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p>Office 365 MAM Policy</p>
                    </a>
                </li>

                {{-- Geofencing --}}
                <li class="nav-header">GEOFENCING</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>Fence Policy</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Fence Repository</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>