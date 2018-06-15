<?php 
	$this->load->view('admin/history_paycard/head', $this->data);
?>
<div class="line"></div>

<!-- Main content wrapper -->
<div class="wrapper" id="main_typecard">
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>
				Danh sách thẻ			</h6>
		 	<div class="num f12">Số lượng: <b><?php echo $total_rows?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			
			<thead class="filter"><tr><td colspan="12">
				<form class="list_filter form" action="<?php echo admin_url('transaction/pay_card/'.$segment = $this->uri->segment(4)) ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item"><input name="id" value="<?php echo $this->input->get('id') ?>" id="filter_id" type="text" style="width:55px;" /></td>
							<td class="label" style="width:40px;"><label for="filter_id">Tên thẻ</label></td>
							<td class="item" style="width:155px;" ><input name="name" value="<?php echo $this->input->get('name')?>" id="filter_iname" type="text" style="width:155px;" /></td>
							<td style='width:150px'>
							<input type="submit" class="button blueB" value="Lọc" />
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('transaction/pay_card'.$segment = $this->uri->segment(4)) ?>'; ">
							</td>
						</tr>
					</tbody></table> 
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td>Mã số</td>
					<td>Username</td>
					<td>Loại thẻ</td>
					<td>Mệnh giá</td>
					<td>Seri</td>
					<td>Mã thẻ</td>
					<td>Facebook</td>
					<td>Số điện thoại</td>
					<td>Trạng Thái</td>
					<td>Ngày tạo</td>
					<td>Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="12">
					    <div class='pagination'>
					    	<?php echo $this->pagination->create_links() ?>
						</div>
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item">
				<?php foreach ($list as $row): ?>
				    <tr class='row_<?php echo $row->id ?>'>
						
						<td class="textC"><?php echo $row->id?></td>
						<td>
							<a href="" class="tipS" title="" target="_blank">
								<b><?=$user->user_name?></b>
							</a>
						</td>
						<td class="text-center">
				            <?php 
				              if($transaction->type == 1){echo 'VIETTEL';} 
				              else if($transaction->type == 2){echo 'VINAFONE';}
				              else if($transaction->type == 3){echo 'MOBIFONE';}
				              else if($transaction->type == 4){echo 'ZING';}
				              else if($transaction->type == 5){echo 'GATE';}
				              else if($transaction->type == 6){echo 'MEGACARD';}
				              else if($transaction->type == 7){echo 'BIT';}
				              else if($transaction->type == 8){echo 'VCOIN';}
				            ?>
				          </td>
						<td class="text-center">
				            <?php 
				              if($transaction->cash == 1){echo 10000;} 
				              else if($transaction->cash == 2){echo 20000;}
				              else if($transaction->cash == 3){echo 30000;}
				              else if($transaction->cash == 4){echo 50000;}
				              else if($transaction->cash == 5){echo 100000;}
				              else if($transaction->cash == 6){echo 200000;}
				              else if($transaction->cash == 7){echo 500000;}
				              else if($transaction->cash == 8){echo 1000000;}
				            ?>
				            đ
				        </td>
						<td class="textC">
							<?=$row->seri?>
						 </td>
						 <td class="textC">
							<?=$row->code?>
						 </td>
						 <td class="textC">
							<?=$transaction->fb?>
						 </td>
						 <td class="textC">
							<?=$transaction->phone?>
						 </td>
						<td class="textC">
							<?= $row->status==1?'Thành Công':'Thất Bại'?>
						</td>
						<td class="textC">
							<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date("Y-m-d H:i:s" , $row->created)?>
						</td>
						<td class="option textC">
							<a href="<?php echo admin_url('pay_card/edit/'.$row->id.'?ids='.$segment = $this->uri->segment(4)) ?>" title="Chỉnh sửa" class="tipS">
								<img src="<?php echo public_url('admin')?>/images/icons/color/edit.png" />
							</a>
							<a href="<?php echo admin_url('pay_card/delete/'.$row->id) ?>" title="Xóa" class="tipS verify_action" >
							    <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png" />
							</a>
						</td>
					</tr>
				<?php endforeach ?>
		    </tbody>
		</table>
	</div>
</div>