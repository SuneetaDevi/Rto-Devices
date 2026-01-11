@extends('tenant.layouts.master')
@section('settings_menu_open', 'menu-open')
@section('settings_active', 'active')
@section('users_active', 'active')

@push('style')
    <!-- intl-tel-input -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css" />

    <style>
        /* Page wrapper */
        .user-form-page {
            padding: 40px 15px;
            background-color: #f4f6f9;
            min-height: calc(100vh - 56px);
        }

        /* Form card */
        .form-card {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            max-width: 960px;
            margin: 0 auto;
        }

        /* Title */
        .form-title {
            font-size: 2rem;
            font-weight: 600;
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Labels */
        .form-group label {
            font-weight: 600;
            color: #495057;
        }

        /* Inputs */
        .form-control,
        .form-select {
            border-radius: 6px;
            height: 42px;
        }

        /* intl-tel-input fixes */
        .iti {
            width: 100%;
        }

        .iti--allow-dropdown input.form-control {
            padding-left: 70px !important;
            border-radius: 6px !important;
            height: 42px !important;
        }

        .iti__flag-container {
            border-right: 1px solid #ced4da;
            border-radius: 6px 0 0 6px;
        }

        /* Submit button */
        .btn-submit {
            background-color: #007bff;
            /* Changed color for update action */
            color: #fff;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 6px;
            border: none;
            float: right;
        }

        .btn-submit:hover {
            background-color: #0069d9;
        }

        /* Responsive */
        @media (max-width: 767px) {
            .form-card {
                padding: 20px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper user-form-page">
        <div class="container-fluid">
            <!-- Assume $user variable is passed to the view -->
            <h2 class="form-title">Update User: {{ $user->first_name }} {{ $user->last_name }}</h2>

            <div class="form-card">
                <!-- IMPORTANT: Update the form action to your actual update route -->
                <form action="{{ tenant_route('tenant.setting.users.update', [$user]) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Use PUT or PATCH method for updates --}}
                    <div class="form-row">

                        <!-- LEFT COLUMN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address*</label>
                                <input type="email" name="email" readonly class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="form-group">
                                <label>First Name*</label>
                                <input type="text" name="first_name" class="form-control"
                                    value="{{ old('first_name', $user->first_name) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name*</label>
                                <input type="text" name="last_name" class="form-control"
                                    value="{{ old('last_name', $user->last_name) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Phone Number*</label>
                                <!-- The value below will be used by the JS to initialize the international phone input -->
                                <input type="tel" id="phone" name="phone" class="form-control"
                                    value="{{ old('phone', $user->phone) }}" required>
                                <input type="hidden" name="phone_full" id="phone_full">
                            </div>
                            <div class="form-group">
                                <label>Store*</label>
                                <select name="store_id" class="form-control" required>
                                    <option value="">-- Select Store --</option>
                                    {{-- Assuming $stores is an array of TenantStore objects with id and store_name --}}
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}" {{ old('store_id', $user->store_id) == $store->id ? 'selected' : '' }}>
                                            {{ $store->store_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Role*</label>
                                <select name="role" class="form-control" required>
                                    <option value="">-- Select Role --</option>
                                    @php
                                        $roles = ['COMPANY_ADMIN', 'STORE_MANAGER', 'STORE_USER'];
                                    @endphp
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status*</label>
                                <select name="status" class="form-control" required>
                                    <option value="ACTIVE" {{ old('status', $user->status) == 'ACTIVE' ? 'selected' : '' }}>
                                        ACTIVE</option>
                                    <option value="INACTIVE" {{ old('status', $user->status) == 'INACTIVE' ? 'selected' : '' }}>INACTIVE</option>
                                </select>
                            </div>
                        </div>

                        <!-- RIGHT COLUMN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username*</label>
                                <input type="text" name="username" class="form-control"
                                    value="{{ old('username', $user->username) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Address 1*</label>
                                <input type="text" name="address1" class="form-control"
                                    value="{{ old('address1', $user->address1) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Address 2</label>
                                <input type="text" name="address2" class="form-control"
                                    value="{{ old('address2', $user->address2) }}">
                            </div>
                            <div class="form-group">
                                <label>Zip*</label>
                                <input type="text" name="zip" class="form-control" value="{{ old('zip', $user->zip) }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>City*</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city', $user->city) }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>State*</label>
                                <input type="text" name="state" class="form-control"
                                    value="{{ old('state', $user->state) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Timezone</label>
                                <select name="timezone" class="form-control">
                                    @php
                                        $timezones = ['America/New_York', 'America/Chicago', 'America/Los_Angeles'];
                                    @endphp
                                    @foreach ($timezones as $tz)
                                        <option value="{{ $tz }}" {{ old('timezone', $user->timezone) == $tz ? 'selected' : '' }}>
                                            {{ $tz }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col text-right mt-3">
                            <button type="submit" class="btn btn-submit">Update User</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const phoneInputField = document.querySelector("#phone");

            // Get the current phone number value and strip leading plus if present (iti handles the full number)
            const initialPhoneNumber = phoneInputField.value.replace(/^\+/, '');

            const iti = window.intlTelInput(phoneInputField, {
                initialCountry: "us",
                separateDialCode: false,
                // Set the initial value after the library initializes to handle country code
                nationalMode: true, // Display the number in national format initially
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js"
            });

            // Attempt to set the number using the utility function if it's a full number (e.g., +12025550104)
            if (initialPhoneNumber.startsWith('+')) {
                iti.setNumber(initialPhoneNumber);
            } else {
                // For US-based local numbers, just set the value and let the ITI determine the best display
                phoneInputField.value = initialPhoneNumber;
            }


            document.querySelector("form").addEventListener("submit", function (e) {
                // Check if the phone number is valid
                if (!iti.isValidNumber()) {
                    // Prevent submission if invalid
                    e.preventDefault();

                    // You might want to add visual feedback here
                    // alert("Please enter a valid phone number."); 
                }

                // Always set the full international number (e.g., +12025550104) before submitting
                document.querySelector("#phone_full").value = iti.getNumber();
            });
        });
    </script>
@endpush