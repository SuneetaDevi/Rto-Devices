@extends('tenant.layouts.master') {{-- Assuming you're extending a master layout --}}
@section('resources_active', 'active')
@section('title', $title)

@push('style')
    <style>
        /* Page Styling */
        .resources-page {
            padding: 30px;
            background-color: #f8f9fa;
            /* Light background similar to the image */
        }

        .resources-title {
            font-size: 2.5rem;
            color: #4682b4;
            /* Steel blue color from the image */
            margin-bottom: 40px;
            text-align: center;
            font-weight: 300;
        }

        /* Resource Card Styling */
        .resource-card {
            background-color: #fff;
            border: 1px solid #e9ecef;
            /* Subtle border */
            border-radius: .25rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 30px;
            height: 100px;
            /* Fixed height for uniformity */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: box-shadow 0.2s, border-color 0.2s;
        }

        .resource-card:hover {
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
            border-color: #007bff;
            cursor: pointer;
        }

        .resource-card a,
        .resource-card span {
            font-size: 1.1rem;
            color: #343a40;
            text-decoration: none;
            line-height: 1.4;
            display: block;
        }

        /* Style for clickable instructions */
        .resource-card a {
            /* color: #007bff; */
            /* Blue link color for instructions */
            font-weight: 500;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper resources-page">
        <div class="container-fluid">
            <h2 class="resources-title">Resources</h2>

            <div class="row justify-content-center">

                {{-- Row 1 --}}
                <div class="col-md-4 col-lg-4 mb-4">
                    <a href="{{ tenant_route('tenant.resources.page', ['rto-devices-fees']) }}">
                        <div class="resource-card">
                            <span>RTO Devices Fees</span>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-lg-4 mb-4">
                    <a href="{{ tenant_route('tenant.resources.page', ['submit-promise-guarantee-claim']) }}">

                        <div class="resource-card">
                            <span>Submit Promise Guarantee Claim</span>
                        </div>
                </div>

                <div class="col-md-4 col-lg-4 mb-4">
                    <a href="{{ tenant_route('tenant.resources.page', ['promise-guarantee-claim-report']) }}">

                        <div class="resource-card">
                            <span>Promise Guarantee Claim Report</span>
                        </div>
                </div>

                {{-- Row 2 --}}
                <div class="col-md-4 col-lg-4 mb-4">
                    <a href="{{ tenant_route('tenant.resources.page', ['android-installation-instructions']) }}">

                        <div class="resource-card">
                            <span>Android Installation Instructions</span>
                        </div>
                </div>

                <div class="col-md-4 col-lg-4 mb-4">
                    <a href="{{ tenant_route('tenant.resources.page', ['apple-installation-instructions']) }}">

                        <div class="resource-card">
                            <span>Apple Installation Instructions</span>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-lg-4 mb-4">
                    <a href="{{ tenant_route('tenant.resources.page', ['submit-promise-guarantee-claim']) }}">

                        <div class="resource-card">
                            <span>Referral Program Rules</span>
                        </div>
                    </a>
                </div>

                {{-- Row 3 --}}
                <div class="col-md-4 col-lg-4 mb-4">
                    <a href="{{ tenant_route('tenant.resources.page', ['additional-items']) }}">

                        <div class="resource-card">
                            <span>Additional Items</span>
                        </div>
                    </a>
                </div>

                {{-- Note: Added empty columns to center the final item if needed, matching the implied layout --}}
                <div class="col-md-4 col-lg-4 mb-4"></div>
                <div class="col-md-4 col-lg-4 mb-4"></div>

            </div> {{-- End row --}}
        </div> {{-- End container-fluid --}}
    </div> {{-- End content-wrapper --}}
@endsection

@push('script')
    {{-- Any page-specific JavaScript can go here --}}
@endpush
