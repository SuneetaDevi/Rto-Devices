@extends('tenant.layouts.master')
@section('referral_active', 'active')
@section('title', $title)


@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.1/css/intlTelInput.min.css"
        integrity="sha512-0dRgZqXqB3x2VGxJDgHnR8S+Jc7nmOq4X0qX3s+v6Gg9u0nW3b7gKKdVKnJlm6D6r6zqA+EawId0k7s3KhrqXg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .referral-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .referral-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .referral-card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-top: 3px solid #007bff;
        }

        .referral-form .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .referral-form .form-control {
            border: none;
            border-bottom: 1px solid #ced4da;
            border-radius: 0;
            padding-left: 0;
            padding-top: 1.5rem;
            padding-bottom: 0.5rem;
            box-shadow: none;
            background-color: transparent;
        }

        .referral-form .form-control:focus {
            border-bottom: 2px solid #007bff;
            outline: none;
        }

        .referral-form label {
            position: absolute;
            top: 0.5rem;
            left: 0;
            color: #6c757d;
            font-size: 0.8rem;
            pointer-events: none;
            transition: all 0.2s ease;
            text-transform: uppercase;
            font-weight: 500;
        }

        .referral-form .form-control:focus+label,
        .referral-form .form-control:not(:placeholder-shown)+label {
            top: -0.5rem;
            font-size: 0.7rem;
            color: #007bff;
        }

        .required-label::after {
            content: '*';
            color: #e74c3c;
            margin-left: 2px;
        }

        .message-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-control.error {
            border-bottom: 2px solid #e74c3c;
        }

        .form-control.valid {
            border-bottom: 2px solid #28a745;
        }

        .iti {
            width: 100%;
        }

        .iti__flag-container {
            top: 0.5rem !important;
        }

        .btn-submit {
            min-width: 120px;
            padding: 0.75rem 2rem;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid py-4">
                <div class="referral-container">
                    {{-- Header --}}
                    <div class="referral-header">
                        <h1 class="h2 font-weight-light text-primary mb-3">Referral Program</h1>
                        <h2 class="h5 text-danger font-weight-bold mb-3">REFER A MERCHANT AND EARN $100!</h2>
                        <p class="text-muted mb-0">
                            Under the RTO Devices Referral Program, you earn $100 when that merchant you refer becomes
                            active on the
                            RTO Devices platform. Certain rules apply, so please talk with your RTO Devices representative,
                            and ask
                            about Referral Program details.
                        </p>
                    </div>

                    {{-- Form --}}
                    <div class="card referral-card">
                        <div class="card-body">
                            <form class="referral-form" id="referralForm">
                                <div class="row">
                                    {{-- Company Name --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="companyName" placeholder=" "
                                                required>
                                            <label for="companyName" class="required-label">COMPANY NAME</label>
                                        </div>
                                    </div>

                                    {{-- First & Last Name --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="firstName" placeholder=" "
                                                required>
                                            <label for="firstName" class="required-label">FIRST NAME</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="lastName" placeholder=" "
                                                required>
                                            <label for="lastName" class="required-label">LAST NAME</label>
                                        </div>
                                    </div>

                                    {{-- Email & Phone --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" placeholder=" "
                                                required>
                                            <label for="email" class="required-label">EMAIL</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="tel" class="form-control" id="phoneNumber" placeholder=" "
                                                required>
                                            <label for="phoneNumber" class="required-label">PHONE NUMBER</label>
                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="address1" placeholder=" "
                                                required>
                                            <label for="address1" class="required-label">ADDRESS 1</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="address2" placeholder=" ">
                                            <label for="address2">ADDRESS 2</label>
                                        </div>
                                    </div>

                                    {{-- Zip & City --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="zip" placeholder=" "
                                                required>
                                            <label for="zip" class="required-label">ZIP</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="city" placeholder=" "
                                                required>
                                            <label for="city" class="required-label">CITY</label>
                                        </div>
                                    </div>

                                    {{-- State & Number of Stores --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="state" placeholder=" "
                                                required>
                                            <label for="state" class="required-label">STATE</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="numStores" placeholder=" "
                                                required min="1">
                                            <label for="numStores" class="required-label">NUMBER OF STORES</label>
                                        </div>
                                    </div>

                                    {{-- Message --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea class="form-control message-textarea" id="message" rows="3" placeholder=" " required></textarea>
                                            <label for="message" class="required-label">MESSAGE</label>
                                        </div>
                                    </div>

                                    {{-- Submit Button --}}
                                    <div class="col-12">
                                        <div class="text-right pt-3">
                                            <button type="submit" class="btn btn-primary btn-submit" id="submitBtn"
                                                disabled>
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.1/js/intlTelInput.min.js"
        integrity="sha512-LKq6Rvj6g+WvJ5vXy2SzrYFvLnkKPXp6p6B4PzRyB+0ULWnGCD0H3L8p6V1Jru1BlYkRE6x2pW06gSFLsV+7ug=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize international telephone input
            const phoneInputField = document.querySelector("#phoneNumber");
            const iti = window.intlTelInput(phoneInputField, {
                initialCountry: "us",
                separateDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.1/js/utils.js"
            });

            const form = document.getElementById('referralForm');
            const submitBtn = document.getElementById('submitBtn');
            const requiredFields = form.querySelectorAll('input[required], textarea[required]');

            // Function to check if all required fields are filled and valid
            function checkFormValidity() {
                let allValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        allValid = false;
                        return;
                    }

                    // Field-specific validations
                    if (field.type === 'email' && !isValidEmail(field.value)) {
                        allValid = false;
                    }

                    if (field.id === 'numStores' && parseInt(field.value) < 1) {
                        allValid = false;
                    }
                });

                // Phone validation
                if (!iti.isValidNumber()) {
                    allValid = false;
                }

                submitBtn.disabled = !allValid;
            }

            // Email validation
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // Field validation with visual feedback
            function validateField(field) {
                const value = field.value.trim();

                if (field.hasAttribute('required') && !value) {
                    field.classList.add('error');
                    field.classList.remove('valid');
                    return false;
                }

                // Specific field validations
                if (field.type === 'email' && value && !isValidEmail(value)) {
                    field.classList.add('error');
                    field.classList.remove('valid');
                    return false;
                }

                if (field.id === 'numStores' && value && parseInt(value) < 1) {
                    field.classList.add('error');
                    field.classList.remove('valid');
                    return false;
                }

                field.classList.remove('error');
                field.classList.add('valid');
                return true;
            }

            // Add event listeners to all fields
            form.querySelectorAll('input, textarea').forEach(field => {
                field.addEventListener('input', function() {
                    validateField(this);
                    checkFormValidity();
                });

                field.addEventListener('blur', function() {
                    validateField(this);
                });
            });

            // Special handling for phone input
            phoneInputField.addEventListener('input', function() {
                checkFormValidity();
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Final validation
                let allValid = true;
                requiredFields.forEach(field => {
                    if (!validateField(field)) {
                        allValid = false;
                    }
                });

                if (!iti.isValidNumber()) {
                    allValid = false;
                    phoneInputField.classList.add('error');
                }

                if (!allValid) {
                    alert('Please fill in all required fields correctly.');
                    return;
                }

                // Show loading state
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Submitting...';
                submitBtn.disabled = true;

                // Prepare form data
                const formData = {
                    companyName: document.getElementById('companyName').value,
                    firstName: document.getElementById('firstName').value,
                    lastName: document.getElementById('lastName').value,
                    email: document.getElementById('email').value,
                    phoneNumber: iti.getNumber(),
                    address1: document.getElementById('address1').value,
                    address2: document.getElementById('address2').value,
                    zip: document.getElementById('zip').value,
                    city: document.getElementById('city').value,
                    state: document.getElementById('state').value,
                    numStores: document.getElementById('numStores').value,
                    message: document.getElementById('message').value
                };

                // Simulate API call
                setTimeout(() => {
                    console.log('Form submitted:', formData);

                    // Show success message
                    alert('Thank you! Your referral has been submitted successfully.');

                    // Reset form
                    form.reset();
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = originalText;

                    // Reset validation classes
                    form.querySelectorAll('.form-control').forEach(field => {
                        field.classList.remove('valid', 'error');
                    });

                    // Reset phone input
                    iti.setNumber('');

                }, 1500);
            });

            // Initial form check
            checkFormValidity();
        });
    </script>
@endpush
