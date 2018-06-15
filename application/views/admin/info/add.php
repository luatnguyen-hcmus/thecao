<?php 
	$this->load->view('admin/info/head', $this->data);
?>
<div class="line"></div>

<div class="wrapper">
    
	   	<!-- Form -->
		<form class="form" id="form" action="<?php echo admin_url('slide/add') ?>" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="widget">
				    <div class="title">
						<img src="<?php echo public_url('admin')?>/images/icons/dark/add.png" class="titleIcon">
						<h6>Thêm mới Thông Báo</h6>	
					</div>
					
				    <ul class="tabs">
		                <li><a href="#tab1">Thông tin chung</a></li>
		                
					</ul>
					
					<div class="tab_container">
					     <div id="tab1" class="tab_content pd0">
					         <div class="formRow">
								<label class="formLeft" for="param_name">Tên thông báo:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text"></span>
									<span name="name_autocheck" class="autocheck"></span>
									<div name="name_error" class="clear error"></div>
								</div>
								<div class="clear"></div>
							</div>

							<!-- <div class="formRow">
								<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
								<div class="formRight">
									<div class="left"><input type="file" id="image" name="image"></div>
									<div name="image_error" class="clear error"></div>
								</div>
								<div class="clear"></div>
							</div> -->

							<div class="formRow">
								<label class="formLeft" for="param_name">Nôi dung:</label>
								<div class="formRight">
									<span class="oneTwo"><input name="info" id="param_info" _autocheck="true" type="text"></span>
									<span name="name_autocheck" class="autocheck"></span>
									<div name="name_error" class="clear error"></div>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<label class="formLeft" for="param_name">Trạng thái:</label>
								<div class="formRight">
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
								</div>
								<span name="name_autocheck" class="autocheck"></span>
									<div name="name_error" class="clear error"><?php echo form_error('username') ?></div>
								<div class="clear"></div>
							</div>

												         
							<div class="formRow hide"></div>
						 	</div>
						
	        			</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" value="Thêm mới" class="redB">
	           			<input type="reset" value="Hủy bỏ" class="basic">
	           		</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>