@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? 'Partners | RTO Devices' }}
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
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,202.7C672,203,768,181,864,170.7C960,160,1056,160,1152,170.7C1248,181,1344,203,1392,213.3L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') center bottom/cover;
        }

        .partner-card {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            transition: .3s;
            height: 100%;
            border: 1px solid #f0f0f0;
        }

        .partner-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
        }

        .partner-logo {
            height: 80px;
            max-width: 100%;
            object-fit: contain;
            margin-bottom: 25px;
            transition: .3s;
        }

        .partner-card:hover .partner-logo {
            transform: scale(1.05);
        }

        .partner-tag {
            background: var(--gradient);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 12px;
        }

        /* Bootstrap Tab Customization */
        .nav-tabs {
            border: none;
            justify-content: center;
            margin-bottom: 40px;
        }

        .nav-tabs .nav-link {
            border: 2px solid #e9ecef;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            color: #6c757d;
            margin: 0 8px;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .nav-tabs .nav-link.active {
            background: var(--gradient);
            color: white;
            border-color: var(--primary);
        }

        .tab-pane {
            animation: fadeIn 0.6s ease-in;
        }

        .partner-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 991px) {
            .section {
                padding: 60px 0;
            }

            .hero-section {
                padding: 80px 0 60px;
            }
        }

        @media (max-width: 767px) {
            .section {
                padding: 50px 0;
            }

            .nav-tabs .nav-link {
                padding: 10px 20px;
                margin: 5px;
                font-size: 0.9rem;
            }

            .partner-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <i class="fas fa-handshake fa-2x me-3"></i>
                        <h2 class="mb-0">Partner Ecosystem</h2>
                    </div>
                    <h1 class="display-4 fw-bold mb-4">Our Valued Partners</h1>
                    <p class="lead mb-0">RTO Devices collaborates with industry-leading technology providers and
                        distribution networks. We carefully select partners who share our vision, mission, and commitment to
                        excellence.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section with Bootstrap Tabs -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- Bootstrap Tabs -->
                    <ul class="nav nav-tabs" id="partnersTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                                type="button" role="tab" aria-controls="all" aria-selected="true">
                                All Partners
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="technology-tab" data-bs-toggle="tab" data-bs-target="#technology"
                                type="button" role="tab" aria-controls="technology" aria-selected="false">
                                Technology
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="distribution-tab" data-bs-toggle="tab"
                                data-bs-target="#distribution" type="button" role="tab" aria-controls="distribution"
                                aria-selected="false">
                                Distribution
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tradeshows-tab" data-bs-toggle="tab" data-bs-target="#tradeshows"
                                type="button" role="tab" aria-controls="tradeshows" aria-selected="false">
                                Trade Shows
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="partnersTabContent">
                        <!-- All Partners Tab -->
                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                            <div class="partner-grid">
                                <!-- Apple -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.apple.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Apple" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Apple</h4>
                                        <p class="text-muted mb-0">Our proprietary device security technology integrates
                                            deeply with Apple iOS, achieving unparalleled security levels. Device IMEIs are
                                            registered with Apple, placing devices in secure mode when needed while
                                            maintaining emergency communication capabilities.</p>
                                        <span class="partner-tag">Technology</span>
                                    </div>
                                </div>

                                <!-- Google -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.google.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1573804633927-bfcbcd909acd?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Google" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Google</h4>
                                        <p class="text-muted mb-0">Our advanced locking technology integrates seamlessly
                                            with Android OS, enhanced by Samsung's KNOX security framework. Device IMEIs are
                                            registered globally with Google, enabling simplified over-the-air software
                                            installation and comprehensive device management.</p>
                                        <span class="partner-tag">Technology</span>
                                    </div>
                                </div>

                                <!-- Fiserv -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.fiserv.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Fiserv" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Fiserv</h4>
                                        <p class="text-muted mb-0">As a global leader in payments and financial technology,
                                            Fiserv connects businesses and financial institutions worldwide. Our
                                            auto-bill-pay system integrates seamlessly with Fiserv's infrastructure through
                                            the Clover Connect merchant services network.</p>
                                        <span class="partner-tag">Technology</span>
                                    </div>
                                </div>

                                <!-- Marceco -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.marceco.net/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Marceco" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Marceco</h4>
                                        <p class="text-muted mb-0">As a premier Direct Distribution Partner for Boost Mobile
                                            and wireless products provider, Marceco offers RTO Devices solutions to dealers
                                            nationwide. Many Boost Authorized Dealers have significantly grown their
                                            businesses using our in-house payment platform.</p>
                                        <span class="partner-tag">Distribution</span>
                                    </div>
                                </div>

                                <!-- Wireless Dealer Group -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.wirelessdealergroup.com/" target="_blank"
                                        class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Wireless Dealer Group" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Wireless Dealer Group</h4>
                                        <p class="text-muted mb-0">Dedicated to helping dealers grow their businesses and
                                            increase profitability, Wireless Dealer Group provides RTO Devices access to
                                            dealers across the United States. Many members have established successful
                                            buy-now-pay-later programs using our platform.</p>
                                        <span class="partner-tag">Distribution</span>
                                    </div>
                                </div>

                                <!-- Clover Connect -->
                                <div class="partner-card fade-in">
                                    <a href="https://integrate.clover.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Clover" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Clover Connect</h4>
                                        <p class="text-muted mb-0">Clover Connect transforms customer-merchant interactions
                                            through innovative payment solutions. Our software platform integrates with
                                            Clover Connect's merchant services, supporting secure card-not-present
                                            transactions and streamlined payment processing.</p>
                                        <span class="partner-tag">Technology</span>
                                    </div>
                                </div>

                                <!-- Samsung -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.samsung.com/us/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Samsung" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Samsung</h4>
                                        <p class="text-muted mb-0">Samsung Knox provides a comprehensive business platform
                                            for mobile device configuration and management. RTO Devices integrates with
                                            Samsung KNOX technology to deliver enhanced security layers specifically for
                                            Samsung devices in our payment ecosystem.</p>
                                        <span class="partner-tag">Technology</span>
                                    </div>
                                </div>

                                <!-- Lux Wireless -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.luxwireless.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1586953208448-b95a79798f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Lux Wireless" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Lux Wireless</h4>
                                        <p class="text-muted mb-0">As a rapidly growing premier cell phone accessory
                                            wholesaler and manufacturer based in Atlanta, Lux Wireless offers competitively
                                            priced cell phones and accessories specifically curated for RTO Devices platform
                                            users.</p>
                                        <span class="partner-tag">Distribution</span>
                                    </div>
                                </div>

                                <!-- All Wireless Expo -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.allwirelessexpo.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="All Wireless Expo" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">All Wireless & Prepaid Expo</h4>
                                        <p class="text-muted mb-0">Since 2008, this premier event has been the leading
                                            gathering for prepaid wireless and value-added services. No other event brings
                                            together more prepaid providers, from MVNO hosting partners to retail
                                            distribution experts, under one roof.</p>
                                        <span class="partner-tag">Trade Shows</span>
                                    </div>
                                </div>

                                <!-- Gadget Repair Expo -->
                                <div class="partner-card fade-in">
                                    <a href="https://gadgetrepairexpo.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Gadget Repair Expo" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Gadget Repair Expo</h4>
                                        <p class="text-muted mb-0">This vibrant event brings together repair experts,
                                            manufacturers, suppliers, and enthusiasts to exchange ideas and showcase
                                            cutting-edge technologies. The expo inspires the next generation of repair
                                            professionals while promoting device maintenance and sales growth.</p>
                                        <span class="partner-tag">Trade Shows</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Technology Partners Tab -->
                        <div class="tab-pane fade" id="technology" role="tabpanel" aria-labelledby="technology-tab">
                            <div class="partner-grid">
                                <!-- Apple -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.apple.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Apple" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Apple</h4>
                                        <p class="text-muted mb-0">Our proprietary device security technology integrates
                                            deeply with Apple iOS, achieving unparalleled security levels. Device IMEIs are
                                            registered with Apple, placing devices in secure mode when needed while
                                            maintaining emergency communication capabilities.</p>
                                        <span class="partner-tag">Technology</span>
                                    </div>
                                </div>

                                <!-- Google -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.google.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1573804633927-bfcbcd909acd?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Google" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Google</h4>
                                        <p class="text-muted mb-0">Our advanced locking technology integrates seamlessly
                                            with Android OS, enhanced by Samsung's KNOX security framework. Device IMEIs are
                                            registered globally with Google, enabling simplified over-the-air software
                                            installation and comprehensive device management.</p>
                                        <span class="partner-tag">Technology</span>
                                    </div>
                                </div>

                                <!-- Fiserv -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.fiserv.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Fiserv" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Fiserv</h4>
                                        <p class="text-muted mb-0">As a global leader in payments and financial technology,
                                            Fiserv connects businesses and financial institutions worldwide. Our
                                            auto-bill-pay system integrates seamlessly with Fiserv's infrastructure through
                                            the Clover Connect merchant services network.</p>
                                        <span class="partner-tag">Technology</span>
                                    </div>
                                </div>

                                <!-- Clover Connect -->
                                <div class="partner-card fade-in">
                                    <a href="https://integrate.clover.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Clover" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Clover Connect</h4>
                                        <p class="text-muted mb-0">Clover Connect transforms customer-merchant interactions
                                            through innovative payment solutions. Our software platform integrates with
                                            Clover Connect's merchant services, supporting secure card-not-present
                                            transactions and streamlined payment processing.</p>
                                        <span class="partner-tag">Technology</span>
                                    </div>
                                </div>

                                <!-- Samsung -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.samsung.com/us/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Samsung" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Samsung</h4>
                                        <p class="text-muted mb-0">Samsung Knox provides a comprehensive business platform
                                            for mobile device configuration and management. RTO Devices integrates with
                                            Samsung KNOX technology to deliver enhanced security layers specifically for
                                            Samsung devices in our payment ecosystem.</p>
                                        <span class="partner-tag">Technology</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Distribution Partners Tab -->
                        <div class="tab-pane fade" id="distribution" role="tabpanel" aria-labelledby="distribution-tab">
                            <div class="partner-grid">
                                <!-- Marceco -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.marceco.net/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Marceco" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Marceco</h4>
                                        <p class="text-muted mb-0">As a premier Direct Distribution Partner for Boost Mobile
                                            and wireless products provider, Marceco offers RTO Devices solutions to dealers
                                            nationwide. Many Boost Authorized Dealers have significantly grown their
                                            businesses using our in-house payment platform.</p>
                                        <span class="partner-tag">Distribution</span>
                                    </div>
                                </div>

                                <!-- Wireless Dealer Group -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.wirelessdealergroup.com/" target="_blank"
                                        class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Wireless Dealer Group" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Wireless Dealer Group</h4>
                                        <p class="text-muted mb-0">Dedicated to helping dealers grow their businesses and
                                            increase profitability, Wireless Dealer Group provides RTO Devices access to
                                            dealers across the United States. Many members have established successful
                                            buy-now-pay-later programs using our platform.</p>
                                        <span class="partner-tag">Distribution</span>
                                    </div>
                                </div>

                                <!-- Lux Wireless -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.luxwireless.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1586953208448-b95a79798f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Lux Wireless" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Lux Wireless</h4>
                                        <p class="text-muted mb-0">As a rapidly growing premier cell phone accessory
                                            wholesaler and manufacturer based in Atlanta, Lux Wireless offers competitively
                                            priced cell phones and accessories specifically curated for RTO Devices platform
                                            users.</p>
                                        <span class="partner-tag">Distribution</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Trade Shows Tab -->
                        <div class="tab-pane fade" id="tradeshows" role="tabpanel" aria-labelledby="tradeshows-tab">
                            <div class="partner-grid">
                                <!-- All Wireless Expo -->
                                <div class="partner-card fade-in">
                                    <a href="https://www.allwirelessexpo.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="All Wireless Expo" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">All Wireless & Prepaid Expo</h4>
                                        <p class="text-muted mb-0">Since 2008, this premier event has been the leading
                                            gathering for prepaid wireless and value-added services. No other event brings
                                            together more prepaid providers, from MVNO hosting partners to retail
                                            distribution experts, under one roof.</p>
                                        <span class="partner-tag">Trade Shows</span>
                                    </div>
                                </div>

                                <!-- Gadget Repair Expo -->
                                <div class="partner-card fade-in">
                                    <a href="https://gadgetrepairexpo.com/" target="_blank" class="text-decoration-none">
                                        <img src="https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Gadget Repair Expo" class="partner-logo">
                                    </a>
                                    <div class="partner-content">
                                        <h4 class="h5 mb-2">Gadget Repair Expo</h4>
                                        <p class="text-muted mb-0">This vibrant event brings together repair experts,
                                            manufacturers, suppliers, and enthusiasts to exchange ideas and showcase
                                            cutting-edge technologies. The expo inspires the next generation of repair
                                            professionals while promoting device maintenance and sales growth.</p>
                                        <span class="partner-tag">Trade Shows</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background: var(--gradient); color: white;">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <h2 class="h1  text-center text-lg-start mb-3">Interested in Becoming a Partner?</h2>
                    <p class="lead  text-center text-lg-start mb-0">Join our network of industry leaders and grow together
                    </p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <a href="/become_partner" class="btn btn-primary btn-lg"> Learn More <i
                            class="fas fa-arrow-right ms-2"></i> </a>
                </div>
            </div>
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

            // Smooth scrolling
            $('a[href^="#"]').on('click', function (event) {
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 70
                    }, 1000);
                }
            });

            // Initialize Bootstrap tabs
            var triggerTabList = [].slice.call(document.querySelectorAll('#partnersTab button'))
            triggerTabList.forEach(function (triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)

                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault()
                    tabTrigger.show()
                })
            });
        });
    </script>
@endpush