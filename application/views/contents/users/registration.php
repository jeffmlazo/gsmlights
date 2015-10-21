<div class="col-lg-4 col-md-4 col-sm-4"></div>
<div class="col-lg-4 col-md-4 col-sm-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Add User</h3>
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
                </div>
                
                <div class="form-group">
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                </div>

                <input type="submit" value="SAVE" class="btn btn-primary" style="display:block; margin: 0 auto;">
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
    });
</script>