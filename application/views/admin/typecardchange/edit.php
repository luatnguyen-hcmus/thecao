<?php 
	$this->load->view('admin/typecardchange/head', $this->data);
?>
<div class="line"></div>

<div class="wrapper">
	<div class="widget">
		<div class="title">
			<h6>Chỉnh Sửa Thẻ </h6>
		 	
		</div>
		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
					<label class="formLeft" for="param_name">Loại Thẻ:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="name" id="param_name" value="<?php echo $typecardchange->name ?>" _autocheck="true" type="text"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('name') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
					<div class="formRight">
						<div class="left">
							<input type="file" id="image" name="image">
							<img width="100px" height="70px;" src="<?php echo base_url('upload/typecard/'.$typecardchange->image) ?>" >
						</div>

						<div name="image_error" class="clear error"></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_phone">Thứ tự hiển thị:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="sort_card" id="param_phone" value="<?php echo $typecardchange->sort_order ?>" _autocheck="true" type="text"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('sort_card') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label class="formLeft" for="param_address">Chiếc khấu:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo">
							<input type="number" name="hunress" min="1" value="<?=$sub->hunress_change?>"> %
						</span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('hunress') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_address">Số lượng kí tự mã thẻ min:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo">
							<input type="number" name="mincode" min="1" value="<?=$typecardchange->min_code?>">
						</span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('mincode') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label class="formLeft" for="param_address">Số lượng kí tự mã thẻ max:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo">
							<input type="number" name="maxcode" min="1" value="<?=$typecardchange->max_code?>">
						</span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('maxcode') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_address">Số lượng kí tự mã seri min:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo">
							<input type="number" name="minseri" min="1" value="<?=$typecardchange->min_seri?>">
						</span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('minseri') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label class="formLeft" for="param_address">Số lượng kí tự mã seri max:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo">
							<input type="number" name="maxseri" min="1" value="<?=$typecardchange->max_seri?>">
						</span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('maxseri') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="formRow">
					<label class="formLeft" for="param_username">Trạng Thái:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo">
							<span> 
								<p>
									Hiển thị
									<input name="status" value="1" id="param_username" _autocheck="true" type="radio" <?php if($typecardchange->status_change == 1) echo 'checked'; else echo '' ?> />
								</p>
							</span>
							<span>	
								<p>
									Không hiển thị
									<input name="status" value="0" id="param_username" _autocheck="true" type="radio" <?php if($typecardchange->status_change == 0) echo 'checked'; else echo '' ?> />
								</p>
							</span>
						</span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('username') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_username">Tình Trạng:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo">
							<span> 
								<p>
									Hoạt động
									<input name="featured" value="1" id="param_username" _autocheck="true" type="radio" <?php if($typecardchange->featured_change == 1) echo 'checked'; else echo '' ?> />
								</p>
							</span>
							<span>	
								<p>
									Bảo trì
									<input name="featured" value="0" id="param_username" _autocheck="true" type="radio" <?php if($typecardchange->featured_change == 0) echo 'checked'; else echo '' ?> />
								</p>
							</span>
						</span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('username') ?></div>
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