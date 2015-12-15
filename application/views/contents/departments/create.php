<div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                Add Department
            </h3>
        </div>

        <div class="panel-body" style="padding-left: 25px; padding-right: 25px;">
            <form id="add-department" action="#" autocomplete="false">
                <div class="form-group">
                    <label for="department">Department:</label>
                    <input type="text" class="form-control" id="department" name="department" required>
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

        $('#department').focus();

        $('#add-department').on('submit', function(e) {
            e.preventDefault();

            $.post('<?php echo base_url() ?>department/save', $(this).serialize(), function(response) {
                var obj = $.parseJSON(response);

                if(obj.status === 'success')
                {
                    $('#add-department').resetForm();
                    $('#department').focus();
                }

                $.alertDisplay('#add-department', obj.msg, obj.status);

            });

        });
    });
</script>