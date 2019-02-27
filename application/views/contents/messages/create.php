<div class="col-lg-4 col-md-4 col-sm-4"></div>
<div class="col-lg-4 col-md-4 col-sm-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                Create Message
            </h3>
        </div>

        <div class="panel-body" style="padding-left: 25px; padding-right: 25px;">
            <form id="create-message" action="#" autocomplete="false">

                <div class="form-group">
                    <label for="priority">Priority:</label>
                    <select class="form-control" id="priotity" name="priority" autofocus required>
                        <option value="">Select Priority</option>
                        <option value="minor">Minor</option>
                        <option value="urgent">Urgent</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Message: <input type="text" class="form-control" id="message-ctr" value="100" name="message-ctr" readonly="readonly" style="display: inline !important; width: 50px !important; background-color: #fff !important; text-align: center !important;"></label>
                    <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter Message" style="resize: none;" minlength="3" maxlength="100" required></textarea>
                </div>

                <div class="btn-align-right">
                    <label for="post" class="btn btn-primary">
                        <i class="glyphicon glyphicon-share" aria-hidden="true"></i>
                        POST
                    </label>
                    <input id="post" type="submit" value="POST" class="hidden">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4"></div>

<script>
    $(function() {

        $('#priority').focus();

        // Set the initial message ctr value
        var init_message_ctr = $('#message-ctr').val();

        $('#create-message').on('submit', function(e) {
            e.preventDefault();

            $.post('<?php echo base_url() ?>message/save', $(this).serialize(), function(response) {
                var obj = $.parseJSON(response);

                if(obj.status === 'success')
                {
                    $('#create-message').resetForm();
                    $('#priority').focus();
                }

                $.alertDisplay('#create-message', obj.msg, obj.status);

                // Reset the default character value
                $('#message-ctr').attr('value', init_message_ctr);
            });

        });

        // Keyboard event for creating message after keyup triggered
        $('#create-message').on('keyup', '#message', function() {
            // Get the current value and length of the entered message and store it to the current_message_ctr variable
            var current_message_ctr = $(this).val().length;
            var new_message_ctr = 0;
            if(init_message_ctr > current_message_ctr)
            {
                new_message_ctr = init_message_ctr - current_message_ctr;
            }
            else if(init_message_ctr < current_message_ctr)
            {
                new_message_ctr = init_message_ctr + current_message_ctr;
            }
            else
            {
                new_message_ctr = 0;
            }

            $('#message-ctr').attr('value', new_message_ctr);
        });
    });
</script>