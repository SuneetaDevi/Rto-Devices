@extends('tenant.layouts.master')
@section('report_active', 'active')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .metric-card {
            background: linear-gradient(135deg, #007bff 0%, #00c6ff 100%);
            color: white;
            border-radius: 0.375rem;
            padding: 1rem;
            text-align: center;
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
            transition: transform 0.2s ease;
        }
        
        .metric-card:hover {
            transform: translateY(-2px);
        }
        
        .chart-container {
            background: white;
            border-radius: 0.375rem;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .revenue-table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        
        .filter-container {
            background: white;
            border-radius: 0.375rem;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
@endpush
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ tenant_route('tenant.report') }}">Reports</a> </li>
    <li class="breadcrumb-item active">Portfolio Summary Report</li>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid py-4">
                {{-- Page Header --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <h1 class="h2 font-weight-light text-center text-success">Portfolio Summary Report</h1>
                    </div>
                </div>

                {{-- Filter Form --}}
                <div class="card filter-container mb-4">
                    <div class="card-body">
                        <form class="form-inline" id="reportFilterForm">
                            <div class="form-group mr-3 mb-2">
                                <label for="dateRange" class="mr-2 font-weight-bold">Origination Date Range</label>
                                <input type="text" id="dateRange" class="form-control" value="11/01/2025 - 11/08/2025">
                            </div>
                            <div class="form-group mr-3 mb-2">
                                <label for="storeSelect" class="mr-2 font-weight-bold">Store</label>
                                <select id="storeSelect" class="form-control" style="width: 200px;">
                                    <option value="">-- SELECT STORE --</option>
                                    <option value="AAT" selected>Site 1</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success mb-2">Search</button>
                        </form>
                    </div>
                </div>

                @php $reportGenerated = true; @endphp

                @if ($reportGenerated)
                    {{-- Report Metadata --}}
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="text-muted small">
                                <p class="mb-1">Prepared for: null.</p>
                                <p class="mb-1">Contract Origination Dates: 11/01/2025 - 11/08/2025</p>
                                <p class="mb-0">Report created at: 11/08/2025 10:19:21 AM</p>
                            </div>
                        </div>
                    </div>

                    {{-- Summary Metrics --}}
                    <div class="row mb-4">
                        @foreach([
        ['title' => 'Total Contracts', 'value' => '0'],
        ['title' => 'Act/Due', 'value' => '0'],
        ['title' => 'Past Due', 'value' => '0'],
        ['title' => 'Defaulted', 'value' => '0'],
        ['title' => 'Paid Off Early', 'value' => '0'],
        ['title' => 'Paid Off in Full', 'value' => '0']
    ] as $metric)
                        <div class="col-md-4 col-lg-2 mb-3">
                            <div class="metric-card">
                                <h6 class="mb-2">{{ $metric['title'] }}</h6>
                                <strong class="h4">{{ $metric['value'] }}</strong>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Additional Metrics --}}
                    <div class="row mb-4">
                        @foreach([
        ['title' => 'AVG Rental Factor', 'value' => '2.5'],
        ['title' => 'ABP %', 'value' => '0.0%'],
        ['title' => 'Lock vs No Lock %', 'value' => '100.0%'],
        ['title' => 'Rescheduled Contracts', 'value' => '0'],
        ['title' => 'Lost/Stolen/Damaged Contracts', 'value' => '0']
    ] as $metric)
                        <div class="col-md-4 col-lg-2 mb-3">
                            <div class="metric-card">
                                <h6 class="mb-2">{{ $metric['title'] }}</h6>
                                <strong class="h4">{{ $metric['value'] }}</strong>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Detailed Metrics & Chart --}}
                    <div class="row">
                        <div class="col-lg-3 mb-4">
                            @foreach([
        ['title' => 'AVG Contract Duration', 'value' => '27.0'],
        ['title' => 'AVG Down Payment %', 'value' => '20.0%'],
        ['title' => 'Down Payments Collected', 'value' => '$276.00'],
        ['title' => 'Contract Payments Collected', 'value' => '$257.02'],
        ['title' => 'Payment Fees Collected', 'value' => '$70.00'],
        ['title' => 'Total Revenue Collected', 'value' => '$603.02']
    ] as $metric)
                            <div class="metric-card mb-3">
                                <h6 class="mb-2">{{ $metric['title'] }}</h6>
                                <strong class="h5">{{ $metric['value'] }}</strong>
                            </div>
                            @endforeach
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="chart-container h-100">
                                <canvas id="paymentChart" height="300"></canvas>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-4">
                            @foreach([
        ['title' => 'Total Retail Value', 'value' => '$1,380.00'],
        ['title' => 'Total Rental Value', 'value' => '$3,036.00'],
        ['title' => 'Outstanding Balance Retail Value', 'value' => '$846.98'],
        ['title' => 'Outstanding Balance Rental Value', 'value' => '$1,227.78'],
        ['title' => 'Additional Revenue over Retail', 'value' => '$1,656.00']
    ] as $metric)
                            <div class="metric-card mb-3">
                                <h6 class="mb-2">{{ $metric['title'] }}</h6>
                                <strong class="h5">{{ $metric['value'] }}</strong>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Revenue Table --}}
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-4">12 Month Portfolio Revenue Outlook [Active Contracts]</h5>
                            <div class="table-responsive">
                                <table class="table table-sm revenue-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th></th>
                                            @foreach(['Remainder of Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Total'] as $month)
                                            <th class="text-center">{{ $month }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(['Cash Pay', 'Automatic Bill Pay', 'Rental Pmts Total', 'Payment Fees', 'Total'] as $row)
                                        <tr>
                                            <td class="font-weight-bold">{{ $row }}</td>
                                            @for($i = 0; $i < 13; $i++)
                                            <td class="text-center">$0.00</td>
                                            @endfor
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(function () {
            $('#dateRange').daterangepicker({
                opens: 'right',
                locale: { format: 'MM/DD/YYYY' }
            });

            const ctx = document.getElementById('paymentChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Monthly', 'Bi-Weekly', 'Weekly'],
                    datasets: [{
                        data: [55, 25, 20],
                        backgroundColor: ['#ffc107', '#17a2b8', '#dc3545']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        });
    </script>
@endpush