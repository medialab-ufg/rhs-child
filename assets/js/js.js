jQuery( document ).ready(function( $ ) {
    $( '.single-item-collection--attachments' ).slick({
        prevArrow: '<button type="button" data-role="none" class="single-item-collection--attachments-prev" aria-label="Previous" role="button" style="display: block;"><i class="mdi mdi-menu-left"></i></button>',
        nextArrow: '<button type="button" data-role="none" class="single-item-collection--attachments-next" aria-label="Next" role="button" style="display: block;"><i class="mdi mdi-menu-right"></i></button>',
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [ {
            breakpoint: 1024,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
        ]
    });
});