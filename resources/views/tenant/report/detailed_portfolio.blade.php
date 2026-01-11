@extends('tenant.layouts.master')
@section('report_active', 'active')

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .page-content-wrapper {
            padding: 20px;
        }

        .page-title {
            color: #495057;
            font-weight: 300;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Card styling */
        .report-card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            background-color: #f8f9fa;
        }

        .report-title {
            font-size: 1.25rem;
            font-weight: 500;
            color: #333;
        }

        .report-actions .btn {
            margin-left: 5px;
        }

        /* Quick Filter Bar */
        .quick-filter-bar {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            background: #f8f9fa;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
        }

        .quick-filter-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .quick-filter-label {
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 0;
            white-space: nowrap;
        }

        /* Table styling */
        .data-table {
            width: 100%;
            min-width: 1500px;
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
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .data-table tbody td {
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .data-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* DataTables customization */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            /* padding: 0.375rem 0.75rem; */
            margin-left: 2px;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #007bff;
            color: white !important;
            border: 1px solid #007bff;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 15px;
        }

        .no-results {
            text-align: center;
            color: #8c8c8c;
            font-style: italic;
            padding: 15px;
        }

        /* Print Styles */
        @media print {

            .report-actions,
            .quick-filter-bar,
            .dataTables_length,
            .dataTables_filter,
            .dataTables_info,
            .dataTables_paginate,
            .dt-buttons,
            .breadcrumb,
            .content-header {
                display: none !important;
            }

            .report-card {
                border: none;
                box-shadow: none;
            }

            .data-table {
                min-width: auto;
                width: 100%;
            }

            .data-table th,
            .data-table td {
                font-size: 10px;
                padding: 6px 4px;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .report-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .quick-filter-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .quick-filter-group {
                width: 100%;
            }
        }
    </style>
@endpush

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ tenant_route('tenant.report') }}">Reports</a> </li>
    <li class="breadcrumb-item active">Portfolio Detailed Report</li>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid py-4">
                <h1 class="page-title">Portfolio Detailed Report</h1>

                <div class="card report-card">
                    <div class="report-header">
                        <div class="report-title">Portfolio Detailed Report</div>
                        <div class="report-actions">
                            <button class="btn btn-outline-secondary btn-sm" id="print-btn" title="Print">
                                <i class="fas fa-print"></i>
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" id="csv-btn" title="Export CSV">
                                <i class="fas fa-file-csv"></i>
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" id="excel-btn" title="Export Excel">
                                <i class="fas fa-file-excel"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Quick Filter Bar -->
                    <div class="quick-filter-bar">
                        <div class="quick-filter-group">
                            <span class="quick-filter-label">Origination Date Range:</span>
                            <input type="text" id="dateRange" class="form-control form-control-sm"
                                value="08/01/2025 - 09/30/2025">
                        </div>
                        <div class="quick-filter-group">
                            <span class="quick-filter-label">Payment Status:</span>
                            <select id="paymentStatus" class="form-control form-control-sm">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="paid" selected>Closed - Paid in Full</option>
                                <option value="default">Defaulted</option>
                            </select>
                        </div>
                        <div class="quick-filter-group">
                            <span class="quick-filter-label">Store:</span>
                            <select id="storeSelect" class="form-control form-control-sm">
                                <option value="">All Stores</option>
                                <option value="AAT" selected>Site 1</option>
                                <option value="XYZ">XYZ RENTALS</option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-sm" id="apply-filters">Search</button>
                        <button class="btn btn-secondary btn-sm" id="clear-filters">Clear</button>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="data-table" id="portfolioTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>COMPANY</th>
                                        <th>STORENAME</th>
                                        <th>ACCOUNT MANAGER</th>
                                        <th>DEALER SUCCESS MANAGER</th>
                                        <th>POS INV#</th>
                                        <th>CONTRACT#</th>
                                        <th>CONTRACT BILLING STATUS</th>
                                        <th>CONTRACT ORIGINATION DATE</th>
                                        <th>CUSTOMER LAST NAME</th>
                                        <th>CUSTOMER FIRST NAME</th>
                                        <th>CUSTOMER PHONE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="12" class="no-results">No results found matching your search criteria.
                                        </td>
                                    </tr>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize DataTable with export buttons
            const table = $('#portfolioTable').DataTable({
                paging: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                dom: '<"d-flex justify-content-between mb-2"<"length-menu"l><"search-box"f>>t<"d-flex justify-content-between mt-2"<"info"i><"pagination"p>>',
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fas fa-copy"></i> Copy',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ],
                language: {
                    search: "Search portfolio:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                scrollX: true
            });

            // Apply filters
            $('#apply-filters').click(function () {
                const paymentStatus = $('#paymentStatus').val();
                const store = $('#storeSelect').val();

                table.columns().search(''); // Clear previous searches

                if (paymentStatus) {
                    table.column(7).search(paymentStatus, true, false); // Contract Billing Status column
                }
                if (store) {
                    table.column(2).search(store, true, false); // Store Name column
                }

                table.draw();
            });

            // Clear filters
            $('#clear-filters').click(function () {
                $('#paymentStatus').val('paid');
                $('#storeSelect').val('AAT');
                table.columns().search('').draw();
            });

            // Export button handlers
            $('#print-btn').click(function () {
                table.button('.buttons-print').trigger();
            });

            $('#csv-btn').click(function () {
                table.button('.buttons-csv').trigger();
            });

            $('#excel-btn').click(function () {
                table.button('.buttons-excel').trigger();
            });
        });
    </script>
@endpush