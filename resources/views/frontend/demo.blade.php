@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? 'RTO Devices' }}
@endsection

@section('meta')
    <meta property="og:title" content="{{$row->meta_title ?? $og_title}}" />
    <meta property="og:description" content="{{$row->meta_description ?? $og_description}}" />
    <meta property="og:image" content="{{asset($og_image)}}" />
    <meta name="description" content="{{$row->meta_description ?? $og_description}}">
    <meta name="keywords" content="{{$row->meta_keywords ?? $meta_keywords}}">
@endsection

@push('style')
@endpush

@section('content')
    <!-- Book Demo Hero Section -->
    <section class="book-demo-hero">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Grow Your Mobile Store Faster with Our Powerful Payment Platform</h1>
                    <p>Schedule a Free Demo Today</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <h3 class="mb-3">Trusted by 1,000+ Successful Mobile Retailers Nationwide</h3>
                        <p class="text-muted">Fill out the form below and our team will contact you to schedule a
                            personalized demo</p>
                    </div>

                    <div class="form-container">
                        <div class="form-header">
                            <h2>Request Your Free Demo</h2>
                            <p>See how RTO Devices can transform your mobile store</p>
                        </div>

                        <div class="form-body">
                            <form id="demoForm" method="post" action="{{ route('frontend.demo.submit') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="companyName" class="form-label">Company Name</label>
                                        <input type="text" class="form-control" id="companyName" name="companyName"
                                            placeholder="Enter your company's name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="numberOfStores" class="form-label">Number of Stores</label>
                                        <input type="number" class="form-control" id="numberOfStores" name="numberOfStores"
                                            placeholder="Enter number of stores" min="1" required>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName"
                                            placeholder="Enter your first name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName"
                                            placeholder="Enter your last name" required>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter your email address" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            placeholder="(555) 555-5555" required>
                                        <div class="invalid-feedback">Phone number cannot be blank.</div>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-12">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Enter your street address" required>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-md-4">
                                        <label for="suite" class="form-label">Suite</label>
                                        <input type="text" class="form-control" id="suite" name="suite"
                                            placeholder="Suite # (optional)">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="zipCode" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" id="zipCode" name="zipCode"
                                            placeholder="Zip Code" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city" placeholder="City"
                                            required>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-12">
                                        <label for="state" class="form-label">State</label>
                                        <select class="form-select select2-state" id="state" name="state" required>
                                            <option value="" disabled selected>Select State</option>
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3 mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100">Submit Request</button>
                                    </div>
                                </div>

                                <div class="row g-3 mt-2">
                                    <div class="col-12 text-center">
                                        <p class="small text-muted mb-0">
                                            <i class="fas fa-lock me-2"></i>
                                            Your information is secure and will never be shared with third parties.
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script>
        // Form validation
        // Initialize Select2 for State dropdown
        $(document).ready(function () {
            // Initialize Select2
            $('.select2-state').select2({
                placeholder: "Select State",
                allowClear: false,
                width: '100%',
                theme: 'default'
            });

            // Form validation
            $('#demoForm').on('submit', function (e) {
                let isValid = true;

                // Check phone number
                const phone = $('#phone').val();
                if (!phone || phone.trim() === '') {
                    $('#phone').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#phone').removeClass('is-invalid');
                }

                // Check Select2 state field
                const state = $('#state').val();
                if (!state) {
                    $('#state').parent().find('.select2-container').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#state').parent().find('.select2-container').removeClass('is-invalid');
                }

                // Check other required fields
                $('input[required]').each(function () {
                    if (!$(this).val() || $(this).val().trim() === '') {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                // Prevent submission only if form is invalid
                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush