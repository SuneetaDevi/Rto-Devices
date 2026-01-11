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
@php
    $localLanguage = session()->get('languageName') ?? geDefaultLanguage()->iso_code;
@endphp
@section('content')
    <section class="my-3 py-3">
        <div class="legal-container">
            <div class="last-updated">
                <i class="fas fa-clock me-2"></i>Last Updated: March
                {{ \Carbon\Carbon::parse($row->updated_at)->format('d, Y') }}
            </div>
            {!! $row->body !!}


            <div class="contact_info">
                <h3>Contact Us</h3>
                <p>If you have any questions about these Terms & Conditions, please contact us:</p>
                <p>
                    <strong>Email:</strong> legal@rtodevices.com<br>
                    <strong>Phone:</strong> (888) 707-0107<br>
                    <strong>Address:</strong> 123 Business Ave, Suite 101, Dallas, TX 75201
                </p>
            </div>
        </div>
    </section>

@endsection

@push('script')
@endpush