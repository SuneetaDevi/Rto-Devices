@extends('tenant.layouts.master')

@section('settings_menu_open', 'menu-open')
@section('settings_active', 'active')
@section('stores_active', 'active')

@push('style')
    <style>
        /* Page wrapper */
        .store-form-page {
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

        /* Submit button */
        .btn-submit {
            background-color: #007bff;
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
    <div class="content-wrapper store-form-page">
        <div class="container-fluid">
            <h2 class="form-title">Update Store</h2>

            <div class="form-card">
                <form action="{{ tenant_route('tenant.setting.stores.update', ['store' => $store->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-row">

                        <!-- LEFT COLUMN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Store Name*</label>
                                <input type="text" name="store_name" class="form-control" value="{{ $store->store_name }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ $store->phone }}">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $store->email }}">
                            </div>

                            <div class="form-group">
                                <label>Dealer Manager</label>
                                <select name="dealer_manager_id" class="form-control">
                                    <option value="">-- Select Dealer Manager --</option>
                                    @foreach($tenantUsers as $user)
                                        <option value="{{ $user->id }}" {{ $store->dealer_manager_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                        </div>

                        <!-- RIGHT COLUMN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $store->address }}">
                            </div>


                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="{{ $store->city }}">
                            </div>

                            <div class="form-group">
                                <label>State</label>
                                <input type="text" name="state" class="form-control" value="{{ $store->state }}">
                            </div>
                            <div class="form-group">
                                <label>Account Manager</label>
                                <select name="account_manager_id" class="form-control">
                                    <option value="">-- Select Account Manager --</option>
                                    @foreach($tenantUsers as $user)
                                        <option value="{{ $user->id }}" {{ $store->account_manager_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col text-right mt-3">
                            <button type="submit" class="btn btn-submit">Update Store</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection