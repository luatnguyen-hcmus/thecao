<div class="container">
<div class="page-header">
<h3>Đăng nhập</h3>
</div>
<div class="row">
<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
<form id="flogin" name="flogin" method="POST" role="form" novalidate="">
<div class="form-group">
<label class="control-label sr-only"></label>
<div class="text-danger" id="msg_err_login" style="display: none">
<img src="http://thecao247.vn/images/loading.gif">
Loading ...
</div>
</div>
<div class="form-group">
<label class="control-label" for="username">Tên đăng nhập</label>
<input type="text" id="username_login" name="username_login" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" autocomplete="off" class="form-control">
<div id="email_error" class="error"> <?php echo form_error('username_login')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password_login">Mật khẩu</label>
<input type="password" id="password_login" name="password_login" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" autocomplete="off" class="form-control">
<div id="password_error" class="error"> <?php echo form_error('password_login')?></div>

</div>
<div class="field-group">
	<div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
	<label for="remember-me">Ghi nhớ mật khẩu</label>
</div>

<h3 style="color: red;"><?php echo form_error('login'); ?></h3>
<div class="form-group">
<label class="control-label sr-only"></label>
<input type="submit" class="btn btn-success btn-block" value="Đăng nhập">
<a href="<?php echo base_url('/reset')?>" class="btn btn-success btn-block">Quên mật khẩu?</a>
</div>
</form>
</div>
</div>
</div>