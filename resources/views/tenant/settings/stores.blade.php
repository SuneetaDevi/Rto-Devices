@extends('tenant.layouts.master')
@section('settings_menu_open', 'menu-open')
@section('settings_active', 'active')
@section('stores_active', 'active')
@section('title', $title)

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
        .stores-card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .stores-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            background-color: #f8f9fa;
        }

        .stores-title {
            font-size: 1.25rem;
            font-weight: 500;
            color: #333;
        }

        .stores-actions .btn {
            margin-left: 5px;
        }

        /* Table styling */
        .data-table {
            width: 100%;
            min-width: 1600px;
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

        .icon-col {
            width: 40px;
            text-align: center;
        }

        .icon-col i {
            color: #007bff;
            font-size: 1rem;
            cursor: pointer;
        }

        /* DataTables customization */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
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

        /* Print Styles */
        @media print {

            .stores-actions,
            .dataTables_length,
            .dataTables_filter,
            .dataTables_info,
            .dataTables_paginate,
            .dt-buttons,
            .breadcrumb,
            .content-header {
                display: none !important;
            }

            .stores-card {
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
            .stores-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid py-3">
                <h1 class="page-title">Stores</h1>

                <div class="card stores-card">
                    <div class="stores-header">
                        <div class="stores-title">Stores</div>
                        <div class="stores-actions">
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

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="data-table" id="stores-table">
                                <thead>
                                    <tr>
                                        <th class="icon-col"></th>
                                        <th>ID</th>
                                        <th>Organization</th>
                                        <th>Company</th>
                                        <th>Store</th>
                                        <th>Account Manager</th>
                                        <th>Dealer Success Manager</th>
                                        <th>Address 1</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $store)
                                        <tr>
                                            <td class="icon-col">
                                                <a href="{{ tenant_route('tenant.setting.stores.edit', [$store->id]) }}"
                                                    target="_blank" rel="noopener noreferrer">
                                                    <i class="fas fa-pen text-primary btn" title="Edit Store"></i>
                                                </a>

                                            </td>
                                            <td>{{ $store->id }}</td>
                                            <td>{{ $store->tenant->name ?? 'N/A' }}</td> {{-- Organization --}}
                                            <td>{{ $store->tenant->name ?? 'N/A' }}</td> {{-- Company --}}
                                            <td>{{ $store->store_name }}</td>
                                            <td>{{ $store->accountManager->name ?? 'N/A' }}</td> {{-- Account Manager --}}
                                            <td>{{ $store->dealerManager->name ?? 'N/A' }}</td> {{-- Dealer Success Manager --}}
                                            <td>{{ $store->address ?? '' }}</td>
                                            <td>{{ $store->city ?? '' }}</td>
                                            <td>{{ $store->state ?? '' }}</td>
                                            <td>{{ $store->phone ?? '' }}</td>
                                            <td>{{ $store->email ?? '' }}</td>
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
        $(document).ready(function() {
            // Initialize DataTable with export buttons
            const table = $('#stores-table').DataTable({
                paging: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                dom: '<"d-flex justify-content-between mb-2"<"length-menu"l><"search-box"f>>t<"d-flex justify-content-between mt-2"<"info"i><"pagination"p>>',
                buttons: [{
                        extend: 'copy',
                        text: '<i class="fas fa-copy"></i> Copy',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':not(.icon-col)'
                        }
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':not(.icon-col)'
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':not(.icon-col)'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':not(.icon-col)'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':not(.icon-col)'
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
                language: {
                    search: "Search stores:",
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
            $('#print-btn').click(function() {
                table.button('.buttons-print').trigger();
            });

            $('#csv-btn').click(function() {
                table.button('.buttons-csv').trigger();
            });

            $('#excel-btn').click(function() {
                table.button('.buttons-excel').trigger();
            });
        });
    </script>
@endpush
