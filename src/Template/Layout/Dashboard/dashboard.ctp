<?php echo $this->Html->docType(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin CMS | <?php echo ucfirst($this->request->params['controller']) . ' ' . ucfirst($this->request->params['action']); ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        echo $this->Html->css([
            '/assets/lte/bootstrap/css/bootstrap.min',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
            '/assets/lte/dist/css/AdminLTE.min',
            '/assets/lte/dist/css/style',
            '/assets/lte/dist/css/skins/_all-skins.min']);
        echo $this->fetch('css');
        echo $this->Html->script(array(
            '/assets/lte/plugins/jQuery/jquery-2.2.3.min',
            '/assets/lte/bootstrap/js/bootstrap.min'));
        ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <script type="text/javascript">
            var baseUrl = '<?php echo $base; ?>';
            var urlWebroot = '<?php echo $baseWebroot; ?>';
        </script>
        <?php
        echo $this->fetch('content');
        echo $this->fetch('scriptBottom');
        ?>
    </body>
</html>
