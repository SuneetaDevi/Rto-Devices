@extends('admin.layouts.master')

@section('tenant-active', 'active')
@section('title') Tenants @endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tenants List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tenants</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">Tenants
                                    <span class="float-right">
                                        <a href="{{ route('admin.tenant.create') }}"
                                            class="btn btn-sm btn-primary btn-gradient">
                                            + Add Tenant
                                        </a>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table id="dataTables" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">SN</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Shop</th>
                                            <th>Status</th>
                                            <th>Valid Till</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="5%">SN</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Shop</th>
                                            <th>Status</th>
                                            <th>Valid Till</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($rows as $key => $row)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td><a href="mailto:{{ $row->email }}">{{ $row->email }}</a></td>
                                                <td>{{ $row->subdomain }}</td>
                                                <td>
                                                    @if($row->status)
                                                        <span class="text-success">Active</span>
                                                    @else
                                                        <span class="text-danger">Suspended</span>
                                                    @endif
                                                </td>
                                                <td>{{ $row->valid_till }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-xs btn-secondary dropdown-toggle btn-sm btn-gradient"
                                                            type="button" data-toggle="dropdown" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="{{ route('admin.tenant.users', $row->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fa fa-users"></i> Users
                                                            </a>
                                                            <form
                                                                action="{{ route('admin.tenant.suspensionToggle', $row->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to toggle this tenant\'s status?')">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">
                                                                    @if($row->status)
                                                                        <i class="fa fa-ban text-warning"></i> Suspend
                                                                    @else
                                                                        <i class="fa fa-check text-success"></i> Activate
                                                                    @endif
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('admin.tenant.destroy', $row->id) }}"
                                                                method="POST" onsubmit="return confirm('Are you sure?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="fa fa-trash"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="6">No tenants found.</td>
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