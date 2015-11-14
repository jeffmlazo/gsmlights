<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GSMLights</title>

        <!--Bootstrap-->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-theme.css" rel="stylesheet">

        <!--DataTables-->
        <link href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/jquery.dataTables_themeroller.css" rel="stylesheet">

        <!--Spinner Loader-->
        <link href="<?php echo base_url(); ?>assets/css/spinner-loader.css" rel="stylesheet">

        <!--Custom Theme-->
        <link href="<?php echo base_url(); ?>assets/css/custom-theme.css" rel="stylesheet">

        <!--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries-->
        <!--WARNING: Respond.js doesn't work if you view the page via file://-->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <!--jQuery (necessary for Bootstrap's JavaScript plugins)-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <!--Include all compiled plugins (below), or include individual files as needed-->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

        <!--Custom jQuery Libraries-->
        <script src="<?php echo base_url(); ?>assets/js/jquery.bootstrap.alertDisplay.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.bootstrap.modal.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.default.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.loader.js"></script>

        <!--Navigation tabs-->
        <ul class="nav nav-tabs" id="navs" style="margin: 10px;">
            <?php
            // Set default for admin navigations
            $is_admin = TRUE;
            $active_nav = '';
            if ($this->session->userData('user_type') === 'employee')
            {
                // FALSE means that the user was an employee
                $is_admin = FALSE;
                $active_nav = 'active';
            }
            ?>

            <?php if ($is_admin): ?>
                <li role="presentation" class="active">
                    <a href="#" id="registration">
                        <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                        Registration
                        <span class="sr-only">(active)</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#" id="file">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        File
                    </a>
                </li>
            <?php endif; ?>

            <li role="presentation" class="dropdown <?php echo $active_nav; ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    Message
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#" id="message-create">
                            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                            Create
                        </a>
                    </li>
                    <li>
                        <a href="#" id="message-inbox">
                            <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
                            Inbox
                        </a>
                    </li>
                </ul>
            </li>

            <?php if ($is_admin): ?>
                <li role="presentation" class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        User
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" id="user-add">
                                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                Add
                            </a>
                        </li>
                        <li>
                            <a href="#" id="user-view-list">
                                <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                                View Users
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <li role="presentation">
                <a href="#" id="logout">
                    <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                    Logout
                </a>
            </li>
            <li role="presentation" class="navbar-right nav-rigth-elements">
                <span class="text-info">
                    <strong>Welcome <a href="#" id="profile"><?php echo ucfirst($this->session->userdata('username')); ?></a></strong>
                </span>
            </li>
        </ul>

        <div class="container-fluid">
            <div class="row" style="margin-top: 20px;">

                <!--This is were the pop modals will be populated-->
                <div id="modal-container"></div>

                <!--Main content-->
                <div id="main-content">
                    <?php
                    $data = array($job_title_options, $department_options);
                    $this->load->view('contents/files/registration', $data);
                    ?>
                </div>

            </div>
        </div>

        <script>
            $(function() {
                $('#navs a, #nav a a').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).attr('id');
                    if(id === 'logout') {
                        document.location.href = '<?php echo base_url(); ?>account/logout';
                    }
                    else if(typeof id !== 'undefined')
                    {
                        if(id === 'profile')
                        {
                            $.get('<?php echo base_url(); ?>user/prompt_profile', {user_id: '<?php echo $this->session->userdata('user_id'); ?>'}, function(response) {
                                $.modalDisplay({
                                    titleIcon: 'wrench',
                                    title: 'User Profile',
                                    content: response
                                });
                            });
                        }
                        else
                        {
                            // Adds a class for active in the nav
                            $(this).tab('show');
                            $.ajaxLoader(
                                    '#main-content',
                                    '<?php echo base_url() ?>uisystemcontain/navs/' + id,
                                    {spinnerSize: 'large', delayTime: 1000}
                            );
                        }
                    }
                });
            });
        </script>
    </body>
</html>