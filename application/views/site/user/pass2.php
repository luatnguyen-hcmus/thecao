<div class="container">
<div class="page-header">
<h3>MẬT KHẨU CẤP 2</h3>
</div>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
<form id="fpass2" name="fpass" method="POST" role="form" novalidate="">
<div class="form-group">
<label class="control-label sr-only"></label>
<div class="text-danger" id="msg_err_pass" style="display: none">
<img src="http://thecao247.vn/images/loading.gif">
Loading ...
</div>
</div>
<div class="form-group">
<label class="control-label" for="username">Mật khẩu cấp 2</label>
<input type="password" id="password_new" name="password_new" autocomplete="off" class="form-control">
<div class="error"><?php echo form_error('password_new')?></div>
</div>
<div class="form-group">
<label class="control-label" for="username">Xác nhận mật khẩu</label>
<input type="password" id="password_new" name="repassword_new" autocomplete="off" class="form-control">
<div class="error"><?php echo form_error('repassword_new')?></div>
</div>
<div class="form-group">
<label class="control-label sr-only"></label>
<input type="submit" class="btn btn-success btn-block" value="Đặt mật khẩu cấp 2">
</div>
</form>
</div>
</div>
</div>