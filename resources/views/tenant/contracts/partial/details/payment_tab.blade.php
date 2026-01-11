<div class="tab-pane fade show active" id="make-payment" role="tabpanel" aria-labelledby="make-payment-tab">
    <div class="row">
        <!-- Left Side: Next Payment Info -->
        <div class="col-md-6 mb-4">
            <div class="card p-3 h-100">
                <h5 class="mb-3">Next Payment Info</h5>
                <div class="row mb-2">
                    <div class="col-6 text-muted">Next Amount Due:</div>
                    <div class="col-6 text-right font-weight-bold">$20.39</div>
                </div>
                <div class="row">
                    <div class="col-6 text-muted">Next Due Date:</div>
                    <div class="col-6 text-right font-weight-bold">11/2/2025</div>
                </div>
            </div>
        </div>

        <!-- Right Side: Payment Form -->
        <div class="col-md-6">
            <div class="card p-3 h-100">
                <h5 class="mb-3">Make Payment</h5>
                <form id="paymentForm">
                    <!-- Payment Amount -->
                    <div class="form-group row mb-3 align-items-center">
                        <label for="paymentAmount" class="col-6 col-form-label text-muted">Payment Amount</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bold">$20.39</span>
                        </div>
                    </div>

                    <!-- Calculation Breakdown -->
                    <div class="payment-summary mb-3 border p-2 rounded">
                        <div class="row d-flex justify-content-between">
                            <div class="col-6 text-muted">Tax (6.35%):</div>
                            <div class="col-6 text-right">$1.29</div>
                        </div>
                        <div class="row d-flex justify-content-between">
                            <div class="col-6 text-muted">Payment Fee:</div>
                            <div class="col-6 text-right">$5.00</div>
                        </div>
                        <div class="row d-flex justify-content-between font-weight-bold border-top pt-2 total">
                            <div class="col-6">Total:</div>
                            <div class="col-6 text-right">$26.68</div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="form-group row mb-3 align-items-center">
                        <label for="paymentMethod" class="col-6 col-form-label text-muted">Payment Method</label>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0">
                                        <i class="fas fa-money-bill-wave text-success"></i>
                                    </span>
                                </div>
                                <select class="form-control" id="paymentMethod">
                                    <option selected>Cash</option>
                                    <option>Credit Card</option>
                                    <option>Debit Card</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Amount Tendered -->
                    <div class="form-group row mb-3 align-items-center">
                        <label for="amountTendered" class="col-6 col-form-label text-muted">Amount Tendered</label>
                        <div class="col-6">
                            <input type="number" class="form-control" id="amountTendered" value="26" step="0.01"
                                min="0">
                            <small class="form-text text-danger" id="requiredAmount">Amount received must be greater
                                than or equal to
                                total</small>
                        </div>
                    </div>

                    <!-- Change Due & Submit -->
                    <div class="form-group row mt-4 align-items-center">
                        <div class="col-6 d-flex align-items-center">
                            <span class="text-muted mr-2">Change Due:</span>
                            <span class="font-weight-bold" id="changeDue">$0.00</span>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-primary border" id="submitBtn" disabled>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        const total = 26.68;
        const amountInput = document.getElementById('amountTendered');
        const changeDue = document.getElementById('changeDue');
        const submitBtn = document.getElementById('submitBtn');

        amountInput.addEventListener('input', () => {
            const value = parseFloat(amountInput.value);
            if (!isNaN(value) && value >= total) {
                changeDue.textContent = `$${(value - total).toFixed(2)}`;
                $("#requiredAmount").hide();
                submitBtn.disabled = false;
            } else {
                changeDue.textContent = '$0.00';
                submitBtn.disabled = true;
            }
        });
    </script>
@endpush