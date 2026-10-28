// Front Page Hero Slide Option
document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        speed: 1200
    });
});

// About Img Swiper 
document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.about-swiper', {
        loop: true,
        spaceBetween: 0,
        slidesPerView: 'auto',
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        // Disable auto sliding
        autoplay: false,
        speed: 1000,
    });
});


