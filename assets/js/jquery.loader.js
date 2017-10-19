;
(function($) {
    $.extend({
        ajaxLoader: function(target, url, options) {
            var defaults = {
                spinnerSize: '',
                method: 'GET',
                data: null
            };

            var o = $.extend(defaults, options);

            // Add a class for loader indicator
            $(target).empty().addClass("spinner-loader " + o.spinnerSize);

            $.ajax({
                url: url,
                method: o.method
            }).done(function(response) {
                setTimeout(function() {
                    $(target).removeClass("spinner-loader " + o.spinnerSize).html(response);
                });
            });
        }
    });
})(jQuery);