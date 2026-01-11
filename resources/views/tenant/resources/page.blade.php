@extends('tenant.layouts.master') {{-- Assuming you're extending a master layout --}}
@section('resources_active', 'active')
@section('title', $data['row']->title ?? '')

@push('style')
    <style>
        /* Container adjustments */
        .resources-page {
            padding: 20px 0;
        }


        /* Card styling */
        .resource-card {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 0.5rem;
            /* rounded corners */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            /* subtle shadow */
            padding: 25px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        /* Optional hover effect */
        .resource-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        /* Paragraphs inside card */
        .resource-card p {
            color: #555;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        /* Headings inside card */
        .resource-card h3,
        .resource-card h4,
        .resource-card h5 {
            margin-top: 1.2rem;
            margin-bottom: 0.8rem;
            color: #222;
        }

        .resource-card ul {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .resource-card img {
            max-width: 100%;
            height: auto;
            border-radius: 0.25rem;
            margin-bottom: 1rem;
        }

        /* General table styling */
        .resource-card table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        /* Table head */
        .resource-card table thead th {
            background-color: #0d6efd;
            /* Bootstrap primary color */
            color: #fff;
            font-weight: 600;
            padding: 10px 12px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }

        /* Table body rows */
        .resource-card table tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #dee2e6;
            color: #495057;
        }

        /* Hover effect */
        .resource-card table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Striped rows */
        .resource-card table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f4f6;
        }

        /* Bordered table */
        .resource-card table.table-bordered {
            border: 1px solid #dee2e6;
        }

        .resource-card table.table-bordered th,
        .resource-card table.table-bordered td {
            border: 1px solid #dee2e6;
        }

        /* Responsive wrapper */
        .resource-card .table-responsive {
            overflow-x: auto;
        }

        /* Table captions */
        .resource-card table caption {
            caption-side: bottom;
            font-size: 0.875rem;
            color: #6c757d;
            padding-top: 0.5rem;
        }

        /* Links in tables */
        .resource-card table a {
            color: #0d6efd;
            text-decoration: none;
        }

        .resource-card table a:hover {
            text-decoration: underline;
        }

        /* Small adjustments for mobile */
        @media (max-width: 768px) {

            .resource-card table thead th,
            .resource-card table tbody td {
                padding: 8px 10px;
            }
        }

        .resource-card li {
            margin-bottom: 0.5rem;
        }


        /* Links inside card */
        .resource-card a {
            color: #0d6efd;
            /* Bootstrap primary color */
            text-decoration: none;
        }

        .resource-card a:hover {
            text-decoration: underline;
        }

        /* Page / Card Title */
        .resources-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            /* Center the title */
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper resources-page">
        <div class="container-fluid">
            <h2 class="resources-title">{{ $data['row']->title ?? '' }}</h2>

            <div class="resource-card">
                {!! $data['row']->body ?? '' !!}
            </div>
        </div> {{-- End container-fluid --}}
    </div> {{-- End content-wrapper --}}
@endsection

@push('script')
    {{-- Any page-specific JavaScript can go here --}}
@endpush
