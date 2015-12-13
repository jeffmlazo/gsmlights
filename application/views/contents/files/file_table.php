<table id="file-list" class="display">
    <thead>
        <tr>
            <th><input type="checkbox" class="checkbox" id="check-all"></th>
            <th>Phone Number</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Job Title</th>
            <th>Department</th>
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
            orderNum: 8,
            columnDefs: [
                {"bSortable": false, "aTargets": [0, -1]},
                {
                    "targets": -1,
                    "data": null,
                    "defaultContent":
                            "<div class=\"btn-group\" role=\"group\" aria-label=\"...\">" +
                            "<button class=\"btn btn-primary edit\">" +
                            "<span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>" +
                            "Edit" +
                            "</button>" +
                            "<button class=\"btn btn-primary delete-row\">" +
                            "<span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span>" +
                            "Delete" +
                            "</button>" +
                            "</div>"
                }
            ]
        };

        var table_data = $.tableDisplay('#file-list', <?php echo (isset($json_data) && !empty($json_data) ? $json_data : 'null'); ?>, table_options);

        $('#file-list tbody').on('click', 'button', function() {
            var me = $(this);
            var data = table_data.row(me.parents('tr')).data();
            console.log(data);

            if(data[0] !== null && data[0].indexOf('checkbox') > 0)
            {
                // Removes the checkbox element in the 0 index array
                data.shift();
            }

            var arr_data = [];
            for(var i = 0; i <= data.length; i++)
            {
                arr_data[i] = data[i];
            }

            if(me.hasClass('edit') || me.hasClass('delete-row'))
            {
                var action = 'edit';
                if(me.hasClass('delete-row'))
                {
                    action = 'delete-row';
                }

                $.get('<?php echo base_url(); ?>account/prompt_file/' + action, {arr_data: arr_data}, function(response) {

                    if(action === 'delete-row')
                    {
                        $.modalDisplay({
                            titleIcon: 'trash',
                            title: 'Delete File',
                            content: response,
                            btnSave: false,
                            btnCustom: true,
                            btnCustomIcon: 'trash',
                            btnCustomText: 'Delete',
                            btnCustomClass: 'delete-row'
                        });
                    }
                    else
                    {
                        $.modalDisplay({
                            titleIcon: 'edit',
                            title: 'Edit File',
                            content: response
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
                $('#file-list tbody .checkbox').prop('checked', 'checked');
            }
            else
            {
                $('#file-list tbody .checkbox').removeProp('checked');
            }
        });
    });
</script>
