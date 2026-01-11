@extends('tenant.layouts.master')
@section('device_provisioning_active', 'active')
@push('style')
    <style>
        .provisioning-table-card {
                border-top: 3px solid #007bff;
            }

            .provisioning-table th {
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
                border-top: none;
                white-space: nowrap;
            }

            .provisioning-table td {
                white-space: nowrap;
                vertical-align: middle;
            }

            .status-badge {
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 0.75rem;
                font-weight: 600;
            }

            .status-pending {
                background-color: #fff3cd;
                color: #856404;
                border: 1px solid #ffeaa7;
            }

            .status-provisioned {
                background-color: #d1ecf1;
                color: #0c5460;
                border: 1px solid #bee5eb;
            }

            .store-alert {
                background-color: #f8d7da;
                border: 1px solid #f5c6cb;
                color: #721c24;
            }
        </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                {{-- Page Header --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <h1 class="h2 font-weight-light text-center text-primary mb-4">Device Provisioning</h1>
                    </div>
                </div>

                {{-- Action Button --}}
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <a href="{{ route('tenant.device-provisioning.create', ['tenant_domain' => app('currentTenant')->subdomain]) }}" 
                           class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-plus-circle mr-2"></i>Create New Device Provisioning Batch
                        </a>
                    </div>
                </div>

                {{-- Store Alert --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-danger store-alert text-center mb-0">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            You are provisioning for store: Site 1
                        </div>
                    </div>
                </div>

                {{-- Table Controls --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted">Showing 1-20 of 57 items.</small>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <div class="form-inline justify-content-md-end">
                            <small class="text-muted mr-2">Search:</small>
                            <input type="text" class="form-control form-control-sm" style="width: 200px;" 
                                   placeholder="Search batches...">
                        </div>
                    </div>
                </div>

                {{-- Main Table --}}
                <div class="card provisioning-table-card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 provisioning-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="40"></th>
                                        <th>Batch ID</th>
                                        <th>Status</th>
                                        <th>Manufacturer</th>
                                        <th>Model</th>
                                        <th>IMEI</th>
                                        <th>Serial #</th>
                                        <th>Store</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                    {{-- Filter Row --}}
                                    <tr class="bg-light">
                                        <th></th>
                                        <th>
                                            <input type="text" class="form-control form-control-sm" 
                                                   placeholder="Filter Batch ID...">
                                        </th>
                                        <th>
                                            <select class="form-control form-control-sm">
                                                <option value="">All Status</option>
                                                <option value="pending">Pending Initial Verification</option>
                                                <option value="provisioned">Device Provisioned</option>
                                                <option value="failed">Provisioning Failed</option>
                                            </select>
                                        </th>
                                        <th>
                                            <input type="text" class="form-control form-control-sm" 
                                                   placeholder="Filter Manufacturer...">
                                        </th>
                                        <th>
                                            <input type="text" class="form-control form-control-sm" 
                                                   placeholder="Filter Model...">
                                        </th>
                                        <th>
                                            <input type="text" class="form-control form-control-sm" 
                                                   placeholder="Filter IMEI...">
                                        </th>
                                        <th>
                                            <input type="text" class="form-control form-control-sm" 
                                                   placeholder="Filter Serial...">
                                        </th>
                                        <th>
                                            <input type="text" class="form-control form-control-sm" 
                                                   placeholder="Filter Store...">
                                        </th>
                                        <th>
                                            <input type="text" class="form-control form-control-sm" 
                                                   placeholder="Filter User...">
                                        </th>
                                        <th>
                                            <input type="text" class="form-control form-control-sm" 
                                                   placeholder="Filter Date...">
                                        </th>
                                        <th>
                                            <input type="text" class="form-control form-control-sm" 
                                                   placeholder="Filter Time...">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach([
                                            ['id' => '16SC167D', 'status' => 'Pending Initial Verification', 'status_class' => 'pending', 'manufacturer' => 'APPLE', 'model' => 'IPHONE 15, 4', 'imei' => '357702054466638', 'serial' => 'K2RWLF9075', 'store' => 'Site 1', 'user' => 'HYESESANL SHYQYRI', 'date' => '07/27/2025', 'time' => '02:02:21 PM'],
                                            ['id' => 'F2DF00F2', 'status' => 'Device Provisioned', 'status_class' => 'provisioned', 'manufacturer' => 'SAMSUNG', 'model' => 'GALAXY S24 ULTRA', 'imei' => '3529990828100382', 'serial' => 'RSCX2221JLR', 'store' => 'Site 1', 'user' => 'HYESESANL SHYQYRI', 'date' => '07/26/2025', 'time' => '04:41:30 PM'],
                                            ['id' => 'ASC5074B', 'status' => 'Device Provisioned', 'status_class' => 'provisioned', 'manufacturer' => 'APPLE', 'model' => 'IPHONE 16 Pro Max', 'imei' => '358637762733638', 'serial' => 'MYD94FRO6YC', 'store' => 'Site 1', 'user' => 'HYESESANL SHYQYRI', 'date' => '07/21/2025', 'time' => '05:37:47 PM'],
                                            ['id' => 'DDA272B1', 'status' => 'Device Provisioned', 'status_class' => 'provisioned', 'manufacturer' => 'APPLE', 'model' => 'IPHONE 16', 'imei' => '351280059612254', 'serial' => 'M43XMVM711', 'store' => 'Site 1', 'user' => 'HYESESANL SHYQYRI', 'date' => '07/19/2025', 'time' => '10:26:29 AM'],
                                            ['id' => 'X1C234D5', 'status' => 'Pending Initial Verification', 'status_class' => 'pending', 'manufacturer' => 'GOOGLE', 'model' => 'PIXEL 8 PRO', 'imei' => '358901234567890', 'serial' => 'GPX8P123456', 'store' => 'Site 1', 'user' => 'HYESESANL SHYQYRI', 'date' => '07/28/2025', 'time' => '09:15:30 AM']
                                        ] as $batch)
                                        <tr>
                                            <td class="text-center">
                                                <a href="#" onclick="viewBatch('{{ $batch['id'] }}')" class="text-primary">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                            <td><strong>{{ $batch['id'] }}</strong></td>
                                            <td>
                                                <span class="status-badge status-{{ $batch['status_class'] }}">
                                                    {{ $batch['status'] }}
                                                </span>
                                            </td>
                                            <td>{{ $batch['manufacturer'] }}</td>
                                            <td>{{ $batch['model'] }}</td>
                                            <td>{{ $batch['imei'] }}</td>
                                            <td>{{ $batch['serial'] }}</td>
                                            <td>{{ $batch['store'] }}</td>
                                            <td>{{ $batch['user'] }}</td>
                                            <td>{{ $batch['date'] }}</td>
                                            <td>{{ $batch['time'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination Footer --}}
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="text-muted mr-2">Rows per page:</span>
                            <select class="form-control form-control-sm" style="width: auto;">
                                <option>10</option>
                                <option selected>20</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                            <span class="text-muted ml-2">1 - 20 of 57</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-outline-secondary mr-2" disabled>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function viewBatch(batchId) {
            alert(`Viewing batch details for: ${batchId}`);
            // In a real application:
            // window.location.href = `/provisioning/batch/${batchId}`;
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Filter functionality
            const filterInputs = document.querySelectorAll('.provisioning-table .form-control-sm');
            filterInputs.forEach(input => {
                input.addEventListener('input', function () {
                    console.log(`Filtering by: ${this.value}`);
                    // Implement actual filtering logic
                });
            });

            // Row click functionality
            document.querySelectorAll('.provisioning-table tbody tr').forEach(row => {
                row.addEventListener('click', function (e) {
                    if (!e.target.closest('td:first-child')) {
                        const batchId = this.querySelector('td:nth-child(2) strong').textContent;
                        viewBatch(batchId);
                    }
                });
            });
        });
    </script>
@endpush