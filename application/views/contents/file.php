<div class="col-lg-2 col-md-2 col-sm-2"></div>
<div class="col-lg-8 col-md-8 col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">List of File</h3>
        </div>

        <div class="panel-body" style="padding: 10px;">
            <button class="btn btn-primary"id="reload-table" style="margin-bottom: 10px;">Refresh</button>
            <table id="file_list" class="display">
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
        </div>
    </div>
</div>
<div class="col-lg-2 col-md-2 col-sm-2"></div>

<script>
    $(function() {

        var tableOptions = {
            orderNum: 2,
            columnDefs: [
                {"bSortable": false, "aTargets": [0, -1]},
                {"targets": -1, "data": null, "defaultContent": "<button class=\"btn btn-primary edit\">Edit</button>&nbsp;<button class=\"btn btn-primary delete\">Delete</button>"}
            ]
        };

        var tableData = $.tableDisplay('#file_list', <?php echo $json_data; ?>, tableOptions);

        $('#file_list tbody').on('click', 'button', function() {
            var me = $(this);
            var data = tableData.row($(this).parents('tr')).data();
            if(me.hasClass('edit'))
            {
                var arr_data = [];
                for(var i = 0; i <= 6; i++)
                {
                    arr_data[i] = data[i + 1];
                }

                $.get('<?php echo base_url(); ?>account/edit_file', {arr_data: arr_data}, function(response) {
                    $.modalDisplay({
                        title: 'Edit File',
                        content: response
                    });
                });
            }
            else if(me.hasClass('delete'))
            {
                // Do some delete
            }
        });

        $('#reload-table').on('click', function(e) {
            e.preventDefault();

            tableData.table('#file_list').ajax.url('<?php echo base_url(); ?>account/reload_file').load();
        });
    });
</script>
