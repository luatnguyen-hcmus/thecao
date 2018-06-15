<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('admin/head');?>
</head>
<body>
	<div id="left_content">
		<?php $this->load->view('admin/left');?>
	</div>
	<div id="rightSide" style="position: relative;">
		<?php $this->load->view('admin/header')?>
		<div style="position: absolute;top:30px;left:40px;">
			<?php if(isset($message)) : ?>
	  			<p style="color:red;"><b><?php echo $message; ?></b></p>
	  		<?php endif?>
	  	</div>
		<?php $this->load->view($temp, $this->data);?>
		<div id="footer">
			<?php $this->load->view('admin/footer')?>
		</div>
	</div>
	<div class="clear"></div>
</body>
</html>