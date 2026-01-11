@extends('tenant.layout.app')
@section('title', $title)

@push('style')
    <style>
        .chart-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .report-card:hover {
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
                            class="flex items-center px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-chart-bar w-5 h-5 mr-3 text-blue-600"></i>
                            Reports & Analytics
                        </a>
                    </li>

                    <li class="mt-6">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Dashboard</p>
                    </li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-tachometer-alt w-5 h-5 mr-3"></i> Overview</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-chart-line w-5 h-5 mr-3"></i> Performance</a></li>

                    <li class="mt-6">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Device Reports</p>
                    </li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-mobile-alt w-5 h-5 mr-3"></i> Device Health</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-battery-half w-5 h-5 mr-3"></i> Battery Reports</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-wifi w-5 h-5 mr-3"></i> Network Usage</a></li>

                    <li class="mt-6">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Security Reports</p>
                    </li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-shield-alt w-5 h-5 mr-3"></i> Compliance</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-exclamation-triangle w-5 h-5 mr-3"></i> Security Events</a></li>

                    <li class="mt-6">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Export</p>
                    </li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-file-export w-5 h-5 mr-3"></i> Export Data</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-cog w-5 h-5 mr-3"></i> Report Settings</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Reports & Analytics</h1>
                <p class="text-gray-600">Comprehensive insights into your device management</p>
            </div>

            <!-- Date Range Selector -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                            <option>Last 7 days</option>
                            <option>Last 30 days</option>
                            <option>Last 90 days</option>
                            <option>Custom Range</option>
                        </select>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
                            <i class="fas fa-download mr-2"></i> Export Report
                        </button>
                    </div>
                    <div class="text-sm text-gray-500">
                        Last updated: Just now
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="report-card bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Devices</p>
                            <p class="text-2xl font-bold text-gray-900">1,247</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="fas fa-mobile-alt text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>12% increase</span>
                    </div>
                </div>

                <div class="report-card bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Active Devices</p>
                            <p class="text-2xl font-bold text-gray-900">984</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>8% increase</span>
                    </div>
                </div>

                <div class="report-card bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Security Issues</p>
                            <p class="text-2xl font-bold text-gray-900">23</p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-lg">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-red-600">
                        <i class="fas fa-arrow-down mr-1"></i>
                        <span>5% decrease</span>
                    </div>
                </div>

                <div class="report-card bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Avg Battery %</p>
                            <p class="text-2xl font-bold text-gray-900">74%</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <i class="fas fa-battery-half text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-gray-600">
                        <i class="fas fa-minus mr-1"></i>
                        <span>No change</span>
                    </div>
                </div>
            </div>

            <!-- Charts Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Device Platform Chart -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Device Platforms</h3>
                    <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                        <div class="text-center">
                            <div class="w-32 h-32 mx-auto mb-4 rounded-full border-8 border-blue-500 relative">
                                <div class="absolute inset-0 rounded-full border-8 border-green-500 transform -rotate-45">
                                </div>
                                <div class="absolute inset-0 rounded-full border-8 border-yellow-500 transform rotate-45">
                                </div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-lg font-bold">5</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 text-sm">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-500 rounded mr-2"></div>
                                    <span>Android (60%)</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded mr-2"></div>
                                    <span>iOS (20%)</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-500 rounded mr-2"></div>
                                    <span>Windows (20%)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Compliance Status -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Compliance Status</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Fully Compliant</span>
                                <span>85%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Needs Attention</span>
                                <span>12%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full" style="width: 12%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Non-Compliant</span>
                                <span>3%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: 3%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Security Events</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Device</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Event Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Severity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">admin_A369i</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jailbreak Detected</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">High</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2 hours ago</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">admin_Y7</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Root Access Attempt</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">High</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 hours ago</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">admin_Primo_RX
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Policy Violation</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Medium</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1 day ago</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('script')
    <script>
        // Report-specific JavaScript can go here
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Reports dashboard loaded');
        });
    </script>
@endpush
