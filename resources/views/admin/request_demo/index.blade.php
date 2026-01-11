@extends('admin.layouts.master')

@section('request_demo', 'active')
@section('title') {{ $title ?? 'Request Demo' }} @endsection

@section('content')

                 @php 
                    $statusLabels = [
        1 => ['text' => 'Active', 'class' => 'badge bg-success'],
        0 => ['text' => 'Pending', 'class' => 'badge bg-warning'],
        2 => ['text' => 'Declined', 'class' => 'badge bg-danger'],
    ];
                @endphp
                <div class="content-wrapper">
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0">Request Demo List</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Request Demo</li>
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
                                            <h3 class="card-title">Manage Request Demos</h3>
                                        </div>

                                        <div class="card-body table-responsive p-0">
                                            <table id="dataTables" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Company Name</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Status</th>
                                                        <th>Phone</th>
                                                        <th>Number of Stores</th>
                                                        <th>Address</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($requests as $key => $request)


                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $request->company_name }}</td>
                                                            <td>{{ $request->first_name }} {{ $request->last_name }}</td>
                                                            <td><a href="mailto:{{ $request->email }}">{{ $request->email }}</a></td>
                                                            @php $status = $statusLabels[$request->status] ?? ['text' => 'Unknown', 'class' => 'badge bg-secondary']; @endphp
                                                            <td > <span class="{{ $status['class'] }}">{{ $status['text'] }}</span></td>
                                                            <td>{{ $request->phone }}</td>
                                                            <td>{{ $request->number_of_stores }}</td>
                                                            <td>{{ $request->address }} @if($request->suite), {{ $request->suite }} @endif,
                                                                {{ $request->city }}, {{ $request->state }}, {{ $request->zip_code }}
                                                            </td>
                                                            <td>{{ $request->created_at->format('d M Y') }}</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button
                                                                        class="btn btn-xs btn-secondary dropdown-toggle btn-sm btn-gradient"
                                                                        type="button" data-toggle="dropdown">
                                                                        Actions
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <!-- <a href="javascript:void(0)" class="dropdown-item view"
                                                                            data-id="{{ $request->id }}">
                                                                            <i class="fa fa-eye"></i> View
                                                                        </a> -->
                                                                        @if ($request->status != 1)
                                                                                                                                                  <a href="javascript:void(0)" class="dropdown-item approve"
                                                                             data-id="{{ $request->id }}">
                                                                                                                                                    <i class="fa fa-check"></i> Approve
                                                                                                                                                </a>
                                                                        @endif

                                                                        <a href="{{ route('admin.request-demo.delete', $request->id) }}"
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
    <!-- Optional JS scripts for table search, delete confirmation etc. -->
    <script>
        $(document).on('click', '.approve', function (e) {
            e.preventDefault();

            let id = $(this).data('id');

            Swal.fire({
                title: 'Approve Request?',
                text: "Are you sure you want to approve this user request?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.request-demo.approve') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        },
                        success: function (response) {
                            Swal.fire({
                                title: 'Approved!',
                                text: response.message || 'User request has been approved.',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            // Optionally reload the page or update the UI dynamically
                            setTimeout(() => location.reload(), 1500);
                        },
                        error: function (xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: xhr.responseJSON?.message || 'Something went wrong.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    </script>

@endpush