<div class="container">
<div class="page-header">
<h3>Đổi mật khẩu</h3>
</div>
<div class="row">
<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
<form  name="fpass" method="POST" role="form" novalidate="">
<div class="form-group">
<label class="control-label sr-only"></label>
<div class="text-danger" id="msg_err_pass" style="display: none">
<img src="http://thecao247.vn/images/loading.gif">
Loading ...
</div>
</div>
<div class="form-group">
<label class="control-label" for="username">Mật khẩu mới</label>
<input type="password" id="password_login" name="password_login" autocomplete="off" class="form-control">
<div class="error"><?php echo form_error('password_login')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password_login">Xác nhận mật khẩu mới</label>
<input type="password" id="repassword_login" name="repassword_login" autocomplete="off" class="form-control">
<div class="error"><?php echo form_error('repassword_login')?></div>
</div>
<div class="form-group">
<label class="control-label" for="username">Mật khẩu cấp 2</label>
<input type="password" id="password2" name="password2" autocomplete="off" class="form-control">
<div class="error"><?php echo form_error('password2')?></div>
</div>
<div class="form-group">
<label class="control-label sr-only"></label>
<input type="submit" class="btn btn-success btn-block" value="Đổi mật khẩu">
</div>
</form>
</div>
</div>
</div>