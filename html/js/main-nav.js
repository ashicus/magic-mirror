(function($) {
    $('.burger-nav, .main-nav .close-menu').on('click', function() {
        $('.main-nav').toggleClass('open');
    });

    $('.sub-nav>ul>li>a').on('click', function() {
        $(this).next('ul').slideToggle();
    });

    var $body = $('body');
    $(document).on('scroll', function() {
        var scrollTop = $body.scrollTop() || document.documentElement.scrollTop;

        if(scrollTop > 0) {
            $body.addClass('scrolled');
        } else {
            $body.removeClass('scrolled');
        }
    })
})(jQuery);
