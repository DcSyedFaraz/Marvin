$('.slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: '<i class="fa-solid fa-chevron-left"></i>',
    nextArrow: '<i class="fa-solid fa-chevron-right"></i>',
    autoplay: true,
});

$('.highschool-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: '<i class="fa-solid fa-chevron-left"></i>',
    nextArrow: '<i class="fa-solid fa-chevron-right"></i>',
    autoplay: true,
});

$('.student-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: '<i class="fa-solid fa-chevron-left"></i>',
    nextArrow: '<i class="fa-solid fa-chevron-right"></i>',
    autoplay: true,
});

$('.hot-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: '<i class="fa-solid fa-chevron-left"></i>',
    nextArrow: '<i class="fa-solid fa-chevron-right"></i>',
    autoplay: true,
});

$('.job-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: '<i class="fa-solid fa-chevron-left"></i>',
    nextArrow: '<i class="fa-solid fa-chevron-right"></i>',
    autoplay: true,
});

$('.free-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: '<i class="fa-solid fa-chevron-left"></i>',
    nextArrow: '<i class="fa-solid fa-chevron-right"></i>',
    autoplay: true,
});


$(document).ready(function () {
    $('.video-gallery').magnificPopup({
        delegate: 'a',
        type: 'iframe',
        gallery: {
            enabled: true
        }
    });
});