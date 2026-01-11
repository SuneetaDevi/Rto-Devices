@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? 'RTO Devices' }}
@endsection

@section('meta')
    <meta property="og:title" content="{{ $seo->title ?? $og_title }}" />
    <meta property="og:description" content="{{ $seo->description ?? $og_description }}" />
    <meta property="og:image" content="{{ asset($seo->image ?? $og_image) }}" />
    <meta name="description" content="{{$seo->meta_description ?? $og_description}}">
    <meta name="keywords" content="{{$seo->keywords ?? $meta_keywords}}">
@endsection

@push('style')
    <style>
        iframe {
            width: 100% !important;
            height: 350px !important;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Contact Us</h1>
                    <p>We'd love to hear from you! We are available 7 days a week 365 days a year!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Information -->
                <div class="col-lg-6">
                    <div class="contact-card">
                        <div class="row">
                            <div class="col-12 col-md-6 col-xl-12 col-xxl-6">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <h4 class="fs-5">Call Sales</h4>
                                    <p class="phone-number fs-6">(888) 707-0107 ext. 2</p>
                                    <a href="tel:(888) 707-0107" class="stretched-link"></a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-xl-12 col-xxl-6">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-headset"></i>
                                    </div>
                                    <h4 class="fs-5">Call Dealer Support</h4>
                                    <p class="phone-number fs-6">(210) 809-4800</p>
                                    <a href="tel:(210) 809-4800" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>

                        <h3 class="fs-5">Our Hours</h3>
                        <div class="table-responsive">
                            <table class="hours-table">
                                <thead>
                                    <tr>
                                        <th>Day</th>
                                        <th>Eastern</th>
                                        <th>Central</th>
                                        <th>Mountain</th>
                                        <th>Pacific</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Monday</td>
                                        <td>9:00 AM - 11:00 PM</td>
                                        <td>8:00 AM - 10:00 PM</td>
                                        <td>7:00 AM - 9:00 PM</td>
                                        <td>6:00 AM - 8:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>Tuesday</td>
                                        <td>9:00 AM - 11:00 PM</td>
                                        <td>8:00 AM - 10:00 PM</td>
                                        <td>7:00 AM - 9:00 PM</td>
                                        <td>6:00 AM - 8:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>Wednesday</td>
                                        <td>9:00 AM - 11:00 PM</td>
                                        <td>8:00 AM - 10:00 PM</td>
                                        <td>7:00 AM - 9:00 PM</td>
                                        <td>6:00 AM - 8:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>Thursday</td>
                                        <td>9:00 AM - 11:00 PM</td>
                                        <td>8:00 AM - 10:00 PM</td>
                                        <td>7:00 AM - 9:00 PM</td>
                                        <td>6:00 AM - 8:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>Friday</td>
                                        <td>9:00 AM - 11:00 PM</td>
                                        <td>8:00 AM - 10:00 PM</td>
                                        <td>7:00 AM - 9:00 PM</td>
                                        <td>6:00 AM - 8:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>Saturday</td>
                                        <td>10:00 AM - 9:00 PM</td>
                                        <td>9:00 AM - 8:00 PM</td>
                                        <td>8:00 AM - 7:00 PM</td>
                                        <td>7:00 AM - 6:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>Sunday</td>
                                        <td>10:00 AM - 9:00 PM</td>
                                        <td>9:00 AM - 8:00 PM</td>
                                        <td>8:00 AM - 7:00 PM</td>
                                        <td>7:00 AM - 6:00 PM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="contact-card">
                        <h3 class="mb-4">Reach Out</h3>
                        <p class="mb-4">Have a question about in-house payment plans or want to know more about our company?
                            Fill out the form and we will be in touch.</p>

                        <form id="contactForm" method="post" action="{{ route('frontend.contact.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="companyName" class="form-label">Company Name</label>
                                        <input type="text" class="form-control" id="companyName" name="companyName"
                                            placeholder="Enter your company's name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName"
                                            placeholder="Enter your first name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName"
                                            placeholder="Enter your last name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter your email address" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="(555) 555-5555"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message"
                                    placeholder="How can we help you?" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="social-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="mb-3">Follow us on social media</h3>
                    <div class="social-icons">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')

@endpush