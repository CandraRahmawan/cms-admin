<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>Dashboard</b>CMS</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php
        $element = $session->read('Flash')['flash'][0]['element'];
        if (!empty($element)) {
            echo $this->Element($element);
        }
        echo $this->Form->create(null, [
            'url' => ['controller' => 'Login', 'action' => 'login', '_ext' => 'html']]);
        ?>
        <div class="form-group has-feedback">
            <input type="text" name="email" class="form-control" placeholder="Email/Username">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
        <a href="#">I forgot my password</a><br>
    </div>
</div>