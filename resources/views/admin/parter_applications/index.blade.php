@extends('admin.layouts.master')

@section('partner_application', 'active')
@section('title') {{ $title ?? 'Partner Applications' }} @endsection

@section('content')


    @endphp
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Partner Applications List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Partner Applications</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage Partner Applications</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table id="dataTables" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Company Name</th>
                                            <th>Partner Type</th>
                                            <th>Contact Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Website</th>
                                            <th>Message</th>
                                            <th>Request Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($rows as $key => $request)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $request->companyName }}</td>
                                                <td>{{ $request->partnerType }}</td>
                                                <td>{{ $request->contactName }}</td>
                                                <td><a href="mailto:{{ $request->email }}">{{ $request->email }}</a></td>
                                                <td>{{ $request->phone }}</td>
                                                <td>{{ $request->website }}</td>
                                                <td>{{ $request->message }}</td>
                                                <td>{{ $request->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-xs btn-secondary dropdown-toggle btn-sm btn-gradient"
                                                            type="button" data-toggle="dropdown">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            <a href="{{ route('admin.partner-request.delete', $request->id) }}"
                                                                class="dropdown-item" id="deleteData">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No demo requests found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush