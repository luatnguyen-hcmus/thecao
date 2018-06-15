<?php 
	$this->load->view('admin/transaction/headput', $this->data);
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
			
			<thead class="filter"><tr><td colspan="13">
				<form class="list_filter form" action="<?php echo admin_url('transaction/put') ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="100%"><tbody>
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item">
								<input name="id" value="<?php echo $this->input->get('id') ?>" id="filter_id" type="text" style="width:55px;" />
							</td>
							<td class="item">
								<input name="findcode" type="text" class="form-control border-input" value="<?php echo $this->input->get('findcode')?>" id="filter_iname" value="" placeholder="Mã thẻ">
							</td>
							<td class="item">
								<input name="findseri" type="text" class="form-control border-input" value="<?php echo $this->input->get('findseri')?>" id="filter_iname" value="" placeholder="Mã seri">
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
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('transaction/put') ?>'; ">
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
					<td style="width:60px;">username</td>
					<td style="width:60px;">Loại thẻ</td>
					<td style="width:60px;">Số seri</td>
					<td style="width:60px;">Số pin</td>
					<td style="width:60px;">Mệnh giá</td>
					<td style="width:60px;">Số dư cuối</td>
					<td>Số tiền nhận được</td>
					<td>Hình thức </td>
					<td>Trạng Thái</td>
					<td style="width:75px;">Ngày tạo</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="13">
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
						<td class="textC">
							<?php 
					            if($row->type == 1){echo 'VIETTEL';} 
					            else if($row->type == 2){echo 'VINAFONE';}
					            else if($row->type == 3){echo 'MOBIFONE';}
					            else if($row->type == 4){echo 'ZING';}
					            else if($row->type == 5){echo 'GATE';}
					            else if($row->type == 6){echo 'MEGACARD';}
					            else if($row->type == 7){echo 'BIT';}
					            else if($row->type == 8){echo 'VCOIN';}
				            ?>
						</td>
						<td class="textC"><?php echo $row->seri?></td>
						<td class="textC"><?php echo $row->pin?></td>
						<td class="textC">
							<?php 
					              if($row->cash == 1){echo number_format(10000);} 
					              else if($row->cash == 2){echo number_format(20000);}
					              else if($row->cash == 3){echo number_format(30000);}
					              else if($row->cash == 4){echo number_format(50000);}
					              else if($row->cash == 5){echo number_format(100000);}
					              else if($row->cash == 6){echo number_format(200000);}
					              else if($row->cash == 7){echo number_format(500000);}
					              else if($row->cash == 8){echo number_format(1000000);}
				            ?>
				            đ
						</td>
						<td class="textC">
							<?php 
								$user_id_login = $row->user_id;
								$this->load->model('user_model');
								$user_info = $this->user_model->get_info($user_id_login);
								if($user_info){
									echo number_format($user_info->bag)." vnđ ";
							}?>
						</td>
						<td>
							<?= number_format($row->amount)?> đ
						</td>
						<td>
							<?php 
								if($row->type_transaction == 1){
									echo 'Nạp thẻ';
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
									echo "Thất Bại";
								}
							 ?> 
						</td>
						
						<td class="textC"><?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date("Y-m-d H:i:s" , $row->created)?></td>

						<td class="option textC">
							<a href="<?php echo admin_url('transaction/process/'.$row->id)?>" title="Xử lí giao dịch thành công" class="tipE">
								<img src="<?php echo public_url('admin')?>/images/icons/color/star.png" />
							</a>

							<a href="<?php echo admin_url('transaction/process_error/'.$row->id) ?>" title="Xử lí giao dịch thất bại" class="tipE" >
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