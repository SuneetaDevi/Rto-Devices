@extends('admin.layouts.master')

@section('title')
    {{ $data['title'] ?? 'Subscriber Emails' }}
@endsection
@section('newsletter-active', 'active')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $data['title'] ?? 'Subscriber Emails' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Subscriber Emails</li>
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
                                <h3 class="card-title">{{ __('Subscriber Email List') }}</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table id="dataTables" class="table table-hover table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="50%">Email</th>
                                            <th width="40%">Subscribed At</th>
                                            <th width="5%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($emails as $email)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $email->email }}</td>
                                                <td>{{ $email->created_at->format('d M, Y H:i') }}</td>
                                                <td>
                                                    <form action="{{ route('admin.newsletter.delete', $email->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this email?')"
                                                            data-toggle="tooltip" title="Delete Email">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No newsletter emails found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Email</th>
                                            <th>Subscribed At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div> <!-- /card-body -->
                        </div> <!-- /card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection