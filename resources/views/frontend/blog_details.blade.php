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
    <section class="blog-detail-header">
        <div class="container">
            <div class="blog-meta">
                <!-- <span class="blog-category">PAYMENT SOLUTIONS</span> -->
                <span><i class="far fa-clock me-1"></i> 8 min read</span>
                <span><i class="far fa-calendar me-1"></i> March 15, 2024</span>
            </div>

            <h1 class="mb-2">{{ $blog->title }}</h1>
            <!-- <p class="blog-excerpt">Understand how easy-to-manage "buy now, pay later" options can turn first-time visitors
                            into loyal customers and boost your mobile store revenue.</p> -->
        </div>
    </section>

    <!-- Featured Image -->
    <section class="container">
        <div class="featured-image" style="background-image: url({{ asset($blog->image) }})">
        </div>
    </section>

    <!-- Content Section -->
    <section class="blog-content-section">
        {!! $blog->details !!}
    </section>

    <!-- Related Posts -->
    <section class="related-posts-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="text-center mb-5">Related Articles</h2>
                    <div class="row g-4">
                        @forelse($related_blogs as $blog)
                            <div class="col-md-4">
                                <div class="related-post-card">
                                    <div class="related-post-image" style="background-image: url('{{ asset($blog->image) }}')">
                                    </div>
                                    <div class="related-post-content">
                                        <h4 class="related-post-title">{{ $blog->title }}</h4>
                                        <a href="{{ route('frontend.blogs.details', ['slug' => $blog->slug]) }}"
                                            class="read-more stretched-link">
                                            Read More <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No related articles found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('script')
@endpush