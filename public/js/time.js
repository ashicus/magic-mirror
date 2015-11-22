(function($) {
    var refresh_interval = 1000;
    var refresh_timer = setInterval(function() {
        $('.time').html(moment().format('h:mm a'));
    }, refresh_interval);
})(jQuery);
