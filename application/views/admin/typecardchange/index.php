<?php 
	$this->load->view('admin/typecardchange/head', $this->data);
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
			
			<thead class="filter"><tr><td colspan="9">
				<form class="list_filter form" action="<?php echo admin_url('typecardchange') ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item"><input name="id" value="<?php echo $this->input->get('id') ?>" id="filter_id" type="text" style="width:55px;" /></td>
							<td class="label" style="width:40px;"><label for="filter_id">Tên thẻ</label></td>
							<td class="item" style="width:155px;" ><input name="name" value="<?php echo $this->input->get('name')?>" id="filter_iname" type="text" style="width:155px;" /></td>
							<td style='width:150px'>
							<input type="submit" class="button blueB" value="Lọc" />
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('typecardchange') ?>'; ">
							</td>
							
						</tr>
					</tbody></table> 
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td><img src="<?php echo public_url('admin')?>/images/icons/tableArrows.png" /></td>
					<td>Mã số</td>
					<td>Tên thẻ</td>
					<td>Hình ảnh</td>
					<td>Thứ tự hiển thị</td>
					<td>Chiếc khấu</td>
					<td>Trạng thái</td>
					<td>Tình trạng</td>
					<td>Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="9">
						 <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('typecard/del_all')?>">
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
						<td>
							
							<a href="" class="tipS" title="" target="_blank">
								<b><?php echo $row->name?></b>
							</a>
							
						</td>
						<td class="textR">
							<div class="image_thumb">
								<img src="<?php echo base_url('upload/typecard/'.$row->image)?>" height="50">
								<div class="clear"></div>
							</div>
						</td>
						<td class="textC"><?php echo $row->sort_order?></td>
						<td class="textC">
							<?php foreach($row->subs as $subss):?>
								<b><?=$subss->hunress_change?> %</b>
							<?php endforeach?>
						 </td>
						<td class="textC">
							<?= $row->status_change==1?'Hiển thị':'Không hiển thị' ?>
						</td>
						<td class="textC">
							<?= $row->featured_change==1?'Hoạt động':'Bảo trì' ?>
						</td>
						<td class="option textC">
							<a href="<?php echo admin_url('typecardchange/edit/'.$row->id) ?>" title="Chỉnh sửa" class="tipS">
								<img src="<?php echo public_url('admin')?>/images/icons/color/edit.png" />
							</a>
							<a href="<?php echo admin_url('typecardchange/delete/'.$row->id) ?>" title="Xóa" class="tipS verify_action" >
							    <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png" />
							</a>
						</td>
					</tr>
				<?php endforeach ?>
		    </tbody>
		</table>
	</div>
</div>