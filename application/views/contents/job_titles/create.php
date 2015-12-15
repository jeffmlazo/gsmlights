<div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                Add Job Title
            </h3>
        </div>

        <div class="panel-body" style="padding-left: 25px; padding-right: 25px;">
            <form id="add-job-title" action="#" autocomplete="false">
                <div class="form-group">
                    <label for="job-title">Job Title:</label>
                    <input type="text" class="form-control" id="job-title" name="job-title" required>
                </div>

                <div class="btn-align-right">
                    <label for="save" class="btn btn-primary">
                        <i class="glyphicon glyphicon-save" aria-hidden="true"></i>
                        SAVE
                    </label>
                    <input id="save" type="submit" value="SAVE" class="hidden">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {

        $('#job-title').focus();

        $('#add-job-title').on('submit', function(e) {
            e.preventDefault();

            $.post('<?php echo base_url() ?>job_title/save', $(this).serialize(), function(response) {
                var obj = $.parseJSON(response);

                if(obj.status === 'success')
                {
                    $('#add-job-title').resetForm();
                    $('#job-title').focus();
                }

                $.alertDisplay('#add-job-title', obj.msg, obj.status);

            });

        });
    });
</script>