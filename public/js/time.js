(function($) {
    var refresh_interval = 2000;
    var refresh_timer = setInterval(function() {
        $('.time').html(moment().format('h') + '<span>:</span>' + moment().format('mm a'));
    }, refresh_interval);
})(jQuery);
