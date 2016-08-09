<?php echo $this->Html->docType(); ?>
<html lang="en">
    <head>
        <title>Login Page</title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <?php
        echo $this->Html->charset();
        echo $this->Html->css(array(
            '/assets/default/bootstrap/css/bootstrap.min.css',
            'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400&amp;subset=latin-ext,latin',
            '/assets/default/css/login'));
        ?>
    </head>
    <body>
        <div class="login_container">
            <?php echo $this->fetch('content'); ?>
        </div>
        <div class="modal fade" id="terms_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Terms & Conditions</h4>
                    </div>
                    <div class="modal-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus eaque tempora! Porro cumque labore voluptate dolore alias libero commodi deserunt unde aspernatur dignissimos quaerat similique maiores quasi eos optio quidem.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus eaque tempora! Porro cumque labore voluptate dolore alias libero commodi deserunt unde aspernatur dignissimos quaerat similique maiores quasi eos optio quidem.
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php
    echo $this->Html->css(array(
        '/assets/default/js/jquery.min.js',
        '/assets/default/bootstrap/js/bootstrap.min.js'));
    ?>
    <script type="text/javascript">
        $(function () {
            // switch forms
            $('.open_register_form').click(function (e) {
                e.preventDefault();
                $('#login_form').removeClass().addClass('animated fadeOutDown');
                setTimeout(function () {
                    $('#login_form').removeClass().hide();
                    $('#register_form').show().addClass('animated fadeInUp');
                }, 700);
            })
            $('.open_login_form').click(function (e) {
                e.preventDefault();
                $('#register_form').removeClass().addClass('animated fadeOutDown');
                setTimeout(function () {
                    $('#register_form').removeClass().hide();
                    $('#login_form').show().addClass('animated fadeInUp');
                }, 700);
            })
        })
    </script>
</html>
