<div class="col-lg-1 col-md-1 col-sm-1"></div>
<div class="col-lg-10 col-md-10 col-sm-10">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                List of File
            </h3>
        </div>

        <div class="panel-body" style="padding: 10px;">
            <div class="btn-container" style="border-bottom: 1px solid #E5E5E5; margin-bottom: 15px; padding-bottom: 15px;">
                <div class="btn-group" role="group" aria-label="...">
                    <button class="btn btn-primary" id="reload-table">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                        Refresh
                    </button>
                    <button class="btn btn-primary" id="delete-all">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        Delete
                    </button>
                </div>
            </div>
            <div id="file-list-container">
                <?php
                $data = (isset($json_data) && !empty($json_data) ? $json_data : null);
                $this->load->view('contents/files/file_table', $data);
                ?>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-1 col-md-1 col-sm-1"></div>

<script>
    $(function() {
        $('.panel-body').on('click', '#reload-table', function(e) {
            e.preventDefault();

            $.ajaxLoader(
                    '#file-list-container',
                    '<?php echo base_url(); ?>account/files/reload',
                    {spinnerSize: 'large'}
            );
        });

        $('.panel-body').on('click', '#delete-all', function(e) {
            e.preventDefault();

            var arr_row_data = [];
            $('#file-list tbody input:checked').each(function(index) {
                var me = $(this);
                var data = $('#file-list').DataTable().row(me.parents('tr')).data();

                if(data[0] !== null && data[0].indexOf('checkbox') > 0)
                {
                    // Removes the checkbox element in the 0 index array
                    data.shift();
                }

                arr_row_data[index] = data;
            });

            // Check if there was a checked for deletion
            if(arr_row_data.length > 0)
            {
                $.get('<?php echo base_url(); ?>account/prompt_file/delete_all', {checked_rows: arr_row_data}, function(response) {
                    $.modalDisplay({
                        titleIcon: 'trash',
                        title: 'Delete File(s)',
                        content: response,
                        btnSave: false,
                        btnCustom: true,
                        btnCustomIcon: 'trash',
                        btnCustomText: 'Delete',
                        btnCustomClass: 'delete-all'
                    });

                });
            }
            else
            {
                var msg = '<div id="warning" class="bg-warning" style="padding: 10px;">' +
                        '<p>' +
                        'Please check at least 1 checkbox in the table below before clicking this delete button.' +
                        '</p>' +
                        '</div>';

                $.modalDisplay({
                    titleIcon: 'trash',
                    title: 'Delete File(s)',
                    content: msg,
                    btnSave: false
                });
            }
        });
    });
</script>
