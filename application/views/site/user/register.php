<div class="container">
<div class="page-header">
<h3>Đăng ký</h3>
</div>
<div class="row">
<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
<form id="fregister" method="POST" role="form" novalidate="">
<div class="form-group">
<label class="control-label" for="username">Tên đăng nhập</label>
<input type="text" id="username" value="<?php echo set_value('username') ?>" name="username" placeholder="Tên đăng nhập..." class="form-control">

	<div id="password_error" class="error"><?php echo form_error('username')?></div>
</div>
<div class="form-group">
<label class="control-label" for="email">Email</label>
<input type="email" id="email" value="<?php echo set_value('email') ?>" name="email" placeholder="Email..." class="form-control">

	<div class="error"><?php echo form_error('email')?></div>
</div>

<div class="form-group">
<label class="control-label" for="phone">Số điện thoại</label>
<input type="number" id="phone" value="<?php echo set_value('phone') ?>" name="phone" placeholder="Số điện thoại..." class="form-control">

	<div class="error"><?php echo form_error('phone')?></div>
</div>

<div class="form-group">
<label class="control-label" for="password">Mật khẩu</label>
<input type="password" id="password" name="password" placeholder="" autocomplete="off" class="form-control">
	<div class="error"><?php echo form_error('password')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password">Nhập Lại Mật khẩu</label>
<input type="password" id="againpassword" name="againpassword" placeholder="" autocomplete="off" class="form-control">
	<div class="error"><?php echo form_error('againpassword')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password">Mật khẩu Cấp 2</label>
<input type="password" id="password2" name="password2" placeholder="" autocomplete="off" class="form-control">
	<div class="error"><?php echo form_error('password2')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password">Nhập Lại Mật khẩu Cấp 2</label>
<input type="password" id="againpassword2" name="againpassword2" placeholder="" autocomplete="off" class="form-control">
	<div class="error"><?php echo form_error('againpassword2')?></div>
</div>

<div class="form-group">
<div id="err_register_msg" style="color: red;"></div>
<input type="checkbox" name="agree">
<a href="<?php echo base_url('/dieukhoan') ?>" target="_blank"> Tôi đồng ý với các quy định của hệ thống.</a>
<div class="error"><?php echo form_error('agree')?></div>
</div>

<div class="form-group">
<label class="control-label sr-only"></label>
<input type="submit" class="btn btn-success btn-block" value="Đăng ký">
<div style="display: none;" id="loading_register">
<img src="http://thecao247.vn/images/loading.gif"> Loading ...
</div>
</div>
</form>
</div>
</div>
</div>
<style type="text/css">
	input[type="number"] {
        -moz-appearance: textfield !important;
        appearance: none !important;
        -webkit-appearance: none !important;
    }
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>