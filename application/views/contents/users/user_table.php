<table id="user-list" class="display">
    <thead>
        <tr>
            <th><input type="checkbox" class="checkbox" id="check-all"></th>
            <th>Username</th>
            <th>User Type</th>
            <th>Created On</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <!--Data for <td> will be populated here-->
    </tbody>
</table>

<script>
    $(function() {

        var table_options = {
            orderNum: 3,
            columnDefs: [
                {"bSortable": false, "aTargets": [0, -1]},
                {
                    "targets": -1,
                    "data": null,
                    "defaultContent":
                            "<div class=\"btn-group\" role=\"group\" aria-label=\"...\">" +
                            "<button class=\"btn btn-primary delete-row\">" +
                            "<span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span>" +
                            "Delete" +
                            "</button>" +
                            "</div>"
                }
            ]
        };

        var table_data = $.tableDisplay('#user-list', <?php echo (isset($json_data) && !empty($json_data) ? $json_data : 'null'); ?>, table_options);

        $('#user-list tbody').on('click', 'button', function() {
            var me = $(this);
            var data = table_data.row(me.parents('tr')).data();
            if(data[0].indexOf('checkbox') > 0)
            {
                // Removes the checkbox element in the 0 index array
                data.shift();
            }

            var arr_data = [];
            for(var i = 0; i <= data.length; i++)
            {
                arr_data[i] = data[i];
            }

            if(me.hasClass('delete-row'))
            {
                var action = 'edit';
                if(me.hasClass('delete-row'))
                {
                    action = 'delete-row';
                }

                $.get('<?php echo base_url(); ?>user/prompt_user/' + action, {arr_data: arr_data}, function(response) {

                    if(action === 'delete-row')
                    {
                        $.modalDisplay({
                            titleIcon: 'trash',
                            title: 'Delete User',
                            content: response,
                            btnSave: false,
                            btnCustom: true,
                            btnCustomIcon: 'trash',
                            btnCustomText: 'Delete',
                            btnCustomClass: 'delete-row'
                        });
                    }
                });
            }
        });

        $('#check-all').on('click', function() {
            var me = $(this);
            // Check if the currrent state of the checkbox
            if(me.is(':checked'))
            {
                $('#user-list tbody .checkbox').prop('checked', 'checked');
            }
            else
            {
                $('#user-list tbody .checkbox').removeProp('checked');
            }
        });
    });
</script>
