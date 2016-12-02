<?php echo $this->Html->docType(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>DashBoard | Log in</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        echo $this->Html->css(array(
            '/assets/lte/bootstrap/css/bootstrap.min',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
            '/assets/lte/dist/css/AdminLTE.min',
        ));
        ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <?php
        echo $this->fetch('content');

        echo $this->Html->script(array(
            '/assets/lte/plugins/jQuery/jquery-2.2.3.min',
            '/assets/lte/bootstrap/js/bootstrap.min'));
        ?>
    </body>
</html>

