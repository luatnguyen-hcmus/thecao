<?php 
	$this->load->view('admin/info/head', $this->data);
?>
<div class="line"></div>

<!-- Main content wrapper -->
<div class="wrapper" id="main_info">
	<div class="widget">
	
		<div class="title">
			<h6>
				Danh sách Thông Báo			</h6>
		 	<div class="num f12">Số lượng: <b><?php echo $total_rows?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			<thead>
				<tr>
					<td>Mã số</td>
					<td>Vị trí</td>
					<td>Nội dung</td>
					<td>Trạng thái</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			<tbody class="list_item">
				<?php foreach ($list as $row): ?>
				    <tr class='row_<?php echo $row->id ?>'>						
						<td class="textC"><?php echo $row->id?></td>
						<td>
							<a href="" class="tipS" title="" target="_blank">
								<b><?php echo $row->title?></b>
							</a>
							
						</td>


						<td class="textC"><?php echo $row->content ?></td>

						<td class="textC"><?= $row->status==1?'hiển thị':'không hiển thị' ?></td>
						<td class="option textC">
							<a href="<?php echo admin_url('info/edit/'.$row->id) ?>" title="Chỉnh sửa" class="tipS">
								<img src="<?php echo public_url('admin')?>/images/icons/color/edit.png" />
							</a>
							<a href="<?php echo admin_url('info/delete/'.$row->id) ?>" title="Xóa" class="tipS verify_action" >
							    <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png" />
							</a>
						</td>
					</tr>
				<?php endforeach ?>
		    </tbody>
		</table>
	</div>
</div>