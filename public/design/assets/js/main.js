$(document).ready(function() {

    var $headerSection = $('.header'),
    $internalheaderSection = $('.header-internal'),
    $navbar = $('.navbar');

    $(window).scroll(function() {
        if( $(window).scrollTop() >= $headerSection.height() ) {
            $navbar.addClass('sticky');
        } else { 
            $navbar.removeClass('sticky');
        }
    });

    // bx slider trigger

    $('.slider').bxSlider({
        mode: 'vertical',
        swipeThreshold: 0,
        auto: 'true',
        pause: 5000,
        autoHover: 'true'
    });

    // Fire MixItUp Shuffle

    var $container = $('#Container'),
        $filterSelect = $('#FilterSelect');

    $container.mixItUp();

    $(".shuffle li").click(function() {

        $(this).addClass("selected").parent().siblings().children().removeClass("selected");

    });

    // dropdown select option

    $filterSelect.on('change', function(){

        $container.mixItUp('filter', this.value);

    });

    // Show more products btn

    $(".show-more").click(function() {

        $("#Container .hidden").fadeIn(1000);

    });

    // Loading Screen
    
    $(window).on('load', function () {

        $(".loading-overlay .spinner").fadeOut(1000, function () {

            $(this).parent().slideUp(400, function () {

                $(this).remove();

            });

        });

    });


        $("#exzoom").exzoom({
            "autoPlay": false,
        });

        // owl slider trigger
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })


});


