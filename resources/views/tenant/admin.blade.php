@extends('tenant.layout.app')

@push('style')
    <style>
        .user-avatar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stats-card:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 h-screen sticky top-0 overflow-y-auto">
            <nav class="p-4">
                <ul class="space-y-1">
                    <li>
                        <a href="#"
                            class="flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg">
                            <i class="fas fa-user-shield w-5 h-5 mr-3"></i>
                            Administration
                        </a>
                    </li>

                    <li class="mt-6">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">System</p>
                    </li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-cog w-5 h-5 mr-3"></i> System Settings</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-database w-5 h-5 mr-3"></i> Database</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-server w-5 h-5 mr-3"></i> Server Status</a></li>

                    <li class="mt-6">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">User Management</p>
                    </li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-users w-5 h-5 mr-3"></i> Users</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-user-tag w-5 h-5 mr-3"></i> Roles & Permissions</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-history w-5 h-5 mr-3"></i> Audit Logs</a></li>

                    <li class="mt-6">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tenant Management</p>
                    </li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-building w-5 h-5 mr-3"></i> Tenants</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-plug w-5 h-5 mr-3"></i> Integrations</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-credit-card w-5 h-5 mr-3"></i> Billing</a></li>

                    <li class="mt-6">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Security</p>
                    </li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-lock w-5 h-5 mr-3"></i> Security Policies</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-shield-alt w-5 h-5 mr-3"></i> Firewall</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-key w-5 h-5 mr-3"></i> API Keys</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">System Administration</h1>
                    <p class="text-gray-600">Manage system settings, users, and tenant configurations</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700">
                        <i class="fas fa-save mr-2"></i> Save Changes
                    </button>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
                        <i class="fas fa-sync-alt mr-2"></i> Refresh
                    </button>
                </div>
            </div>

            <!-- System Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="stats-card bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg mr-4">
                            <i class="fas fa-server text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Server Status</p>
                            <p class="text-xl font-bold text-gray-900">Online</p>
                        </div>
                    </div>
                </div>

                <div class="stats-card bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg mr-4">
                            <i class="fas fa-database text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Database</p>
                            <p class="text-xl font-bold text-gray-900">Healthy</p>
                        </div>
                    </div>
                </div>

                <div class="stats-card bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-lg mr-4">
                            <i class="fas fa-users text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Active Users</p>
                            <p class="text-xl font-bold text-gray-900">156</p>
                        </div>
                    </div>
                </div>

                <div class="stats-card bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-lg mr-4">
                            <i class="fas fa-building text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Tenants</p>
                            <p class="text-xl font-bold text-gray-900">24</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <button class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-user-plus text-blue-600 text-xl mb-2"></i>
                        <span class="text-sm font-medium">Add User</span>
                    </button>
                    <button class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-cog text-green-600 text-xl mb-2"></i>
                        <span class="text-sm font-medium">System Config</span>
                    </button>
                    <button class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-shield-alt text-purple-600 text-xl mb-2"></i>
                        <span class="text-sm font-medium">Security</span>
                    </button>
                    <button class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-file-export text-yellow-600 text-xl mb-2"></i>
                        <span class="text-sm font-medium">Backup</span>
                    </button>
                </div>
            </div>

            <!-- System Information & Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- System Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">System Information</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Server Version</span>
                            <span class="text-sm font-medium">v4.2.1</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Last Backup</span>
                            <span class="text-sm font-medium">2 hours ago</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Database Size</span>
                            <span class="text-sm font-medium">2.4 GB</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Uptime</span>
                            <span class="text-sm font-medium">45 days</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Memory Usage</span>
                            <span class="text-sm font-medium text-green-600">68%</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">CPU Load</span>
                            <span class="text-sm font-medium text-yellow-600">42%</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Admin Activity -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Admin Activity</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div
                                    class="user-avatar w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                    AJ</div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Admin User</p>
                                    <p class="text-sm text-gray-600">Modified user permissions</p>
                                    <p class="text-xs text-gray-500">10 minutes ago</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div
                                    class="user-avatar w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                    SJ</div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">System Job</p>
                                    <p class="text-sm text-gray-600">Automated backup completed</p>
                                    <p class="text-xs text-gray-500">2 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div
                                    class="user-avatar w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                    MA</div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Master Admin</p>
                                    <p class="text-sm text-gray-600">Updated system configuration</p>
                                    <p class="text-xs text-gray-500">5 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('Admin dashboard loaded');

            // Example: Toggle system maintenance mode
            const maintenanceToggle = document.getElementById('maintenance-toggle');
            if (maintenanceToggle) {
                maintenanceToggle.addEventListener('change', function () {
                    console.log('Maintenance mode:', this.checked);
                    // API call to toggle maintenance mode would go here
                });
            }
        });
    </script>
@endpush