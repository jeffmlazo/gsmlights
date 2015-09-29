<div class="col-lg-6 col-md-6 col-sm-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Add Account</h3>
        </div>

        <div class="panel-body">


            <form id="add-account" action="<?php echo base_url(); ?>account/save" autocomplete="false">

                <div class="form-group">
                    <label for="department">Department:</label>
                    <select class="form-control" id="department" name="department" autofocus required>
                        <option value="">Select Department</option>
                        <option value="dep1">Department1</option>
                        <option value="dep2">Department2</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="job-title">Job Title:</label>
                    <select class="form-control" id="job-title" name="job-title" required>
                        <option value="">Select Job Title</option>
                        <option value="1">Admin</option>
                        <option value="2">Employee</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="phone-number">Phone Number:</label>
                    <input type="text" class="form-control" id="phone-number" name="phone-number" required>
                </div>

                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>

                <div class="form-group">
                    <label for="middlename">Middle Name:</label>
                    <input type="text" class="form-control" id="middlename" name="middlename" required>
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>

                <input type="submit" value="SAVE" style="display:block; margin: 0 auto;">
            </form>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#add-account').on('submit', function (e) {
            e.preventDefault();

            $.post('<?php echo base_url() ?>account/save', $(this).serialize(), function (response) {
                console.log($(this).serialize());

                // Check if there was already an alert
                if ($('.alert').length === 0) {
                    var msg = '<div class="alert alert-success alert-dismissable" role="alert">' +
                            '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' +
                            '<span class="sr-only">Success:</span>' +
                            '<strong>' +
                            'Account was successfully added.' +
                            '</strong>' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>';
                    var msg_hidden = $(msg).hide();
                    $('#add-account').prepend(msg_hidden);
                    msg_hidden.fadeIn('slow');
                }
            });

        });
    });
</script>