<?php 
	$this->load->view('admin/user/head', $this->data);
?>
<div class="line"></div>
<div class="wrapper">
	<div class="widget">
		<div class="title">
			<h6>Chỉnh Sửa Thành Viên</h6>
		 	
		</div>
		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
					<label class="formLeft" for="param_name">Username:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="name" id="param_name" value="<?php echo $user->user_name ?>" _autocheck="true" type="text"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('name') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_email">Email:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="email" id="param_email" value="<?php echo $user->email ?>" _autocheck="true" type="text" readonly></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('email') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_password">Mật Khẩu:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="password" id="param_password" _autocheck="true" type="password"></span>
						<div class="clear"></div>
						<p>Nếu thay đổi mật khẩu thỳ nhập dữ liệu vào trường trên đây. </p>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('password') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_re_password">Nhập Lại Mật khẩu:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="re_password" id="param_re_password" _autocheck="true" type="password"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('re_password') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				
				<div class="formRow">
					<label class="formLeft" for="param_username">Tình Trạng:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo">
							<span> 
								<p>
									hoạt động
									<input name="status" value="1" id="param_status_en" _autocheck="true" type="radio" <?php if($user->status == 1) echo 'checked'; else echo '' ?> />
								</p>
							</span>
							<span>	
								<p>
									khóa
									<input name="status" value="0" id="param_status_dis" _autocheck="true" type="radio" <?php if($user->status == 0) echo 'checked'; else echo '' ?> />
								</p>
							</span>
						</span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('status') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				

				<div class="formSubmit">
           			<input type="submit" value="Chỉnh sửa" class="redB">
           			<input type="reset" value="Hủy bỏ" class="basic">
           		</div>
			</fieldset>
		</form>
	</div>
	
</div>