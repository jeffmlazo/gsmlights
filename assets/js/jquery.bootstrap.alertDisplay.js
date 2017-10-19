;
(function ($) {
    $.extend({
        alertDisplay: function (target, message, status) {
            // Clear the first the alert that was previously appended
            $('.alert').remove();
            // Default options for success
            var defaults = {
                status: 'success',
                icon: 'thumbs-up',
                text: 'Success'
            };

            // Default options for error
            var options;
            if (status === 'error') {
                options = {
                    status: 'danger',
                    icon: 'alert',
                    text: 'Error'
                };
            }

            // Extended options for the other different alerts
            var o = $.extend(defaults, options);

            // Alert box for single error message
            var msg = '<div class="alert alert-' + o.status + ' alert-dismissable" role="alert">' +
                    '<span class="glyphicon glyphicon-' + o.icon + '" aria-hidden="true" style="padding-right: 5px;"></span>' +
                    '<span class="sr-only">' + o.text + ':</span>' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '<strong>' +
                    message +
                    '</strong>' +
                    '</div>';

            // Check if there are multiple or an error that was store as array
            if (Array.isArray(message))
            {
                /**
                 *  Loop all messages in a new variable and concatinate it to
                 *  a single variable.
                 *  "for in loop" is similar with "for each loop" in php 
                 *  ex. foreach(message as msg_val){ message[msg_val]}
                 */
                var msg = '';
                for (var msg_val in message)
                {
                    // Alert box for multiple messages
                    msg += '<div class="alert alert-' + o.status + ' alert-dismissable" role="alert">' +
                            '<span class="glyphicon glyphicon-' + o.icon + '" aria-hidden="true" style="padding-right: 5px;"></span>' +
                            '<span class="sr-only">' + o.text + ':</span>' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '<strong>' +
                            message[msg_val] +
                            '</strong>' +
                            '</div>';
                }
            }

            var msg_hidden = $(msg).hide();
            $(target).prepend(msg_hidden);
            msg_hidden.show();
        }
    });
})(jQuery);