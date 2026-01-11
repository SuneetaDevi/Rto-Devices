@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? 'Become a partner | RTO Devices' }}
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
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            transition: .3s;
            height: 100%;
            border: 1px solid #f0f0f0;
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

        .benefit-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #fff;
            font-size: 28px;
        }

        .overline-w-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
        }

        .overline-w-icon i {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .form-select {
            padding: 12px 15px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
        }

        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(58, 134, 255, 0.25);
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

            .cta-sec {
                text-align: center;
            }
        }

        @media (max-width: 575px) {
            .btn {
                font-size: 16px;
            }

            .btn i {
                display: none;
            }
        }

        .error-text {
            color: #d00;
            font-weight: 500;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="overline-w-icon">
                        <i class="fas fa-handshake"></i>
                        <div>Join Our Partner Program</div>
                    </div>
                    <h1 class="display-5 fw-bold mb-4">Collaborate with RTO Devices to Accelerate Your Business Growth</h1>
                    <p class="lead mb-4 mb-lg-5">If you serve mobile retailers and repair shop owners seeking revenue
                        expansion, our Referring Master Dealer Program offers exceptional opportunities. Connect with us
                        today to explore partnership possibilities.</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="#partner-form" class="btn btn-primary btn-lg">
                            Start Partnership Journey
                        </a>
                        <a href="/partners" class="btn btn-outline-primary-white btn-lg">
                            Explore Partner Network <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partner Benefits Section -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h2>Partnership Advantages</h2>
                        <p class="lead">Discover the comprehensive benefits of joining our elite partner network</p>
                    </div>
                </div>
            </div> 
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon" style="background: transparent">
                            <img src="{{ asset('assets/images/icons/benefits-1.png') }}" alt="icon">
                        </div>
                        <h4 class="h5 mb-3">Recurring Revenue Streams</h4>
                        <p class="text-muted">Earn both initial referral bonuses and ongoing commissions from every payment
                            plan initiated through your partner network.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon" style="background: transparent">
                            <img src="{{ asset('assets/images/icons/benefits-2.png') }}" alt="icon">
                        </div>
                        <h4 class="h5 mb-3">Brand Collaboration</h4>
                        <p class="text-muted">Leverage co-branding opportunities that combine RTO Devices's market presence
                            with your established brand identity.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon" style="background: transparent">
                            <img src="{{ asset('assets/images/icons/benefits-3.png') }}" alt="icon">
                        </div>
                        <h4 class="h5 mb-3">Cross Selling</h4>
                        <p class="text-muted">Your products and services gain exposure through our extensive communications
                            with thousands of mobile retailers nationwide.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Partner Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h2>Why Choose RTO Devices Partnership?</h2>
                        <p class="lead">Experience the advantages of working with industry leaders</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="benefit-icon" style="background: transparent">
                            <img src="{{ asset('assets/images/icons/why-1.png') }}" alt="icon">
                        </div>
                        <h5 class="h6 mb-3">Rapid Implementation</h5>
                        <p class="text-muted small">Begin realizing partnership benefits within 30 days with minimal setup
                            requirements.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="benefit-icon" style="background: transparent">
                            <img src="{{ asset('assets/images/icons/why-2.png') }}" alt="icon">
                        </div>
                        <h5 class="h6 mb-3">Marketing Support</h5>
                        <p class="text-muted small">We handle the promotional efforts while you focus on your core business
                            operations.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="benefit-icon" style="background: transparent">
                            <img src="{{ asset('assets/images/icons/why-3.png') }}" alt="icon">
                        </div>
                        <h5 class="h6 mb-3">Extended Market Reach</h5>
                        <p class="text-muted small">Access thousands of retailers beyond your current customer base through
                            our established network.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="benefit-icon" style="background: transparent">
                            <img src="{{ asset('assets/images/icons/why-4.png') }}" alt="icon">
                        </div>
                        <h5 class="h6 mb-3">Profitability Focus</h5>
                        <p class="text-muted small">Generate continuous revenue streams as your referred partners succeed
                            with our platform.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partnership Process Section -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h2>Simple Partnership Process</h2>
                        <p class="lead">Get started with our straightforward onboarding journey</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="feature-icon mx-auto mb-3">
                            <span class="h4 text-white mb-0">1</span>
                        </div>
                        <h5 class="h6 mb-3">Initial Consultation</h5>
                        <p class="text-muted small">Schedule a discovery call to explore partnership alignment and
                            opportunities.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="feature-icon mx-auto mb-3">
                            <span class="h4 text-white mb-0">2</span>
                        </div>
                        <h5 class="h6 mb-3">Program Agreement</h5>
                        <p class="text-muted small">Review and sign our comprehensive partnership agreement with clear
                            terms.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="feature-icon mx-auto mb-3">
                            <span class="h4 text-white mb-0">3</span>
                        </div>
                        <h5 class="h6 mb-3">Onboarding & Training</h5>
                        <p class="text-muted small">Complete our partner training program and access marketing resources.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="feature-icon mx-auto mb-3">
                            <span class="h4 text-white mb-0">4</span>
                        </div>
                        <h5 class="h6 mb-3">Revenue Generation</h5>
                        <p class="text-muted small">Start earning commissions as your referrals join and succeed with our
                            platform.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-sec" style="background: var(--gradient); color: white;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-title mb-0">
                        <h2 class="text-start">Ready to Begin Your Partnership Journey?</h2>
                        <p class="lead text-white text-start mb-3 mb-lg-0 mx-0">Join our network of successful partners and
                            unlock new growth opportunities</p>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="#partner-form" class="btn btn-primary btn-lg"> Start Partnership Today </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Partner Form Section -->
    <section id="partner-form" class="section form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <div class="section-title">
                            <h2>Begin Your Partnership Application</h2>
                            <p class="lead">Complete the form below and our partnership team will contact you within 24
                                hours</p>
                        </div>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-3 p-sm-4 p-md-5">
                            <form>
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="companyName" class="form-label">Company Name *</label>
                                        <input type="text" class="form-control" id="companyName" name="companyName"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="partnerType" class="form-label">Partnership Type *</label>
                                        <select class="form-select" id="partnerType" name="partnerType" required>
                                            <option value="">Select Partnership Type</option>
                                            <option value="distribution">Distribution Partner</option>
                                            <option value="technology">Technology Partner</option>
                                            <option value="reseller">Reseller Partner</option>
                                            <option value="referral">Referral Partner</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="contactName" class="form-label">Contact Name *</label>
                                        <input type="text" class="form-control" id="contactName" name="contactName"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="website" class="form-label">Company Website</label>
                                        <input type="url" class="form-control" id="website" name="website">
                                    </div>
                                    <div class="col-12">
                                        <label for="message" class="form-label">Tell us about your business and partnership
                                            interests</label>
                                        <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="agreeTerms"
                                                name="agreeTerms" required>
                                            <label class="form-check-label" for="agreeTerms">
                                                I agree to the partnership terms and conditions
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            Submit Application <i class="fas fa-paper-plane ms-2"></i>
                                        </button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
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

            // Smooth scrolling for anchor links
            $('a[href^="#"]').on('click', function (event) {
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 70
                    }, 1000);
                }
            });

            $('form').on('submit', function (e) {
                e.preventDefault();

                const form = $(this);
                const formData = new FormData(this);

                // Remove old errors
                form.find('.error-text').remove();

                $.ajax({
                    url: form.attr('action') ?? '/partnership-apply',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        form.find('button[type="submit"]').prop('disabled', true);
                    },
                    success: function (response) {
                        // Hide form only on success
                        form.hide();

                        form.after(`
                        <div class="alert alert-success mt-3">
                            ${response.message ?? "Thank you! Your partnership application was submitted successfully."}
                        </div>
                    `);
                    },
                    error: function (xhr) {

                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;

                            $.each(errors, function (fieldName, errorMessage) {
                                const inputField = form.find(`[name="${fieldName}"]`);

                                // Add error text below the input
                                inputField.after(`
                                <div class="error-text text-danger mt-1" style="font-size: 14px;">
                                    ${errorMessage[0]}
                                </div>
                            `);
                            });
                        }
                    },
                    complete: function () {
                        form.find('button[type="submit"]').prop('disabled', false);
                    }
                });
            });



        });
    </script>
@endpush
