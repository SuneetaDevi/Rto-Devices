@extends('tenant.layouts.master')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Verify Devices (Batch: {{ $batch }})</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Device</th>
                <th>IMEI</th>
                <th>Serial</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($devices as $device)
            <tr>
                <td>{{ $device->model }}</td>
                <td>{{ $device->imei }}</td>
                <td>{{ $device->serial ?? '--' }}</td>
                <td>
                    <span class="badge badge-warning">Pending</span>
                </td>
                <td>
                    <form method="POST"
                        action="{{ route('tenant.device.verify', $device->id) }}">
                        @csrf
                        <button class="btn btn-success btn-sm">
                            Verify
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
