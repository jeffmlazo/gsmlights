<form id="edit-user" action="#" autocomplete="false">
    <div class="form-group">
        <label for="user-type">User Type:</label>
        <select class="form-control" id="user-type" name="user-type" required>
            <option value="">Select User Type</option>
            <?php echo $user_type_options; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
    </div>

    <div class="form-group">
        <label for="phone-number">Password:</label>
        <input type="text" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
    </div>
    <input type="hidden" class="hidden" id="user-id" name="user-id" value="<?php echo $user_id; ?>">
</form>

<script>
    $(function() {

        // If the modal showed set the auto focus to the top most first field
        $('.modal').on('shown.bs.modal', function() {
            $('#job-title').focus();
        });

        $('.modal').on('click', 'button', function(e) {
            e.preventDefault();
            var me = $(this);

            if(me.hasClass('btn-save'))
            {
                $.post('<?php echo base_url() ?>user/update_user', $('#edit-user').serialize(), function(response) {
                    var obj = $.parseJSON(response);

                    if(obj.status === 'success') {
                        setTimeout(function() {
                            $('.modal').modal('hide');
                            $('#reload-table').click();
                        }, 1000);
                    }
                    $.alertDisplay('.modal-body', obj.msg, obj.status);
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
    });
</script>