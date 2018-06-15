<!-- Title area -->
<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Trả Thẻ</h5>
			<span>Quản Lý Trả Thẻ</span>
		</div>
		
		<div class="horControlB menu_action">
			<ul>
				<?php 
					$segment = $this->uri->segment(4);
				?>
				<li><a href="<?php echo admin_url('pay_card/add/'.$segment.'') ?>">
					<img src="<?php echo public_url('admin')?>/images/icons/control/16/add.png" />
					<span>Thêm mới</span>
				</a></li>
				
				
				<li><a href="<?php echo admin_url('transaction/pay_card/'.$segment.'/') ?>">
					<img src="<?php echo public_url('admin')?>/images/icons/control/16/list.png" />
					<span>Danh sách</span>
				</a></li>
			</ul>
		</div>
		
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
(function($)
{
	$(document).ready(function()
	{
		var main = $('#form');
		
		// Tabs
		main.contentTabs();
	});
})(jQuery);
</script>