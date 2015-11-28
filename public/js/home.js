(function($) {
    var refresh_interval = 5 * 60000;
    var refresh_timer = setInterval(function() {
        location.reload();
    }, refresh_interval);
})(jQuery);
