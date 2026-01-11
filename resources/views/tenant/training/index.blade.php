@extends('tenant.layouts.master')
@section('training_active', 'active')
@section('title', $title)

@push('style')
    <style>
        /* Page Styling */
        .training-page {
            padding: 50px 30px;
            background-color: #fff;
            /* White background */
            min-height: calc(100vh - 56px);
        }

        .training-title {
            font-size: 2.5rem;
            color: #4682b4;
            /* Steel blue color */
            margin-bottom: 5px;
            text-align: center;
            font-weight: 300;
        }

        .training-description {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 50px;
            text-align: center;
        }

        /* YouTube Embed Container Styling */
        .video-container {
            /* Center the video player */
            max-width: 900px;
            margin: 0 auto;
            /* Create a responsive 16:9 aspect ratio box */
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            border: 1px solid #e9ecef;
            /* Subtle border around the video */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Placeholder styling for the red box area in the image */
        .video-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #dc3545;
            /* Red text color */
            font-size: 1.2rem;
            border: 2px solid #dc3545;
            /* Red border from the image */
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper training-page">
        <div class="container">

            <h2 class="training-title">Training Videos</h2>
            <p class="training-description">
                All courses are free of charge for stores that have been issued RTO Devices portal credentials.
            </p>

            {{-- YouTube Video Embed Area --}}
            <div class="video-container">

                {{-- To use a real embed, replace the .video-placeholder div with a real iframe: --}}
                <iframe src="https://www.youtube.com/embed/YOUR_VIDEO_ID" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>


            </div>

        </div> {{-- End container --}}
    </div> {{-- End content-wrapper --}}
@endsection

@push('script')
    {{-- Any page-specific JavaScript can go here --}}
@endpush
