<form id="edit-file" action="#" autocomplete="false">
    <?php // JX-TODO: Add here the Department field ?>
    <div class="form-group">
        <label for="job-title">Job Title:</label>
        <select class="form-control" id="job-title" name="job-title" required>
            <option value="">Select Job Title</option>
            <?php echo $job_title_options; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
    </div>

    <div class="form-group">
        <label for="phone-number">Phone Number:</label>
        <div class="input-group">
            <div class="input-group-addon">+63</div>
            <input type="text" class="form-control" id="phone-number" name="phone-number" value="<?php echo $phone_number; ?>" maxlength="10" required>
        </div>
        <p class="help-block">Remove "0" at the beginning. Ex. 9086805971</p>
    </div>

    <div class="form-group">
        <label for="firstname">First Name:</label>
        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname; ?>" required>
    </div>

    <div class="form-group">
        <label for="middlename">Middle Name:</label>
        <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo $middlename; ?>" required>
    </div>

    <div class="form-group">
        <label for="lastname">Last Name:</label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname; ?>" required>
    </div>
    <input type="hidden" class="hidden" id="account-id" name="account-id" value="<?php echo $account_id; ?>">
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
                $.post('<?php echo base_url() ?>account/update_file', $('#edit-file').serialize(), function(response) {
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