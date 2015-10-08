<div id="warning" class="bg-warning" style="padding: 10px;">
    <p>
        Are you sure you want to delete this account?<br/>
        <strong><?php echo $firstname . ' ' . substr(ucfirst($middlename), 0, 1) . '. ' . $lastname; ?></strong>
    </p>
</div>

<script>
    $(function() {

        $('.modal').on('click', 'button', function(e) {
            e.preventDefault();
            var me = $(this);
            var user_id = <?php echo json_encode($user_id); ?>;

            if(me.hasClass('delete-row'))
            {
                $.post('<?php echo base_url() ?>account/delete_file', {user_id: user_id}, function(response) {
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