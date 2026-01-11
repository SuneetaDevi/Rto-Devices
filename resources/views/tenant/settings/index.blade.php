@extends('tenant.layouts.master') {{-- Assuming you're extending a master layout --}}
@section('settings_menu_open', 'menu-open')
@section('settings_active', 'active')
@push('style')
    <style>
        /* Page Styling */
        .settings-page {
            padding: 50px 30px;
            background-color: #f8f9fa;
            /* Light background */
            min-height: calc(100vh - 56px);
            /* Ensure content area is tall */
        }

        .settings-title {
            font-size: 2.5rem;
            color: #4682b4;
            /* Steel blue color from the image */
            margin-bottom: 40px;
            text-align: center;
            font-weight: 300;
        }

        /* Settings Card Styling */
        .settings-card {
            max-width: 300px;
            /* Limit card width to match image appearance */
            background-color: #fff;
            border-top: 3px solid #007bff;
            /* Blue top border */
            border-radius: .25rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            padding: 15px;
            margin: 0 auto;
            /* Center the card horizontally */
        }

        .card-heading {
            font-size: 1.1rem;
            color: #343a40;
            margin-bottom: 10px;
            font-weight: 600;
        }

        /* List Item Styling */
        .settings-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .settings-list li {
            margin-bottom: 5px;
        }

        .settings-list a {
            font-size: 1rem;
            color: #007bff;
            /* Blue link color */
            text-decoration: none;
            display: block;
            padding: 3px 0;
        }

        .settings-list a:hover {
            text-decoration: underline;
            background-color: #f8f9fa;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper settings-page">
        <div class="container">
            <h2 class="settings-title">Settings</h2>

            {{-- Centered Administration Card --}}
            <div class="settings-card">
                <div class="card-heading">Administration</div>

                <ul class="settings-list">
                    <li><a href="#">Users</a></li>
                    <li><a href="#">Stores</a></li>
                </ul>
            </div>

        </div> {{-- End container --}}
    </div> {{-- End content-wrapper --}}
@endsection

@push('script')
    {{-- Any page-specific JavaScript can go here --}}
@endpush