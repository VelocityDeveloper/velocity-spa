jQuery(function($) {
    if($('.entry-content table').length > 0){
        $('.entry-content table').each(function(i, obj) {
            $(this).addClass('table');
            $(this).after( "<div class='table-responsive table"+i+"'></div>" );
            $(this).appendTo(".table"+i+"");
            $(this).find('thead').addClass('table-dark');
        });
    }

    if (typeof Splide !== 'undefined' && document.querySelector('.splide')) {
    var splide = new Splide( '.splide', {
        type   : 'loop',
        perPage: 3,
        perMove: 1,
        gap    : '20px',
        autoplay  : true,
        interval  : 3000,
        arrows    : true,
        pagination: true,
        breakpoints: {
            768: {
                perPage: 2,
            },
            480: {
                perPage: 1,
            },
        }
    } );
    splide.mount();
    }
});
