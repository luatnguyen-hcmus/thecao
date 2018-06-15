<?php 
	$this->load->view('admin/transaction/headbank', $this->data);
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
			
			<thead class="filter"><tr><td colspan="14">
				<form class="list_filter form" action="<?php echo admin_url('transaction/get_bank') ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="100%"><tbody>
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item">
								<input name="id" value="<?php echo $this->input->get('id') ?>" id="filter_id" type="text" style="width:55px;" />
							</td>
							<td class="item">
								<input name="stk" type="text" class="form-control border-input" value="<?php echo $this->input->get('stk')?>" id="filter_iname" value="" placeholder="Số tài khoản">
							</td>
							<td class="item">
								<input name="sothe" type="text" class="form-control border-input" value="<?php echo $this->input->get('sothe')?>" id="filter_iname" value="" placeholder="Số thẻ">
							</td>
							<td class="item">
								<select class="form-control border-input" name="findstatus">
						    		<option value="">Trạng thái</option>
							    		<option value="'0'">Chờ Duỵêt</option>
							    		<option value="1">Thành công</option>
							        	<option value="2">Thất Bại</option>
								</select>
							</td>
							<td style="position: relative;">
							    <div class="input-append date" id="dp3" data-date="" data-date-format="yyyy-mm-dd">
							        <input value="<?php echo $this->input->get('findday')?>" class="form-control border-input" size="16" type="text" id="timeCheckInback" name="findday"  value="" placeholder="Từ ngày" readonly>
							        <span class="add-on"><i class="icon-th"></i></span>
							    </div>
							</td>
							<td style="position: relative;">
							    <div class="input-append date" id="dp4" data-date="" data-date-format="yyyy-mm-dd">
							        <input value="<?php echo $this->input->get('finddayout')?>" class="form-control border-input" size="16" type="text" id="timeCheckOutback" name="finddayout"  value="" placeholder="Đến ngày" readonly>
							        <span class="add-on"><i class="icon-th"></i></span>
							    </div>
							</td>
							<td style='width:150px'>
							<input type="submit" class="button blueB" value="Lọc" />
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('transaction/get_bank') ?>'; ">
							</td>
							<td class="label" style="width:200px;"><label for="filter_id">Tổng tiền giao dịch:<?= number_format($amount_total1)?> vnđ</label></td>
						</tr>
					</tbody></table> 
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin')?>/images/icons/tableArrows.png" /></td>
					<td style="width:60px;">Mã số</td>
					<td style="width:60px;">Username</td>
					<td style="width:60px;">Số tài khoản</td>
					<td style="width:60px;">Số thẻ</td>
					<td style="width:60px;">Tên chủ thẻ</td>
					<td style="width:60px;">Ngân hàng</td>
					<td style="width:60px;">Chi nhánh</td>
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
					<td colspan="14">
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
						<td class="textC"><?=$row->code_bank ?></td>
						<td class="textC"><?php echo $row->code_open?></td>
						<td class="textC"><?php echo $row->name_bank?></td>
						<td class="textC">
							<?php 
								if($row->type_bank == 1){
									echo "VIETCOMBANK";
								}
								else if($row->type_bank == 2){
									echo "VIETINBANK";
								}
								else if($row->type_bank == 3){
									echo "AGRIBANK";
								}
								else if($row->type_bank == 4){
									echo "BIDV";
								}
								else{
									echo $row->type_bank;
								}
							?>
								
						</td>
						<td class="textC">
							<?=$row->type_place?>
						</td>
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
								if($row->type_transaction == 2){
									echo 'Rút tiền về ngân hàng';
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
									echo "Thất bại";
								}
							 ?> 
						</td>
						
						<td class="textC"><?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date("Y-m-d H:i:s" , $row->created)?></td>

						<td class="option textC">
							<a href="<?php echo admin_url('transaction/process_bank/'.$row->id)?>" title="Xử lí giao dịch thành công" class="tipE">
								<img src="<?php echo public_url('admin')?>/images/icons/color/star.png" />
							</a>

							<a href="<?php echo admin_url('transaction/process_error_bank/'.$row->id) ?>" title="Xử lí giao dịch thất bại" class="tipS" >
							    <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png" />
							</a>
						</td>
					</tr>
				<?php endforeach ?>
		    </tbody>
		</table>
	</div>
</div>

<script>
    $(function(){
      $('#dp3').datepicker()
        .on('changeDate', function(ev){
          $('#timeCheckInback').val();
          $('#dp3').datepicker('hide');
        });      
      $('#dp4').datepicker()
        .on('changeDate', function(ev){
          $('#timeCheckOutback').val();
          $('#dp4').datepicker('hide');
        });     
    });
  </script>
  <style type="text/css">
  	.datepicker.datepicker-dropdown.dropdown-menu{
  		position: absolute;
  		display: block;
	    top: 240px !important;
	    left: 830px !important;
  		background: white;
  		display: none;
  	}
  	table thead td span{
  		display: none;
  	}
  </style>