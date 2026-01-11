@extends('tenant.layouts.master')
@section('contract_active', 'active')

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
    .contracts-card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .contracts-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        background-color: #f8f9fa;
    }

    .contracts-title {
        font-size: 1.25rem;
        font-weight: 500;
        color: #333;
    }

    .contracts-actions .btn {
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
    .contracts-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1200px;
    }

    .contracts-table th {
        font-weight: 600;
        font-size: 0.8rem;
        color: #6c757d;
        text-transform: uppercase;
        border-top: none !important;
        border-bottom: 1px solid #dee2e6;
        padding: 12px 10px;
        vertical-align: bottom;
        white-space: nowrap;
        cursor: pointer;
        position: relative;
    }

    .contracts-table th:hover {
        background-color: #f1f1f1;
    }

    .contracts-table td {
        white-space: nowrap;
        vertical-align: top;
        font-size: 0.9rem;
        padding: 12px 10px;
        line-height: 1.3;
        border-bottom: 1px solid #eee;
    }

    .contracts-table tbody tr:hover {
        background-color: #f5f5f5;
    }

    .contracts-table .icon-col {
        width: 40px;
        text-align: center;
    }

    .contracts-table .icon-col i {
        color: #007bff;
        font-size: 1rem;
        cursor: pointer;
    }

    .sort-indicator {
        margin-left: 5px;
        font-size: 12px;
    }

    /* Grid View */
    .grid-view {
        display: none;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .grid-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        padding: 20px;
        border-left: 4px solid #007bff;
    }

    .grid-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        padding-bottom: 8px;
        border-bottom: 1px solid #f0f0f0;
    }

    .grid-label {
        font-weight: 600;
        color: #666;
    }

    .grid-value {
        text-align: right;
    }

    .status-closed {
        color: #28a745;
        font-weight: 600;
    }

    .status-active {
        color: #007bff;
        font-weight: 600;
    }

    .status-pending {
        color: #ffc107;
        font-weight: 600;
    }

    .amount {
        font-weight: 600;
        color: #007bff;
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

    /* Print Styles */
    @media print {

        .contracts-actions,
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

        .contracts-card {
            border: none;
            box-shadow: none;
        }

        .contracts-table {
            min-width: auto;
            width: 100%;
        }

        .contracts-table th,
        .contracts-table td {
            font-size: 10px;
            padding: 6px 4px;
        }
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


    /* Responsive adjustments */
    @media (max-width: 768px) {
        .contracts-header {
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
<li class="breadcrumb-item active">Contracts</li>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <h1 class="page-title">Contracts</h1>

            <div class="card contracts-card">
                <div class="contracts-header">
                    <div class="contracts-title">Contracts</div>
                    <div class="contracts-actions">
                        <button class="btn btn-outline-secondary btn-sm" id="print-btn" title="Print">
                            <i class="fas fa-print"></i>
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" id="csv-btn" title="Export CSV">
                            <i class="fas fa-file-csv"></i>
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" id="excel-btn" title="Export Excel">
                            <i class="fas fa-file-excel"></i>
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" id="view-toggle" title="Switch to Grid View">
                            <i class="fas fa-table"></i>
                        </button>
                    </div>
                </div>

                <!-- Quick Filter Bar -->
                <div class="quick-filter-bar">
                    <div class="quick-filter-group">
                        <span class="quick-filter-label">Billing Status:</span>
                        <select class="form-control form-control-sm" id="billing-status-filter">
                            <option value="">All Statuses</option>
                            <option value="Closed - Early Payoff">Closed - Early Payoff</option>
                            <option value="Active">Active</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <div class="quick-filter-group">
                        <span class="quick-filter-label">Guarantee Status:</span>
                        <select class="form-control form-control-sm" id="guarantee-status-filter">
                            <option value="">All Statuses</option>
                            <option value="Valid">Valid</option>
                            <option value="Expired">Expired</option>
                        </select>
                    </div>
                    <div class="quick-filter-group">
                        <span class="quick-filter-label">Store:</span>
                        <select class="form-control form-control-sm" id="store-filter">
                            <option value="">All Stores</option>
                            <option value="Site 1">Site 1</option>
                            <option value="Downtown Branch">Downtown Branch</option>
                        </select>
                    </div>
                    <button class="btn btn-primary btn-sm" id="apply-filters">Apply Filters</button>
                    <button class="btn btn-secondary btn-sm" id="clear-filters">Clear</button>
                </div>

                <div class="card-body">
                    <!-- Table View -->
                    <div class="table-responsive" id="table-view">
                        <table class="data-table" id="contracts-table">
                            <thead>
                                <tr>
                                    <th class="icon-col"></th>
                                    <th>Contract #</th>
                                    <th>Organization</th>
                                    <th>Company</th>
                                    <th>Store</th>
                                    <th>Billing Status</th>
                                    <th>IMEI</th>
                                    <th>Serial #</th>
                                    <th>Manufacturer</th>
                                    <th>Model</th>
                                    <th>Customer</th>
                                    <th>MDN 1</th>
                                    <th>Phone 1</th>
                                    <th>Phone 2</th>
                                    <th>Address</th>
                                    <th>SSN</th>
                                    <th>DOM</th>
                                    <th>Guarantee Status</th>
                                    <th>Device Memory</th>
                                    <th>Lock Status</th>
                                    <th>Merchandise Condition</th>
                                    <th>Downpayment</th>
                                    <th>Paid Till Now</th>
                                    <th>Payment Left</th>
                                    <th>Next Payment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated by DataTables -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Grid View -->
                    <div class="grid-view" id="grid-view">
                        <!-- Grid cards will be generated by JavaScript -->
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
        // Sample data
        const contractsData = [
            {
                id: 1,
                contractNumber: '90184724',
                organization: 'SIRIUS ELECTRONIC SOLUTION LLC',
                company: 'SIRIUS ELECTRONIC SOLUTION LLC',
                store: 'Site 1',
                billingStatus: 'Closed - Early Payoff',
                imei: '',
                serialNumber: '',
                manufacturer: '',
                model: '',
                customer: 'YA, KY',
                mdn1: '',
                phone1: '2156159954',
                phone2: '',
                address: '123 Main St, Dhaka',
                ssn: 'XXX-XX-1234',
                dom: '2024-06-15',
                guaranteeStatus: 'Valid',
                deviceMemory: '256GB',
                lockStatus: 'Unlocked',
                merchandiseCondition: 'Excellent',
                downpayment: '$200',
                paidTillNow: '$600',
                paymentLeft: '$400',
                nextPaymentDate: '2025-12-01'
            },
            {
                id: 2,
                contractNumber: '90279203',
                organization: 'SIRIUS ELECTRONIC SOLUTION LLC',
                company: 'SIRIUS ELECTRONIC SOLUTION LLC',
                store: 'Site 1',
                billingStatus: 'Closed - Early Payoff',
                imei: '358677224544982',
                serialNumber: 'DMCF6D563P',
                manufacturer: 'APPLE',
                model: 'IPHONE 13 PRO MAX',
                customer: 'CRUZ, ANGEL',
                mdn1: '',
                phone1: '860750287C',
                phone2: '01798765432',
                address: '456 Lake Road, Chittagong',
                ssn: 'XXX-XX-5678',
                dom: '2024-09-20',
                guaranteeStatus: 'Expired',
                deviceMemory: '512GB',
                lockStatus: 'Locked',
                merchandiseCondition: 'Good',
                downpayment: '$150',
                paidTillNow: '$450',
                paymentLeft: '$550',
                nextPaymentDate: '2025-12-10'
            },
            {
                id: 3,
                contractNumber: '90345678',
                organization: 'TECH SOLUTIONS INC',
                company: 'TECH SOLUTIONS INC',
                store: 'Downtown Branch',
                billingStatus: 'Active',
                imei: '123456789012345',
                serialNumber: 'SN12345678',
                manufacturer: 'SAMSUNG',
                model: 'GALAXY S21',
                customer: 'SMITH, JOHN',
                mdn1: '5551234567',
                phone1: '5559876543',
                phone2: '',
                address: '789 Tech Street, Dhaka',
                ssn: 'XXX-XX-9012',
                dom: '2024-07-10',
                guaranteeStatus: 'Valid',
                deviceMemory: '128GB',
                lockStatus: 'Unlocked',
                merchandiseCondition: 'Very Good',
                downpayment: '$100',
                paidTillNow: '$300',
                paymentLeft: '$700',
                nextPaymentDate: '2025-11-15'
            }
        ];

        // Initialize DataTable with export buttons
        const table = $('#contracts-table').DataTable({
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
            order: [[1, 'desc']],
            data: contractsData,
            columns: [
                {
                    data: null,
                    className: 'icon-col',
                    render: function (data, type, row) {
                        return '<i class="far fa-eye text-primary btn" onclick="viewContract(' + row.id + ')" title="View Details"></i>';
                    },
                    orderable: false
                },
                { data: 'contractNumber' },
                { data: 'organization' },
                { data: 'company' },
                { data: 'store' },
                {
                    data: 'billingStatus',
                    render: function (data, type, row) {
                        let statusClass = '';
                        if (data.includes('Closed')) statusClass = 'status-closed';
                        else if (data === 'Active') statusClass = 'status-active';
                        else if (data === 'Pending') statusClass = 'status-pending';

                        return `<span class="${statusClass}">${data}</span>`;
                    }
                },
                { data: 'imei' },
                { data: 'serialNumber' },
                { data: 'manufacturer' },
                { data: 'model' },
                { data: 'customer' },
                { data: 'mdn1' },
                { data: 'phone1' },
                { data: 'phone2' },
                { data: 'address' },
                { data: 'ssn' },
                { data: 'dom' },
                { data: 'guaranteeStatus' },
                { data: 'deviceMemory' },
                { data: 'lockStatus' },
                { data: 'merchandiseCondition' },
                { data: 'downpayment' },
                { data: 'paidTillNow' },
                { data: 'paymentLeft' },
                { data: 'nextPaymentDate' }
            ],
            language: {
                search: "Search contracts:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });

        // Apply filters
        $('#apply-filters').click(function () {
            const billingStatus = $('#billing-status-filter').val();
            const guaranteeStatus = $('#guarantee-status-filter').val();
            const store = $('#store-filter').val();

            // Combine filters
            table.columns().search(''); // Clear previous searches

            if (billingStatus) {
                table.column(5).search(billingStatus, true, false);
            }
            if (guaranteeStatus) {
                table.column(17).search(guaranteeStatus, true, false);
            }
            if (store) {
                table.column(4).search(store, true, false);
            }

            table.draw();

            // Regenerate grid if in grid view
            if (!isTableView) {
                generateGridCards();
            }
        });

        // Clear filters
        $('#clear-filters').click(function () {
            $('#billing-status-filter').val('');
            $('#guarantee-status-filter').val('');
            $('#store-filter').val('');

            table.columns().search('').draw();

            if (!isTableView) {
                generateGridCards();
            }
        });

        // View toggle functionality
        let isTableView = true;
        $('#view-toggle').click(function () {
            isTableView = !isTableView;

            if (isTableView) {
                $('#table-view').show();
                $('#grid-view').hide();
                $(this).find('i').removeClass('fa-th-large').addClass('fa-table');
                $(this).attr('title', 'Switch to Grid View');
            } else {
                $('#table-view').hide();
                $('#grid-view').show();
                $(this).find('i').removeClass('fa-table').addClass('fa-th-large');
                $(this).attr('title', 'Switch to Table View');
                generateGridCards();
            }
        });

        // Generate grid cards from table data
        function generateGridCards() {
            const gridView = $('#grid-view');
            gridView.empty();

            const data = table.rows({ search: 'applied' }).data().toArray();

            data.forEach(contract => {
                const card = $('<div class="grid-card"></div>');

                // Add key fields to the card
                const fields = [
                    { label: 'Contract #', value: contract.contractNumber },
                    { label: 'Organization', value: contract.organization },
                    { label: 'Company', value: contract.company },
                    { label: 'Store', value: contract.store },
                    { label: 'Billing Status', value: contract.billingStatus, specialClass: getStatusClass(contract.billingStatus) },
                    { label: 'Customer', value: contract.customer },
                    { label: 'Phone 1', value: contract.phone1 },
                    { label: 'Address', value: contract.address },
                    { label: 'DOM', value: contract.dom },
                    { label: 'Guarantee Status', value: contract.guaranteeStatus },
                    { label: 'Device Memory', value: contract.deviceMemory },
                    { label: 'Downpayment', value: contract.downpayment, specialClass: 'amount' },
                    { label: 'Paid Till Now', value: contract.paidTillNow, specialClass: 'amount' },
                    { label: 'Payment Left', value: contract.paymentLeft, specialClass: 'amount' },
                    { label: 'Next Payment Date', value: contract.nextPaymentDate }
                ];

                fields.forEach(field => {
                    if (field.value) {
                        const row = $('<div class="grid-row"></div>');
                        row.append(`<div class="grid-label">${field.label}:</div>`);

                        let value = field.value;
                        if (field.specialClass) {
                            value = `<span class="${field.specialClass}">${value}</span>`;
                        }

                        row.append(`<div class="grid-value">${value}</div>`);
                        card.append(row);
                    }
                });

                // Add view button
                const viewBtn = $('<button class="btn btn-primary btn-sm mt-2">View Details</button>');
                viewBtn.click(function () {
                    viewContract(contract.id);
                });
                card.append(viewBtn);

                gridView.append(card);
            });
        }

        // Helper function to get status class
        function getStatusClass(status) {
            if (status.includes('Closed')) return 'status-closed';
            if (status === 'Active') return 'status-active';
            if (status === 'Pending') return 'status-pending';
            return '';
        }

        // Print functionality
        $('#print-btn').click(function () {
            table.button('.buttons-print').trigger();
        });
        $('#csv-btn').click(function () {
            table.button('.buttons-csv').trigger();
        });

        $('#excel-btn').click(function () {
            table.button('.buttons-excel').trigger();
        });


        // View contract details
        window.viewContract = function (contractId) {
            // Use a route pattern and replace the placeholder dynamically
            let url = "{{ tenant_route('tenant.contract.details', [':id']) }}";
            url = url.replace(':id', contractId);

            window.location.href = url;
        };
    });
</script>
@endpush