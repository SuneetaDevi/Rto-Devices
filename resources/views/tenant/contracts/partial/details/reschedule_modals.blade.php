@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">



    <style>
        /* Prevent label from splitting into two lines */
        #modalStep2 label[for="paymentDay"] {
            white-space: nowrap;
        }

        #paymentDay {
            max-width: 250px;
            /* adjust size as needed */
            display: inline-block;
        }

        /* Prevent dropdown options from breaking lines */
        #paymentDay {
            white-space: nowrap;
        }
    </style>
@endpush


<div class="modal fade" id="modalStep1" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Reschedule Contract</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label for="priorBalance">Prior Outstanding Balance</label>
                    <p>$<span id="priorBalance">{{ number_format($contract->payment_left, 2) }}</span></p>
                </div>

                <div class="form-group">
                    <label for="rescheduleFee">Reschedule Fee</label>
                    <input type="number" class="form-control" id="rescheduleFee" value="15.00" step="0.01">
                </div>

                <div class="form-group">
                    <label for="newContractfee">New Contract Fee</label>
                    <p>$<span id="newContractfee">{{ number_format(($contract->payment_left + 15.00), 2) }}</span></p>
                </div>

                <div class="form-group">
                    <label for="paymentAm ountTowardsBlance">Payment Amount Towards Balance</label>
                    <input type="number" class="form-control" id="paymentAmountTowardsBlance" value="15.00" step="0.01"
                        readonly>
                </div>

                <div class="alert alert-info">
                    <strong>Tax( 6.350%):</strong> <span id="tax">0.00</span><br>
                    <strong>Payment Fee:</strong> <span id="paymentFee">0.00</span><br>
                    <strong>Total:</strong> <span id="totalPayableToday">0.00</span>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="goToStep2">Continue</button>
            </div>
        </div>
    </div>
</div>
<form action="{{ tenant_route('tenant.contract.reschedule') }}" method="POST">
    @csrf
    <input type="hidden" name="contract_id" value="{{ $contract->pub_ref }}">
    <input type="hidden" name="priorBalance" id="formPriorBalance">
    <input type="hidden" name="rescheduleFee" id="formRescheduleFee">
    <input type="hidden" name="tax" id="formTax">
    <input type="hidden" name="paymentFee" id="formPaymentFee">
    <input type="hidden" name="totalPayableToday" id="formTotalPayableToday">
    <input type="hidden" name="newContractfee" id="formNewContractFee">
    <input type="hidden" name="paymentOption" id="formPaymentOption">

    <div class="modal fade" id="modalStep2" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Select Payment Term</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <!-- Balance Alert -->
                    <div class="alert alert-success">
                        Balance After Payment: <strong><span id="step2Balance"></span></strong>
                    </div>

                    <!-- Payment Plan Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="paymentPlanTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Term</th>
                                    <th>Weekly</th>
                                    <th>Bi-Weekly</th>
                                    <th>Monthly</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <!-- Payment Day & Start Date -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paymentDay" class="font-weight-bold">Payment Day</label>
                                <select class="form-control" id="paymentDay" name="paymentDay">
                                    <option value="">Select a day</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="startDateStep2" class="font-weight-bold">Start Date</label>
                                <input type="text" class="form-control datepicker" id="startDateStep2" name="startDate"
                                    placeholder="Select start date">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                    <button type="submit" class="btn btn-primary">Continue</button>
                </div>
            </div>
        </div>
    </div>
</form>


@push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>


    <script>
        $(function () {

            // ---------------------------
            // INIT DATE PICKER
            // ---------------------------

            // Initialize Flatpickr
            // Initialize Flatpickr
            let fp = flatpickr(".datepicker", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                defaultDate: "today",
                onChange: function (selectedDates, dateStr, instance) {
                    updateDaySelect(selectedDates[0]);
                },
                onReady: function (selectedDates, dateStr, instance) {
                    // Set day on load
                    updateDaySelect(instance.selectedDates[0]);
                }
            });

            // Function to update day select
            function updateDaySelect(date) {
                if (!date) return;
                let days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                let dayName = days[date.getDay()];
                document.getElementById("paymentDay").value = dayName;
            }


            // ---------------------------
            // SHOW FIRST MODAL
            // ---------------------------
            $("#rescheduleButton").click(function () {
                $("#modalStep1").modal("show");
                calculateTotals();
            });

            // --- Auto recalc when fields change ---
            $("#rescheduleFee")
                .on("input", calculateTotals);

            function calculateTotals() {
                // Get values
                let priorBalance = parseFloat($("#priorBalance").text().replace(/,/g, '')) || 0;
                let rescheduleFee = parseFloat($("#rescheduleFee").val()) || 0;

                // Constants
                let taxRate = 6.350; // %
                let paymentFee = 5.00; // fixed fee

                // Calculations
                let tax = rescheduleFee * (taxRate / 100);
                let totalPayableToday = rescheduleFee + tax + paymentFee;
                let balanceAfterPayment = priorBalance;
                let newContractfee = priorBalance + rescheduleFee;
                // Update UI
                $("#tax").text(tax.toFixed(2));
                $("#paymentFee").text(paymentFee.toFixed(2));
                $("#paymentAmountTowardsBlance").val(rescheduleFee.toFixed(2));
                $("#totalPayableToday").text(totalPayableToday.toFixed(2));
                $("#newContractfee").text(newContractfee.toFixed(2));
            }


            // ---------------------------
            // CONTINUE TO STEP 2
            // ---------------------------
            $("#goToStep2").click(function () {
                // Hide Step 1
                $("#modalStep1").modal("hide");

                // Copy values to hidden inputs
                $("#formPriorBalance").val($("#priorBalance").text());
                $("#formRescheduleFee").val($("#rescheduleFee").val());
                $("#formTax").val($("#tax").text());
                $("#formPaymentFee").val($("#paymentFee").text());
                $("#formTotalPayableToday").val($("#totalPayableToday").text());
                $("#formNewContractFee").val($("#newContractfee").text());

                // Payment plan selection (will update later when user clicks radio)
                $('input[name="paymentOption"]').change(function () {
                    $("#formPaymentOption").val($(this).val());
                });

                // Set balance display
                let balance = parseFloat($("#newContractfee").text());
                $("#step2Balance").text(balance.toFixed(2));

                // Generate payment plan table
                generatePaymentPlan(balance);

                // Show Step 2
                $("#modalStep2").modal("show");
            });


            // ---------------------------
            // PAYMENT PLAN GENERATION
            // ---------------------------
            function generatePaymentPlan(balance) {

                const terms = [
                    { label: "6 Months", weeks: 27, biweeks: 14, months: 6 },
                    { label: "9 Months", weeks: 40, biweeks: 20, months: 9 },
                    { label: "12 Months", weeks: 53, biweeks: 27, months: 12 },
                    { label: "18 Months", weeks: 79, biweeks: 40, months: 18 },
                    { label: "24 Months", weeks: 105, biweeks: 53, months: 24 },
                    { label: "36 Months", weeks: 157, biweeks: 79, months: 36 }
                ];

                let table = "";

                terms.forEach((t, index) => {
                    table += `
                                                                                                                                                                                                                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td>${t.label}</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="form-check">
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <input class="form-check-input" type="radio" name="paymentOption" id="weekly${index}" value="Weekly-${index}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <label class="form-check-label" for="weekly${index}">$${(balance / t.weeks).toFixed(2)} × ${t.weeks}</label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="form-check">
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <input class="form-check-input" type="radio" name="paymentOption" id="biweekly${index}" value="BiWeekly-${index}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <label class="form-check-label" for="biweekly${index}">$${(balance / t.biweeks).toFixed(2)} × ${t.biweeks}</label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="form-check">
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <input class="form-check-input" type="radio" name="paymentOption" id="monthly${index}" value="Monthly-${index}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <label class="form-check-label" for="monthly${index}">$${(balance / t.months).toFixed(2)} × ${t.months}</label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                            `;
                });

                $("#paymentPlanTable tbody").html(table);
            }


        });
    </script>
@endpush