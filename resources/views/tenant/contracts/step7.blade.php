@extends('tenant.layouts.master')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('tenant.contract.index', request()->route('tenant_domain')) }}">Contracts</a>
    </li>
    <li class="breadcrumb-item active">Payment</li>
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('shop/cotracts/steps.css') }}">

@endpush
@section('content')
    <div class="content-wrapper">
        <div class="content py-5">
            <div class="container">
                <div class="creation-container">

                    <form id="payment-form" method="POST"
                        action="{{ tenant_route('tenant.contract.processPayment', [$contract->pub_ref]) }}">
                        @csrf

                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            @for ($i = 1; $i <= 8; $i++)
                                <div class="step-circle @if($i <= 7) active @endif">{{ $i }}</div>
                            @endfor
                        </div>

                        <h3 class="text-center mb-5">Secure Payment</h3>

                        <div class="row justify-content-center">
                            <div class="col-md-6">

                                <div class="amount-due-block mb-4">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Amount to charge:</span>
                                        <span class="fw-bold text-dark">${{ number_format($amount, 2) }}</span>
                                    </div>
                                </div>

                                <!-- Stripe Card Element -->
                                <label class="form-label small text-muted mb-1">Card Details</label>
                                <div id="card-element" class="form-control form-control-minimal form-input-box"
                                    style="padding: 12px;"></div>

                                <div id="card-errors" class="text-danger small mt-2"></div>

                                <!-- Submit Button -->
                                <div class="text-end mt-4">
                                    <button class="btn btn-primary btn-sm" id="submitBtn" type="submit">
                                        Pay ${{ number_format($amount, 2) }}
                                    </button>
                                </div>

                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <!-- <div class="d-flex justify-content-between align-items-center pt-4 border-top mt-5">
                                            <button type="button" class="btn btn-link text-muted px-0" onclick="window.history.back()">
                                                <i class="fas fa-arrow-left mr-2"></i> Back
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary px-4" disabled>
                                                Continue <i class="fas fa-arrow-right ml-2"></i>
                                            </button>
                                        </div> -->

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        const elements = stripe.elements();

        const card = elements.create('card', {
            hidePostalCode: true
        });
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        const errorBox = document.getElementById('card-errors');

        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: 'card',
                card: card
            });

            if (error) {
                errorBox.textContent = error.message;
                return;
            }

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'payment_method_id';
            input.value = paymentMethod.id;
            form.appendChild(input);

            form.submit();
        });
    </script>
@endpush