;
(function($) {
    $.extend({
        alertDisplay: function(target, message, status) {
            // Clear the first the alert that was previously appended
            $('.alert').remove();
            // Default options for success
            var defaults = {
                status: 'success',
                icon: 'ok',
                text: 'Success'
            };

            // Default options for error
            var options;
            if(status === 'error') {
                options = {
                    status: 'danger',
                    icon: 'remove',
                    text: 'Error'
                };
            }

            var o = $.extend(defaults, options);

            var msg = '<div class="alert alert-' + o.status + ' alert-dismissable" role="alert">' +
                    '<span class="glyphicon glyphicon-' + o.icon + '" aria-hidden="true" style="padding-right: 5px;"></span>' +
                    '<span class="sr-only">' + o.text + ':</span>' +
                    '<strong>' +
                    message +
                    '</strong>' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>';

            var msg_hidden = $(msg).hide();
            $(target).prepend(msg_hidden);
            msg_hidden.fadeIn('slow');
        }
    });
})(jQuery);