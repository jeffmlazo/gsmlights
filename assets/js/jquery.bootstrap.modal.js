;
(function($) {
    $.extend({
        modalDisplay: function(options) {
            var defaults = {
                title: 'No title',
                content: 'No content',
                modalSize: '', // Default medium
                btnClose: true,
                btnSave: true,
                btnCustom: false
            };

            // Extend options to overide the default values
            var o = $.extend(defaults, options);

            // Default modal design
            var modal_content = '<div class="modal fade" tabindex="-1" role="dialog">' +
                    '<div class="modal-dialog ' + o.modalSize + '">' +
                    '<div class="modal-content">' +
                    '<div class="modal-header">' +
                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<h4 class="modal-title">' +
                    '<span class="glyphicon glyphicon-' + o.titleIcon + '" aria-hidden="true" style="padding-right: 2px;"></span>' +
                    o.title +
                    '</h4>' +
                    '</div>' +
                    '<div class="modal-body">' +
                    o.content +
                    '</div>' +
                    '<div class="modal-footer">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

            $('#modal-container').empty().html(modal_content);
            // If true add the close button in the modal
            if(o.btnClose)
            {
                $('.modal-footer').prepend(
                        '<button type="button" class="btn btn-danger btn-close" data-dismiss="modal">' +
                        '<span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="padding-right: 2px;"></span>' +
                        'Close' +
                        '</button>'
                        );
            }

            // If true add the save button in the modal
            if(o.btnSave)
            {
                $('.modal-footer').append(
                        '<button type="button" class="btn btn-primary btn-save">' +
                        '<span class="glyphicon glyphicon-save" aria-hidden="true" style="padding-right: 2px;"></span>' +
                        'Save' +
                        '</button>'
                        );
            }

            // If true add the custom button in the modal
            if(o.btnCustom)
            {
                $('.modal-footer').append(
                        '<button type="button" class="btn btn-primary ' + o.btnCustomClass + '">' +
                        '<span class="glyphicon glyphicon-' + o.btnCustomIcon + '" aria-hidden="true" style="padding-right: 2px;"></span>' +
                        o.btnCustomText +
                        '</button>'
                        );
            }

            $('.modal').modal('show');
        }
    });
})(jQuery);