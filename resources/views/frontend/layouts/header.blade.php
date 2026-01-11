<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">RTO <span class="d-block"> DEVICES </span></a>

        <!-- Only show mobile screend -->
        <div class="d-flex d-lg-none gap-2 me-2 ms-auto">
            <a class="btn btn-outline-primary primary-squre-btn" href="./contact.html">
                <i class="fa-solid fa-headset"></i>
            </a>
            <a class="btn btn-outline-primary primary-squre-btn" href="./login.html">
                <i class="fa-solid fa-user"></i>
            </a>
        </div>

        <button class="navbar-toggler p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.how_it_works') }}">How It Works</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Partners
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('frontend.partners') }}">Partners</a></li>
                            <li><a class="dropdown-item" href="{{ route('frontend.become_partner') }}">Become A Partner</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#benefits">Benefits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.blogs') }}">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.testimonials') }}">Testimonials</a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0 d-none d-lg-inline">
                        <a class="btn btn-outline-primary primary-squre-btn" href="{{ route('frontend.contact') }}">
                            <i class="fa-solid fa-headset"></i>
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0 d-none d-lg-inline">
                        <a class="btn btn-outline-primary primary-squre-btn" href="{{ route('login') }}">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-primary" href="{{ route('frontend.demo') }}">Book a Demo</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
