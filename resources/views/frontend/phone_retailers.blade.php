@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? 'Phone Retailers | RTO Devices' }}
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
        .hero-section {
            background: var(--gradient);
            color: #fff;
            padding: 120px 0 100px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,202.7C672,203,768,181,864,170.7C960,160,1056,160,1152,170.7C1248,181,1344,203,1392,213.3L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') center bottom/cover;
        }

        .feature-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            transition: .3s;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: #fff;
            font-size: 32px;
        }

        .partner-logo {
            height: 60px;
            max-width: 100%;
            object-fit: contain;
            opacity: .8;
            filter: grayscale(0);
            transition: .3s;
        }

        .partner-logo:hover {
            filter: grayscale(100%);
            opacity: 1;
        }

        .comparison-section {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 50px;
            margin: 40px 0;
        }

        .comparison-card {
            background: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            height: 100%;
        }

        .comparison-card.highlight {
            background: var(--gradient);
            color: #fff;
        }

        .tab-content {
            padding: 40px 0;
        }

        .nav-tabs .nav-link {
            border: none;
            padding: 15px 30px;
            font-weight: 600;
            color: #6c757d;
            border-bottom: 3px solid transparent;
            transition: .3s;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary);
            border-bottom: 3px solid var(--primary);
        }

        .stats-box {
            background: rgba(255, 255, 255, .15);
            padding: 25px;
            border-radius: 15px;
            transition: .3s;
            text-align: center;
        }

        .stats-box:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, .2);
        }

        .identity-feature-card {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
            transition: .3s;
            border: 2px solid transparent;
        }

        .identity-feature-card:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
        }

        .identity-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #fff;
            font-size: 24px;
        }

        @media (max-width: 991px) {
            .section {
                padding: 60px 0;
            }

            .hero-section {
                padding: 80px 0 60px;
            }

            .identifier-arrow i {
                transform: rotate(90deg);
            }
        }

        @media (max-width: 767px) {
            .section {
                padding: 50px 0;
            }

            .comparison-section {
                padding: 30px;
            }
        }

        @media (max-width: 575px) {
            .btn {
                font-size: 16px !important;
            }

            .btn i {
                display: none;
            }

            .calc-sec .btn {
                text-transform: capitalize !important;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="overline-w-icon mb-3">
                        <i class="fas fa-store me-2"></i>
                        <span>Cell Phone Retailers</span>
                    </div>
                    <h1 class="display-4 fw-bold mb-4">Build Simple, Secure & Profitable In-House Payment Plans</h1>
                    <p class="lead mb-4">Our advanced software platform enables you to offer premium smartphones and
                        accessory bundles with your own flexible "buy now, pay later" payment options.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('frontend.demo') }}" class="btn btn-primary btn-lg">
                            Schedule Discovery Call <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <a href="https://youtu.be/WnC4iZSSV7I?si=eSR7j-b-TvIYjn2G" class="btn btn-primary btn-lg" target="_blank">
                            <i class="fa-regular fa-circle-play me-2"></i> Watch Video
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('assets/images/phone_retailers/hero-mobile.png') }}" alt="Smartphones"
                        class="img-fluid rounded-3">
                </div>
            </div>
        </div>
    </section>

    <!-- Partner Section - Start -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Trusted by 1,000+ Mobile Retailers Across the U.S.</h2>
                <p>Join hundreds of mobile stores already growing faster with our in-house payment platform.</p>
            </div>
            <div class="row g-4 row-cols-2 row-cols-md-3 row-cols-lg-5 align-items-center justify-content-center">
                <div class="col text-center">
                    <img src="{{ asset('assets/images/partner/1.webp') }}" alt="Boost Mobile" class="partner-logo">
                </div>
                <div class="col text-center">
                    <img src="{{ asset('assets/images/partner/2.webp') }}" alt="Metro by T-Mobile" class="partner-logo">
                </div>
                <div class="col text-center">
                    <img src="{{ asset('assets/images/partner/3.webp') }}" alt="Cricket Wireless" class="partner-logo">
                </div>
                <div class="col text-center">
                    <img src="{{ asset('assets/images/partner/4.webp') }}" alt="Simple Mobile" class="partner-logo">
                </div>
                <div class="col text-center">
                    <img src="{{ asset('assets/images/partner/5.webp') }}" alt="Simple Mobile" class="partner-logo">
                </div>
            </div>
        </div>
    </section>
    <!-- Partner Section - End -->

    <!-- Why In-House Section -->
    <section class="section bg-light" id="features">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-title mb-4">
                    <div class="col-12 col-md-8 mx-auto">
                        <div class="text-primary mb-2 fw-bold">Why Choose In-House Payment Plans?</div>
                        <h2>More Affordable for Customers, More Profitable for Your Business</h2>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Expand Customer Reach</h4>
                        <p class="mb-0">Approve customers directly and break free from third-party finance companies
                            rejecting your potential buyers.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Boost Sales Power</h4>
                        <p class="mb-0">Create custom payment plans for Apple and Android devices, tablets, and profitable
                            accessory bundles.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h4>Generate Residual Income</h4>
                        <p class="mb-0">Build continuous cash flow instead of settling for small commissions from external
                            finance providers.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>Enhance Customer Service</h4>
                        <p class="mb-0">Adjust payment schedules and amounts instantly to accommodate customers in special
                            circumstances.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Platform Features -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <div class="col-12 col-md-8 mx-auto">
                    <div class="text-primary mb-2 fw-bold">The RTO Devices Platform</div>
                    <h2>Unlock Your Store's Full Sales Potential with Custom Payment Solutions</h2>
                </div>
            </div>

            <ul class="nav nav-tabs justify-content-center mb-4" id="platformTabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#payment-plans">Payment Plans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#payments">Payments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#device-lock">Device Security</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#identity">Identity Verification</a>
                </li>
            </ul>

            <div class="tab-content" id="platformTabsContent">
                <!-- Payment Plans Tab -->
                <div class="tab-pane fade show active" id="payment-plans">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="feature-list">
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Personalized Payment Options</h5>
                                        <p>Design payment plans that match customer budgets, free from rigid third-party
                                            constraints.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Unlimited Product Offerings</h5>
                                        <p>Create flexible plans for iPhones, Android devices, tablets, repairs, and
                                            accessory bundles.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Automated Payment Reminders</h5>
                                        <p>Automatic text notifications keep customers informed about upcoming payments and
                                            due dates.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Comprehensive Data Analytics</h5>
                                        <p>Access detailed management reports and audit trails for all transactions across
                                            stores and employees.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                alt="Payment Plans Dashboard" class="img-fluid rounded-3">
                        </div>
                    </div>
                </div>

                <!-- Payments Tab -->
                <div class="tab-pane fade" id="payments">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="feature-list">
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Multiple Payment Methods</h5>
                                        <p>Accept payments in-store via cash, card, mobile apps, or phone transactions.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Auto Bill Pay Integration</h5>
                                        <p>Seamless automatic payments with funds deposited directly into your business
                                            account.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Secure Card Storage</h5>
                                        <p>Safely store multiple payment cards using advanced tokenization technology.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Real-time Card Validation</h5>
                                        <p>Instant payment card verification ensures cards are ready for processing on due
                                            dates.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center">
                            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                alt="Payment Processing" class="img-fluid rounded-3">
                        </div>
                    </div>
                </div>

                <!-- Device Security Tab -->
                <div class="tab-pane fade" id="device-lock">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="feature-list">
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Security-First Approach</h5>
                                        <p>Utilize our auto-lock feature to restrict device usage when payments are overdue,
                                            with immediate restoration upon payment completion.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Multi-layer Protection System</h5>
                                        <p>Advanced device locking technology deeply integrated into device operating
                                            systems with automatic IMEI registration.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Universal Device Compatibility</h5>
                                        <p>Works seamlessly with Android OS and Apple iOS devices, including iPads and
                                            Galaxy tablets with or without SIM cards.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Automatic Lock Removal</h5>
                                        <p>Devices are automatically unlocked and control released upon successful
                                            completion of payment plans.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center">
                            <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                alt="Device Security" class="img-fluid rounded-3">
                        </div>
                    </div>
                </div>

                <!-- Identity Verification Tab -->
                <div class="tab-pane fade" id="identity">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="feature-list">
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Complete Customer Information</h5>
                                        <p>Capture full customer names for ID verification without requiring Social Security
                                            Numbers.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Automated ID Documentation</h5>
                                        <p>Use employee mobile cameras to securely capture valid customer IDs without
                                            storing images on personal devices.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>USPS Address Validation</h5>
                                        <p>Real-time connection to United States Post Office database for instant customer
                                            address verification.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <i class="fas fa-check text-primary me-3 mt-1"></i>
                                    <div>
                                        <h5>Payment Card Verification</h5>
                                        <p>Comprehensive card validation including name, address, and CVV matching with
                                            customer-provided information.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="identity-feature-card">
                                        <div class="identity-icon">
                                            <i class="fas fa-id-card"></i>
                                        </div>
                                        <h6>Full Customer Name</h6>
                                        <small class="text-muted">SSN Not Required</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="identity-feature-card">
                                        <div class="identity-icon">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                        <h6>Automated ID Capture</h6>
                                        <small class="text-muted">Secure Documentation</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="identity-feature-card">
                                        <div class="identity-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <h6>USPS Validated Address</h6>
                                        <small class="text-muted">Real-time Verification</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="identity-feature-card">
                                        <div class="identity-icon">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                        <h6>Payment Card CVV</h6>
                                        <small class="text-muted">Secure Validation</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Financial Comparison -->
    <section class="section bg-light" id="comparison">
        <div class="container">
            <div class="section-title">
                <h2>Numbers Speak Louder Than Words</h2>
                <p class="lead">Compare the Financial Benefits of In-House Payment Plans</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="comparison-card">
                        <h3 class="h4 mb-4">Third-Party Finance Company</h3>
                        <p>You surrender control and potential profits while potentially sharing valuable customer data with
                            competitors.</p>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span>Cash Price:</span>
                                <strong>$750</strong>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span>Weekly Payment:</span>
                                <strong>$30</strong>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span>Total Customer Payment:</span>
                                <strong>$1,687.25</strong>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span>Your Profit:</span>
                                <strong class="text-primary">$125</strong>
                            </div>
                        </div>
                        <small class="text-muted mt-3 d-block">*Illustrative example based on public third-party finance
                            data</small>
                    </div>
                </div>
                <div class="col-lg-2 text-center">
                    <div class="h-100 d-flex align-items-center justify-content-center identifier-arrow">
                        <i class="fas fa-arrow-right fa-3x text-muted"></i>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="comparison-card highlight">
                        <h3 class="h4 mb-4">RTO Devices In-House Platform</h3>
                        <p>Maintain complete control over pricing and profits while building customer loyalty and repeat
                            business.</p>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between border-bottom py-2 border-light">
                                <span>Cash Price:</span>
                                <strong>$750</strong>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2 border-light">
                                <span>Weekly Payment:</span>
                                <strong>$21.5</strong>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2 border-light">
                                <span>Total Customer Payment:</span>
                                <strong>$1,363.75</strong>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2 border-light">
                                <span>Your Profit:</span>
                                <strong>$863.75</strong>
                            </div>
                        </div>
                        <small class="mt-3 d-block opacity-75">*Based on national averages from RTO Devices platform
                            users</small>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <p class="h5 mb-4">"<strong>With RTO Devices, you earn $738.75 more profit per plan while customers save
                        $323.5</strong>"</p>
                <a href="/demo" class="btn btn-primary btn-lg">
                    Schedule Discovery Call <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Calculator CTA -->
    <section class="section calc-sec" style="background: var(--gradient); color: white;">
        <div class="container text-center">
            <div class="feature-icon mx-auto mb-4">
                <i class="fas fa-calculator"></i>
            </div>
            <h2 class="h1 mb-3">Calculate Your Profit Potential</h2>
            <p class="lead mb-4">Use our interactive calculator to see how much you could earn with in-house payment plans
            </p>
            <a href="/calculator" class="btn btn-primary text-uppercase"> Explore Profit Calculator
            </a>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            // Navbar scroll effect
            $(window).scroll(function () {
                if ($(window).scrollTop() > 50) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
            });
        });
    </script>
@endpush
