<?php 
	$this->load->view('admin/user/head', $this->data);
?>
	<div class="line"></div>
	<div class="wrapper">
	<div class="widget">
	
		<div class="title">
			
			<h6>Danh sách Tài Khoản</h6>
		 	<div class="num f12">Tổng số: <b><?=$total?></b></div>
		</div>
		
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
			<thead class="filter"><tr><td colspan="13">
				<form class="list_filter form" action="<?php echo admin_url('user') ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item">
								<input name="id" value="<?php echo $this->input->get('id') ?>" id="filter_id" type="text" style="width:55px;" />
							</td>
							<td class="item">
								<input name="findemail" type="text" class="form-control border-input" value="<?php echo $this->input->get('findemail')?>" id="filter_email" value="" placeholder="Email">
							</td>
							<td class="item">
								<input name="findusername" type="text" class="form-control border-input" value="<?php echo $this->input->get('findusername')?>" id="filter_username" value="" placeholder="Username">
							</td>
							<td class="item">
								<select class="form-control border-input" name="findstatus">
						    		<option value="">Tình trạng</option>
							    		<option value="'0'">Bị Khóa</option>
							    		<option value="1">Đang hoạt động</option>
								</select>
							</td>	
							<td style='width:150px'>
							<input type="submit" class="button blueB" value="Lọc" />
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('user') ?>'; ">
							</td>
							
						</tr>
					</tbody></table> 
				</form>
			</td></tr></thead>
			<thead>
				<tr>
					
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
							
					     <div class='pagination'></div>
					</td>
				</tr>
			</tfoot>
 			
			<tbody>
				<!-- Filter -->
				<?php  foreach ($list as $row) :?>
				<tr>
						
						
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
<div class="clear mt30"></div>
