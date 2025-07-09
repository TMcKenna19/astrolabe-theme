document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 3500,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        speed: 1000
    });
});
