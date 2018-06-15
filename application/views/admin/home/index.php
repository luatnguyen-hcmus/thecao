<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Bảng điều khiển</h5>
			<span>Trang quản lý hệ thống</span>
		</div>
		
		<div class="clear"></div>
	</div>
</div>
<div class="line"></div>
<div class="wrapper">
	
	<div class="widgets">
	     <!-- Stats -->
		
		<!-- Amount -->
		<div class="oneTwo">
			<div class="widget">
				<div class="title">
					<img src="<?php echo public_url('admin')?>/images/icons/dark/money.png" class="titleIcon">
					<h6>Doanh số</h6>
				</div>
				
				<table cellpadding="0" cellspacing="0" width="100%" class="sTable myTable">
					<tbody>
						
							<tr>
									<td class="fontB blue f13">Tổng doanh số nạp thẻ cào</td>
									<td class="textR webStatsLink red" style="width:120px;"><?=number_format($amount_total)?> đ</td>
							</tr>
						    
						    <tr>
									<td class="fontB blue f13">Tổng doanh số mua thẻ cào</td>
									<td class="textR webStatsLink red" style="width:120px;"><?=number_format($day_total)?> đ</td>
							</tr>
					</tbody>
				</table>
			</div>
		</div>


		<!-- User -->
		<div class="oneTwo">
			<div class="widget">
				<div class="title">
					<img src="<?php echo public_url('admin')?>/images/icons/dark/users.png" class="titleIcon">
					<h6>Thống kê dữ liệu</h6>
				</div>
				
				<table cellpadding="0" cellspacing="0" width="100%" class="sTable myTable">
					<tbody>
						
						<tr>
							<td>
								<div class="left">Tổng số gia dịch nạp thẻ</div>
								<div class="right f11"><a href="<?php echo admin_url('transaction/put')?>">Chi tiết</a></div>
							</td>
							<td class="textC webStatsLink">
								<?= $total_transaction1?>					
							</td>
						</tr>
						<tr>
							<td>
								<div class="left">Tổng số gia dịch rút tiền về ngân hàng</div>
								<div class="right f11"><a href="<?php echo admin_url('transaction/get_bank')?>">Chi tiết</a></div>
							</td>
							<td class="textC webStatsLink">
								<?= $total_transaction2?>					
							</td>
						</tr>
						<tr>
							<td>
								<div class="left">Tổng số gia dịch chuyển tiền cho thành viên</div>
								<div class="right f11"><a href="<?php echo admin_url('transaction/get_tcsr')?>">Chi tiết</a></div>
							</td>
							<td class="textC webStatsLink">
								<?= $total_transaction3?>					
							</td>
						</tr>
						<tr>
							<td>
								<div class="left">Tổng số gia dịch mua thẻ </div>
								<div class="right f11"><a href="<?php echo admin_url('transaction/buy')?>">Chi tiết</a></div>
							</td>
							
							<td class="textC webStatsLink">
								<?= $total_transaction4?>					
							</td>
						</tr>
						
						<!-- <tr>
							<td>
								<div class="left">Tổng số bài viết</div>
								<div class="right f11"><a href="<?php echo admin_url('news')?>">Chi tiết</a></div>
							</td>
							
							<td class="textC webStatsLink">
								<?= $total_new?>				
							</td>
						</tr> -->
						
						<tr>
							<td>
								<div class="left">Tổng số thành viên</div>
								<div class="right f11"><a href="<?php echo admin_url('user')?>">Chi tiết</a></div>
							</td>
							
							<td class="textC webStatsLink">
								<?= $total_user?>					
							</td>
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>

		<div class="clear"></div>
		
		<!-- Giao dich thanh cong gan day nhat -->
		<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách Tài Khoản</h6>
		 	<div class="num f12">Tổng số: <b><?=$total?></b></div>
		</div>
		
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
			<thead>
				<tr>
					<td style="width:10px;"><img src="<?php echo public_url('admin')?>/images/icons/tableArrows.png" /></td>
					<td style="width:80px;">Mã số</td>
					<td>Email</td>
					<td>User name</td>
					<td>số điện thoại</td>
					<td>Tình trạng</td>
					<td style="width:100px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot>
				<tr>
					<td colspan="7">
					     <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="user/del_all.html">
									<span style='color:white;'>Xóa hết</span>
								</a>
						 </div>
							
					     <div class='pagination'></div>
					</td>
				</tr>
			</tfoot>
 			
			<tbody>
				<!-- Filter -->
				<?php  foreach ($list as $row) :?>
				<tr>
						<td><input type="checkbox" name="id[]" value="<?=$row->id?>" /></td>
						
						<td class="textC"><?=$row->id?></td>
						
						
						<td><span title="<?=$row->name?>" class="tipS">
							<?=$row->email?>					</span></td>
						
						
						<td><span title="<?=$row->email?>" class="tipS">
							<?=$row->user_name?>						</span></td>

						<td><span title="<?=$row->phone?>" class="tipS">
							<?=$row->phone?>						</span></td>

						<td><span title="<?=$row->name?>" class="tipS">
							<?=$row->status==1?'hoạt động':'đang bị khóa'?>					
						</span></td>
						<td class="option">
							 <a href="<?php echo admin_url('user/edit/'.$row->id) ?>" title="Chỉnh sửa" class="tipS ">
							<img src="<?php echo public_url('admin')?>/images/icons/color/edit.png" />
							</a>
							<a href="<?php echo admin_url('user/lock/'.$row->id) ?>" title="Khóa tài khoản" class="tipS" >
							    <img src="<?php echo public_url('admin')?>/images/icons/dark/key.png" />
							</a>
						</td>
					</tr>					
				<?php endforeach ?>
			</tbody>
		</table>
	</div>

    </div>
	
</div>
<div class="clear mt30"></div>