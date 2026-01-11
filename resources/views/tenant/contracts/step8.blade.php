@extends('tenant.layouts.master')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('tenant.contract.index', request()->route('tenant_domain')) }}">Contracts</a>
    </li>
    <li class="breadcrumb-item active">Completed</li>
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('shop/cotracts/steps.css') }}">
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content py-5">
            <div class="container">
                <div class="creation-container text-center">

                    <!-- Step Indicator -->
                    <div class="step-indicator">
                        @for ($i = 1; $i <= 8; $i++)
                            <div class="step-circle active">{{ $i }}</div>
                        @endfor
                    </div>

                    <div class="py-5">
                        <i class="fas fa-check-circle text-success" style="font-size: 70px;"></i>
                        <h3 class="mt-4 mb-3 text-dark">Contract Completed Successfully</h3>

                        <p class="text-muted">
                            The customer contract <strong>#{{ $contract->pub_ref }}</strong>
                            has been successfully processed and completed.
                        </p>

                        <div class="mt-4">
                            <a href="{{ tenant_route('tenant.contract.details', [$contract->pub_ref]) }}"
                                class="btn btn-primary px-4 me-2">View Contract</a>

                            <a href="{{ tenant_route('tenant.contract.index') }}" class="btn btn-outline-secondary px-4">Go
                                to Dashboard</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
