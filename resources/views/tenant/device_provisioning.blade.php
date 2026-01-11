@extends('tenant.layouts.master')

@push('style')
    <style>
        /* Custom Styling for the Page Title */
        .provisioning-title {
            color: #5cb85c;
            font-size: 2.2rem;
            font-weight: 300;
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        /* Styling for the central Action Button */
        .action-button-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-provisioning-batch {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            padding: 10px 25px;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .btn-provisioning-batch:hover {
            background-color: #0056b3;
        }

        /* Styling for the Red Store Alert */
        .store-alert-message {
            color: #dc3545;
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px 15px;
            border-radius: 5px;
        }

        /* Table Specific Styles */
        .provisioning-table-card {
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
            border: none;
        }

        .provisioning-table th,
        .provisioning-table td {
            white-space: nowrap;
            vertical-align: middle;
            padding: 12px 10px;
            font-size: 0.9rem;
        }

        .provisioning-table thead th {
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            border-bottom: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }

        /* Style for the filter row (Inputs inside TH) */
        .provisioning-table thead tr.filter-row th {
            padding-top: 8px;
            padding-bottom: 8px;
            border-top: none;
            background-color: #f8f9fa;
        }

        .provisioning-table .form-control-sm {
            height: calc(1.5em + 0.5rem + 2px);
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .provisioning-table .form-control-sm:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* Style for the icon column */
        .provisioning-table .icon-col {
            width: 40px;
            text-align: center;
        }

        .provisioning-table .icon-col i {
            color: #007bff;
            font-size: 1rem;
            cursor: pointer;
        }

        /* Status badges */
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

        /* Footer/Pagination style */
        .pagination-footer {
            padding: 15px 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .pagination-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pagination-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .pagination-controls i {
            cursor: pointer;
            color: #6c757d;
            transition: color 0.2s ease;
        }

        .pagination-controls i:hover {
            color: #007bff;
        }

        .pagination-controls i.disabled {
            color: #dee2e6;
            cursor: not-allowed;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .provisioning-title {
                font-size: 1.8rem;
            }

            .pagination-footer {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">

            {{-- Page Title --}}
            <h1 class="provisioning-title">Device Provisioning</h1>

            {{-- Action Button --}}
            <div class="action-button-container">
                <button class="btn btn-provisioning-batch">
                    <i class="fas fa-plus-circle mr-2"></i>Create New Device Provisioning Batch
                </button>
            </div>

            {{-- Store Alert --}}
            <div class="store-alert-message">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                You are provisioning for store: Site 1
            </div>

            {{-- Showing Items Count --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <small class="text-muted">Showing 1-20 of 57 items.</small>
                <div class="d-flex align-items-center">
                    <small class="text-muted mr-2">Search:</small>
                    <input type="text" class="form-control form-control-sm" style="width: 200px;"
                        placeholder="Search batches...">
                </div>
            </div>

            {{-- Main Table Card --}}
            <div class="card provisioning-table-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 provisioning-table">
                            <thead>
                                <tr>
                                    <th class="icon-col"></th>
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
                                <tr class="filter-row">
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
                                {{-- Sample Row 1: Pending Initial Verification --}}
                                <tr>
                                    <td class="icon-col">
                                        <i class="far fa-eye" onclick="viewBatch('16SC167D')"></i>
                                    </td>
                                    <td><strong>16SC167D</strong></td>
                                    <td>
                                        <span class="status-badge status-pending">Pending Initial Verification</span>
                                    </td>
                                    <td>APPLE</td>
                                    <td>IPHONE 15, 4</td>
                                    <td>357702054466638</td>
                                    <td>K2RWLF9075</td>
                                    <td>Site 1</td>
                                    <td>HYESESANL SHYQYRI</td>
                                    <td>07/27/2025</td>
                                    <td>02:02:21 PM</td>
                                </tr>
                                {{-- Sample Row 2: Device Provisioned --}}
                                <tr>
                                    <td class="icon-col">
                                        <i class="far fa-eye" onclick="viewBatch('F2DF00F2')"></i>
                                    </td>
                                    <td><strong>F2DF00F2</strong></td>
                                    <td>
                                        <span class="status-badge status-provisioned">Device Provisioned</span>
                                    </td>
                                    <td>SAMSUNG</td>
                                    <td>GALAXY S24 ULTRA</td>
                                    <td>3529990828100382</td>
                                    <td>RSCX2221JLR</td>
                                    <td>Site 1</td>
                                    <td>HYESESANL SHYQYRI</td>
                                    <td>07/26/2025</td>
                                    <td>04:41:30 PM</td>
                                </tr>
                                {{-- Sample Row 3: Device Provisioned --}}
                                <tr>
                                    <td class="icon-col">
                                        <i class="far fa-eye" onclick="viewBatch('ASC5074B')"></i>
                                    </td>
                                    <td><strong>ASC5074B</strong></td>
                                    <td>
                                        <span class="status-badge status-provisioned">Device Provisioned</span>
                                    </td>
                                    <td>APPLE</td>
                                    <td>IPHONE 16 Pro Max</td>
                                    <td>358637762733638</td>
                                    <td>MYD94FRO6YC</td>
                                    <td>Site 1</td>
                                    <td>HYESESANL SHYQYRI</td>
                                    <td>07/21/2025</td>
                                    <td>05:37:47 PM</td>
                                </tr>
                                {{-- Sample Row 4: Device Provisioned --}}
                                <tr>
                                    <td class="icon-col">
                                        <i class="far fa-eye" onclick="viewBatch('DDA272B1')"></i>
                                    </td>
                                    <td><strong>DDA272B1</strong></td>
                                    <td>
                                        <span class="status-badge status-provisioned">Device Provisioned</span>
                                    </td>
                                    <td>APPLE</td>
                                    <td>IPHONE 16</td>
                                    <td>351280059612254</td>
                                    <td>M43XMVM711</td>
                                    <td>Site 1</td>
                                    <td>HYESESANL SHYQYRI</td>
                                    <td>07/19/2025</td>
                                    <td>10:26:29 AM</td>
                                </tr>
                                {{-- Additional sample rows for demonstration --}}
                                <tr>
                                    <td class="icon-col">
                                        <i class="far fa-eye" onclick="viewBatch('X1C234D5')"></i>
                                    </td>
                                    <td><strong>X1C234D5</strong></td>
                                    <td>
                                        <span class="status-badge status-pending">Pending Initial Verification</span>
                                    </td>
                                    <td>GOOGLE</td>
                                    <td>PIXEL 8 PRO</td>
                                    <td>358901234567890</td>
                                    <td>GPX8P123456</td>
                                    <td>Site 1</td>
                                    <td>HYESESANL SHYQYRI</td>
                                    <td>07/28/2025</td>
                                    <td>09:15:30 AM</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination Footer --}}
                <div class="pagination-footer">
                    <div class="pagination-info">
                        <span>Rows per page:</span>
                        <select class="form-control form-control-sm" style="width: auto;">
                            <option>10</option>
                            <option selected>20</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <span>1 - 20 of 57</span>
                    </div>
                    <div class="pagination-controls">
                        <i class="fas fa-chevron-left disabled"></i>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        // Function to handle batch viewing
        function viewBatch(batchId) {
            alert(`Viewing batch details for: ${batchId}`);
            // In a real application, you would redirect to a detail page or open a modal
            // window.location.href = `/provisioning/batch/${batchId}`;
        }

        // Function to handle creating new batch
        document.querySelector('.btn-provisioning-batch').addEventListener('click', function () {
            alert('Creating new device provisioning batch...');
            // In a real application, you would redirect to a create form
            // window.location.href = '/provisioning/create';
        });

        // Filter functionality
        document.addEventListener('DOMContentLoaded', function () {
            // Add event listeners to filter inputs
            const filterInputs = document.querySelectorAll('.provisioning-table .form-control-sm');
            filterInputs.forEach(input => {
                input.addEventListener('input', function () {
                    // Implement filtering logic here
                    console.log(`Filtering by: ${this.value}`);
                });
            });

            // Pagination controls
            const prevBtn = document.querySelector('.fa-chevron-left');
            const nextBtn = document.querySelector('.fa-chevron-right');

            prevBtn.addEventListener('click', function () {
                if (!this.classList.contains('disabled')) {
                    console.log('Previous page');
                    // Implement previous page logic
                }
            });

            nextBtn.addEventListener('click', function () {
                if (!this.classList.contains('disabled')) {
                    console.log('Next page');
                    // Implement next page logic
                }
            });
        });

        // Row click functionality (optional)
        document.querySelectorAll('.provisioning-table tbody tr').forEach(row => {
            row.addEventListener('click', function (e) {
                // Don't trigger if clicking on the eye icon
                if (!e.target.closest('.icon-col')) {
                    const batchId = this.querySelector('td:nth-child(2) strong').textContent;
                    viewBatch(batchId);
                }
            });
        });
    </script>
@endpush