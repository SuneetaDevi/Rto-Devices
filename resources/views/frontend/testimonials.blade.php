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
    <section class="testimonials-header">
        <div class="container">
            <h1>Retailer Success Stories: How In-house Payment Plans Are Boosting Businesses</h1>
            <p>These real-world stories show how our in-house payment solutions help retailers grow revenue, retain
                customers, and create flexible buying options.</p>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="testimonials-grid">
                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "My mobile shop is inside a supermarket in Dallas. I've already earned back my full investment and
                        now make over $40,000 in extra monthly profit through my in-house payment plan program."
                    </div>
                    <div class="testimonial-author">Angelo</div>
                    <div class="testimonial-company">FastFix Electronics</div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "Across all my branches, I now have full control to offer customers affordable payment options. If
                        their situation changes, I can easily adjust their plan — it keeps them loyal and stress-free."
                    </div>
                    <div class="testimonial-author">Harold</div>
                    <div class="testimonial-company">Owner of Cellutalk</div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "Once my sales team learned how to explain flexible payment plans, customers stopped walking away.
                        It's easy to match a plan to their budget — sales went up, and satisfaction followed."
                    </div>
                    <div class="testimonial-author">Josh</div>
                    <div class="testimonial-company">Owner at 1 Stop Phone Shop</div>
                </div>

                <!-- Testimonial 4 -->
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "When finance companies kept rejecting my customers, I knew there had to be a smarter way. Creating
                        our own approval system let us offer fair, flexible payment plans — and profit more."
                    </div>
                    <div class="testimonial-author">Amador</div>
                    <div class="testimonial-company">Owner at NG Cellular</div>
                </div>

                <!-- Testimonial 5 -->
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "Our in-house payment option started strong — it's already profitable and customer demand keeps
                        rising. People simply want payment flexibility; meeting that need has been game-changing."
                    </div>
                    <div class="testimonial-author">Cedric</div>
                    <div class="testimonial-company">Franchise owner at Cell Phone Repair</div>
                </div>

                <!-- Testimonial 6 -->
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "If customers can't pay upfront, you risk losing them. With payment plans, they stay — and it's made
                        a huge difference in my store's revenue."
                    </div>
                    <div class="testimonial-author">Alberto</div>
                    <div class="testimonial-company">Owner at Smart Electronic & Furniture</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-card">
                <h2 class="cta-title">Ready to Transform Your Business?</h2>
                <p class="cta-description">Join hundreds of successful mobile retailers who are already growing their
                    revenue with our in-house payment solutions. Start your journey to higher profits today.</p>
                <a href="{{ route('frontend.demo') }}" class="btn btn-primary btn-lg">Book a Free Demo</a>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush