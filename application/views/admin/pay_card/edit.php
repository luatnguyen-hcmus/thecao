<?php 
	$this->load->view('admin/pay_card/head', $this->data);
?>
<div class="line"></div>

<div class="wrapper">
	<div class="widget">
		<div class="title">
			<h6>Sửa giao dịch trả thẻ</h6>
		 	
		</div>
		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
					<label class="formLeft" for="param_name">Mã seri:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input value="<?=$pay_card->seri?>" name="seri" id="param_name" _autocheck="true" type="text"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('seri') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_phone">Mã Thẻ:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input value="<?=$pay_card->code?>" name="code" id="param_phone" _autocheck="true" type="text"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('code') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formSubmit">
           			<input type="submit" value="Cập Nhật" class="redB">
           			<input type="reset" value="Hủy bỏ" class="basic">
           		</div>
			</fieldset>
		</form>
	</div>
	
</div>