;
(function($) {
    $.extend({
        tableDisplay: function(target, data, options) {

            // Default options for unstyled table
            var defaults = {
                orderNum: 0
            };

            // Extend the option that was declare in the view
            var o = $.extend(defaults, options);

            var tableData = $(target).DataTable({
                "scrollX": true,
                "order": [[o.orderNum, "asc"]],
                "columnDefs": o.columnDefs,
                "pagingType": "simple_numbers",
                "info": true,
                "lengthMenu": [[10, 50, 100, 500, -1], [10, 50, 100, 500, 'All']],
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "Nothing found - sorry",
                    "info": "Showing page _PAGE_ to _PAGES_ of _MAX_ entries",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                },
                "data": data
            });

            // This will return the data from the table
            return tableData;
        }
    });
})(jQuery);