<table id="file-list" class="display">
    <thead>
        <tr>
            <th></th>
            <th>Phone Number</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Job Title</th>
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
            orderNum: 2,
            columnDefs: [
                {"bSortable": false, "aTargets": [0, -1]},
                {"targets": -1, "data": null, "defaultContent": "<button class=\"btn btn-primary edit\">Edit</button>&nbsp;<button class=\"btn btn-primary delete-row\">Delete</button>"}
            ]
        };

        var table_data = $.tableDisplay('#file-list', <?php echo $json_data; ?>, table_options);

        $('#file-list tbody').on('click', 'button', function() {
            var me = $(this);
            var data = table_data.row($(this).parents('tr')).data();
            var arr_data = [];
            for(var i = 0; i <= 6; i++)
            {
                arr_data[i] = data[i + 1];
            }
            if(me.hasClass('edit') || me.hasClass('delete-row'))
            {
                var action = 'edit';
                if(me.hasClass('delete-row'))
                {
                    action = 'delete';
                }

                $.get('<?php echo base_url(); ?>account/prompt_file/' + action, {arr_data: arr_data}, function(response) {

                    if(action === 'delete')
                    {
                        $.modalDisplay({
                            title: 'Delete File',
                            content: response,
                            modalSize: 'modal-sm',
                            btnSave: false,
                            btnCustom: true,
                            btnCustomText: 'Delete',
                            btnCustomClass: 'delete-row'
                        });
                    }
                    else
                    {
                        $.modalDisplay({
                            title: 'Edit File',
                            content: response
                        });
                    }

                });
            }
        });
    });
</script>
