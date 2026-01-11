@extends('admin.layouts.master')

@section('tenant-active', 'active')
@section('title') Tenant Users @endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tenant Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.tenant.index') }}">Tenants</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                                <h5 class="m-0">
                                    Users
                                    <span class="float-right">
                                        <a href="{{ route('admin.tenant.index') }}"
                                            class="btn btn-sm btn-primary  btn-gradient">
                                            <i class="fa fa-angle-left"></i> Back
                                        </a>
                                        <button type="button" class="btn btn-sm btn-success  btn-gradient ml-2"
                                            data-toggle="modal" data-target="#newUserModal">
                                            <i class="fa fa-plus"></i> New User
                                        </button>
                                    </span>
                                </h5>
                            </div>


                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">SN</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Admin</th>
                                            <th>Created At</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $key => $user)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                                <td>
                                                    @if($user->is_admin)
                                                        <span class="text-success">Yes</span>
                                                    @else
                                                        <span class="text-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-xs btn-secondary  btn-gradient dropdown-toggle btn-sm"
                                                            type="button" data-toggle="dropdown" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <!-- Change Password Trigger -->
                                                            <button type="button" class="dropdown-item change-password-btn"
                                                                data-user-id="{{ $user->id }}"
                                                                data-user-name="{{ $user->name }}">
                                                                <i class="fa fa-lock"></i> Change Password
                                                            </button>

                                                            <!-- Delete Form -->
                                                            <form action="{{ route('admin.tenant.user.destroy', $user->id) }}"
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
                                            <tr>
                                                <td colspan="6" class="text-center">No users found for this tenant.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div> <!-- /card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Single Change Password Modal (Bootstrap 4) -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="changePasswordForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="text" name="password" id="modalPassword" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- New User Modal -->
    <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.tenant.user.store', $tenantId) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="newUserModalLabel">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter user name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter user email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="newUserPassword" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button"
                                        toggle="#newUserPassword">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_admin">Admin</label>
                            <select name="is_admin" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary  btn-gradient">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('.change-password-btn').click(function () {
                let userId = $(this).data('user-id');
                let userName = $(this).data('user-name');

                // Update modal title
                $('#changePasswordModalLabel').text('Change Password - ' + userName);

                // Update form action dynamically
                $('#changePasswordForm').attr('action', '/admin/tenant/user/password/' + userId);

                // Show modal
                $('#changePasswordModal').modal('show');
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".toggle-password").click(function () {
                const input = $($(this).attr("toggle"));
                const icon = $(this).find("i");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    input.attr("type", "password");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
        });
    </script>
@endpush