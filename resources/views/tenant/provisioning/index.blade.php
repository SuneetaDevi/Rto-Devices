@extends('tenant.layouts.master')
@section('device_provisioning_active', 'active')
@section('title', $title)

@push('style')
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Header Spacing */
        .page-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            font-size: 0.95rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
        }

        /* Section Spacing */
        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #eaecef;
        }

        /* Card Styling */
        .content-card {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .card-header-custom {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .card-body-custom {
            padding: 1.25rem;
        }

        /* Button Styling */
        .btn-primary-custom {
            background-color: #3498db;
            border-color: #3498db;
            border-radius: 4px;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
        }

        .btn-primary-custom:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        /* Alert Styling */
        .alert-warning-custom {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            border-radius: 4px;
            padding: 0.75rem 1rem;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.35rem 0.65rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
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

        .status-failed {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Table Styling */
        .table-container {
            width: 100%;
            padding: 0.5rem;
        }

        .data-table {
            width: 100%;
            min-width: 1200px;
            border-collapse: collapse;
        }

        .data-table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            font-weight: 600;
            padding: 0.75rem;
            text-align: left;
            white-space: nowrap;
        }

        .data-table tbody td {
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .data-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Filter Inputs */
        .filter-input {
            width: 200px;
            font-size: 0.8rem;
            padding: 0.35rem 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 3px;
            background-color: #f8f9fa;
        }

        .filter-input:focus {
            background-color: #ffffff;
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        /* Action Buttons */
        .action-btn {
            color: #6c757d;
            padding: 0.25rem 0.5rem;
            border-radius: 3px;
            transition: all 0.2s;
        }

        .action-btn:hover {
            color: #3498db;
            background-color: #e3f2fd;
        }

        /* Stats Section */
        .stats-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            flex: 1;
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 1rem;
            text-align: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #6c757d;
        }

        /* Fixed widths for table columns */
        .col-action {
            width: 60px;
        }

        .col-batch-id {
            width: 120px;
        }

        .col-status {
            width: 180px;
        }

        .col-manufacturer {
            width: 130px;
        }

        .col-model {
            width: 150px;
        }

        .col-imei {
            width: 160px;
        }

        .col-serial {
            width: 130px;
        }

        .col-store {
            width: 100px;
        }

        .col-user {
            width: 150px;
        }

        .col-date {
            width: 110px;
        }

        .col-time {
            width: 110px;
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

                {{-- Table Section --}}
                <div class="content-card">
                    <div class="card-header-custom">
                        Provisioning Batches
                    </div>
                    <div class="card-body-custom p-0">
                        <div class="table-container">
                            <table class="data-table" id="provisioningTable">
                                <thead>
                                    <tr>
                                        <th class="col-action text-center">Action</th>
                                        <th class="col-batch-id">Batch ID</th>
                                        <th class="col-status">Status</th>
                                        <th class="col-manufacturer">Manufacturer</th>
                                        <th class="col-model">Model</th>
                                        <th class="col-imei">IMEI</th>
                                        <th class="col-serial">Serial #</th>
                                        <th class="col-store">Store</th>
                                        <th class="col-user">User</th>
                                        <th class="col-date">Date</th>
                                        <th class="col-time">Time</th>
                                    </tr>
                                    {{-- Filter Row --}}
                                    <tr>
                                        <th class="text-center">-</th>
                                        <th><input type="text" class="filter-input" placeholder="Filter Batch ID"></th>
                                        <th>
                                            <select class="filter-input">
                                                <option value="">All Status</option>
                                                <option value="Pending Initial Verification">Pending</option>
                                                <option value="Device Provisioned">Provisioned</option>
                                                <option value="Provisioning Failed">Failed</option>
                                            </select>
                                        </th>
                                        <th><input type="text" class="filter-input" placeholder="Filter Manufacturer">
                                        </th>
                                        <th><input type="text" class="filter-input" placeholder="Filter Model"></th>
                                        <th><input type="text" class="filter-input" placeholder="Filter IMEI"></th>
                                        <th><input type="text" class="filter-input" placeholder="Filter Serial"></th>
                                        <th><input type="text" class="filter-input" placeholder="Filter Store"></th>
                                        <th><input type="text" class="filter-input" placeholder="Filter User"></th>
                                        <th><input type="text" class="filter-input" placeholder="Filter Date"></th>
                                        <th><input type="text" class="filter-input" placeholder="Filter Time"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($batches as $batch)
                                        <tr>
                                            <td class="text-center">
                                                <a href="#" onclick="viewBatch('{{ $batch['id'] ?? 'N/A' }}')"
                                                    class="action-btn" title="View Details">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                            <td><strong>{{ $batch['id'] ?? 'N/A' }}</strong></td>
                                            <td>
                                                <span class="status-badge status-{{ strtolower($batch['status'] ?? 'unknown') }}">
                                                    {{ $batch['status'] ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>{{ $batch['manufacturer'] ?? 'N/A' }}</td>
                                            <td>{{ $batch['model'] ?? 'N/A' }}</td>
                                            <td>{{ $batch['imei'] ?? 'N/A' }}</td>
                                            <td>{{ $batch['serial'] ?? 'N/A' }}</td>
                                            <td>{{ $batch['store'] ?? 'N/A' }}</td>
                                            <td>{{ $batch['user_name'] ?? 'N/A' }}</td>
                                            <td>{{ $batch['date'] ?? 'N/A' }}</td>
                                            <td>{{ $batch['time'] ?? 'N/A' }}</td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Include flatpickr CSS & JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function viewBatch(batchId) {
            alert(`Viewing batch details for: ${batchId}`);
        }

        $(document).ready(function() {
            var table = $('#provisioningTable').DataTable({
                responsive: false,
                paging: true,
                pageLength: 10,
                lengthMenu: [10, 20, 50, 100],
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                scrollX: true,
                fixedColumns: {
                    left: 1
                },
                columnDefs: [{
                    orderable: false,
                    targets: 0,
                    searchable: false
                }]
            });

            // Simple filter implementation
            $('.filter-input').on('keyup change', function() {
                var columnIndex = $(this).closest('th').index();
                var value = $(this).val();

                // Skip action column
                if (columnIndex !== 0) {
                    table.column(columnIndex).search(value).draw();
                }
            });

            // Flatpickr initialization
            flatpickr('.filter-input[placeholder="Filter Date"]', {
                dateFormat: 'm/d/Y',
                allowInput: true,
                onChange: function(selectedDates, dateStr) {
                    table.column(9).search(dateStr).draw();
                }
            });

            flatpickr('.filter-input[placeholder="Filter Time"]', {
                enableTime: true,
                noCalendar: true,
                dateFormat: 'h:i K',
                time_24hr: false,
                allowInput: true,
                onChange: function(selectedDates, timeStr) {
                    table.column(10).search(timeStr).draw();
                }
            });
        });
    </script>
@endpush
