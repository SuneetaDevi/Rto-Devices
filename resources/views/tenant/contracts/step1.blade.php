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
                    <form method="post" action="{{ tenant_route('tenant.contract.step2', [$contract->pub_ref]) }}">
                        @csrf
                        <input type="hidden" name="contract_id" value="{{ $contract->id }}">

                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            @for ($i = 1; $i <= 8; $i++)
                                <div class="step-circle @if($i == 1) active @endif">{{ $i }}</div>
                            @endfor
                        </div>

                        <h3 class="text-center mb-4">Contract Security</h3>

                        <p class="lead text-center mb-4">Do you want to secure this contract with a device lock?</p>

                        <!-- Toggle Switch -->
                        <div class="d-flex align-items-center mb-4">
                            <span class="text-primary">YES</span>
                            <div class="custom-control custom-switch ml-3">
                                <input type="checkbox" name="is_device_lock_installed" class="custom-control-input" id="deviceLockSwitch" 
                                    {{ $contract->is_device_lock_installed ? 'checked' : '' }}>
                                <label class="custom-control-label" for="deviceLockSwitch"></label>
                            </div>
                        </div>

                        <!-- IMEI / SERIAL Input -->
                        <div class="form-group mb-4">
                            <label for="imeiSerial" class="form-label small fw-semibold text-primary">IMEI / SERIAL *</label>
                            <input type="text" class="form-control form-control-minimal" id="imeiSerial" name="imei_serial"
                                value="{{ old('imei_serial', $contract->imei_serial) }}"
                                placeholder="" {{ $contract->imei_serial ? '' : 'readonly' }}>
                        </div>

                        <!-- DEVICE MANUFACTURER / MODEL Input (Read-only) -->
                        <div class="form-group mb-4">
                            <label for="deviceModel" class="form-label small fw-semibold text-muted">DEVICE MANUFACTURER / MODEL *</label>
                            <input type="text" class="form-control form-control-disabled" id="deviceModel" value="{{ $contract->imei_serial ? 'Auto-detected from IMEI' : 'N/A' }}"
                                readonly>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </button>
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
    <script>
        document.getElementById('deviceLockSwitch').addEventListener('change', function () {
            const imeiInput = document.getElementById('imeiSerial');
            const deviceModelInput = document.getElementById('deviceModel');

            if (this.checked) {
                imeiInput.removeAttribute('readonly');
                imeiInput.classList.remove('form-control-disabled');
                imeiInput.classList.add('form-control-minimal');
                imeiInput.focus();
            } else {
                imeiInput.setAttribute('readonly', true);
                imeiInput.classList.remove('form-control-minimal');
                imeiInput.classList.add('form-control-disabled');
                deviceModelInput.value = 'N/A';
                imeiInput.value = '';
            }
        });

        // Auto-detect device from IMEI (simulated)
        document.getElementById('imeiSerial').addEventListener('blur', function() {
            if(this.value.trim() !== '') {
                document.getElementById('deviceModel').value = 'Auto-detected from IMEI';
            }
        });

        // Cancel button
        document.getElementById('cancelBtn').addEventListener('click', function() {
            if(confirm('Are you sure you want to cancel and delete this contract?')) {
                window.location.href = "{{ route('tenant.contract.index', request()->route('tenant_domain')) }}";
            }
        });
    </script>
@endpush