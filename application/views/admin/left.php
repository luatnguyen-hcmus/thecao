<div id="leftSide" style="padding-top:30px;">
<!-- Account panel -->
	<div class="sideProfile">
		<a href="#" title="" class="profileFace"><img width="40" src="<?php echo public_url()?>/admin/images/user.png"></a>
		<?php if(isset($admin_info)) : ?>
			<span>Xin chào: <strong>admin!</strong></span>
			<span><?php echo ($admin_info->name)?></span>
		<?php endif?>
		<div class="clear"></div>
	</div>
	<div class="sidebarSep"></div>		    
	<!-- Left navigation -->
	<ul id="menu" class="nav">
		<li class="home">
			<a href="<?php echo admin_url()?>" class="active" id="current">
				<span>Bảng điều khiển</span>
				<strong></strong>
			</a>			
		</li>
		<li class="tran">
			<a href="" class="exp inactive">
				<span>Quản lý giao dịch</span>
				<strong>4</strong>
			</a>
			<ul class="sub" style="display: none;">
				<li>
					<a href="<?php echo admin_url('transaction/put') ?>">
							Danh sách nạp thẻ
					</a>
				</li>
				<li>
					<a href="<?php echo admin_url('transaction/get_bank') ?>">
							Danh sách rút về ngân hàng		
					</a>
				</li>
				<li>
					<a href="<?php echo admin_url('transaction/get_tcsr') ?>">
							Danh sách rút về tcsr						
					</a>
				</li>
				<li>
					<a href="<?php echo admin_url('transaction/buy') ?>">
							Danh sách mua thẻ				
					</a>
				</li>
			</ul>
						
		</li>
		<li class="product">
			<a href="" class="exp inactive">
				<span>Quản Lí Loại thẻ</span>
				<strong>2</strong>
			</a>
			<ul class="sub" style="display: none;">
				<li>
					<a href="<?php echo admin_url('typecardchange') ?>">
						Quản Lí Đổi Thẻ
					</a>
				</li>
				<li>
					<a href="<?php echo admin_url('typecardbuy') ?>">
						Quản Lí Mua Thẻ
					</a>
				</li>
				<!-- <li>
					<a href="<?php echo admin_url('typecardget') ?>">
						Quản Lí Rút Về Ngân Hàng&chuyển khoản
					</a>
				</li> -->
				
				<!-- <li>
					<a href="<?php echo admin_url('catalog') ?>">
						Danh mục							
					</a>
				</li> -->
			</ul>
		</li>
		<li class="account">
			<a href="" class="exp inactive">
				<span>Quản Lý Tài khoản</span>
				<strong>3</strong>
			</a>
			
			<ul class="sub" style="display: none;">
				<li>
					<a href="<?php echo admin_url('admin')?>">
						Ban quản trị							
					</a>
				</li>
				<li>
					<a href="<?php echo admin_url('user')?>">
						Thành viên							
					</a>
				</li>
				<li>
					<a href="<?php echo admin_url('userlock')?>">
						Thành viên	bị khóa
					</a>
				</li>
			</ul>
						
		</li>
		<li class="content">
	
			<a href="" class="exp inactive">
				<span>Nội dung</span>
				<strong>1</strong>
			</a>
			
			<ul class="sub" style="display: none;">
				<li>
					<a href="<?php echo admin_url('info') ?>">
						Thông báo							
					</a>
				</li>
				<!-- <li>
					<a href="<?php echo admin_url('news') ?>">
						Tin tức							
					</a>
				</li> -->
				
			</ul>
					
		</li>

		<li class="content">
	
			<a href="" class="exp inactive">
				<span>HotLine</span>
				<strong>1</strong>
			</a>
			
			<ul class="sub" style="display: none;">
				<li>
					<a href="<?php echo admin_url('phone') ?>">
						Hotline							
					</a>
				</li>
			</ul>
					
		</li>
	
	</ul>
			
</div>
<div class="clear"></div>