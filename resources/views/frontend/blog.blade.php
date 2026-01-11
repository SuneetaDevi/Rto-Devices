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
    <section class="blogs-header">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1>Insights to Help You Boost Mobile Sales with Smart Payment Options</h1>
                    <p>Explore expert tips, strategies, and real success stories to help you grow your mobile retail
                        business through flexible in-house payment plans. Learn from real retailers who turned payment
                        flexibility into lasting profit.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blogs Section -->
    <section class="blogs-section">
        <div class="container">
            <div class="row g-4">
                <!-- Blog Post 1 -->

                @foreach ($rows as $row)
                    <div class="col-md-6 col-lg-4">
                        <div class="blogs-card">
                            <div class="blogs-image" style="background-image: url('{{ asset($row->image) }}')">
                                <div class="blogs-number">{{ $loop->index + 1 }}</div>
                            </div>
                            <div class="blogs-content">
                                <h3 class="blogs-title">{{ $row->title }}</h3>
                                <p class="blogs-excerpt">
                                    {{ mb_strimwidth(strip_tags($row->details), 0, 150, '...') }}
                                </p>

                                <a href="{{route('frontend.blogs.details', ['slug' => $row->slug])}}"
                                    class="read-more stretched-link">
                                    Read Post <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-container text-center">
                <h2 class="newsletter-title">Stay Connected and Keep Learning</h2>
                <p class="newsletter-subtitle">Subscribe to our newsletter to receive the latest insights, case studies, and
                    tips for growing your mobile business.</p>

                <form class="newsletter-form" method="post" action="{{ route('frontend.newsletter.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Enter your email address"
                            required>
                    </div>
                    <div class="form-check mb-3 text-start">
                        <input class="form-check-input" type="checkbox" id="newsletterConsent" required>
                        <label class="form-check-label" for="newsletterConsent">
                            I agree to receive marketing emails and updates from RTO Devices
                        </label>
                    </div>
                    <button type="submit" class="btn btn-light btn-lg w-100">Subscribe Now</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush