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
            min-width: 1400px;
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

        /* Right-align numeric columns */
        .text-right {
            text-align: right;
        }

        .amount-positive {
            color: #28a745;
            font-weight: 600;
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

        /* Export buttons styling */
        .dt-buttons .btn {
            margin-right: 5px;
            margin-bottom: 5px;
        }

        /* Summary cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
            padding: 20px;
        }

        .summary-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .summary-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: #007bff;
            margin: 10px 0;
        }

        .summary-label {
            font-size: 0.9rem;
            color: #6c757d;
            text-transform: uppercase;
            font-weight: 600;
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
            .content-header,
            .summary-cards {
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

            .summary-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ tenant_route('tenant.report') }}">Reports</a> </li>
    <li class="breadcrumb-item active">Sales Tax Report</li>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid py-3">
                <h1 class="page-title">Sales Tax Report</h1>

                <div class="report-card">
                    <div class="report-header">
                        <div class="report-title">Sales Tax Report</div>
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

                    <!-- Summary Cards -->
                    <div class="summary-cards">
                        <div class="summary-card">
                            <div class="summary-label">Total Amount</div>
                            <div class="summary-value" id="total-amount">$225.56</div>
                        </div>
                        <div class="summary-card">
                            <div class="summary-label">Total Sales Tax</div>
                            <div class="summary-value" id="total-tax">$17.06</div>
                        </div>
                        <div class="summary-card">
                            <div class="summary-label">Total Collected</div>
                            <div class="summary-value" id="total-collected">$242.62</div>
                        </div>
                        <div class="summary-card">
                            <div class="summary-label">Total Transactions</div>
                            <div class="summary-value" id="total-transactions">4</div>
                        </div>
                    </div>

                    <!-- Quick Filter Bar -->
                    <div class="quick-filter-bar">
                        <div class="quick-filter-group">
                            <span class="quick-filter-label">Date Range:</span>
                            <input type="date" class="form-control form-control-sm" id="start-date">
                            <span class="quick-filter-label">to</span>
                            <input type="date" class="form-control form-control-sm" id="end-date">
                        </div>
                        <div class="quick-filter-group">
                            <span class="quick-filter-label">Store:</span>
                            <select class="form-control form-control-sm" id="store-filter">
                                <option value="">All Stores</option>
                                <option value="Site 1">Site 1</option>
                                <option value="MAIN STREET STORE - 45 MAIN ST">MAIN STREET STORE</option>
                            </select>
                        </div>
                        <div class="quick-filter-group">
                            <span class="quick-filter-label">Payment Type:</span>
                            <select class="form-control form-control-sm" id="payment-filter">
                                <option value="">All Types</option>
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-sm" id="apply-filters">Apply Filters</button>
                        <button class="btn btn-secondary btn-sm" id="clear-filters">Clear</button>
                    </div>

                    <div class="card-body p-0">
                        <!-- Table View -->
                        <div class="table-responsive">
                            <table class="data-table" id="salesTaxTable">
                                <thead>
                                    <tr>
                                        <th>ISO</th>
                                        <th>Master Agent</th>
                                        <th>Organization</th>
                                        <th>Company</th>
                                        <th>Store</th>
                                        <th>Date</th>
                                        <th>Contract Number</th>
                                        <th>Customer Name</th>
                                        <th class="text-right">Amount</th>
                                        <th class="text-right">Sales Tax</th>
                                        <th class="text-right">Total Amount</th>
                                        <th>Payment Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>RTO Devices</td>
                                        <td>Site 1</td>
                                        <td>2025-11-08</td>
                                        <td>95513870-1</td>
                                        <td>OLIVIA M BELL</td>
                                        <td class="text-right amount-positive">$30.03</td>
                                        <td class="text-right amount-positive">$1.91</td>
                                        <td class="text-right amount-positive">$36.94</td>
                                        <td>Cash</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>RTO Devices</td>
                                        <td>Site 1</td>
                                        <td>2025-11-08</td>
                                        <td>48204419-1</td>
                                        <td>OLIVIA BELL</td>
                                        <td class="text-right amount-positive">$30.03</td>
                                        <td class="text-right amount-positive">$1.91</td>
                                        <td class="text-right amount-positive">$36.94</td>
                                        <td>Cash</td>
                                    </tr>
                                    <tr>
                                        <td>XYZ Agent</td>
                                        <td>Master Agent B</td>
                                        <td>Org Corp</td>
                                        <td>GLOBAL RENTALS INC</td>
                                        <td>MAIN STREET STORE - 45 MAIN ST</td>
                                        <td>2025-11-07</td>
                                        <td>12345678-2</td>
                                        <td>JOHN D DOE</td>
                                        <td class="text-right amount-positive">$45.50</td>
                                        <td class="text-right amount-positive">$3.64</td>
                                        <td class="text-right amount-positive">$50.14</td>
                                        <td>Card</td>
                                    </tr>
                                    <tr>
                                        <td>ABC Agent</td>
                                        <td>Master Agent C</td>
                                        <td>Org Group</td>
                                        <td>TECH SOLUTIONS LLC</td>
                                        <td>MAIN STREET STORE - 45 MAIN ST</td>
                                        <td>2025-11-06</td>
                                        <td>98765432-3</td>
                                        <td>JANE SMITH</td>
                                        <td class="text-right amount-positive">$120.00</td>
                                        <td class="text-right amount-positive">$9.60</td>
                                        <td class="text-right amount-positive">$129.60</td>
                                        <td>Card</td>
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
            const table = $('#salesTaxTable').DataTable({
                paging: true,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
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
                order: [[5, 'desc']], // Order by Date descending
                language: {
                    search: "Search records:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                scrollX: true,
                autoWidth: false,
                responsive: false
            });

            // Apply filters
            $('#apply-filters').click(function () {
                const startDate = $('#start-date').val();
                const endDate = $('#end-date').val();
                const store = $('#store-filter').val();
                const paymentType = $('#payment-filter').val();

                // Combine filters
                table.columns().search(''); // Clear previous searches

                // Date range filter (column 5 - Date)
                if (startDate || endDate) {
                    table.column(5).search(`${startDate}|${endDate}`, true, false);
                }

                // Store filter (column 4 - Store)
                if (store) {
                    table.column(4).search(store, true, false);
                }

                // Payment type filter (column 11 - Payment Type)
                if (paymentType) {
                    table.column(11).search(paymentType, true, false);
                }

                table.draw();
                updateSummary();
            });

            // Clear filters
            $('#clear-filters').click(function () {
                $('#start-date').val('');
                $('#end-date').val('');
                $('#store-filter').val('');
                $('#payment-filter').val('');

                table.columns().search('').draw();
                updateSummary();
            });

            // Update summary statistics
            function updateSummary() {
                const data = table.rows({ search: 'applied' }).data().toArray();

                let totalAmount = 0;
                let totalTax = 0;
                let totalCollected = 0;

                data.forEach(row => {
                    const amount = parseFloat(row[8].replace('$', '')) || 0;
                    const tax = parseFloat(row[9].replace('$', '')) || 0;
                    const collected = parseFloat(row[10].replace('$', '')) || 0;

                    totalAmount += amount;
                    totalTax += tax;
                    totalCollected += collected;
                });

                $('#total-amount').text('$' + totalAmount.toFixed(2));
                $('#total-tax').text('$' + totalTax.toFixed(2));
                $('#total-collected').text('$' + totalCollected.toFixed(2));
                $('#total-transactions').text(data.length);
            }

            // Initialize summary
            updateSummary();

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

            // Set default date range to last 30 days
            const today = new Date();
            const thirtyDaysAgo = new Date();
            thirtyDaysAgo.setDate(today.getDate() - 30);

            $('#start-date').val(thirtyDaysAgo.toISOString().split('T')[0]);
            $('#end-date').val(today.toISOString().split('T')[0]);
        });
    </script>
@endpush