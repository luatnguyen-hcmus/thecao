<?php 
	$this->load->view('admin/info/head', $this->data);
?>
<div class="line"></div>

<div class="wrapper">
    
	   	<!-- Form -->
		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="widget">
				    <div class="title">
						<img src="<?php echo public_url('admin')?>/images/icons/dark/add.png" class="titleIcon">
						<h6>Chỉnh Sửa Thông Báo</h6>
					</div>
					
				    <ul class="tabs">
		                <li><a href="#tab1">Thông tin chung</a></li>
		                
					</ul>
					
					<div class="tab_container">
					     <div id="tab1" class="tab_content pd0">
					         <div class="formRow">
								<label class="formLeft" for="param_name">Tên Thông Báo:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text" value="<?php echo $info->title ?>"></span>
									<div name="name_error" class="clear error"><?php echo form_error('name') ?></div>
								</div>
								<div class="clear"></div>
							</div>

							
							<div class="formRow">
								<label class="formLeft">Nội dung:</label>
								<div class="formRight">
									<textarea name="content" id="param_content" class="editor">
										<?=$info->content?>
									</textarea>
									<div name="content_error" class="clear error"><?php echo form_error('content') ?></div>
								</div>
								<div class="clear"></div>
							</div>

							

							<div class="formRow">
								<label class="formLeft" for="param_username">Trạng Thái:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo">
										<span> 
											<p>
												hiển thị
												<input name="status" value="1" id="param_username" _autocheck="true" type="radio" <?php if($info->status == 1) echo 'checked'; else echo '' ?> />
											</p>
										</span>
										<span>	
											<p>
												không hiển thị
												<input name="status" value="0" id="param_username" _autocheck="true" type="radio" <?php if($info->status == 0) echo 'checked'; else echo '' ?> />
											</p>
										</span>
									</span>
									<span name="name_autocheck" class="autocheck"></span>
									<div name="name_error" class="clear error"><?php echo form_error('status') ?></div>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow hide"></div>
						</div>
													
					</div><!-- End tab_container-->
								        		
	        		<div class="formSubmit">
	           			<input type="submit" value="Cập Nhật" class="redB">
	           			<input type="reset" value="Hủy bỏ" class="basic">
	           		</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>