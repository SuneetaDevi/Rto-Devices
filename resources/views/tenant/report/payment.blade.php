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
                border-top: 3px solid #007bff;
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

            /* Filter Chip */
            .filter-chip {
                background-color: #e9ecef;
                border-radius: 50rem;
                padding: 0.3rem 0.75rem;
                font-size: 0.85rem;
                margin-bottom: 15px;
                display: inline-block;
            }

            /* Table styling */
            .data-table {
                width: 100%;
                min-width: 2000px;
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
                font-size: 0.85rem;
            }

            .data-table tbody tr:hover {
                background-color: #f8f9fa;
            }

            .text-right {
                text-align: right;
            }

            .contract-link {
                color: #007bff;
                text-decoration: none;
            }

            .contract-link:hover {
                text-decoration: underline;
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

            /* Print Styles */
            @media print {
                .report-actions,
                .filter-chip,
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
                    border-top: none;
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
            }
        </style>
@endpush
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ tenant_route('tenant.report') }}">Reports</a> </li>
    <li class="breadcrumb-item active">Payment Report</li>
@endsection

@section('content')
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid py-4">
                    <h1 class="page-title">Payments Report</h1>

                    <div class="card report-card">
                        <div class="report-header">
                            <div class="report-title">Payments Report</div>
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

                        <!-- Filter Chip -->
                        <div class="px-4 pt-3">
                            <span class="filter-chip">
                                11/1/2025 - 11/8/2025
                                <i class="fas fa-times-circle ml-2 cursor-pointer" onclick="removeFilter()"></i>
                            </span>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="data-table" id="paymentsTable">
                                    <thead>
                                        <tr>
                                            <th>Organization</th>
                                            <th>Company</th>
                                            <th>Store</th>
                                            <th>Contract Number</th>
                                            <th>Time Stamp <i class="fas fa-caret-down"></i></th>
                                            <th>Customer Name</th>
                                            <th>Payment Type</th>
                                            <th>Status</th>
                                            <th>Reason Desc</th>
                                            <th class="text-right">Amount</th>
                                            <th class="text-right">Tax</th>
                                            <th class="text-right">Fee</th>
                                            <th class="text-right">Total Payment Auth</th>
                                            <th class="text-right">Total Payment Received</th>
                                            <th>Ref #</th>
                                            <th>Batch ID</th>
                                            <th>Processed By</th>
                                            <th>Voided By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach([
        ['org' => 'RTO Devices', 'company' => 'RTO Devices', 'store' => 'Site 1', 'contract' => '95513870-1', 'date' => '11/8/2025', 'customer' => 'BELL, OLIVIA M', 'type' => 'Cash', 'status' => 'Accepted', 'reason' => '', 'amount' => '$30.03', 'tax' => '$1.91', 'fee' => '$5.00', 'auth' => '$36.94', 'received' => '$36.94', 'ref' => 'R987654', 'batch' => 'B12345', 'processed' => 'User A', 'voided' => ''],
        ['org' => 'RTO Devices', 'company' => 'RTO Devices', 'store' => 'Site 1', 'contract' => '48204419-1', 'date' => '11/8/2025', 'customer' => 'BELL, OLIVIA', 'type' => 'Cash', 'status' => 'Accepted', 'reason' => '', 'amount' => '$30.03', 'tax' => '$1.91', 'fee' => '$5.00', 'auth' => '$36.94', 'received' => '$36.94', 'ref' => 'R987655', 'batch' => 'B12345', 'processed' => 'User A', 'voided' => ''],
        ['org' => 'GLOBAL LEASING', 'company' => 'GLOBAL RENTALS INC', 'store' => 'CITY CENTER RENTALS - 1 MAIN ST', 'contract' => '12345678-2', 'date' => '11/7/2025', 'customer' => 'JOHN D DOE', 'type' => 'Card', 'status' => '**Rejected**', 'reason' => 'Failed Auth', 'amount' => '$45.50', 'tax' => '$3.64', 'fee' => '$0.50', 'auth' => '$49.64', 'received' => '$0.00', 'ref' => 'R111222', 'batch' => 'B12344', 'processed' => 'User B', 'voided' => 'User B']
    ] as $payment)
                                                <tr>
                                                    <td>{{ $payment['org'] }}</td>
                                                    <td>{{ $payment['company'] }}</td>
                                                    <td>{{ $payment['store'] }}</td>
                                                    <td>
                                                        <a href="#" class="contract-link">{{ $payment['contract'] }}</a>
                                                    </td>
                                                    <td>{{ $payment['date'] }}</td>
                                                    <td>{{ $payment['customer'] }}</td>
                                                    <td>{{ $payment['type'] }}</td>
                                                    <td>{{ $payment['status'] }}</td>
                                                    <td>{{ $payment['reason'] }}</td>
                                                    <td class="text-right">{{ $payment['amount'] }}</td>
                                                    <td class="text-right">{{ $payment['tax'] }}</td>
                                                    <td class="text-right">{{ $payment['fee'] }}</td>
                                                    <td class="text-right">{{ $payment['auth'] }}</td>
                                                    <td class="text-right">{{ $payment['received'] }}</td>
                                                    <td>{{ $payment['ref'] }}</td>
                                                    <td>{{ $payment['batch'] }}</td>
                                                    <td>{{ $payment['processed'] }}</td>
                                                    <td>{{ $payment['voided'] }}</td>
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
            const table = $('#paymentsTable').DataTable({
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
                order: [[4, 'desc']], // Order by Time Stamp descending
                language: {
                    search: "Search payments:",
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

        function removeFilter() {
            document.querySelector('.filter-chip').remove();
        }
    </script>
@endpush