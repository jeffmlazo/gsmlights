<div class="col-lg-4 col-md-4 col-sm-4"></div>
<div class="col-lg-4 col-md-4 col-sm-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                Add User
            </h3>
        </div>

        <div class="panel-body" style="padding-left: 25px; padding-right: 25px;">
            <form id="add-user" action="#" autocomplete="false">

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" id="checkbox-password">
                            Show password
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" id="checkbox-confirm-password">
                            Show confirm password
                        </label>
                    </div>
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
<div class="col-lg-4 col-md-4 col-sm-4"></div>

<script>
    $(function() {

        $('#user-type').focus();

        $('#add-user').on('submit', function(e) {
            e.preventDefault();

            $.post('<?php echo base_url() ?>user/save', $(this).serialize(), function(response) {
                var obj = $.parseJSON(response);

                if(obj.status === 'success') {
                    $('#add-user').resetForm();
                    $('#user-type').focus();
                }
                $.alertDisplay('#add-user', obj.msg, obj.status);
            });

        });

        $('#checkbox-password, #checkbox-confirm-password').on('click', function() {
            var me = $(this);
            // Check if the currrent state of the checkbox
            if(me.is(':checked'))
            {
                me.parents('.form-group').find('input:password').prop('type', 'text');
            }
            else
            {
                me.parents('.form-group').find('input:text').prop('type', 'password');
            }
        });
    });
</script>