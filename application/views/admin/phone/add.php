<?php 
	$this->load->view('admin/phone/head', $this->data);
?>
<div class="line"></div>
<div class="wrapper">
	<div class="widget">
		<div class="title">
			<h6>Thêm mới HotLine</h6>
		 	
		</div>
		<form class="form" id="form" action="add" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
					<label class="formLeft" for="param_name">HotLine:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="name" id="param_name" value="<?php echo set_value('name')?>" _autocheck="true" type="text"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('name') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_username">HotLine Hiển Thị:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="username" id="param_username" value="<?php echo set_value('username')?>" _autocheck="true" type="text"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('username') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<span class="oneTwo">
						<span> 
							<p>
								hiển thị
								<input name="phone" value="1" id="param_username" _autocheck="true" type="radio" />
							</p>
						</span>
						<span>	
							<p>
								không hiển thị
								<input name="phone" value="0" id="param_username" _autocheck="true" type="radio" />
							</p>
						</span>
					</span>
					<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('username') ?></div>
					<div class="clear"></div>
				</div>


				<div class="formSubmit">
           			<input type="submit" value="Thêm mới" class="redB">
           			<input type="reset" value="Hủy bỏ" class="basic">
           		</div>
			</fieldset>
		</form>
	</div>
	
</div>