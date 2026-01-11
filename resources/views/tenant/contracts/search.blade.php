@extends('tenant.layouts.master')
@section('contract_active', 'active')

@push('style')
    <style>
        .search-page {
            background-color: #f8f9fa;
            min-height: calc(100vh - 56px);
        }

        .contract-card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: box-shadow 0.3s ease;
            border-top: 4px solid transparent;
        }

        .contract-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .customer-name {
            font-size: 1.1rem;
            font-weight: 500;
            color: #343a40;
        }

        .status-rescheduled {
            color: #dc3545;
        }

        .status-active {
            color: #28a745;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper search-page">
        <div class="content">
            <div class="container-fluid py-4">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h2 class="h1 font-weight-light text-primary mb-4">Search Results</h2>

                        {{-- Create New Contract Button --}}
                        <a href="{{ tenant_route('tenant.contract.create') }}"
                            class="btn btn-outline-primary btn-lg px-4 rounded-pill">
                            <i class="fas fa-plus-circle mr-2"></i> Create New Contract
                        </a>
                    </div>
                </div>

                {{-- Contract Search Results --}}
                <div class="row justify-content-center">
                    @foreach([
                            ['name' => 'BELL, OLIVIA M', 'contract' => '57672635', 'status' => 'Rescheduled', 'balance' => '$0.00'],
                            ['name' => 'BELL, OLIVIA M', 'contract' => '95513870', 'status' => 'Rescheduled', 'balance' => '$0.00'],
                            ['name' => 'BELL, OLIVIA', 'contract' => '48204418', 'status' => 'Active', 'balance' => '$78.50'],
                            ['name' => 'BELL, OLIVIA M', 'contract' => '95513870-1', 'status' => 'Paid Off in Full', 'balance' => '$0.00']
                        ] as $contract)
                        <div class="col-xl-5 col-lg-6 col-md-8 mb-4">
                            <div class="card contract-card h-100">
                                <div class="card-body">
                                    <h5 class="customer-name card-title">{{ $contract['name'] }}</h5>
                                    <p class="card-text mb-2">
                                        <strong class="text-muted">{{ $contract['contract'] }}</strong>
                                    </p>
                                    <p class="card-text mb-2">
                                        <span class="status-{{ strtolower(str_replace(' ', '-', $contract['status'])) }}">
                                            {{ $contract['status'] }}
                                        </span>
                                    </p>
                                    <p class="card-text mb-2 text-muted small">
                                        IMEI: {{ $loop->index % 2 == 0 ? '352117356471645' : '352843110191951' }}
                                     </p>
                                    <p class="card-text mb-3 text-muted small">
                                        Outstanding Balance: <strong>{{ $contract['balance'] }}</strong>
                                    </p>
                                    <a href="{{ tenant_route('tenant.contract.details', [$contract['contract']]) }}" 
                                       class="btn btn-primary btn-sm">
                                        View Contract
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection