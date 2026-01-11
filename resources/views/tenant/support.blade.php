@extends('tenant.layout.app')

@push('style')
    <style>
        .ticket-priority-high {
            border-left: 4px solid #dc2626;
        }

        .ticket-priority-medium {
            border-left: 4px solid #d97706;
        }

        .ticket-priority-low {
            border-left: 4px solid #059669;
        }

        .chat-bubble-user {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            border-radius: 18px 18px 4px 18px;
        }

        .chat-bubble-support {
            background: #f3f4f6;
            color: #374151;
            border-radius: 18px 18px 18px 4px;
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
                            <i class="fas fa-headset w-5 h-5 mr-3"></i>
                            Support Center
                        </a>
                    </li>

                    <li class="mt-6">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tickets</p>
                    </li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-inbox w-5 h-5 mr-3"></i> All Tickets</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-clock w-5 h-5 mr-3"></i> Pending</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-check-circle w-5 h-5 mr-3"></i> Resolved</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-exclamation-circle w-5 h-5 mr-3"></i> Urgent</a></li>

                    <li class="mt-6">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Knowledge Base</p>
                    </li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-book w-5 h-5 mr-3"></i> Articles</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-video w-5 h-5 mr-3"></i> Tutorials</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-download w-5 h-5 mr-3"></i> Downloads</a></li>

                    <li class="mt-6">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Resources</p>
                    </li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-phone-alt w-5 h-5 mr-3"></i> Contact</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-comments w-5 h-5 mr-3"></i> Live Chat</a></li>
                    <li><a href="#"
                            class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg"><i
                                class="fas fa-file-contract w-5 h-5 mr-3"></i> SLA</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Support Center</h1>
                    <p class="text-gray-600">Manage support tickets and help customers</p>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i> New Ticket
                </button>
            </div>

            <!-- Support Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Open Tickets</p>
                            <p class="text-2xl font-bold text-gray-900">24</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="fas fa-inbox text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-red-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>3 new today</span>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Pending Response</p>
                            <p class="text-2xl font-bold text-gray-900">8</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <i class="fas fa-arrow-down mr-1"></i>
                        <span>2 resolved</span>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Avg Response Time</p>
                            <p class="text-2xl font-bold text-gray-900">2.4h</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-lg">
                            <i class="fas fa-stopwatch text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <i class="fas fa-arrow-down mr-1"></i>
                        <span>Improved 15%</span>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Satisfaction Rate</p>
                            <p class="text-2xl font-bold text-gray-900">94%</p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <i class="fas fa-star text-purple-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>2% increase</span>
                    </div>
                </div>
            </div>

            <!-- Recent Tickets & Chat -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Tickets -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Tickets</h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <!-- Ticket 1 -->
                        <div class="p-4 ticket-priority-high hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 mr-2">High</span>
                                    <span class="text-sm font-medium text-gray-900">Device Enrollment Failed</span>
                                </div>
                                <span class="text-xs text-gray-500">2 hours ago</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">User: john@company.com</p>
                            <p class="text-sm text-gray-500 truncate">Android device failing to enroll with error code
                                0x8007005...</p>
                        </div>

                        <!-- Ticket 2 -->
                        <div class="p-4 ticket-priority-medium hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 mr-2">Medium</span>
                                    <span class="text-sm font-medium text-gray-900">App Deployment Issue</span>
                                </div>
                                <span class="text-xs text-gray-500">5 hours ago</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">User: sarah@company.com</p>
                            <p class="text-sm text-gray-500 truncate">Microsoft Teams app not deploying to iOS devices in
                                sales group...</p>
                        </div>

                        <!-- Ticket 3 -->
                        <div class="p-4 ticket-priority-low hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 mr-2">Low</span>
                                    <span class="text-sm font-medium text-gray-900">Password Reset</span>
                                </div>
                                <span class="text-xs text-gray-500">1 day ago</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">User: mike@company.com</p>
                            <p class="text-sm text-gray-500 truncate">User unable to reset device passcode through
                                self-service portal...</p>
                        </div>
                    </div>
                </div>

                <!-- Live Chat -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Live Chat - Sarah Johnson</h3>
                        <p class="text-sm text-gray-600">Device: admin_A369i • Issue: Battery draining quickly</p>
                    </div>
                    <div class="p-6 h-96 overflow-y-auto">
                        <div class="space-y-4">
                            <!-- Support Message -->
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                    S</div>
                                <div class="flex-1">
                                    <div class="chat-bubble-support px-4 py-2 max-w-xs">
                                        <p class="text-sm">Hi Sarah! I can see your device battery is draining faster than
                                            expected. Let me check the battery usage statistics.</p>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Support Agent • 2 minutes ago</p>
                                </div>
                            </div>

                            <!-- User Message -->
                            <div class="flex items-start space-x-3 justify-end">
                                <div class="flex-1 text-right">
                                    <div class="chat-bubble-user px-4 py-2 max-w-xs ml-auto">
                                        <p class="text-sm">Yes, it's been happening since the last update. The battery drops
                                            30% in just 2 hours.</p>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Sarah Johnson • 1 minute ago</p>
                                </div>
                                <div
                                    class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                    SJ</div>
                            </div>

                            <!-- Support Message -->
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                    S</div>
                                <div class="flex-1">
                                    <div class="chat-bubble-support px-4 py-2">
                                        <p class="text-sm">I can see high background activity from the email app. Let me
                                            adjust the sync settings and we'll monitor the improvement.</p>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Support Agent • Just now</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 border-t border-gray-200">
                        <div class="flex space-x-2">
                            <input type="text" placeholder="Type your message..."
                                class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Knowledge Base Quick Links -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Knowledge Base</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="#" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-mobile-alt text-blue-600 text-xl mr-3"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Device Enrollment</p>
                                <p class="text-xs text-gray-500">Step-by-step guides</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-shield-alt text-green-600 text-xl mr-3"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Security Setup</p>
                                <p class="text-xs text-gray-500">Best practices</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-cog text-purple-600 text-xl mr-3"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Troubleshooting</p>
                                <p class="text-xs text-gray-500">Common issues & solutions</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('Support dashboard loaded');

            // Example: Auto-refresh tickets
            setInterval(() => {
                console.log('Refreshing ticket data...');
                // API call to refresh tickets would go here
            }, 30000); // Refresh every 30 seconds

            // Example: Chat functionality
            const chatInput = document.querySelector('input[placeholder="Type your message..."]');
            const sendButton = document.querySelector('.fa-paper-plane').closest('button');

            if (sendButton && chatInput) {
                sendButton.addEventListener('click', function () {
                    const message = chatInput.value.trim();
                    if (message) {
                        console.log('Sending message:', message);
                        // API call to send message would go here
                        chatInput.value = '';
                    }
                });

                chatInput.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        sendButton.click();
                    }
                });
            }
        });
    </script>
@endpush