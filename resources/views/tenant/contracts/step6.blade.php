@extends('tenant.layouts.master')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('tenant.contract.index', request()->route('tenant_domain')) }}">Contracts</a>
    </li>
    <li class="breadcrumb-item active">Payment Collection</li>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('shop/cotracts/steps.css') }}">
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content py-5">
            <div class="container">
                <div class="creation-container">
                    <form method="POST" action="{{ tenant_route('tenant.contract.step7', [$contract->pub_ref]) }}">
                        @csrf
                        <input type="hidden" name="contract_id" value="{{ $contract->id }}">

                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            @for ($i = 1; $i <= 8; $i++)
                                <div class="step-circle @if($i <= 6) active @endif">{{ $i }}</div>
                            @endfor
                        </div>

                        <h3 class="text-center mb-5">Payment Collection</h3>

                        <div class="form-body">
                            <div class="row justify-content-center">

                                <!-- LEFT SIDE -->
                                <div class="col-md-5 text-start pe-md-5 mb-4 mb-md-0">
                                    @php
                                        $amountDue = (float) $contract->down_payment;
                                        $fee = 5;
                                        $tax = round($amountDue * 0.0635, 2);
                                        $total = $amountDue + $fee + $tax;
                                    @endphp

                                    <div class="amount-due-block">
                                        <div class="mb-3">
                                            <span class="text-muted">Amount Due:</span>
                                            <span class="fw-bold text-dark ms-2">${{ number_format($amountDue, 2) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-muted">Due Date:</span>
                                            <span class="fw-bold text-dark ms-2">
                                                {{ \Carbon\Carbon::parse($contract->first_payment_date)->format('m/d/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- RIGHT SIDE -->
                                <div class="col-md-5 text-start ps-md-5">
                                    <!-- Payment Amount -->
                                    <div class="mb-4">
                                        <label for="paymentAmount" class="form-label small text-muted mb-1">Payment
                                            Amount</label>
                                        <input type="text"
                                            class="form-control form-control-minimal form-input-box text-dark"
                                            id="paymentAmount" value="${{ number_format($amountDue, 2) }}" readonly>
                                    </div>

                                    <!-- Tax, Fee, Total -->
                                    <div class="amount-due-block text-muted mb-4">
                                        <div class="d-flex justify-content-between">
                                            <span>Tax (6.35%):</span>
                                            <span class="text-dark fw-bold">${{ number_format($tax, 2) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Payment Fee:</span>
                                            <span class="text-dark fw-bold">${{ number_format($fee, 2) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between fw-bold text-dark border-top mt-2 pt-2">
                                            <span>Total:</span>
                                            <span class="text-dark fw-bold">${{ number_format($total, 2) }}</span>
                                        </div>
                                    </div>

                                    <!-- Payment Method -->
                                    <div class="mb-4">
                                        <label class="form-label-red mb-1">Payment Method</label>
                                        <select
                                            class="form-select form-control-minimal form-control-red-active form-input-box"
                                            id="paymentMethod" name="payment_method" required>
                                            <option value="" disabled {{ !$contract->payment_method ? 'selected' : '' }}>
                                                Select Payment Method
                                            </option>
                                            <option value="cash" {{ $contract->payment_method == 'cash' ? 'selected' : '' }}>
                                                Cash</option>
                                            <option value="credit_card" {{ $contract->payment_method == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                            <option value="debit_card" {{ $contract->payment_method == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                        </select>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary btn-sm" id="submitPayment">Submit
                                            Payment</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top mt-5">
                            <a href="{{ tenant_route('tenant.contract.step5', [$contract->pub_ref]) }}"
                                class="btn btn-link text-muted px-0">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </a>

                            <button type="button" class="btn btn-link text-danger text-decoration-none px-4" id="cancelBtn">
                                <i class="fas fa-times mr-2"></i> Cancel & Delete
                            </button>

                            <button type="button" class="btn btn-primary px-4" id="continueBtn"
                                onclick="window.location.href='{{ tenant_route('tenant.contract.step7', [$contract->pub_ref]) }}'">
                                Continue <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paymentMethod = document.getElementById('paymentMethod');
            const submitBtn = document.getElementById('submitPayment');
            const continueBtn = document.getElementById('continueBtn');

            // Enable continue button if payment method is already selected
            if (paymentMethod.value) {
                continueBtn.disabled = false;
            }

            paymentMethod.addEventListener('change', function () {
                if (this.value) {
                    submitBtn.disabled = false;
                    submitBtn.classList.replace('btn-secondary', 'btn-primary');
                    continueBtn.disabled = false;
                    continueBtn.classList.replace('btn-outline-secondary', 'btn-primary');
                }
            });

            // Form submission validation
            document.querySelector('form').addEventListener('submit', function (e) {
                if (!paymentMethod.value) {
                    e.preventDefault();
                    alert('Please select a payment method');
                }
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