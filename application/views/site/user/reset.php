<div class="container">
<div class="page-header">
<h3>Lấy lại mật khẩu</h3>
</div>
<div class="row">
<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
<form id="freset" name="freset" method="POST" role="form" novalidate="">
<div class="form-group">
<label class="control-label sr-only"></label>
<div class="text-danger" id="msg_err_pass" style="display: none">
<img src="http://thecao247.vn/images/loading.gif">
Loading ...
</div>
</div>
<div class="form-group">
<label class="control-label" for="username">Nhập Email</label>
<input type="email" id="email_pass" name="email_pass" autocomplete="off" value="<?php echo set_value('email_pass') ?>" class="form-control">
<?php echo form_error('email_pass')?>
</div>
<div class="form-group">
<label class="control-label" for="username_pass">Tên đăng nhập</label>
<input type="text" id="username_pass" name="username_pass" value="<?php echo set_value('username_pass') ?>" autocomplete="off" class="form-control">
<?php echo form_error('username_pass')?>
</div>
<!-- <div class="form-group">
<label class="control-label" for="captcha">Mật khẩu cấp 2</label>
    <input type="password" id="username_pass" name="username_pass2" autocomplete="off" class="form-control">
</div> -->
<h3 style="color: red;"><?php echo form_error('login'); ?></h3>
<div class="form-group">
<label class="control-label sr-only"></label>
<input type="submit" class="btn btn-success btn-block" value="Đổi mật khẩu">
</div>
</form>
</div>
</div>
</div>