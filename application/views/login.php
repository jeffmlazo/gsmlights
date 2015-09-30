<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LOGIN</title>

        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-theme.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>
            body {     background-image: url("assets/images/grid.jpg"); }
        </style>
    </head>
    <body>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

        <!--Custom JQuery Libraries-->
        <script src="<?php echo base_url(); ?>assets/js/jquery.alertDisplay.js"></script>

        <div class="container" style="margin-top: 20%;">
            <div class="login-wrapper">
                <div style="width:320px;" class="well center-block">
                    <h1 style="color: #C14545;" class="text-center">Welcome to BOARD</h1>
                    <form id="login" action="#" class="form-signin">
                        <input type="text" class="form-control" placeholder="Username" name="username" required autofocus> <br>
                        <input type="password" class="form-control" placeholder="Password" name="password" required> <br>
                        <!--                        <label>
                                                    <input type="checkbox"> Keep me logged in
                                                </label>-->
                        <input type="submit" class="btn btn-lg btn-primary btn-block btn-sm" value="LOGIN">
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(function() {
                $('#login').on('submit', function(e) {
                    e.preventDefault();

                    $.post('<?php echo base_url() ?>account/check_user', $(this).serialize(), function(response) {
                        var obj = $.parseJSON(response);

                        if(obj.status === 'success') {
                            document.location.href = '<?php echo base_url() ?>uisystemcontain';
                        } else {
                            $.alertDisplay('#login', obj.msg, obj.status);
                        }
                    });

                });
            });
        </script>

    </body>
</html>
