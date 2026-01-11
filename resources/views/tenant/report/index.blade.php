@extends('tenant.layouts.master')
@section('report_active', 'active')
@section('title', $title)

@push('style')
    <style>
        .report-card {
            border-top: 3px solid #007bff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 140px;
        }

        .report-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .view-link {
            color: #007bff;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .view-link.old-version {
            color: #6c757d;
        }

        .view-link:hover {
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid py-4">
                {{-- Page Header --}}
                <div class="row mb-5">
                    <div class="col-12">
                        <h1 class="h2 font-weight-light text-center text-dark">Reports</h1>
                    </div>
                </div>

                {{-- Report Cards --}}
                <div class="row">
                    @foreach ([['title' => 'Portfolio Summary Report', 'new_link' => tenant_route('tenant.report.portfolio'), 'old_link' => '#'], ['title' => 'Sales Tax Report', 'new_link' => tenant_route('tenant.report.sales'), 'old_link' => '#'], ['title' => 'Payments', 'new_link' => tenant_route('tenant.report.payment'), 'old_link' => null], ['title' => 'Portfolio Detailed Report', 'new_link' => tenant_route('tenant.report.portfolio.detailed'), 'old_link' => '#'], ['title' => 'Dealer Contract Reconciliation', 'new_link' => tenant_route('tenant.report.dealer_contract_reconciliation'), 'old_link' => '#']] as $report)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card report-card h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title font-weight-bold text-dark mb-3">{{ $report['title'] }}</h5>
                                    <div class="mt-auto">
                                        <a href="{{ $report['new_link'] }}" class="view-link d-block mb-2">
                                            View Report
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
