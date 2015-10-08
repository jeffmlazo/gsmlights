<div class="col-lg-2 col-md-2 col-sm-2"></div>
<div class="col-lg-8 col-md-8 col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">List of File</h3>
        </div>

        <div class="panel-body" style="padding: 10px;">
            <div class="btn-container" style="border-bottom: 1px solid #E5E5E5; margin-bottom: 15px; padding-bottom: 15px;">
                <div class="btn-group" role="group" aria-label="...">
                    <button class="btn btn-primary" id="reload-table">Refresh</button>
                    <button class="btn btn-primary" id="delete-check">Delete</button>
                </div>
            </div>
            <div id="file-list-container">
                <?php
                $data = $json_data;
                $this->load->view('contents/file_table', $data);
                ?>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-2 col-md-2 col-sm-2"></div>

<script>
    $(function() {
        $('#reload-table').on('click', function(e) {
            e.preventDefault();

            $.ajaxLoader(
                    '#file-list-container',
                    '<?php echo base_url(); ?>account/files/reload',
                    {spinnerSize: 'large'}
            );

        });
    });
</script>
