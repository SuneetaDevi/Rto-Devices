@extends('frontend.layouts.app')

@section('title')
    {{ $data['title'] ?? __('auth.sign_in') }}
@endsection

@php
    $setting = getSetting();
@endphp

@section('meta')
    <meta property="og:title" content="Sign In | RTO Devices" />
    <meta property="og:description" content="{{$setting->seo_meta_description}}" />
    <meta property="og:image" content="{{ asset($setting->site_logo) }}" />
    <meta name="description" content="{{$setting->seo_meta_description}}">
    <meta name="keywords" content="{{$setting->seo_keywords}}">
@endsection

@push('style')
@endpush

@section('content')
    <section class="login-section">
        <div class="container">
            <div class="login-container">
                <div class="login-header">
                    <h1>Welcome Back</h1>
                    <p>Sign in to your RTO Devices account</p>
                </div>

                <div class="login-body">
                    <form id="loginForm" method="post"
                        action="{{ route('tenant.login', ['tenant_domain' => $tenant_domain]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email address" required>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div class="password-input">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter your password" required>
                                <button type="button" class="password-toggle" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="login-options">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    Remember me
                                </label>
                            </div>
                            <a class="forgot-password" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                                Forgot Password?
                            </a>
                        </div>

                        <button type="submit" class="btn btn-primary login-btn">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Forgot Password Modal -->
    <div class="modal fade forgot-pass-modal" id="forgotPasswordModal" tabindex="-1"
        aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Your Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="resetForm">
                        <p class="reset-instructions">Enter your email address and we'll send you a link to reset your
                            password.</p>
                        <div class="form-group">
                            <label for="resetEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="resetEmail" placeholder="Enter your email address"
                                required>
                        </div>
                    </div>
                    <div id="successMessage" class="success-message">
                        <i class="fas fa-check-circle"></i>
                        <h4>Password Reset Link Sent!</h4>
                        <p>We've sent a password reset link to your email address. Please check your inbox and follow the
                            instructions.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="sendResetLink">Send Reset Link</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        // Password toggle functionality
        $(document).ready(function () {
            $('#togglePassword').on('click', function () {
                const passwordInput = $('#password');
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);

                // Toggle eye icon
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
            });



            // Real-time validation
            $('#email, #password').on('input', function () {
                if ($(this).val().trim() === '') {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Social login buttons
            $('.social-btn.google').on('click', function () {
                alert('Google login would be implemented here');
            });

            $('.social-btn.facebook').on('click', function () {
                alert('Facebook login would be implemented here');
            });

            // Forgot Password Modal functionality
            $('#sendResetLink').on('click', function () {
                const resetEmail = $('#resetEmail').val();

                if (!resetEmail || resetEmail.trim() === '') {
                    $('#resetEmail').addClass('is-invalid');
                    return;
                }

                // Email validation regex
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(resetEmail)) {
                    $('#resetEmail').addClass('is-invalid');
                    return;
                }

                $('#resetEmail').removeClass('is-invalid');

                // Simulate sending reset link
                $('#resetForm').hide();
                $('#successMessage').show();

                // Reset the modal after 3 seconds and close it
                setTimeout(function () {
                    $('#forgotPasswordModal').modal('hide');
                    setTimeout(function () {
                        $('#resetForm').show();
                        $('#successMessage').hide();
                        $('#resetEmail').val('');
                    }, 500);
                }, 3000);
            });

            // Reset modal when closed
            $('#forgotPasswordModal').on('hidden.bs.modal', function () {
                $('#resetForm').show();
                $('#successMessage').hide();
                $('#resetEmail').val('').removeClass('is-invalid');
            });

            // Real-time validation for reset email
            $('#resetEmail').on('input', function () {
                if ($(this).val().trim() === '') {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush