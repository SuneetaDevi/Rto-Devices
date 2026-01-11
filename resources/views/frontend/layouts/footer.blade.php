<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <h5>RTO Devices</h5>
                <p>Empowering mobile retailers with simple, secure in-house payment solutions to boost sales and
                    customer loyalty.</p>
                <div class="social-icons mt-4">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <h5>Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('frontend.how_it_works') }}">How It Works</a></li>
                    <li><a href="{{ route('frontend.testimonials') }}">Success Stories</a></li>
                    <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                    <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                    <li><a href="{{ route('frontend.calculator') }}">Calculator</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <h5>Contact Info</h5>
                <ul class="footer-links">
                    <li><i class="fas fa-map-marker-alt me-2"></i> 123 Business Ave, Suite 101</li>
                    <li><i class="fas fa-phone me-2"></i> (555) 123-4567</li>
                    <li><i class="fas fa-envelope me-2"></i> info@rtodevices.com</li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <h5>Newsletter</h5>
                <p>Stay updated on retail growth tips and in-house payment insights.</p>
                <form class="input-group newsletter-form" method="post"
                    action="{{ route('frontend.newsletter.submit') }}">
                    @csrf
                    <div class="input-group">
                        <input class="form-control" name="email" type="email" placeholder="Your Email">
                        <button type="submit">Subscribe</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="footer-bottom footer-links">
            <div class="d-flex justify-content-center justify-content-md-between align-items-center gap-2 flex-wrap">
                <div class="d-flex gap-2 align-items-center">
                    <a class="text-decoration-none fs-6" href="{{ route('frontend.privacy-policy') }}"> Privacy Policy
                    </a>
                    <span class="text-white px-1">|</span>
                    <a class="text-decoration-none fs-6" href="{{ route('frontend.terms-condition') }}"> Terms &
                        Conditions </a>
                </div>
                <p class="fs-6 mb-0">&copy; 2025 RTO Devices. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>