<div class="col-lg-4 col-md-4 col-sm-4"></div>
<div class="col-lg-4 col-md-4 col-sm-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Create Message</h3>
        </div>

        <div class="panel-body" style="padding-left: 25px; padding-right: 25px;">
            <form id="add-message" action="#" autocomplete="false">

                <div class="form-group">
                    <label for="priority">Priority:</label>
                    <select class="form-control" id="priotity" name="priority" autofocus required>
                        <option value="">Select Priority</option>
                        <option value="minor">Minor</option>
                        <option value="urgent">Urgent</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter Message" style="resize: none;" required></textarea>
                </div>

                <div class="btn-align-right">
                    <input type="submit" value="POST" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4"></div>

<script>
    $(function() {

        $('#priority').focus();

        $('#add-message').on('submit', function(e) {
            e.preventDefault();

            $.post('<?php echo base_url() ?>message/save', $(this).serialize(), function(response) {
                var obj = $.parseJSON(response);
                
                $('#add-message').resetForm();
                $.alertDisplay('#add-message', obj.msg, obj.status);
                $('#priority').focus();
            });

        });
    });
</script>