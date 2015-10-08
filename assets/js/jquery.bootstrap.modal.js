;
(function($) {
    $.extend({
        modalDisplay: function(options) {
            var defaults = {
                title: 'No title',
                content: 'No content',
                modalSize: '', // Default is medium
                btnClose: true,
                btnSave: true,
                btnCustom: false
            };

            // Extend options to overide the default values
            var o = $.extend(defaults, options);

            // Default modal design
            var modal_content = '<div class="modal fade" tabindex="-1" role="dialog">' +
                    '<div class="modal-dialog "' + o.modalSize + '>' +
                    '<div class="modal-content">' +
                    '<div class="modal-header">' +
                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<h4 class="modal-title">' + o.title + '</h4>' +
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

            if(o.btnClose)
            {
                $('.modal-footer').prepend('<button type="button" class="btn btn-danger btn-close" data-dismiss="modal">Close</button>');
            }

            if(o.btnSave)
            {
                $('.modal-footer').append('<button type="button" class="btn btn-primary btn-save">Save</button>');
            }

            if(o.btnCustom)
            {
                $('.modal-footer').append('<button type="button" class="btn btn-primary ' + o.btnCustomClass + '">' + o.btnCustomText + '</button>');
            }

            $('.modal').modal('show');
        }
    });
})(jQuery);