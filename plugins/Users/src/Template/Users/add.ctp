<?php
$this->Html->css(array(
    '/assets/lte/bootstrap/css/fileinput',
    '/assets/lte/plugins/iCheck/all'), ['block' => 'css']);
?>
<script type="text/javascript">
    var preview_path = null;
    var img_name = '';
</script>
<div class="wrapper">
    <?php
    echo $this->Element('Dashboard/header');
    ?>
    <aside class="main-sidebar">
        <?php echo $this->Element('Dashboard/menu-sidebar'); ?>
    </aside>
    <div class="content-wrapper">
        <?php
        echo $this->Element('Dashboard/breadcrumb');
        ?>
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">New Users</h3>
                        </div>
                        <?php
                        $element = $session->read('Flash')['flash'][0]['element'];
                        if (!empty($element)) {
                            echo $this->Element($element);
                        }
                        echo $this->Form->create($users, ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'form_users', 'name' => 'form_users', 'onsubmit' => 'event.preventDefault();']);
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-sm-3 control-label">UserName</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control" id="user_name" name="user_name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="first_name" class="col-sm-3 control-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="first_name" name="first_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-sm-3 control-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="last_name" name="last_name">
                                </div>
                            </div>
                            <div class="form-group pass">
                                <label for="password" class="col-sm-3 control-label">New Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="form-group pass">
                                <label for="conf_password" class="col-sm-3 control-label">Re-New Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="conf_password" name="conf_password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="path_img" class="col-sm-3 control-label">Upload Profile Photos</label>
                                <div class="col-sm-9">
                                    <input id="img_user" name="path_img" type="file" multiple=true>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-9">
                                    <?php
                                    $status = $this->Utility->enumValue('users', 'status');
                                    foreach ($status as $item) {
                                        echo '<label><input class="flat-red" type="radio" checked value="' . $item . '" name="status"> ' . $item . '</label><br>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_active" class="col-sm-3 control-label">Is Active</label>
                                <div class="col-sm-9">
                                    <?php
                                    $this->Utility->radioButtonActive('Y', 'is_active');
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div> 
            </div>
        </section>
    </div>
    <?php echo $this->Element('Dashboard/footer'); ?>
    <div class="control-sidebar-bg"></div>
</div>
<?php
$this->Html->script([
    '/assets/lte/bootstrap/js/canvas-to-blob.min',
    '/assets/lte/bootstrap/js/fileinput',
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/plugins/jquery-validation/dist/jquery.validate.min',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/plugins/iCheck/icheck.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#form_users").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?php echo $this->Url->build(['plugin' => 'Users', 'controller' => 'Users', 'action' => 'cekValidationExistingUser', '_ext' => 'html']) ?>",
                        type: "post",
                        data: {
                            params: function () {
                                return $("#email").val();
                            },
                            type: 'add'
                        }
                    }
                },
                user_name: {
                    required: true,
                    minlength: 3,
                    remote: {
                        url: "<?php echo $this->Url->build(['plugin' => 'Users', 'controller' => 'Users', 'action' => 'cekValidationExistingUser', '_ext' => 'html']) ?>",
                        type: "post",
                        data: {
                            params: function () {
                                return $("#user_name").val();
                            },
                            type: 'add'
                        }
                    }
                },
                first_name: "required",
                last_name: "required",
                password: {
                    required: true,
                    minlength: 5
                },
                conf_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                }
            },
            messages: {
                email: {
                    required: "Email is required",
                    email: "Format Email not valid"
                },
                user_name: {
                    required: "Username is required",
                    minlength: "Username min 3 character"
                },
                first_name: "First Name is required",
                last_name: "Last Name is required",
                password: {
                    required: "Password is required",
                    minlength: "Password min 5 character"
                },
                conf_password: {
                    required: "Password is required",
                    minlength: "Password min 5 character",
                    equalTo: "Confirmation password not match same in password"
                }

            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });

</script>
