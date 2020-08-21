<div id="warning" class="bg-warning" style="padding: 10px;">
    <p>
        <?php if ($prompt_type === 'delete-row') : ?>
            Are you sure you want to delete this user?<br/>
            <strong><?php echo $username; ?></strong>
        <?php else: ?>
            Are you sure you want to delete the following user(s)?<br/>
            <?php echo $users; ?>
        <?php endif; ?>
    </p>
</div>

<script>
    $(function() {

        $('.modal').on('click', 'button', function(e) {
            e.preventDefault();
            var me = $(this);
            var user_id = <?php echo ($prompt_type === 'delete-row' ? json_encode($user_id) : json_encode($user_ids)); ?>;

            if(me.hasClass('delete-row') || me.hasClass('delete-all'))
            {
                var action = 'delete-row';
                if(me.hasClass('delete-all'))
                {
                    action = 'delete-all';
                }

                $.post('<?php echo base_url() ?>user/delete_user/' + action, {user_id: user_id}, function(response) {
                    var obj = $.parseJSON(response);

                    if(obj.status === 'success') {
                        $('#warning').remove();
                        $.alertDisplay('.modal-body', obj.msg);
                        setTimeout(function() {
                            $('.modal').modal('hide');
                            $('#reload-table').click();
                        }, 2000);
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
    });
</script>