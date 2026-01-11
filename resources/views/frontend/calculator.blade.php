@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? 'RTO Devices' }}
@endsection

@section('meta')
    {{--
    <meta property="og:title" content="{{ $seo->title ?? $og_title }}" />
    <meta property="og:description" content="{{ $seo->description ?? $og_description }}" />
    <meta property="og:image" content="{{ asset($seo->image ?? $og_image) }}" />
    <meta name="description" content="{{$seo->meta_description ?? $og_description}}">
    <meta name="keywords" content="{{$seo->keywords ?? $meta_keywords}}"> --}}
@endsection

@push('style')
    <style>
        h4 {
            line-height: 38px;
        }

        /* Header Section */
        .calculator-header {
            background: var(--gradient);
            color: white;
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .calculator-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,202.7C672,203,768,181,864,170.7C960,160,1056,160,1152,170.7C1248,181,1344,203,1392,213.3L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: center bottom;
        }

        .calculator-header h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .calculator-header p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        /* Calculator Section */
        .calculator-section {
            padding: 60px 0;
            background: white;
        }

        .calculator-section .range-slider-block {
            margin-bottom: 35px;
        }

        .calculator-section .range-slider-heading-block {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .calculator-section .range-slider-label {
            font-weight: 600;
            font-size: 16px;
            color: var(--dark);
            flex: 1;
        }

        .calculator-section .range-slider-value {
            font-weight: 700;
            font-size: 1rem;
            color: var(--primary);
            min-width: 80px;
            text-align: right;
        }

        /* Custom Range Slider */
        .calculator-section input[type="range"] {
            --c: var(--primary);
            --l: .25rem;
            --h: 20px;
            --w: 8px;
            width: 100%;
            height: var(--h);
            --_c: color-mix(in srgb, var(--c), #000 var(--p, 0%));
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: none;
            cursor: pointer;
            overflow: hidden;
        }

        .calculator-section input[type="range"]:focus-visible,
        .calculator-section input[type="range"]:hover {
            --p: 25%;
        }

        /* Webkit browsers */
        .calculator-section input[type="range"]::-webkit-slider-thumb {
            height: var(--h);
            width: var(--w);
            background: var(--_c);
            border-image: linear-gradient(90deg, var(--_c) 50%, #ababab 0) 1/0 100vw/0 100vw;
            clip-path: polygon(0 calc(50% + var(--l)/2),
                    -100vw calc(50% + var(--l)/2),
                    -100vw calc(50% - var(--l)/2),
                    0 calc(50% - var(--l)/2),
                    0 0, 100% 0,
                    100% calc(50% - var(--l)/2),
                    100vw calc(50% - var(--l)/2),
                    100vw calc(50% + var(--l)/2),
                    100% calc(50% + var(--l)/2),
                    100% 100%, 0 100%);
            -webkit-appearance: none;
            appearance: none;
            transition: .3s;
        }

        /* Firefox */
        .calculator-section input[type="range"]::-moz-range-thumb {
            height: var(--h);
            width: var(--w);
            background: var(--_c);
            border-image: linear-gradient(90deg, var(--_c) 50%, #ababab 0) 1/0 100vw/0 100vw;
            clip-path: polygon(0 calc(50% + var(--l)/2),
                    -100vw calc(50% + var(--l)/2),
                    -100vw calc(50% - var(--l)/2),
                    0 calc(50% - var(--l)/2),
                    0 0, 100% 0,
                    100% calc(50% - var(--l)/2),
                    100vw calc(50% - var(--l)/2),
                    100vw calc(50% + var(--l)/2),
                    100% calc(50% + var(--l)/2),
                    100% 100%, 0 100%);
            -webkit-appearance: none;
            appearance: none;
            transition: .3s;
            border: none;
        }

        .calculator-section .range-slider-value-markers {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .calculator-section .range-slider-value-marker {
            font-size: 0.85rem;
            color: #6c757d;
            text-align: center;
            flex: 1;
        }

        .calculator-section .learn-more-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            justify-content: space-between;
            font-size: 14px;
        }

        .calculator-section .learn-more-link:hover {
            color: var(--secondary);
            gap: 12px;
        }

        /* Card Styles */
        .calculator-section .slider-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: none;

            position: sticky;
            top: 100px;
        }

        /* Results Section */
        .calculator-section .results-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .calculator-section .result-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
            border-top: 5px solid var(--primary);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .calculator-section .result-card.revenue {
            border-top-color: var(--success);
        }

        .calculator-section .result-card.profit {
            border-top-color: var(--primary);
        }

        .calculator-section .result-label {
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 15px;
            font-size: 1rem;
            text-align: center;
        }

        .calculator-section .result-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark);
            text-align: center;
            width: 100%;
        }

        .calculator-section .result-value.revenue {
            color: var(--success);
        }

        .calculator-section .result-value.profit {
            color: var(--primary);
        }

        /* Comparison Section */
        .calculator-section .comparison-section {
            padding: 40px 0 0;
            background: white;
        }

        .calculator-section .comparison-chart {
            border: 1px solid #e9ecef;
            border-radius: 15px;
            overflow: hidden;
        }

        .calculator-section .chart-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            border-bottom: 1px solid #e9ecef;
            align-items: center;
        }

        .calculator-section .chart-row:last-child {
            border-bottom: none;
        }

        .calculator-section .chart-row.header {
            background: var(--gradient);
            color: white;
        }

        .calculator-section .chart-cell {
            padding: 20px;
            display: flex;
            align-items: center;
            min-height: 70px;
        }

        .calculator-section .chart-cell.center {
            justify-content: center;
            text-align: center;
        }

        .calculator-section .chart-label {
            font-weight: 600;
            line-height: 1.4;
        }

        .calculator-section .chart-row.header .chart-label {
            color: white;
        }

        .calculator-section .check-icon {
            color: var(--success);
            font-size: 1.5rem;
        }

        .calculator-section .cross-icon {
            color: #dc3545;
            font-size: 1.5rem;
        }

        /* Modal */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: var(--gradient);
            color: white;
            border-radius: 20px 20px 0 0;
            border-bottom: none;
            padding: 25px 30px;
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .btn-close {
            filter: invert(1);
        }

        .modal-body {
            padding: 30px;
            line-height: 1.7;
        }

        /* Contact Hero Section */
        .calculator-hero {
            background: var(--gradient);
            color: white;
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .calculator-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,202.7C672,203,768,181,864,170.7C960,160,1056,160,1152,170.7C1248,181,1344,203,1392,213.3L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: center bottom;
        }

        .calculator-hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .calculator-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            text-align: center;
            margin: 0 auto;
            max-width: 600px;
        }

        .final-cta h2 {
            line-height: 44px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .calculator-hero {
                padding: 80px 0 60px;
            }

            .calculator-hero h1 {
                font-size: 2.5rem;
            }

            .calculator-section,
            .results-section,
            .comparison-section,
            .cta-section {
                padding: 30px 0;
            }

            .calculator-card {
                padding: 30px;
            }
        }

        @media (max-width: 767px) {
            .calculator-hero h1 {
                font-size: 2rem;
            }

            .calculator-hero p {
                font-size: 1rem;
            }

            .calculator-section,
            .results-section,
            .comparison-section,
            .cta-section {
                padding: 50px 0;
            }

            .calculator-section .chart-cell {
                padding: 15px;
                justify-content: center;
                min-height: 60px;
            }

            .calculator-section .cta-title {
                font-size: 2rem;
            }

            .calculator-section .range-slider-heading-block {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .calculator-section .range-slider-value {
                text-align: left;
                min-width: auto;
            }

            .final-cta h2 {
                line-height: 32px;
            }
        }

        @media (max-width: 575px) {
            h4 {
                line-height: 30px;
            }

            .calculator-hero {
                padding: 60px 0 40px;
            }

            .calculator-section,
            .results-section,
            .comparison-section,
            .cta-section {
                padding: 40px 0;
            }

            .calculator-section .result-card {
                padding: 20px;
            }

            .calculator-section .result-value {
                font-size: 2rem;
            }

            .card,
            .calculator-card {
                padding: 20px;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="calculator-hero">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9">
                    <h1>Calculate The Profit You Can Make From In-House Payment Plans</h1>
                    <p class="mb-0">Use the slider bars below to project your revenues and profit from In-House Payment
                        Plans for your customers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Calculator Section -->
    <section class="calculator-section">
        <div class="container">
            <div class="row g-4 g-lg-5">
                <!-- Calculator Controls -->
                <div class="col-lg-4">
                    <div class="slider-card">
                        <!-- Phone Retail Price -->
                        <div class="range-slider-block">
                            <div class="range-slider-heading-block">
                                <div class="range-slider-label">Phone Retail Price</div>
                                <div id="calc_retail_price" class="range-slider-value">$750</div>
                            </div>
                            <input id="phone_retail_price" type="range" min="150" max="1200" step="50" value="750"
                                class="mb-2">
                            <div class="range-slider-value-markers">
                                <div class="range-slider-value-marker">$150</div>
                                <div class="range-slider-value-marker">$500</div>
                                <div class="range-slider-value-marker">$800</div>
                                <div class="range-slider-value-marker">$1,200</div>
                            </div>
                        </div>

                        <!-- Phone Wholesale Cost -->
                        <div class="range-slider-block">
                            <div class="range-slider-heading-block">
                                <div class="range-slider-label">Phone Wholesale Cost</div>
                                <div id="calc_wholesale_cost" class="range-slider-value">$600</div>
                            </div>
                            <input id="phone_wholesale_cost" type="range" min="0" max="650" step="50" value="600"
                                class="mb-2">
                            <div class="range-slider-value-markers">
                                <div id="pwc_a" class="range-slider-value-marker">$0</div>
                                <div id="pwc_b" class="range-slider-value-marker">$200</div>
                                <div id="pwc_c" class="range-slider-value-marker">$400</div>
                                <div id="pwc_d" class="range-slider-value-marker">$650</div>
                            </div>
                        </div>

                        <!-- Down Payment % -->
                        <div class="range-slider-block">
                            <div class="range-slider-heading-block">
                                <div class="range-slider-label">Down Payment %</div>
                                <div id="calc_down_payment" class="range-slider-value">30%</div>
                            </div>
                            <input id="phone_down_payment" type="range" min="20" max="60" step="10" value="30" class="mb-2">
                            <div class="range-slider-value-markers">
                                <div class="range-slider-value-marker">20%</div>
                                <div class="range-slider-value-marker">30%</div>
                                <div class="range-slider-value-marker">40%</div>
                                <div class="range-slider-value-marker">50%</div>
                                <div class="range-slider-value-marker">60%</div>
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="range-slider-block">
                            <div class="range-slider-heading-block">
                                <div class="range-slider-label">Quantity of phones sold per month on payment plans</div>
                                <div id="calc_quantity" class="range-slider-value">10</div>
                            </div>
                            <input id="phone_quantity" type="range" min="10" max="100" step="10" value="10" class="mb-2">
                            <div class="range-slider-value-markers">
                                <div class="range-slider-value-marker">10</div>
                                <div class="range-slider-value-marker">20</div>
                                <div class="range-slider-value-marker">30</div>
                                <div class="range-slider-value-marker">40</div>
                                <div class="range-slider-value-marker">50</div>
                                <div class="range-slider-value-marker">60</div>
                                <div class="range-slider-value-marker">70</div>
                                <div class="range-slider-value-marker">80</div>
                                <div class="range-slider-value-marker">90</div>
                                <div class="range-slider-value-marker">100</div>
                            </div>
                        </div>

                        <div>
                            <a href="#" class="learn-more-link" data-bs-toggle="modal" data-bs-target="#calculationModal">
                                <div> Learn more about the calculation method </div>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Results and Comparison -->
                <div class="col-lg-8">
                    <div class="calculator-car">
                        <h4 class="mb-2 mb-md-3">Your Results</h4>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="result-card revenue">
                                    <div class="result-label">Your Revenue from In-House Payment Plans Using RTO Device
                                    </div>
                                    <div id="calc_revenue" class="result-value revenue">$153,000</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="result-card profit">
                                    <div class="result-label">Your Profit from In-House Payment Plans Using RTO Device</div>
                                    <div id="calc_profit" class="result-value profit">$81,600</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="result-card">
                                    <div class="result-label">Your Profit Using a 3rd-Party Finance Company</div>
                                    <div id="calc_3rdparty" class="result-value">$18,000</div>
                                </div>
                            </div>
                        </div>

                        <!-- Comparison Section -->
                        <div class="comparison-section">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <h4 class="text-center mb-4">Retailers Who Use RTO Device For Their In-House Payment
                                        Plans Can't Imagine Doing Business Without It</h4>

                                    <div class="comparison-chart">
                                        <!-- Header Row -->
                                        <div class="chart-row header">
                                            <div class="chart-cell">
                                                <div class="chart-label">Key Benefits</div>
                                            </div>
                                            <div class="chart-cell center">
                                                <div class="chart-label">RTO Device</div>
                                            </div>
                                            <div class="chart-cell center">
                                                <div class="chart-label">3rd-Party Finance Company</div>
                                            </div>
                                        </div>

                                        <!-- Rows -->
                                        <div class="chart-row">
                                            <div class="chart-cell">
                                                <div class="chart-label">Customers are accurately verified</div>
                                            </div>
                                            <div class="chart-cell center">
                                                <i class="fas fa-check-circle check-icon"></i>
                                            </div>
                                            <div class="chart-cell center">
                                                <i class="fas fa-check-circle check-icon"></i>
                                            </div>
                                        </div>

                                        <div class="chart-row">
                                            <div class="chart-cell">
                                                <div class="chart-label">Customer approval is determined by you</div>
                                            </div>
                                            <div class="chart-cell center">
                                                <i class="fas fa-check-circle check-icon"></i>
                                            </div>
                                            <div class="chart-cell center">
                                                <i class="fas fa-times-circle cross-icon"></i>
                                            </div>
                                        </div>

                                        <div class="chart-row">
                                            <div class="chart-cell">
                                                <div class="chart-label">Short transaction times keep customers from waiting
                                                </div>
                                            </div>
                                            <div class="chart-cell center">
                                                <i class="fas fa-check-circle check-icon"></i>
                                            </div>
                                            <div class="chart-cell center">
                                                <i class="fas fa-times-circle cross-icon"></i>
                                            </div>
                                        </div>

                                        <div class="chart-row">
                                            <div class="chart-cell">
                                                <div class="chart-label">You decide the price of merchandise to put on
                                                    payment plans</div>
                                            </div>
                                            <div class="chart-cell center">
                                                <i class="fas fa-check-circle check-icon"></i>
                                            </div>
                                            <div class="chart-cell center">
                                                <i class="fas fa-times-circle cross-icon"></i>
                                            </div>
                                        </div>

                                        <div class="chart-row">
                                            <div class="chart-cell">
                                                <div class="chart-label">You build a payment plan that fits the customer's
                                                    budget</div>
                                            </div>
                                            <div class="chart-cell center">
                                                <i class="fas fa-check-circle check-icon"></i>
                                            </div>
                                            <div class="chart-cell center">
                                                <i class="fas fa-times-circle cross-icon"></i>
                                            </div>
                                        </div>

                                        <div class="chart-row">
                                            <div class="chart-cell">
                                                <div class="chart-label">Control of the payment plan belongs to you - change
                                                    it to help a customer</div>
                                            </div>
                                            <div class="chart-cell center">
                                                <i class="fas fa-check-circle check-icon"></i>
                                            </div>
                                            <div class="chart-cell center">
                                                <i class="fas fa-times-circle cross-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section - Start -->
    <section class="final-cta">
        <div class="container">
            <div class="col-12 col-md-8 mx-auto">
                <h2>Invest 30 minutes to learn how we can help you make this profit a reality in your stores</h2>
                <a href="{{ route('frontend.demo') }}" class="btn btn-primary btn-lg">Book a Demo</a>
            </div>
        </div>
    </section>
    <!-- Final CTA Section - End -->

    <!-- Calculation Method Modal -->
    <div class="modal fade" id="calculationModal" tabindex="-1" aria-labelledby="calculationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calculationModalLabel">Our Calculation Methods</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>The results based on your selections are calculated using RTO Device proprietary methods of pricing
                        rent-to-own payment plans. These methods are similar to those used by 3rd Party Finance Companies.
                    </p>
                    <p>The RTO Device method applies a user defined multiplier to the customer balance owned whereas most
                        3rd Party Finance Companies apply a fixed multiplier of their choice to the retail price of
                        merchandise.</p>
                    <p>The calculations also use national averages compiled from thousands of actual in-house payment plans
                        created on the RTO Device platform. For more information, please contact <a
                            href="mailto:sales@rtodevice">sales@rtodevice</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            // Number formatting function
            function number_format(number, decimals, dec_point, thousands_sep) {
                number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function (n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            // Update wholesale cost field
            function update_wholesale_cost_field(retail_price, wholesale_cost) {
                $('#phone_wholesale_cost').attr('max', retail_price - 100);
                if (wholesale_cost > (retail_price - 100)) {
                    $('#phone_wholesale_cost').val(retail_price - 100);
                    $('#calc_wholesale_cost').text('$' + number_format(retail_price - 100, 0, '.', ','));
                }
                $('#pwc_d').text('$' + number_format(retail_price - 100, 0, '.', ','));
                updateMarkers(Number(retail_price));
            }

            // Update markers
            function updateMarkers(retail_price) {
                var total_range = retail_price - 100;
                if (retail_price === 200) {
                    $('#pwc_b').show().text('$50');
                    $('#pwc_c').hide();
                } else {
                    var segment = total_range / 3;
                    var adjusted_segment = Math.floor(segment / 50) * 50;
                    if (adjusted_segment == 0) {
                        $('#pwc_b, #pwc_c').hide();
                    } else {
                        $('#pwc_b, #pwc_c').show();
                        var pwc_b_value = adjusted_segment;
                        var pwc_c_value = 2 * adjusted_segment;
                        $('#pwc_b').text('$' + number_format(pwc_b_value, 0, '.', ','));
                        $('#pwc_c').text('$' + number_format(pwc_c_value, 0, '.', ','));
                    }
                }
            }

            // Calculate totals
            function calculate_totals(retail_price, wholesale_cost, down_payment, quantity) {
                let revenue = (((retail_price - ((down_payment / 100) * retail_price)) * 2) + (retail_price * (down_payment / 100))) * (quantity * 12)
                $('#calc_revenue').text('$' + number_format(revenue, 0, '.', ','));

                let profit = ((((retail_price - ((down_payment / 100) * retail_price)) * 2) + (retail_price * (down_payment / 100))) - wholesale_cost) * (quantity * 12);
                $('#calc_profit').text('$' + number_format(profit, 0, '.', ','));

                let thirdparty = (retail_price - wholesale_cost) * (quantity * 12);
                $('#calc_3rdparty').text('$' + number_format(thirdparty, 0, '.', ','));
            }

            // Event handlers
            $('#phone_retail_price').on('input change', function () {
                $('#calc_retail_price').text('$' + number_format($(this).val(), 0, '.', ','));
                update_wholesale_cost_field($(this).val(), $('#phone_wholesale_cost').val());
                calculate_totals($(this).val(), $('#phone_wholesale_cost').val(), $('#phone_down_payment').val(), $('#phone_quantity').val());
            });

            $('#phone_wholesale_cost').on('input change', function () {
                $('#calc_wholesale_cost').text('$' + number_format($(this).val(), 0, '.', ','));
                calculate_totals($('#phone_retail_price').val(), $(this).val(), $('#phone_down_payment').val(), $('#phone_quantity').val());
            });

            $('#phone_down_payment').on('input change', function () {
                $('#calc_down_payment').text(number_format($(this).val(), 0, '.', ',') + '%');
                calculate_totals($('#phone_retail_price').val(), $('#phone_wholesale_cost').val(), $(this).val(), $('#phone_quantity').val());
            });

            $('#phone_quantity').on('input change', function () {
                $('#calc_quantity').text(number_format($(this).val(), 0, '.', ','));
                calculate_totals($('#phone_retail_price').val(), $('#phone_wholesale_cost').val(), $('#phone_down_payment').val(), $(this).val());
            });

            // Initial calculation
            calculate_totals($('#phone_retail_price').val(), $('#phone_wholesale_cost').val(), $('#phone_down_payment').val(), $('#phone_quantity').val());
        });
    </script>
@endpush