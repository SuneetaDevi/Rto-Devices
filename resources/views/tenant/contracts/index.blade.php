@extends('tenant.layouts.master')
@section('contract_active', 'active')
@section('title', $title)

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .page-title {
            font-weight: 300;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }

        .contracts-card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .contracts-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
        }

        .contracts-title {
            font-size: 1.25rem;
            font-weight: 500;
        }

        .contracts-actions .btn {
            margin-left: 5px;
        }

        .quick-filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
            padding: 15px 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #eee;
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
        }

        /* Grid styling */
        .grid-view {
            display: none;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .grid-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            padding: 20px;
            border: 1px solid #007bff;
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

        /* Apply Bootstrap button styles to DataTables HTML5 buttons */


        .buttons-html5 {
            display: inline-block !important;
            padding: 0.25rem 0.5rem !important;
            font-size: 0.875rem !important;
            font-weight: 400 !important;
            line-height: 1.5 !important;
            text-align: center !important;
            text-decoration: none !important;
            white-space: nowrap !important;
            vertical-align: middle !important;
            cursor: pointer !important;
            border: 1px solid #6c757d !important;
            border-radius: 0.25rem !important;
            color: #fff !important;
            background-color: #6c757d !important;
            background: #6c757d !important;
            transition: all 0.15s ease-in-out !important;
        }

        .buttons-html5:hover {
            background-color: #5a6268 !important;
            border-color: #545b62 !important;
            color: #fff !important;
        }


        @media(max-width:768px) {
            .grid-view {
                grid-template-columns: 1fr;
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
                        <div class="contracts-actions" id="table-buttons"></div>
                    </div>

                    <div class="quick-filter-bar">
                        <div class="quick-filter-group">
                            <span class="quick-filter-label">Billing Status:</span>
                            <select id="billing-status-filter" class="form-control-sm">
                                <option value="">All Statuses</option>
                                <option value="Closed - Early Payoff">Closed - Early Payoff</option>
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                        <div class="quick-filter-group">
                            <span class="quick-filter-label">Guarantee Status:</span>
                            <select id="guarantee-status-filter " class="form-control-sm">
                                <option value="">All Statuses</option>
                                <option value="Valid">Valid</option>
                                <option value="Expired">Expired</option>
                            </select>
                        </div>
                        <div class="quick-filter-group">
                            <span class="quick-filter-label">Store:</span>
                            <select id="store-filter" class="form-control-sm">
                                <option value="">All Stores</option>
                                <option value="Site 1">Site 1</option>
                                <option value="Downtown Branch">Downtown Branch</option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-sm" id="apply-filters">Apply Filters</button>
                        <button class="btn btn-secondary btn-sm" id="clear-filters">Clear</button>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive" id="table-view">
                            <table id="contracts-table" class="table table-bordered table-striped">
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
                                        <th>Phone 1</th>
                                        <th>Phone 2</th>
                                        <th>Address</th>
                                        <th>DOM</th>
                                        <th>Guarantee Status</th>
                                        <th>Device Memory</th>
                                        <th>Downpayment</th>
                                        <th>Paid Till Now</th>
                                        <th>Payment Left</th>
                                        <th>Next Payment Date</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="grid-view" id="grid-view"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $contractsJs = $contracts
            ->map(function ($c) {
                $customerName = $c->customer?->first_name . ' ' . $c->customer?->last_name;
                return [
                    'id' => $c->id,
                    'contractNumber' => $c->pub_ref,
                    'organization' => $c->tenant->name ?? '',
                    'company' => $c->tenant->name ?? '',
                    'store' => $c->stores->store_name ?? '',
                    'billingStatus' => $c->billing_status, // now dynamic
                    'imei' => $c->imei_serial ?? '',
                    'serialNumber' => $c->serial_number ?? '',
                    'manufacturer' => $c->manufacturer ?? '',
                    'model' => $c->device_model ?? '',
                    'customer' => $customerName ?? '',
                    'phone1' => $c->customer->phone1 ?? '',
                    'phone2' => $c->customer->phone2 ?? '',
                    'address' => $c->customer->address ?? '',
                    'dom' => $c->first_payment_date ?? '',
                    'guaranteeStatus' => $c->guarantee_status ?? '',
                    'deviceMemory' => $c->device_memory ?? '',
                    'downpayment' => $c->formatted_down_payment,
                    'paidTillNow' => $c->formatted_paid_till_now,
                    'paymentLeft' => $c->formatted_payment_left,
                    'nextPaymentDate' => isset($c->next_due_date)
                        ? \Carbon\Carbon::parse($c->next_due_date)->format('m/d/Y')
                        : '11/21/2025',
                ];
            })
            ->toArray();
    @endphp

    <script>
        const contractsData = @json($contractsJs);
    </script>


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
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function() {


            const table = $('#contracts-table').DataTable({
                data: contractsData,
                columns: [{
                        data: null,
                        className: 'icon-col',
                        render: d =>
                            `<i class="far fa-eye text-primary btn" onclick="viewContract(${d.contractNumber})"></i>`
                    },
                    {
                        data: 'contractNumber'
                    }, {
                        data: 'organization'
                    }, {
                        data: 'company'
                    }, {
                        data: 'store'
                    },
                    {
                        data: 'billingStatus',
                        render: function(d) {
                            if (d.includes('Closed')) return '<span class="status-closed">' + d +
                                '</span>';
                            if (d === 'Active') return '<span class="status-active">' + d +
                                '</span>';
                            if (d === 'Pending') return '<span class="status-pending">' + d +
                                '</span>';
                            return d;
                        }
                    },
                    {
                        data: 'imei'
                    }, {
                        data: 'serialNumber'
                    }, {
                        data: 'manufacturer'
                    }, {
                        data: 'model'
                    }, {
                        data: 'customer'
                    },
                    {
                        data: 'phone1'
                    }, {
                        data: 'phone2'
                    }, {
                        data: 'address'
                    }, {
                        data: 'dom'
                    }, {
                        data: 'guaranteeStatus'
                    }, {
                        data: 'deviceMemory'
                    }, {
                        data: 'downpayment'
                    }, {
                        data: 'paidTillNow'
                    }, {
                        data: 'paymentLeft'
                    }, {
                        data: 'nextPaymentDate'
                    }
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':not(.icon-col)'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':not(.icon-col)'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-secondary btn-sm',
                        exportOptions: {
                            columns: ':not(.icon-col)'
                        }
                    },
                    {
                        extend: 'colvis',
                        className: 'btn btn-secondary  buttons-html5  btn-sm'
                    }
                ],
                order: [
                    [1, 'desc']
                ]
            });

            table.buttons().container().appendTo('#table-buttons');
            const gridButton =
                `<button class="btn btn-outline-secondary buttons-html5 btn-sm" id="view-toggle"><i
                                                                                                                                                                                                                                                                                                                                                                    class="fas fa-table"></i></button>`;
            $('#table-buttons').append(gridButton);

            $('#apply-filters').click(function() {
                let billing = $('#billing-status-filter').val();
                let guarantee = $('#guarantee-status-filter').val();
                let store = $('#store-filter').val();

                table.column(5).search(billing).column(15).search(guarantee).column(4).search(store).draw();
            });

            $('#clear-filters').click(function() {
                $('#billing-status-filter').val('');
                $('#guarantee-status-filter').val('');
                $('#store-filter').val('');
                table.columns().search('').draw();
            });

            let isTableView = true;
            $('#view-toggle').click(function() {
                isTableView = !isTableView;
                if (isTableView) {
                    $('#table-view').show();
                    $('#grid-view').hide();
                    $(this).find('i').removeClass('fa-th-large').addClass('fa-table');
                } else {
                    $('#table-view').hide();
                    $('#grid-view').show();
                    $(this).find('i').removeClass('fa-table').addClass('fa-th-large');
                    generateGrid();
                }
            });

            function generateGrid() {
                let data = table.rows({
                    search: 'applied'
                }).data().toArray();
                $('#grid-view').empty();
                data.forEach(c => {
                    let card = $('<div class="grid-card"></div>');
                    let fields = [{
                            label: 'Contract #',
                            value: c.contractNumber
                        }, {
                            label: 'Organization',
                            value: c.organization
                        }, {
                            label: 'Company',
                            value: c.company
                        },
                        {
                            label: 'Store',
                            value: c.store
                        }, {
                            label: 'Billing Status',
                            value: c.billingStatus,
                            specialClass: (c.billingStatus.includes('Closed') ? 'status-closed' : (c
                                .billingStatus === 'Active' ? 'status-active' : 'status-pending'
                                ))
                        },
                        {
                            label: 'Customer',
                            value: c.customer
                        }, {
                            label: 'Phone 1',
                            value: c.phone1
                        }, {
                            label: 'Address',
                            value: c.address
                        }, {
                            label: 'DOM',
                            value: c.dom
                        },
                        {
                            label: 'Guarantee Status',
                            value: c.guaranteeStatus
                        }, {
                            label: 'Device Memory',
                            value: c.deviceMemory
                        }, {
                            label: 'Downpayment',
                            value: c.downpayment,
                            specialClass: 'amount'
                        },
                        {
                            label: 'Paid Till Now',
                            value: c.paidTillNow,
                            specialClass: 'amount'
                        }, {
                            label: 'Payment Left',
                            value: c.paymentLeft,
                            specialClass: 'amount'
                        }, {
                            label: 'Next Payment Date',
                            value: c.nextPaymentDate
                        }
                    ];
                    fields.forEach(f => {
                        if (f.value) {
                            let row = $('<div class="grid-row"></div>');
                            row.append(
                                `<div class="grid-label">${f.label}:</div><div class="grid-value ${f.specialClass || ''}">${f.value}</div>`
                                );
                            card.append(row);
                        }
                    });
                    let btn = $('<button class="btn btn-primary btn-sm mt-2">View Details</button>');
                    btn.click(() => viewContract(c.id));
                    card.append(btn);
                    $('#grid-view').append(card);
                });
            }
        });

        function viewContract(id) {
            let url = "{{ tenant_route('tenant.contract.details', [':id']) }}".replace(':id', id);
            window.location.href = url;
        }
    </script>
@endpush
