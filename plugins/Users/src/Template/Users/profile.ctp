<?php
$this->Html->css(array(
    '/assets/lte/bootstrap/css/fileinput',
    '/assets/lte/plugins/iCheck/all',
    '/assets/lte/plugins/jquery-validation/demo/site-demos'), ['block' => 'css']);
?>
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
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <?php
                            $attr = ['class' => 'profile-user-img img-responsive img-circle', 'alt' => 'User profile picture', 'onerror' => 'javascript:this.src="' . $base . '/img/no-user.png"'];
                            echo $this->Html->image($this->Utility->basePathImgProfile() . $profile['path_img'], $attr);
                            ?>
                            <h3 class="profile-username text-center"><?php echo $profile['first_name'] . ' ' . $profile['last_name']; ?></h3>
                            <p class="text-muted text-center"><?php echo $profile['status']; ?></p>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#update" data-toggle="tab">Update</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="update">
                                <?php
                                $element = $session->read('Flash')['flash'][0]['element'];
                                if (!empty($element)) {
                                    echo $this->Element($element);
                                }
                                echo $this->Form->create(null, [
                                    'url' => ['action' => 'submitProfile'],
                                    'class' => 'form-horizontal',
                                    'enctype' => 'multipart/form-data',
                                    'id' => 'form_users',
                                    'name' => 'form_users',
                                    'onsubmit' => 'event.preventDefault();']);
                                ?>
                                <div class="form-group">
                                    <label for="user_name" class="col-sm-3 control-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->request->query['id_user']; ?>" >
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $profile['user_name']; ?>" onkeyup="return this.value = this.value.toLowerCase();">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <?php
                                            if ($this->request->query['id_user'] != $session_user['user_id']) {
                                                echo '<input type="text" class="form-control" id="email" name="email" value="' . $profile['email'] . '">';
                                            } else {
                                                echo '<input type="text" class="form-control" name="email" value="' . $profile['email'] . '" readonly="true">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="first_name" class="col-sm-3 control-label">First Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $profile['first_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="col-sm-3 control-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $profile['last_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group pass" style="display: none;">
                                    <label for="password" class="col-sm-3 control-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Blank Password if not changes">
                                    </div>
                                </div>
                                <div class="form-group pass" style="display: none;">
                                    <label for="conf_password" class="col-sm-3 control-label">Re-New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="Blank Password if not changes">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9">
                                        <label for="password" class="control-label"><a href="javascript:void(0)" id="showHidePass" onclick="return showHidePass();">Change Password</a></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="path_img" class="col-sm-3 control-label">Upload Profile Photos</label>
                                    <div class="col-sm-9">
                                        <input id="img_user" name="path_img" type="file" multiple=true>
                                    </div>
                                </div>
                                <?php
                                if ($this->request->query['id_user'] != $session_user['user_id']) {
                                    ?>
                                    <div class="form-group">
                                        <label for="status" class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-9">
                                            <?php
                                            $status = $this->Utility->enumValue('users', 'status');
                                            foreach ($status as $item) {
                                                if ($item == $profile['status'])
                                                    echo '<label><input class="flat-red" type="radio" checked value="' . $item . '" name="status"> ' . $item . '</label><br>';
                                                else
                                                    echo '<label><input class="flat-red" type="radio" value="' . $item . '" name="status"> ' . $item . '</label><br>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_active" class="col-sm-3 control-label">Is Active</label>
                                        <div class="col-sm-9">
                                            <?php
                                            $this->Utility->radioButtonActive($profile['is_active'], 'is_active');
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    echo '<input type="hidden" name="is_active" value="' . $profile['is_active'] . '">';
                                    echo '<input type="hidden" name="status" value="' . $profile['status'] . '">';
                                }
                                ?>
                                <hr>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <?php echo $this->Element('Dashboard/footer'); ?>
    <div class="control-sidebar-bg"></div>
</div>
<?php
$this->Html->script(array(
    '/assets/lte/bootstrap/js/canvas-to-blob.min',
    '/assets/lte/bootstrap/js/fileinput',
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/plugins/jquery-validation/dist/jquery.validate.min',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/plugins/iCheck/icheck.min',
    '/assets/lte/dist/js/main'), ['block' => 'scriptBottom']);

if ($profile['path_img'] != '')
    $path_image = '"' . $this->request->webroot . $this->utility->basePathImgProfile() . $profile['path_img'] . '"';
else
    $path_image = 'null';
?>

<script type="text/javascript">
    function showHidePass() {
        if ($('.pass').is(":visible")) {
            $('.pass').hide();
            $("#password").val('');
            $("#conf_password").val('');
        } else {
            $('.pass').show();
        }
    }

    var preview_path = <?php echo $path_image; ?>;
    var img_name = '<?php echo $profile['path_img']; ?>';
</script>

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
                            type: 'update',
                            user_id: function () {
                                return $("#user_id").val();
                            }
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
                            type: 'update',
                            user_id: function () {
                                return $("#user_id").val();
                            }
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
