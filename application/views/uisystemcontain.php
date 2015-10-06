<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MAIN</title>

        <!--Bootstrap-->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-theme.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">

        <!--DataTables-->
        <link href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/jquery.dataTables_themeroller.css" rel="stylesheet">

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!--Include all compiled plugins (below), or include individual files as needed-->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

        <!--Custom jQuery Libraries-->
        <script src="<?php echo base_url(); ?>assets/js/jquery.bootstrap.alertDisplay.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.bootstrap.modal.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>

        <!--DataTable Custom Javascript-->
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.default.js"></script>

        <!--Navigation tabs-->
        <ul class="nav nav-tabs" id="navs" style="margin: 10px;">
            <!--            <li role="presentation" class="active">
                            <a href="<?php // echo base_url();              ?>uisystemcontain/home" id="home">Home</a>
                        </li>-->
            <li role="presentation" class="active">
                <a href="#" id="registration">Registration</a>
            </li>
            <li role="presentation">
                <a href="#" id="file">File</a>
            </li>
            <li role="presentation">
                <a href="#" id="message">Message</a>
            </li>
            <li role="presentation">
                <a href="#" id="logout">Logout</a>
            </li>
        </ul>

        <div class="container-fluid">
            <div class="row" style="margin-top: 20px;">
                <!--This is were the pop modals will be populated-->
                <div id="modal-container"></div>
                <div id="main-content">

                    <?php
                    $data = array($job_title_options, $department_options);
                    $this->load->view('contents/registration', $data);
                    ?>

                </div>
            </div>
        </div>

        <script>
            $(function() {
                $('#navs a').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).attr('id');

                    if(id === 'logout') {
                        document.location.href = '<?php echo base_url(); ?>account/logout';
                    } else {
                        // Adds a class for active in the nav
                        $(this).tab('show');
                        $.get('<?php echo base_url() ?>uisystemcontain/navs/' + id, function(response) {
                            $('#main-content').html(response);
                        });
                    }
                });
            });
        </script>
    </body>
</html>