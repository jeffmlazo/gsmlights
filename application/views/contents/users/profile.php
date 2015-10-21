<form id="edit-user" action="#" autocomplete="false">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" disabled="disabled">
    </div>

    <div class="form-group">
        <label for="password">New Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="" id="checkbox-password">
                Show password
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="confirm-password">Confirm New Password:</label>
        <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="" id="checkbox-confirm-password">
                Show confirm password
            </label>
        </div>
    </div>
    <input type="hidden" class="hidden" id="user-id" name="user-id" value="<?php echo $user_id; ?>">
</form>

<script>
    $(function() {

        // If the modal showed set the auto focus to password field
        $('.modal').on('shown.bs.modal', function() {
            $('#password').focus();
        });

        $('.modal').on('click', 'button', function(e) {
            e.preventDefault();
            var me = $(this);

            if(me.hasClass('btn-save'))
            {
                $.post('<?php echo base_url() ?>user/update_user', $('#edit-user').serialize(), function(response) {
                    var obj = $.parseJSON(response);

                    $.alertDisplay('.modal-body', obj.msg, obj.status);
                    if(obj.status === 'success') {
                        setTimeout(function() {
                            $('.modal').modal('hide');
                        }, 1000);
                    }
                });
            }
            else if(me.hasClass('btn-close') || me.hasClass('close'))
            {
                // Empty the modal-container after the modals has been called
                $('.modal').on('hidden.bs.modal', function() {
                    $('#modal-container').empty();
                });
            }
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