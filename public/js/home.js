(function($) {
    var refresh_interval_miuntes = 5;
    var refresh_interval = refresh_interval_miuntes * 60000;
    var refresh_timer = setInterval(function() {
        location.reload();
    }, refresh_interval);
})(jQuery);
