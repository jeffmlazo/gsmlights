<div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                Add Account
            </h3>
        </div>

        <div class="panel-body" style="padding-left: 25px; padding-right: 25px;">
            <?php echo form_error('username'); ?>
            <form id="add-account" action="#" autocomplete="false">

                <div class="form-group">
                    <label for="department">Department:</label>
                    <select class="form-control" id="department" name="department" autofocus required>
                        <option value="">Select Department</option>
                        <?php echo $department_options; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="job-title">Job Title:</label>
                    <select class="form-control" id="job-title" name="job-title" required>
                        <option value="">Select Job Title</option>
                        <?php echo $job_title_options; ?>
                    </select>
                </div>

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

                <div class="form-group">
                    <label for="phone-number">Phone Number:</label>
                    <div class="input-group">
                        <div class="input-group-addon">+63</div>
                        <input type="text" class="form-control" id="phone-number" name="phone-number" maxlength="10">
                    </div>
                    <p class="help-block">Remove "0" at the beginning. Ex. 9086805971</p>
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

<script>
    $(function() {

        $('#department').focus();

        $('#add-account').on('submit', function(e) {
            e.preventDefault();

            $.post('<?php echo base_url() ?>account/save', $(this).serialize(), function(response) {
                var obj = $.parseJSON(response);

                if(obj.status === 'success')
                {
                    $('#add-account').resetForm();
                    $('#department').focus();
                }

                $.alertDisplay('#add-account', obj.msg, obj.status);
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