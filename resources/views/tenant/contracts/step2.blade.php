@extends('tenant.layouts.master')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('tenant.contract.index', request()->route('tenant_domain')) }}">Contracts</a>
    </li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('shop/cotracts/steps.css') }}">
    <!-- ✅ Flatpickr Modern Datepicker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content py-5">
            <div class="container">
                <div class="creation-container">
                    <form method="post" action="{{ tenant_route('tenant.contract.step3', [$contract->pub_ref]) }}">
                        @csrf
                        <input type="hidden" name="contract_id" value="{{ $contract->id }}">

                        <div class="step-indicator">
                            @for ($i = 1; $i <= 8; $i++)
                                <div class="step-circle @if($i <= 2) active @endif">{{ $i }}</div>
                            @endfor
                        </div>

                        <h3 class="text-center mb-4">Customer Information</h3>

                        <div class="form-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label-top">First Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="first_name"
                                        placeholder="Enter customer's first name"
                                        value="{{ old('first_name', $contract->customer->first_name ?? '') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-top">Last Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="last_name"
                                        placeholder="Enter customer's last name"
                                        value="{{ old('last_name', $contract->customer->last_name ?? '') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-top">Phone Number<span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="phone" placeholder="(XXX) XXX-XXXX"
                                        value="{{ old('phone', $contract->customer->phone ?? '') }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label-top">Date of Birth<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control datepicker" name="dob" placeholder="MM/DD/YYYY"
                                        value="{{ old('dob', $contract->customer->dob ?? '') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-top">Full SSN<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ssn" placeholder="XXX-XX-XXXX"
                                        value="{{ old('ssn', $contract->customer->ssn ?? '') }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-9">
                                    <label class="form-label-top">Address<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address" placeholder="123 Main St"
                                        value="{{ old('address', $contract->customer->address ?? '') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label-top">Suite</label>
                                    <input type="text" class="form-control" name="suite"
                                        placeholder="Apt, Unit, Suite (Optional)"
                                        value="{{ old('suite', $contract->customer->suite ?? '') }}">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label class="form-label-top">ZIP<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="zip" placeholder="XXXXX"
                                        value="{{ old('zip', $contract->customer->zip ?? '') }}" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label-top">City<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="city" placeholder="Enter city name"
                                        value="{{ old('city', $contract->customer->city ?? '') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-top">State<span class="text-danger">*</span></label>
                                    <select name="state" class="form-control" required>
                                        <option value="" disabled selected>Select State</option>
                                        @php
                                            $states = [
                                                'AL' => 'Alabama',
                                                'AK' => 'Alaska',
                                                'AZ' => 'Arizona',
                                                'AR' => 'Arkansas',
                                                'CA' => 'California',
                                                'CO' => 'Colorado',
                                                'CT' => 'Connecticut',
                                                'DE' => 'Delaware',
                                                'FL' => 'Florida',
                                                'GA' => 'Georgia',
                                                'HI' => 'Hawaii',
                                                'ID' => 'Idaho',
                                                'IL' => 'Illinois',
                                                'IN' => 'Indiana',
                                                'IA' => 'Iowa',
                                                'KS' => 'Kansas',
                                                'KY' => 'Kentucky',
                                                'LA' => 'Louisiana',
                                                'ME' => 'Maine',
                                                'MD' => 'Maryland',
                                                'MA' => 'Massachusetts',
                                                'MI' => 'Michigan',
                                                'MN' => 'Minnesota',
                                                'MS' => 'Mississippi',
                                                'MO' => 'Missouri',
                                                'MT' => 'Montana',
                                                'NE' => 'Nebraska',
                                                'NV' => 'Nevada',
                                                'NH' => 'New Hampshire',
                                                'NJ' => 'New Jersey',
                                                'NM' => 'New Mexico',
                                                'NY' => 'New York',
                                                'NC' => 'North Carolina',
                                                'ND' => 'North Dakota',
                                                'OH' => 'Ohio',
                                                'OK' => 'Oklahoma',
                                                'OR' => 'Oregon',
                                                'PA' => 'Pennsylvania',
                                                'RI' => 'Rhode Island',
                                                'SC' => 'South Carolina',
                                                'SD' => 'South Dakota',
                                                'TN' => 'Tennessee',
                                                'TX' => 'Texas',
                                                'UT' => 'Utah',
                                                'VT' => 'Vermont',
                                                'VA' => 'Virginia',
                                                'WA' => 'Washington',
                                                'WV' => 'West Virginia',
                                                'WI' => 'Wisconsin',
                                                'WY' => 'Wyoming'
                                            ];
                                        @endphp
                                        @foreach ($states as $abbr => $name)
                                            <option value="{{ $abbr }}" {{ old('state', $contract->customer->state ?? '') == $abbr ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                        <option value="Other" {{ old('state', $contract->customer->state ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center mb-5">
                                <button type="button" class="btn btn-primary px-5 py-2" id="verifyAddressBtn">
                                    <i class="fas fa-check me-2"></i> VERIFY ADDRESS
                                </button>
                            </div>

                            <div class="text-center mt-5 pt-4 border-top">
                                <h4 class="mb-3">Email Verification</h4>
                                <p class="text-muted mb-4">Please enter an email address below to verify the customer's
                                    email.</p>
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex align-items-center" style="width: 500px;">
                                        {{-- Email is implicitly required by the original code's `required` attribute, so
                                        I'll add the asterisk here too --}}
                                        <label class="sr-only" for="emailInput">Email Address</label>
                                        <input type="email" class="form-control form-control-lg me-2"
                                            placeholder="abc@gmail.com" name="email" id="emailInput"
                                            value="{{ old('email', $contract->customer->email ?? '') }}" required>
                                        <button type="button" class="btn btn-info text-white py-2 px-4"
                                            id="verifyEmailBtn">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-4 border-top mt-5">
                            <a href="{{ tenant_route('tenant.contract.step1', [$contract->pub_ref]) }}"
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
    <!-- ✅ Flatpickr Modern Datepicker -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr(".datepicker", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            maxDate: "today",
            defaultDate: "{{ old('dob', $contract->customer->dob ?? '') }}"
        });
        // Cancel button
        document.getElementById('cancelBtn').addEventListener('click', function () {
            if (confirm('Are you sure you want to cancel and delete this contract?')) {
                window.location.href = "{{ route('tenant.contract.index', request()->route('tenant_domain')) }}";
            }
        });

        let addressVerified = false;
        let emailVerified = false;

        function updateContinueButton() {
            const btn = document.querySelector('button[type="submit"]');
            btn.disabled = !(addressVerified && emailVerified);
        }

        updateContinueButton(); // Initial state

        document.getElementById('verifyAddressBtn').addEventListener('click', function () {
            const btn = this;
            const originalText = btn.innerHTML;

            const address = document.querySelector('input[name="address"]').value;
            const zip = document.querySelector('input[name="zip"]').value;
            const city = document.querySelector('input[name="city"]').value;

            if (!address || !zip || !city) {
                alert("Please fill address, zip and city first.");
                return;
            }

            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Verifying...';
            btn.disabled = true;

            fetch("{{ tenant_route('tenant.contract.step2.addressVerify', [$contract->pub_ref]) }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    address: address,
                    zip: zip,
                    city: city
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // alert("Address verified successfully!");
                        addressVerified = true;
                        btn.classList.remove('btn-primary');
                        btn.classList.add('btn-success');
                        btn.innerHTML = 'VERIFIED';
                    } else {
                        alert("Address verification failed.");
                        btn.innerHTML = originalText;
                    }
                    btn.disabled = false;
                    updateContinueButton();
                })
                .catch(() => {
                    alert("Network error!");
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
        });


        // EMAIL VERIFICATION
        document.getElementById('verifyEmailBtn').addEventListener('click', function () {
            const btn = this;
            const email = document.querySelector('input[name="email"]').value;

            if (!email) {
                alert("Please enter an email address first.");
                return;
            }

            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            btn.disabled = true;

            fetch("{{ tenant_route('tenant.contract.step2.emailVerify', [$contract->pub_ref]) }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ email })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // alert("Verification OTP sent to " + email);
                        showOtpModal(); // open OTP modal
                    } else {
                        alert("Email verification failed!");
                    }
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                })
                .catch(() => {
                    alert("Network error!");
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
        });


        // OTP CONFIRMATION
        function showOtpModal() {
            const modalHtml = `
                                            <div id="otpModal"
                                                 style="position: fixed; 
                                                        top: 0; left: 0; width: 100%; height: 100%;
                                                        background: rgba(0,0,0,0.6); 
                                                        display: flex; justify-content: center; align-items: center;">
                                                <div style="background: white; padding: 30px; width: 400px; border-radius: 8px;">
                                                    <h4 class="mb-3 text-center">Confirm Email OTP</h4>
                                                    <input type="text" id="otpInput" class="form-control mb-3" placeholder="Enter 6-digit OTP">
                                                    <button id="submitOtpBtn" class="btn btn-success w-100">Confirm OTP</button>
                                                </div>
                                            </div>
                                        `;
            document.body.insertAdjacentHTML('beforeend', modalHtml);

            document.getElementById('submitOtpBtn').onclick = verifyOtp;
        }

        function verifyOtp() {
            const otp = document.getElementById('otpInput').value;
            const email = document.querySelector('input[name="email"]').value;

            fetch("{{ tenant_route('tenant.contract.step2.emailVerifyConfirm', [$contract->pub_ref]) }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ email, otp })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        emailVerified = true;
                        // alert("Email verified successfully!");

                        const modal = document.getElementById('otpModal');
                        modal.remove();

                        const btn = document.getElementById('verifyEmailBtn');
                        btn.classList.remove('btn-info');
                        btn.classList.add('btn-success');
                        btn.innerHTML = 'VERIFIED';
                        btn.disabled = true;
                    } else {
                        alert(data.message || "Invalid OTP");
                    }

                    updateContinueButton();
                })
                .catch(() => alert("Network error!"));
        }

    </script>
@endpush