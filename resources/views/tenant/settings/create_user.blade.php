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
            background-color: #28a745;
            color: #fff;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 6px;
            border: none;
            float: right;
        }

        .btn-submit:hover {
            background-color: #218838;
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
            <h2 class="form-title">Create User</h2>

            <div class="form-card">
                <form id="user_form" action="{{ tenant_route('tenant.setting.users.store') }}" method="POST">
                    @csrf
                    <div class="form-row">

                        <!-- LEFT COLUMN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address*</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>First Name*</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name*</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Phone Number*</label>
                                <input type="tel" id="phone" name="phone" class="form-control" required>
                                <input type="hidden" name="phone_full" id="phone_full">
                            </div>
                            <div class="form-group">
                                <label>Store*</label>
                                <select name="store" class="form-control" required>
                                    <option value="">-- Select Store --</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}">{{$store->store_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Role*</label>
                                <select name="role" class="form-control" required>
                                    <option value="">-- Select Role --</option>
                                    <option value="COMPANY_ADMIN">COMPANY_ADMIN</option>
                                    <option value="STORE_MANAGER">MANAGER</option>
                                    <option value="STORE_USER">STORE_USER</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status*</label>
                                <select name="status" class="form-control" required>
                                    <option value="ACTIVE" selected>ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                            </div>
                        </div>

                        <!-- RIGHT COLUMN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username*</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Address 1*</label>
                                <input type="text" name="address1" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Address 2</label>
                                <input type="text" name="address2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Zip*</label>
                                <input type="text" name="zip" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>City*</label>
                                <input type="text" name="city" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>State*</label>
                                <input type="text" name="state" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Timezone</label>
                                <select name="timezone" class="form-control">
                                    <option value="America/New_York" selected>America/New_York</option>
                                    <option value="America/Chicago">America/Chicago</option>
                                    <option value="America/Los_Angeles">America/Los_Angeles</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col text-right mt-3">
                            <button type="submit" class="btn btn-submit">Submit</button>
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
            const iti = intlTelInput(phoneInputField, {
                initialCountry: "us",
                separateDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js",
            });

            // Use the correct form
            document.querySelector("#user_form").addEventListener("submit", function () {
                document.querySelector("#phone_full").value = iti.getNumber();
            });
        });
    </script>

@endpush