$(function() {

    if ( $('.owl-2').length > 0 ) {
        $('.owl-2').owlCarousel({
            center: false,
            items: 1,
            loop: true,
            stagePadding: 0,
            margin: 20,
            smartSpeed: 1000,
            autoplay: true,
            nav: true,
            dots: true,
            pauseOnHover: false,
            responsive:{
                600:{
                    margin: 20,
                    nav: true,
                    items: 2
                },
                1000:{
                    margin: 20,
                    stagePadding: 0,
                    nav: true,
                    items: 4
                }
            }
        });
    }

})
$(document).ready(function()
{


    if($('.bbb_slider').length)
    {
        var trendsSlider = $('.bbb_slider');
        trendsSlider.owlCarousel(
            {
                loop:false,
                margin:30,
                nav:false,
                dots:false,
                autoplayHoverPause:true,
                autoplay:false,
                responsive:
                    {
                        0:{items:1},
                        575:{items:2},
                        991:{items:3}
                    }
            });

        trendsSlider.on('click', '.bbb_fav', function (ev)
        {
            $(ev.target).toggleClass('active');
        });

        if($('.bbb_prev').length)
        {
            var prev = $('.bbb_prev');
            prev.on('click', function()
            {
                trendsSlider.trigger('prev.owl.carousel');
            });
        }

        if($('.bbb_next').length)
        {
            var next = $('.bbb_next');
            next.on('click', function()
            {
                trendsSlider.trigger('next.owl.carousel');
            });
        }
    }


});
