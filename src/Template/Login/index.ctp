<form id="login_form" action="dashboard.html" method="get">
    <h1 class="login_heading">Login <span>/ <a href="#" class="open_register_form">register</a></span></h1>
    <div class="form-group">
        <label for="login_username">Username</label>
        <input type="text" class="form-control input-lg" placeholder="User" id="login_username">
    </div>
    <div class="form-group">
        <label for="login_password">Password</label>
        <input type="password" class="form-control input-lg" id="login_password">
        <span class="help-block"><a href="#">Forgot password?</a></span>
    </div>
    <div class="submit_section">
        <button class="btn btn-lg btn-success btn-block">Continue</button>
    </div>
</form>
<form id="register_form" style="display:none">
    <h1 class="login_heading">Register <span>/ <a href="#" class="open_login_form">login</a></span></h1>
    <div class="form-group">
        <label for="register_username">Username</label>
        <input type="text" class="form-control input-lg" id="register_username">
    </div>
    <div class="form-group">
        <label for="register_email">Email</label>
        <input type="text" class="form-control input-lg" id="register_email">
    </div>
    <div class="form-group">
        <label for="register_password">Password</label>
        <input type="password" class="form-control input-lg" id="register_password">
    </div>
    <div class="form-group">
        <label class="checkbox-inline"><input type="checkbox" name="register_terms" id="register_terms"> Agree to <a href="javascript:void(0)" data-toggle="modal" data-target="#terms_modal">terms&conitions</a></label>
    </div>
    <div class="submit_section">
        <button type="button" class="btn btn-lg btn-success btn-block">Continue</button>
    </div>
</form>