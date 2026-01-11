@extends('admin.layouts.master')

@section('tenant-active', 'active')
@section('title') Tenant Create @endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Tenant</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Create Tenant</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">
                                    Create Tenant
                                    <span class="float-right">
                                        <a href="{{ route('admin.tenant.index') }}"
                                            class="btn btn-sm btn-primary btn-gradient">
                                            <i class="fa fa-angle-left"></i> {{ __('messages.common.back') ?? 'Back' }}
                                        </a>
                                    </span>
                                </h5>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.tenant.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">
                                                {{ __('messages.common.name') ?? 'Name' }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input value="{{ old('name') }}" type="text" class="form-control" name="name"
                                                placeholder="Enter tenant name" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">
                                                {{ __('messages.common.email') ?? 'Email' }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input value="{{ old('email') }}" type="email" class="form-control" name="email"
                                                placeholder="Enter tenant email" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="subdomain" class="form-label">
                                                Business Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="subdomain" value="{{ old('subdomain') }}"
                                                class="form-control" placeholder="example" required>
                                            @error('subdomain')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="valid_till" class="form-label">
                                                Valid Till <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" name="valid_till" value="{{ old('valid_till') }}"
                                                class="form-control" required>
                                            @error('valid_till')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="owner_password" class="form-label">
                                                Default Tenant Password <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="password" name="owner_password" id="password-field"
                                                    class="form-control" required>
                                                <button type="button" class="btn btn-outline-secondary toggle-password"
                                                    toggle="#password-field">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('owner_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="status" class="form-label">
                                                {{ __('messages.common.status') ?? 'Status' }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                                    {{ __('messages.common.active') ?? 'Active' }}
                                                </option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                                    {{ __('messages.common.inactive') ?? 'Inactive' }}
                                                </option>
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('messages.common.save') ?? 'Save' }}
                                        </button>
                                    </div>
                                </form>
                            </div> <!-- /card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $(".toggle-password").on('click', function () {
                const input = $($(this).attr("toggle"));
                const icon = $(this).find("i");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    input.attr("type", "password");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
        });
    </script>
@endpush