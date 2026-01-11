@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? $setting->site_title }}
@endsection

@section('meta')
    <meta property="og:title" content="{{ $seo->title ?? $og_title }}" />
    <meta property="og:description" content="{{ $seo->description ?? $og_description }}" />
    <meta property="og:image" content="{{ asset($seo->image ?? $og_image) }}" />
    <meta name="description" content="{{ $seo->meta_description ?? $og_description }}">
    <meta name="keywords" content="{{ $seo->keywords ?? $meta_keywords }}">
@endsection

@push('style')
    <style>
        .card-footer {
            background-color: #ffffff;
            border-top: none;
        }

        .pointer {
            height: 10px;
            width: 10px;
            transform: rotate(45deg);
            border-radius: 20px 0px 2px 5px;
            margin-top: -14px;
            position: relative;
            left: 5px;
            right: 0px;
        }

        /* @media (max-width: 768px) {
                                    .fa-ul {
                                        margin-left: 0 !important;
                                    }
                                } */
    </style>
@endpush
@php
    $localLanguage = session()->get('languageName') ?? geDefaultLanguage()->iso_code;
@endphp
@section('content')

    <!-- Hero Section - Start -->
    <section class="hero">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <h1>Increase Your Mobile Store Sales with Easy In-house Payment Plans</h1>
                    <p>Give your customers the power to buy smartphones today and pay later — with our simple and secure
                        in-house financing system built for mobile retailers.</p>
                    <div class="mt-4">
                        <a href="{{ route('frontend.demo') }}" class="btn btn-primary btn-lg">Book a Demo</a>
                        <!-- <a href="#" class="btn btn-outline-light btn-lg rounded-pill px-4">Learn More</a> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="stats-box">
                                <h3>60%</h3>
                                <p>Verified: 60% of shoppers prefer stores that offer flexible payment options.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stats-box">
                                <h3>300%</h3>
                                <p>ROI: Earn up to 3x return on your financing investment.</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="stats-box">
                                <h3>$100k+</h3>
                                <p>Proven: Stores using in-house plans can generate $100K+ extra revenue per year.</p>
                            </div>
                        </div>
                        <!-- <div class="col-md-12">
                                                    <img src="./assets/images/hero.svg" alt="hero img" class="img-fluid">
                                                </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section - End -->

    <!-- Partner Section - Start -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Trusted by 1,000+ Mobile Retailers Across the U.S.</h2>
                <p>Join hundreds of mobile stores already growing faster with our in-house payment platform.</p>
            </div>
            <div class="row g-4 row-cols-2 row-cols-md-3 row-cols-lg-5 align-items-center justify-content-center">
                <div class="col text-center">
                    <img src="./assets/images/partner/1.webp" alt="Boost Mobile" class="partner-logo">
                </div>
                <div class="col text-center">
                    <img src="./assets/images/partner/2.webp" alt="Metro by T-Mobile" class="partner-logo">
                </div>
                <div class="col text-center">
                    <img src="./assets/images/partner/3.webp" alt="Cricket Wireless" class="partner-logo">
                </div>
                <div class="col text-center">
                    <img src="./assets/images/partner/4.webp" alt="Simple Mobile" class="partner-logo">
                </div>
                <div class="col text-center">
                    <img src="./assets/images/partner/5.webp" alt="Simple Mobile" class="partner-logo">
                </div>
            </div>
        </div>
    </section>
    <!-- Partner Section - End -->

    <!-- How It Works / Benefits Section -->
    <section id="how-it-works" class="section bg-light ">
        <div class="container">
            <div class="section-title mb-4">
                <h2>What Can You Do With RTO Devices?</h2>
            </div>
            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h4>Offer Buy Now, Pay Later Plans</h4>
                        <p class="mb-0">Let customers take home their favorite phones today and pay over time.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Increase Your Store Revenue</h4>
                        <p class="mb-0">Boost sales by offering flexible financing that attracts more buyers.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Retain More Customers</h4>
                        <p class="mb-0">Keep customers loyal with payment options that make phones more affordable.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <h4>Build Long-Term Growth</h4>
                        <p class="mb-0">Turn every sale into repeat business and steady cash flow.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section - Start -->
    <section id="benefits" class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-10 col-md-10 col-lg-8 mx-auto">
                    <div class="section-title">
                        <h2>Give Your Customers More Ways to Buy Smartphones</h2>
                        <p class="lead">Our platform helps mobile retailers offer in-house payment plans easily — no banks,
                            no credit checks, just instant approvals that increase sales.</p>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card card-custom h-100"
                                style="background-image: url('./assets/images/choose-us/1.jpg')">
                                <div class="card-body p-4">
                                    <div>
                                        <div class="card-icon">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                        <h4>Smartphones for Everyone</h4>
                                        <p class="mb-0">Offer top devices with manageable weekly or monthly payments.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-custom h-100"
                                style="background-image: url('./assets/images/choose-us/2.jpg')">
                                <div class="card-body p-4">
                                    <div>
                                        <div class="card-icon">
                                            <i class="fas fa-bolt"></i>
                                        </div>
                                        <h4>Faster Checkout Experience</h4>
                                        <p class="mb-0">Approve customers instantly and close more deals in minutes.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Choose Us Section - End -->

    <!-- Testimonial Section - Start -->'
    <section class="testimonial section bg-dark pb-0" style="background-color: #ededed !important">
        <div class="container">
            <div class="section-title text-white">
                <h2 class="text-dark">Real Stories with Real Results</h2>
            </div>

            <div class="owl-carousel testimonial-slider owl-theme">
                <!-- Slide 1 -->
                <div class="row g-4 align-items-center">
                    <div class="col-md-4">
                        <div class="testimonial-text">
                            <div class="quote-icon">❝</div>
                            <p>
                                Providing affordable in-house payment plans for my customers has now become essential in all
                                of my stores.
                                We approve customers without relying on a finance company and we offer 90-days same-as-cash
                                payment options.
                            </p>
                            <div class="testimonial-author">— Harold, Cellutalk</div>
                            <div class="testimonial-logo">
                                <img src="./assets/images/partner/1.webp" alt="Cellutalk Logo">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="testimonial-img">
                            <img src="./assets/images/testimonial/1.jpg" alt="Cellutalk Store">
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="row g-4 align-items-center">
                    <div class="col-md-4">
                        <div class="testimonial-text">
                            <div class="quote-icon">❝</div>
                            <p>
                                Thanks to the flexible payment options, our sales have grown and customers are more
                                satisfied than ever.
                                The approval process is quick and hassle-free!
                            </p>
                            <div class="testimonial-author">— John, Mobile Hub</div>
                            <div class="testimonial-logo">
                                <img src="./assets/images/partner/2.webp" alt="Mobile Hub Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="testimonial-img">
                            <img src="./assets/images/testimonial/2.jpg" alt="Mobile Hub Store" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-lg-flex align-items-center">
            <img class="img-fluid" src="./assets/images/eco-system/partner-ecosystem.png" alt="Eco system">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-8 ms-auto text-start mt-4 mt-md-5 mb-5 mb-lg-0">
                        <div class="section-title text-start mb-0">
                            <h2 class="text-dark">Our Partner Network</h2>
                            <p class="lead text-secondary" style="max-width: 100%">We collaborate with top distributors,
                                finance providers, and wireless brands to help independent retailers grow faster.</p>
                            <a href="{{ route('frontend.partners') }}" class="btn btn-primary mt-3"> Learn More </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section - End -->

    <!-- About Section - Start -->
    <section id="about" class="about section bg-light">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <h2>The RTO Devices Story</h2>
                    <p class="lead">It all started with one goal — to help small and independent mobile retailers compete
                        with big-box stores. We built a simple platform that empowers retailers to create their own in-house
                        financing plans and boost sales without relying on third parties.</p>
                    <a href="{{ route('frontend.how_it_works') }}" class="btn btn-primary"> Learn More </a>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="stats-box">
                                <h3>60%</h3>
                                <p>Verified: 60% of shoppers prefer stores that offer flexible payment options.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stats-box">
                                <h3>300%</h3>
                                <p>ROI: Earn up to 3x return on your financing investment.</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="stats-box">
                                <h3>$100k+</h3>
                                <p>Proven: Stores using in-house plans can generate $100K+ extra revenue per year.</p>
                            </div>
                        </div>
                        <!-- <div class="col-md-12">
                                                    <img src="./assets/images/hero.svg" alt="hero img" class="img-fluid">
                                                </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section - End -->

    <!-- Growth Section - Start -->
    <section class="growth section">
        <div class="container">
            <div class="section-title">
                <h2>Empowering Mobile Retailers to Grow Their Business</h2>
            </div>

            <div class="owl-carousel growth-slider owl-theme">
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="fs-5 fw-semibold">Boost Mobile Store Sees 50% Increase in Sales</h4>
                        <p>After implementing our in-house payment system, this retailer saw a dramatic increase in both new
                            and returning customers.</p>
                    </div>
                    <a href="#!" class="stretched-link"></a>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="fs-5 fw-semibold">Metro Dealer Doubles Revenue in 3 Months</h4>
                        <p>By offering flexible payment plans, this dealer attracted a new customer segment and
                            significantly increased average transaction value.</p>
                    </div>
                    <a href="#!" class="stretched-link"></a>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="fs-5 fw-semibold">Affordable Phones for Everyone – Success Story</h4>
                        <p>Learn how one retailer used our platform to make premium smartphones accessible to
                            budget-conscious customers.</p>
                    </div>
                    <a href="#!" class="stretched-link"></a>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="fs-5 fw-semibold">Building Trust Through Flexible Payment Options</h4>
                        <p>Discover how offering payment plans helped this retailer build stronger relationships with their
                            customer base.</p>
                    </div>
                    <a href="#!" class="stretched-link"></a>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="fs-5 fw-semibold">Boost Mobile Store Sees 50% Increase in Sales</h4>
                        <p>After implementing our in-house payment system, this retailer saw a dramatic increase in both new
                            and returning customers.</p>
                    </div>
                    <a href="#!" class="stretched-link"></a>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="fs-5 fw-semibold">Metro Dealer Doubles Revenue in 3 Months</h4>
                        <p>By offering flexible payment plans, this dealer attracted a new customer segment and
                            significantly increased average transaction value.</p>
                    </div>
                    <a href="#!" class="stretched-link"></a>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="fs-5 fw-semibold">Affordable Phones for Everyone – Success Story</h4>
                        <p>Learn how one retailer used our platform to make premium smartphones accessible to
                            budget-conscious customers.</p>
                    </div>
                    <a href="#!" class="stretched-link"></a>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="fs-5 fw-semibold">Building Trust Through Flexible Payment Options</h4>
                        <p>Discover how offering payment plans helped this retailer build stronger relationships with their
                            customer base.</p>
                    </div>
                    <a href="#!" class="stretched-link"></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Growth Section - End -->

    <!-- Final CTA Section - Start -->
    <section class="final-cta">
        <div class="container">
            <h2>Get Started with In-house Payment Plans</h2>
            <p>Let's help your mobile store sell more phones and keep customers coming back.</p>
            <a href="{{ route('frontend.demo') }}" class="btn btn-primary btn-lg">Book a Demo</a>
        </div>
    </section>
    <!-- Final CTA Section - End -->
@endsection

@push('script')
@endpush
