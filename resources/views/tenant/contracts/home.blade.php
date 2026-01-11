@extends('tenant.layouts.master')
@section('dashboard_active', 'active')
@section('title', $title)
@push('style')
    <style>
        /* Card hover effect */
        .action-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        /* Card icon size */
        .action-card i {
            font-size: 2rem;
        }

        .action-card span {
            display: block;
            margin-top: 0.5rem;
            font-weight: 500;
            font-size: 1rem;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">

        {{-- Main Content --}}
        <div class="content">
            <div class="container-fluid py-4">

                {{-- Search Bar --}}
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8 col-lg-6">
                        <div class="input-group input-group-lg shadow rounded">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control border-left-0" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Cards --}}
                <div class="row justify-content-center g-4">

                    {{-- Card 1: Contract Calculator --}}
                    <div class="col-md-4">
                        <a href="#" id="contractCalculatorLink" class="text-decoration-none">
                            <div class="card text-center shadow h-100 border-0 rounded action-card py-4">
                                <i class="fas fa-calculator text-primary"></i>
                                <span>Contract Calculator</span>
                            </div>
                        </a>
                    </div>

                    {{-- Card 2: Create New Contract --}}
                    <div class="col-md-4">
                        <a href="{{ route('tenant.contract.create', ['tenant_domain' => $tenant->subdomain ?? request()->route('tenant_domain'), 'step' => 1]) }}"
                            class="text-decoration-none">
                            <div class="card text-center shadow h-100 border-0 rounded action-card py-4">
                                <i class="fas fa-plus text-success"></i>
                                <span>Create New Contract</span>
                            </div>
                        </a>
                    </div>

                    {{-- Card 3: View Reports --}}
                    <div class="col-md-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-center shadow h-100 border-0 rounded action-card py-4">
                                <i class="fas fa-eye text-info"></i>
                                <span>View Your Reports</span>
                            </div>
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </div>

    {{-- Contract Calculator Modal --}}
    <div class="modal fade" id="contractCalculatorModal" tabindex="-1" role="dialog"
        aria-labelledby="contractCalculatorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content rounded shadow border-0 overflow-hidden">

                {{-- Modal Header --}}
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="contractCalculatorModalLabel">Contract Calculator</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="modal-body bg-light p-4">
                    <form class="text-center w-100" style="max-width: 700px; margin:auto">

                        {{-- Input Fields --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="calcRetailValue">Retail Value ($)</label>
                                <input type="number" class="form-control" id="calcRetailValue" value="200"
                                    min="200" max="6000">
                                <small class="text-muted">Min $200 | Max $6000</small>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="calcDownPayment">Down Payment ($)</label>
                                <input type="number" class="form-control" id="calcDownPayment" value="40"
                                    min="0">
                                <small class="text-muted">$60 min | $300 max | $90 default</small>
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="form-group col-md-6">
                                <label for="calcRentalFactor">Rental Factor</label>
                                <input type="number" class="form-control" id="calcRentalFactor" value="2.5"
                                    step="0.01" min="1.50" max="5.00">
                                <small class="text-muted">Min 1.50 | Max 5.00 | Default 2.50</small>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="calcTotalContractValue">Total Contract Value ($)</label>
                                <input type="text" class="form-control bg-white" id="calcTotalContractValue"
                                    value="0" readonly>
                            </div>
                        </div>

                        {{-- Summary --}}
                        <div class="bg-white p-3 rounded shadow border mt-3">
                            <p id="calcSummary">Total due today: $0</p>
                        </div>

                        {{-- Lease Payment Table --}}
                        <div class="bg-white rounded shadow border mt-3 table-responsive">
                            <table class="table table-sm table-bordered" id="leasePaymentTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Lease Term</th>
                                        <th>Weekly Lease</th>
                                        <th>Bi-Weekly Lease</th>
                                        <th>Monthly Lease</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Dynamic rows --}}
                                </tbody>
                            </table>
                        </div>

                    </form>
                </div>

                {{-- Modal Footer --}}
                <div class="modal-footer bg-light d-flex justify-content-between">
                    <button type="button" id="btnPdfExport" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-file-pdf"></i> PDF
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

    <script>
        $(document).ready(function() {
            const $calculatorCard = $('#contractCalculatorLink');
            const $retail = $('#calcRetailValue');
            const $down = $('#calcDownPayment');
            const $factor = $('#calcRentalFactor');
            const $total = $('#calcTotalContractValue');
            const $summary = $('#calcSummary');
            const $tableBody = $('#leasePaymentTable tbody');
            const leaseTerms = [6, 9, 12, 18, 24, 36];

            // Show Modal
            $calculatorCard.on('click', function(e) {
                e.preventDefault();
                $('#contractCalculatorModal').modal('show');
            });

            // Calculate function
            function calculate() {
                let retail = parseFloat($retail.val()) || 0;
                let down = parseFloat($down.val()) || 0;
                let factor = parseFloat($factor.val()) || 0;
                if (down > retail) down = retail;

                const totalContract = (retail - down) * factor;
                $total.val(totalContract.toFixed(2));
                let taxAmount = down * 0.0635;
                let paymentFee = 5.00;
                let totalDueToday = down + taxAmount + 5.00

                const summaryText = `
                                                                        Today's Down Payment of <strong>$${down.toFixed(2)}</strong>,
                                                                        Sales Tax of <strong>$${taxAmount.toFixed(2)}</strong>,
                                                                        and Payment Fee of <strong>$${paymentFee.toFixed(2)}</strong>
                                                                        totaling <strong>$${totalDueToday.toFixed(2)}</strong> is due today
                                                                    `;

                $summary.html(`
                                                                                    Retail Value: <strong>$${retail.toFixed(2)}</strong> |
                                            ${summaryText} |
                                                                                    Rental Factor: <strong>${factor.toFixed(2)}</strong><br>
                                                                                    Total Contract Value: <strong>$${totalContract.toFixed(2)}</strong>
                                                                                `);

                // Lease Table
                $tableBody.empty();
                leaseTerms.forEach(term => {
                    const weekly = totalContract / (term * 4);
                    const biweekly = totalContract / (term * 2);
                    const monthly = totalContract / term;

                    $tableBody.append(`
                                                                                        <tr>
                                                                                            <td>${term} Month</td>
                                                                                            <td><input type="radio" name="lease_calc_payment"> $${weekly.toFixed(2)} × ${term * 4}</td>
                                                                                            <td><input type="radio" name="lease_calc_payment"> $${biweekly.toFixed(2)} × ${term * 2}</td>
                                                                                            <td><input type="radio" name="lease_calc_payment"> $${monthly.toFixed(2)} × ${term}</td>
                                                                                        </tr>
                                                                                    `);
                });
            }

            $retail.add($down).add($factor).on('input', calculate);
            calculate();

            // PDF Export
            $('#btnPdfExport').on('click', function() {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF({
                    unit: 'pt',
                    format: 'a4'
                });
                const margin = 40;
                const lineHeight = 18;
                let currentY = 50;

                // Title
                doc.setFontSize(18);
                doc.setFont("helvetica", "bold");
                doc.text('Contract Calculator Summary', margin, currentY);
                currentY += lineHeight + 10;

                // Underline
                doc.setLineWidth(1);
                doc.line(margin, currentY, 555, currentY);
                currentY += 15;

                // Summary
                doc.setFontSize(12);
                doc.setFont("helvetica", "normal");
                const retailVal = parseFloat($retail.val()) || 0;
                const downVal = parseFloat($down.val()) || 0;
                const factorVal = parseFloat($factor.val()) || 0;
                const totalVal = parseFloat($total.val()) || 0;
                const summaryText = [
                    `Retail Value: $${retailVal.toFixed(2)}`,
                    `Down Payment: $${downVal.toFixed(2)}`,
                    `Rental Factor: ${factorVal.toFixed(2)}`,
                    `Total Contract Value: $${totalVal.toFixed(2)}`
                ];
                summaryText.forEach(text => {
                    doc.text(text, margin, currentY);
                    currentY += lineHeight;
                });
                currentY += 10;

                // Table
                const headers = [
                    ["Lease Term", "Weekly Lease", "Bi-Weekly Lease", "Monthly Lease"]
                ];
                const body = [];
                $tableBody.find('tr').each(function() {
                    const row = [];
                    $(this).find('td').each(function() {
                        row.push($(this).text().trim());
                    });
                    body.push(row);
                });

                doc.autoTable({
                    head: headers,
                    body: body,
                    startY: currentY,
                    margin: {
                        left: margin,
                        right: margin
                    },
                    theme: 'grid',
                    styles: {
                        fontSize: 11,
                        halign: 'center'
                    },
                    headStyles: {
                        fillColor: [41, 128, 185],
                        textColor: 255,
                        fontStyle: 'bold'
                    },
                    alternateRowStyles: {
                        fillColor: [245, 245, 245]
                    }
                });

                // Footer
                const pageHeight = doc.internal.pageSize.height;
                doc.setFontSize(10);
                doc.setTextColor(150);
                doc.text(`Generated on: ${new Date().toLocaleString()}`, margin, pageHeight - 20);

                doc.save('Contract_Calculator_Summary.pdf');
            });
        });
    </script>
@endpush
