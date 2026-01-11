@extends('tenant.layouts.master')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('tenant.contract.index', request()->route('tenant_domain')) }}">Contracts</a>
    </li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('shop/cotracts/steps.css') }}">
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="content py-5">
            <div class="container">
                <div class="creation-container">
                    <form method="post" action="{{ tenant_route('tenant.contract.step6', [$contract->pub_ref]) }}">
                        @csrf
                        <input type="hidden" name="contract_id" value="{{ $contract->id }}">

                        <!-- Step Indicator -->
                        <div class="step-indicator mb-4">
                            @for ($i = 1; $i <= 8; $i++)
                                <div class="step-circle @if($i <= 5) active @endif">{{ $i }}</div>
                            @endfor
                        </div>

                        <h3 class="text-center mb-4">Contract Summary</h3>

                        <div class="form-body">
                            <!-- Download Buttons -->
                            <div class="mb-3">
                                <button type="button" id="download-csv" class="btn btn-outline-primary mr-2">Download
                                    CSV</button>
                                <button type="button" id="download-pdf" class="btn btn-outline-secondary">Download
                                    PDF</button>
                            </div>

                            <!-- Lead Summary -->
                            <p class="lead text-center lead-summary mb-3">
                                @php
                                    $leaseOption = $contract->lease_term;
                                    $frequency = 'Weekly';
                                    if ($leaseOption) {
                                        if (str_starts_with($leaseOption, 'w_')) {
                                            $frequency = 'Weekly';
                                        } elseif (str_starts_with($leaseOption, 'b_')) {
                                            $frequency = 'Bi-Weekly';
                                        } elseif (str_starts_with($leaseOption, 'm_')) {
                                            $frequency = 'Monthly';
                                        }
                                    }
                                @endphp
                                You have selected a <strong id="payment-frequency-text">{{ $frequency }} pay
                                    contract</strong>
                                with <strong
                                    id="down-payment-text">${{ number_format($contract->down_payment, 2) }}</strong> down.
                            </p>

                            <h5 class="text-center text-secondary mb-5">
                                Today's Down Payment of <strong
                                    id="today-down-text">${{ number_format($contract->down_payment, 2) }}</strong>,
                                Sales Tax of <strong
                                    id="today-tax-text">${{ number_format($contract->down_payment * 0.0635, 2) }}</strong>,
                                and Payment Fee of <strong>$5.00</strong> totaling
                                <span class="text-primary font-weight-bold"
                                    id="today-total-text">${{ number_format($contract->down_payment + ($contract->down_payment * 0.0635) + 5, 2) }}</span>
                                is due today.
                            </h5>

                            <!-- Payment Schedule Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover summary-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Rental Payment</th>
                                            <th>Sales Tax</th>
                                            <th>Payment Fee</th>
                                            <th>Total Payments</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- JS will populate rows here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top mt-4">
                            <a href="{{ tenant_route('tenant.contract.step4', [$contract->pub_ref]) }}"
                                class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </a>
                            <div>
                                <button type="button" class="btn btn-danger mr-2" id="cancelBtn">
                                    <i class="fas fa-times mr-2"></i> Cancel & Delete
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Continue <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- jsPDF core -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <!-- jsPDF AutoTable plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inputs from backend
            const startDate = new Date('{{ $contract->first_payment_date }}');
            const retailValue = parseFloat('{{ $contract->retail_value ?? 0 }}');
            const downPayment = parseFloat('{{ $contract->down_payment ?? 0 }}');
            const rentalFactor = parseFloat('{{ $contract->rental_factor ?? 2.5 }}');
            const leaseOption = '{{ $contract->lease_term }}';
            const salesTaxRate = 6.35 / 100;
            const fee = 5;

            // Calculate total contract value
            const totalContractValue = (retailValue - downPayment) * rentalFactor;

            // Parse lease option
            let frequency = 'weekly', termMonths = 12;
            if (leaseOption.startsWith('w_')) {
                frequency = 'weekly';
                termMonths = parseInt(leaseOption.replace('w_', ''));
            } else if (leaseOption.startsWith('b_')) {
                frequency = 'biweekly';
                termMonths = parseInt(leaseOption.replace('b_', ''));
            } else if (leaseOption.startsWith('m_')) {
                frequency = 'monthly';
                termMonths = parseInt(leaseOption.replace('m_', ''));
            }

            // Update summary text
            document.getElementById('payment-frequency-text').textContent = frequency.charAt(0).toUpperCase() + frequency.slice(1) + ' pay contract';
            document.getElementById('down-payment-text').textContent = `$${downPayment.toFixed(2)}`;

            // Determine number of payments
            let paymentsCount;
            if (frequency === 'weekly') paymentsCount = termMonths * 4;
            else if (frequency === 'biweekly') paymentsCount = termMonths * 2;
            else paymentsCount = termMonths;

            const remaining = totalContractValue;
            const basePayment = remaining / paymentsCount;

            const tbody = document.querySelector('.summary-table tbody');
            tbody.innerHTML = '';

            // Starting balance row
            let balance = 0;
            let row = document.createElement('tr');
            row.innerHTML = `<td>Starting Balance</td><td colspan="4"></td><td>$0.00</td>`;
            tbody.appendChild(row);

            // Down payment row
            balance += downPayment;
            const tax = +(downPayment * salesTaxRate).toFixed(2);
            const totalDue = +(downPayment + tax + fee).toFixed(2);
            document.getElementById('today-down-text').textContent = `$${downPayment.toFixed(2)}`;
            document.getElementById('today-tax-text').textContent = `$${tax.toFixed(2)}`;
            document.getElementById('today-total-text').textContent = `$${totalDue.toFixed(2)}`;

            row = document.createElement('tr');
            row.innerHTML = `<td>${startDate.toLocaleDateString()}</td>
                                 <td>$${downPayment.toFixed(2)}</td>
                                 <td>$${tax}</td>
                                 <td>$${fee.toFixed(2)}</td>
                                 <td class="font-weight-bold">$${totalDue.toFixed(2)}</td>
                                 <td class="font-weight-bold">$${balance.toFixed(2)}</td>`;
            tbody.appendChild(row);

            // Generate subsequent payments
            let currentDate = new Date(startDate);
            for (let i = 1; i <= paymentsCount; i++) {
                if (frequency === 'weekly') currentDate.setDate(currentDate.getDate() + 7);
                else if (frequency === 'biweekly') currentDate.setDate(currentDate.getDate() + 14);
                else currentDate.setMonth(currentDate.getMonth() + 1);

                const paymentTax = +(basePayment * salesTaxRate).toFixed(2);
                const paymentTotal = +(basePayment + paymentTax + fee).toFixed(2);
                balance += basePayment;

                row = document.createElement('tr');
                row.innerHTML = `<td>${currentDate.toLocaleDateString()}</td>
                                     <td>$${basePayment.toFixed(2)}</td>
                                     <td>$${paymentTax.toFixed(2)}</td>
                                     <td>$${fee.toFixed(2)}</td>
                                     <td>$${paymentTotal.toFixed(2)}</td>
                                     <td class="font-weight-bold">$${balance.toFixed(2)}</td>`;
                tbody.appendChild(row);
            }

            // Download CSV
            document.getElementById('download-csv').addEventListener('click', () => {
                let csv = 'Date,Rental Payment,Sales Tax,Payment Fee,Total Payments,Balance\n';
                tbody.querySelectorAll('tr').forEach(tr => {
                    const cols = Array.from(tr.children).map(td => td.textContent.replace('$', '').trim());
                    csv += cols.join(',') + '\n';
                });

                const blob = new Blob([csv], { type: 'text/csv' });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'payment_schedule.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            });

            // Download PDF using jsPDF
            document.getElementById('download-pdf').addEventListener('click', () => {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Title
                doc.setFontSize(16);
                doc.text('Payment Schedule', 14, 20);

                // Contract Info
                doc.setFontSize(10);
                doc.text(`Contract: {{ $contract->pub_ref }}`, 14, 30);
                doc.text(`Customer: {{ $contract->customer->first_name ?? '' }} {{ $contract->customer->last_name ?? '' }}`, 14, 35);
                doc.text(`Date: ${new Date().toLocaleDateString()}`, 14, 40);

                // Define table headers explicitly
                const headers = ['Date', 'Rental Payment', 'Sales Tax', 'Payment Fee', 'Total Payments', 'Balance'];

                // Collect table body
                const body = [];
                tbody.querySelectorAll('tr').forEach((tr, index) => {
                    if (index === 0) return; // skip first row (Starting Balance)

                    const row = Array.from(tr.children).map(td => td.textContent.trim());
                    body.push(row);
                });

                // Generate table
                doc.autoTable({
                    head: [headers],
                    body: body,
                    startY: 50,
                    theme: 'grid',
                    styles: { fontSize: 8 }
                });

                doc.save('payment_schedule.pdf');
            });

            // Cancel button
            document.getElementById('cancelBtn').addEventListener('click', function () {
                if (confirm('Are you sure you want to cancel and delete this contract?')) {
                    window.location.href = "{{ route('tenant.contract.index', request()->route('tenant_domain')) }}";
                }
            });
        });
    </script>
@endpush