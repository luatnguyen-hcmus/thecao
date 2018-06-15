<?php 
	$this->load->view('admin/transaction/headtcsr', $this->data);
?>
<div class="line"></div>

<!-- Main content wrapper -->
<div class="wrapper" id="main_transaction">
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>
				Danh sách giao dịch			</h6>
		 	<div class="num f12">Số lượng: <b><?php echo $total_rows?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			
			<thead class="filter"><tr><td colspan="12">
				<form class="list_filter form" action="<?php echo admin_url('transaction/get_tcsr') ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item"><input name="id" value="<?php echo $this->input->get('id') ?>" id="filter_id" type="text" style="width:55px;" /></td>
							<td style='width:150px'>
							<input type="submit" class="button blueB" value="Lọc" />
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('transaction/get_tcsr') ?>'; ">
							</td>
							
						</tr>
					</tbody></table> 
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin')?>/images/icons/tableArrows.png" /></td>
					<td style="width:60px;">Mã số</td>
					<td style="width:60px;">Username</td>
					<td style="width:60px;">Tài khoản nhận</td>
					<td style="width:60px;">Số dư cuối</td>
					<td>Số tiền rút</td>
					<td>Hình thức </td>
					<td>Trạng Thái</td>
					<td style="width:75px;">Ngày tạo</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="12">
						 <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('transaction/del_all')?>">
									<span style='color:white;'>Xóa hết</span>
								</a>
						 </div>
							
					    <div class='pagination'>
					    	<?php echo $this->pagination->create_links() ?>
						</div>
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item">
				<?php foreach ($list as $row): ?>
				    <tr class='row_<?php echo $row->id ?>'>
						<td><input type="checkbox" name="id[]" value="<?php echo $row->id?>" /></td>
						<td class="textC"><?php echo $row->id?></td>
						<td class="textC">
							<?php 
								$user_id_login = $row->user_id;
								$this->load->model('user_model');
								$user_info = $this->user_model->get_info($user_id_login);
								if($user_info){
									echo $user_info->user_name;
							}?>
						</td>
						<td class="textC"><?=$row->name_bank ?></td>
						<td class="textC">
							<?php 
								$user_id_login = $row->user_id;
								$this->load->model('user_model');
								$user_info = $this->user_model->get_info($user_id_login);
								if($user_info){
									echo number_format($user_info->bag)." đ ";
							}?>
						</td>
						<td>
							<?= number_format($row->current)?> đ
						</td>
						<td>
							<?php 
								if($row->type_transaction == 3){
									echo 'Rút tiền về tcsr';
								}
							?>
						</td>

						<td>
							<?php 
								if($row->status == 0){
									echo "Chờ duyệt";
								}else if($row->status == 1){
									echo "Thành công";
								}else{
									echo "Bị hủy";
								}
							 ?> 
						</td>
						
						<td class="textC"><?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date("Y-m-d H:i:s" , $row->created)?></td>

						<td class="option textC">
							<a href="<?php echo admin_url('transaction/view/'.$row->id)?>" title="Xem chi tiết giao dịch" class="tipE">
								<img src="<?php echo public_url('admin')?>/images/icons/color/star.png" />
							</a>

							<a href="<?php echo admin_url('transaction/del/'.$row->id) ?>" title="Xóa" class="tipS verify_action" >
							    <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png" />
							</a>
						</td>
					</tr>
				<?php endforeach ?>
		    </tbody>
		</table>
	</div>
</div>