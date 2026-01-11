@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? 'RTO Devices' }}
@endsection

@section('meta')
    <meta property="og:title" content="{{$row->meta_title ?? $og_title}}" />
    <meta property="og:description" content="{{$row->meta_description ?? $og_description}}" />
    <meta property="og:image" content="{{asset($og_image)}}" />
    <meta name="description" content="{{$row->meta_description ?? $og_description}}">
    <meta name="keywords" content="{{$row->meta_keywords ?? $meta_keywords}}">
@endsection

@push('style')
@endpush

@section('content')
    <!-- Header Section -->
    <section class="about-header">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1>Vision, Mission, Story & Core Values</h1>
                    <p>Guided by our vision and mission, we help mobile retailers grow with modern in-house payment
                        technology. Since 2016, we've been driven by innovation, integrity, and collaboration — shaping a
                        smarter future for retailers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="vision-mission-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="vision-card">
                        <div class="vision-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3>Our Vision</h3>
                        <p class="mb-0">We envision a future where every mobile store can provide customers with affordable
                            smartphones through flexible in-house payment plans. We believe in empowering small retailers
                            with tools that make premium technology accessible to everyone.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mission-card">
                        <div class="mission-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3>Our Mission</h3>
                        <p class="mb-0">Our mission is to simplify mobile sales by giving store owners easy, profitable
                            payment solutions. We aim to help them serve their customers better, grow faster, and compete
                            confidently in today's market.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="story-content">
                        <h2 class="mb-4">The Beginning of RTO Devices</h2>
                        <p class="lead">In 2016, a small team of dreamers set out to change the way smartphones were sold.
                        </p>
                        <p class="mb-0">They saw how difficult it was for customers to buy quality phones outright — so they
                            built a system that let stores offer "buy now, pay later" options with ease. What started as a
                            small idea soon became a movement empowering hundreds of mobile retailers nationwide.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="story-illustration">
                        <div class="bulb-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="values-section">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2>Our Core Values</h2>
                    <p class="lead mb-0">We're passionate about what we do — and how we do it. Our company is built on three
                        simple but powerful values that define who we are.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4>People Come First</h4>
                        <p class="mb-0">We put people before profits. Every decision we make aims to build trust, respect,
                            and long-term relationships with our customers and partners.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4>Learning Every Day</h4>
                        <p class="mb-0">We embrace mistakes as lessons. Every challenge teaches us to grow stronger,
                            innovate smarter, and serve retailers better.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-laugh-beam"></i>
                        </div>
                        <h4>Enjoy the Journey</h4>
                        <p class="mb-0">We believe work should be meaningful — and fun. Our culture encourages creativity,
                            teamwork, and celebration of success together.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="single-test-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="test-card">
                        <div class="text">
                            "This platform helped us increase sales by 50% — customers love having easy payment options!"
                        </div>
                        <div class="author">— Sarah M., Mobile Planet Owner</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush