<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand / Logo -->
    <a href="{{ tenant_route("tenant.dashboard") }}" class="brand-link text-center">
        <span class="brand-text font-weight-light">Tenant Portal</span>
    </a>

    <!-- Sidebar Menu -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ tenant_route("tenant.dashboard") }}" class="nav-link @yield('dashboard_active')">
                        <i class="nav-icon fa fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ tenant_route("tenant.contract") }}" class="nav-link @yield('contract_active')">
                        <i class="nav-icon fa fa-file-contract"></i>
                        <p>Contracts</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ tenant_route("tenant.device-provisioning") }}"
                        class="nav-link @yield('device_provisioning_active')">
                        <i class="nav-icon fa fa-microchip"></i>
                        <p>Device Provisioning</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link @yield('marketing_active')">
                        <i class="nav-icon fa fa-bullhorn"></i>
                        <p>Marketing Hub</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ tenant_route("tenant.referral") }}" class="nav-link @yield('referral_active')">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Referral Program</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ tenant_route("tenant.report") }}" class="nav-link @yield('report_active')">
                        <i class="nav-icon fa fa-chart-line"></i>
                        <p>Reports</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ tenant_route("tenant.resources") }}" class="nav-link @yield('resources_active')">
                        <i class="nav-icon fa fa-book"></i>
                        <p>Resources</p>
                    </a>
                </li>

                <li class="nav-item has-treeview @yield('settings_menu_open')">
                    <a href="#" class="nav-link @yield('settings_active')">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ tenant_route("tenant.setting.users") }}"
                                class="nav-link @yield('users_active')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ tenant_route("tenant.setting.stores") }}"
                                class="nav-link @yield('stores_active')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stores</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ tenant_route('tenant.training') }}" class="nav-link @yield('training_active')">
                        <i class="nav-icon fa fa-chalkboard-teacher"></i>
                        <p>Training</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>