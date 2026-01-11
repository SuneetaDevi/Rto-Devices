@extends('tenant.layouts.master')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('tenant.contract.index', request()->route('tenant_domain')) }}">Contracts</a>
    </li>
    <li class="breadcrumb-item active">Step 4: Contract Details</li>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/cotracts/steps.css') }}">
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content py-5">
            <div class="container">
                <div class="creation-container">
                    <form method="post" action="{{ tenant_route('tenant.contract.step5', [$contract->pub_ref]) }}">
                        @csrf
                        <input type="hidden" name="contract_id" value="{{ $contract->id }}">

                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            @for ($i = 1; $i <= 8; $i++)
                                <div class="step-circle @if($i <= 4) active @endif">{{ $i }}</div>
                            @endfor
                        </div>

                        <h3 class="text-center mb-5">Contract Details</h3>

                        <!-- Row 1: Retail Value & Down Payment -->
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label class="form-label-top" for="retailValue">Retail Value *</label>
                                <input type="number" class="form-control form-control-minimal" id="retailValue"
                                    name="retail_value" value="{{ old('retail_value', $contract->retail_value ?? 200) }}" step="0.01" min="200">
                                <small class="form-text text-muted">Retail Value: min $200.00 | max $6,000.00</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label-top" for="downPayment">Down Payment *</label>
                                <input type="number" class="form-control form-control-minimal" id="downPayment"
                                    name="down_payment" value="{{ old('down_payment', $contract->down_payment ?? 60) }}"
                                    min="{{ (old('retail_value', $contract->retail_value ?? 200)) * 0.2 }}"
                                    max="{{ old('retail_value', $contract->retail_value ?? 200) }}" step="0.01">
                                <small class="form-text text-muted">Min 20% | Max 100% | Default 30% of Retail Value</small>
                            </div>
                        </div>

                        <!-- Row 2: Rental Factor & Total Contract Value -->
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label class="form-label-top" for="rentalFactor">Rental Factor *</label>
                                <input type="number" class="form-control form-control-minimal" id="rentalFactor"
                                    name="rental_factor" value="{{ old('rental_factor', $contract->rental_factor ?? 2.5) }}" step="0.01" min="1.5"
                                    max="5.0">
                                <small class="form-text text-muted">min 1.50 | max 5.00 | default 2.50</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label-top" for="totalContractValue">Total Contract Value</label>
                                <input type="text" class="form-control form-control-minimal" id="totalContractValue"
                                    name="total_contract_value" value="{{ old('total_contract_value', $contract->total_contract_value ?? '') }}"
                                    readonly>
                            </div>
                        </div>

                        <!-- Row 3: Merchandise Condition & Early Payoff Policy -->
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label class="form-label-top" for="merchandiseCondition">Merchandise Condition *</label>
                                <select class="form-control form-control-minimal" id="merchandiseCondition"
                                    name="merchandise_condition">
                                    <option value="">Select Condition</option>
                                    <option value="new" {{ old('merchandise_condition', $contract->merchandise_condition) === 'new' ? 'selected' : '' }}>NEW</option>
                                    <option value="used" {{ old('merchandise_condition', $contract->merchandise_condition) === 'used' ? 'selected' : '' }}>USED</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label-top" for="earlyPayoffPolicy">Early Payoff Policy</label>
                                <select class="form-control form-control-minimal" id="earlyPayoffPolicy"
                                    name="early_payoff_policy">
                                    <option value="">Select Policy</option>
                                    <option value="30epo" {{ old('early_payoff_policy', $contract->early_payoff_policy) === '30epo' ? 'selected' : '' }}>30 EPO</option>
                                    <option value="60epo" {{ old('early_payoff_policy', $contract->early_payoff_policy) === '60epo' ? 'selected' : '' }}>60 EPO</option>
                                    <option value="90epo" {{ old('early_payoff_policy', $contract->early_payoff_policy) === '90epo' ? 'selected' : '' }}>90 EPO</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 4: Merchandise Description -->
                        <div class="form-row mb-5">
                            <div class="form-group col-md-6">
                                <label class="form-label-top" for="merchandiseDescription">Merchandise Description *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-minimal" id="merchandiseDescription"
                                        name="merchandise_description"
                                        value="{{ old('merchandise_description', $contract->merchandise_description ?? '') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text border-0 bg-transparent"><i
                                                class="fas fa-check-circle text-success"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lease Payment Matrix -->
                        <div class="text-center mb-5">
                            <table class="payment-matrix-table">
                                <thead>
                                    <tr>
                                        <th>Lease Term</th>
                                        <th>Weekly Lease</th>
                                        <th>Bi-Weekly Lease</th>
                                        <th>Monthly Lease</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $terms = [6, 9, 12, 18, 24, 36];
                                    @endphp
                                    @foreach($terms as $term)
                                        <tr>
                                            <td>{{ $term }} months</td>
                                            <td>
                                                <input type="radio" name="lease_payment" id="w_{{ $term }}"
                                                    value="w_{{ $term }}" 
                                                    {{ old('lease_payment', $contract->lease_term) == "w_{$term}" ? 'checked' : '' }}>
                                                <label for="w_{{ $term }}" id="w_label_{{ $term }}">$0.00 x {{ $term * 4 }}</label>
                                            </td>
                                            <td>
                                                <input type="radio" name="lease_payment" id="b_{{ $term }}"
                                                    value="b_{{ $term }}"
                                                    {{ old('lease_payment', $contract->lease_term) == "b_{$term}" ? 'checked' : '' }}>
                                                <label for="b_{{ $term }}" id="b_label_{{ $term }}">$0.00 x {{ ceil($term * 2) }}</label>
                                            </td>
                                            <td>
                                                <input type="radio" name="lease_payment" id="m_{{ $term }}"
                                                    value="m_{{ $term }}"
                                                    {{ old('lease_payment', $contract->lease_term) == "m_{$term}" ? 'checked' : (($contract->lease_term ? '' : ($term == 12 ? 'checked' : ''))) }}>
                                                <label for="m_{{ $term }}" id="m_label_{{ $term }}">$0.00 x {{ $term }}</label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Row 5: Day of Week & Start Date -->
                        <div class="form-row mb-4 justify-content-center">
                            <div class="form-group col-md-4">
                                <label class="form-label-top" for="dayOfWeek">Day of Week *</label>
                                <select class="form-control form-control-minimal" id="dayOfWeek" name="day_of_week">
                                    <option value="">Select Day</option>
                                    @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                        <option value="{{ $day }}" 
                                            {{ old('day_of_week', $contract->day_of_week) === $day ? 'selected' : (($contract->day_of_week ? '' : ($day == 'monday' ? 'selected' : ''))) }}>
                                            {{ ucfirst($day) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label-top" for="startDate">Start Date *</label>
                                <input type="text" class="form-control form-control-minimal datepicker" required
                                    id="startDate" name="start_date" value="{{ old('start_date', $contract->first_payment_date ?? '') }}">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top action-buttons">
                            <a href="{{ tenant_route('tenant.contract.step3', [$contract->pub_ref]) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </a>
                            <div>
                                <button type="button" class="btn btn-danger mr-2" id="cancelBtn">
                                    <i class="fas fa-times mr-2"></i> Cancel & Delete
                                </button>
                                <button type="submit" class="btn btn-primary">Continue <i class="fas fa-arrow-right ml-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/flatpickr.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const retailInput = document.getElementById('retailValue');
            const downInput = document.getElementById('downPayment');
            const rentalFactorInput = document.getElementById('rentalFactor');
            const totalInput = document.getElementById('totalContractValue');

            const leaseTerms = [6, 9, 12, 18, 24, 36];

            function calculateValues(retailChanged = false) {
                let retail = parseFloat(retailInput.value) || 0;
                let down = parseFloat(downInput.value) || 0;
                const factor = parseFloat(rentalFactorInput.value) || 0;

                // Calculate min and max
                const minDown = retail * 0.2;
                const maxDown = retail;

                // If Retail changed, reset Down Payment to 30% and update min/max
                if (retailChanged) {
                    down = retail * 0.3;
                    downInput.value = down.toFixed(2);
                }

                downInput.min = minDown.toFixed(2);
                downInput.max = maxDown.toFixed(2);

                // Ensure down is within min/max if user edited manually
                if (down < minDown) down = minDown;
                if (down > maxDown) down = maxDown;

                // Calculate total contract value
                const total = (retail - down) * factor;
                totalInput.value = '$' + total.toFixed(2);

                // Update lease payment matrix
                leaseTerms.forEach(term => {
                    const weekly = (total / term / 4).toFixed(2);
                    const biweekly = (weekly * 2).toFixed(2);
                    const monthly = (weekly * 4).toFixed(2);

                    document.getElementById(`w_label_${term}`).innerHTML = ` $${weekly} x ${term * 4}`;
                    document.getElementById(`b_label_${term}`).innerHTML = ` $${biweekly} x ${Math.ceil(term * 2)}`;
                    document.getElementById(`m_label_${term}`).innerHTML = ` $${monthly} x ${term}`;
                });
            }

            // Event listeners
            retailInput.addEventListener('input', () => calculateValues(true));
            downInput.addEventListener('input', () => calculateValues(false));
            rentalFactorInput.addEventListener('input', () => calculateValues(false));

            // Initialize calculations
            calculateValues();

            // Date picker
            flatpickr(".datepicker", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                defaultDate: "{{ old('start_date', $contract->first_payment_date ?? 'today') }}"
            });

            // Cancel button
            document.getElementById('cancelBtn').addEventListener('click', function() {
                if(confirm('Are you sure you want to cancel and delete this contract?')) {
                    window.location.href = "{{ route('tenant.contract.index', request()->route('tenant_domain')) }}";
                }
            });
        });
    </script>
@endpush