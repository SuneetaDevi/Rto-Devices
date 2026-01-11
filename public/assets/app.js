$(".testimonial-slider").owlCarousel({
  loop: true,
  margin: 30,
  nav: true,
  dots: true,
  navText: ["<span>&#10094;</span>", "<span>&#10095;</span>"],
  responsive: {
    0: { items: 1 },
    768: { items: 1 },
  },
});

$('.growth-slider').owlCarousel({
  loop: true,
  margin: 20,
  nav: true,
  dots: true,
  autoplay: true,
  autoplayTimeout: 3500,
  autoplayHoverPause: true,
  navText: [
    "<span>&#10094;</span>", 
    "<span>&#10095;</span>"
  ],
  responsive: {
    0: { items: 1 },
    576: { items: 2 },
    992: { items: 3 },
    1200: { items: 4 }
  }
});

// Navbar scroll effect
$(window).scroll(function() {
    if ($(window).scrollTop() > 50) {
        $('.navbar').addClass('scrolled');
    } else {
        $('.navbar').removeClass('scrolled');
    }
});

// Fade-in animation on scroll
// $(document).ready(function() {
//     // Check if element is in viewport
//     function isElementInViewport(el) {
//         var rect = el.getBoundingClientRect();
//         return (
//             rect.top >= 0 &&
//             rect.left >= 0 &&
//             rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
//             rect.right <= (window.innerWidth || document.documentElement.clientWidth)
//         );
//     }
    
//     // Handle scroll event
//     function handleScroll() {
//         $('.fade-in').each(function() {
//             if (isElementInViewport(this)) {
//                 $(this).addClass('visible');
//             }
//         });
//     }
    
//     // Initial check
//     handleScroll();
    
//     // Check on scroll
//     $(window).on('scroll', handleScroll);
// });