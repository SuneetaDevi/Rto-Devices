<!-- JOURNAL Tab -->
<div class="tab-pane fade" id="journal" role="tabpanel" aria-labelledby="journal-tab">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-success mr-2"><i class="fas fa-plus-circle mr-1"></i> Add CCN Payment</button>
                <button class="btn btn-info"><i class="fas fa-print mr-1"></i> Print History</button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped mb-0" id="journalTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Type</th>
                            <th>Tender</th>
                            <th>CC Last 4</th>
                            <th>Reason Desc</th>
                            <th>Inv / Pmt #</th>
                            <th>Auth Number</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Amount</th>
                            <th>Sales Tax</th>
                            <th>Fee</th>
                            <th>Total Payment Auth</th>
                            <th>Total Payment Received</th>
                            <th>Contract Running Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- JS will populate rows here --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('style')
    <style>
        #journalTable th,
        #journalTable td {
            white-space: nowrap;
            text-align: right;
        }

        #journalTable th:first-child,
        #journalTable td:first-child {
            text-align: left;
        }

        #journalTable td.text-primary {
            font-weight: 500;
        }

        /* Make table scrollable horizontally on small screens */
        .table-responsive {
            overflow-x: auto;
        }
    </style>
@endpush

@push('script')
    <script>
        // Dummy JSON data
        const journalData = [
            {
                type: "Invoice",
                tender: "",
                ccLast4: "",
                reason: "",
                invPmt: "792046",
                auth: "",
                date: "07/16/2025",
                time: "",
                amount: 205.80,
                tax: "",
                fee: "",
                totalAuth: "",
                totalReceived: "",
                balance: 205.80
            },
            {
                type: "Payment",
                tender: "Cash",
                ccLast4: "",
                reason: "",
                invPmt: "332875",
                auth: "",
                date: "07/16/2025",
                time: "02:42:07 PM",
                amount: 205.80,
                tax: 13.07,
                fee: 5.00,
                totalAuth: 223.87,
                totalReceived: 223.87,
                balance: 0.00
            },
            {
                type: "Invoice",
                tender: "",
                ccLast4: "",
                reason: "",
                invPmt: "792047",
                auth: "",
                date: "07/18/2025",
                time: "",
                amount: 20.39,
                tax: "",
                fee: "",
                totalAuth: "",
                totalReceived: "",
                balance: 20.39
            },
            {
                type: "Payment",
                tender: "Cash",
                ccLast4: "",
                reason: "",
                invPmt: "334155",
                auth: "",
                date: "07/18/2025",
                time: "12:15:42 PM",
                amount: 20.39,
                tax: 1.29,
                fee: 5.00,
                totalAuth: 26.68,
                totalReceived: 26.68,
                balance: 0.00
            }
        ];

        const tbody = document.querySelector("#journalTable tbody");

        journalData.forEach(item => {
            const tr = document.createElement('tr');

            tr.innerHTML = `
                    <td class="text-primary"><i class="fas fa-${item.type === 'Invoice' ? 'file-invoice' : 'money-bill-wave'}"></i> ${item.type}</td>
                    <td>${item.tender}</td>
                    <td>${item.ccLast4}</td>
                    <td>${item.reason}</td>
                    <td>${item.invPmt}</td>
                    <td>${item.auth}</td>
                    <td>${item.date}</td>
                    <td>${item.time}</td>
                    <td>$${item.amount.toFixed(2)}</td>
                    <td>${item.tax ? '$' + item.tax.toFixed(2) : ''}</td>
                    <td>${item.fee ? '$' + item.fee.toFixed(2) : ''}</td>
                    <td>${item.totalAuth ? '$' + item.totalAuth.toFixed(2) : ''}</td>
                    <td>${item.totalReceived ? '$' + item.totalReceived.toFixed(2) : ''}</td>
                    <td class="font-weight-bold text-right">$${item.balance.toFixed(2)}</td>
                `;

            tbody.appendChild(tr);
        });
    </script>
@endpush