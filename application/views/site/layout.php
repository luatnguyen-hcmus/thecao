<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('site/head.php');?>
	</head>
	<!-- <body onkeydown="return false"> -->
	<body>
        <div class="navbar-default navbar-fixed-top">
            <!-- the header -->
	      	<?php $this->load->view('site/header.php');?>
		</div>
		<div id="banner" class="container" style="width:100%;margin:0 auto;margin-top:30px">
			<img width="100%" src="<?php echo public_url('site/images/banner.jpg')?>"/>
		</div>
  		<?php if(isset($message)) : ?>
  			<!-- <p style="color:red;"><?php echo $message; ?></p> -->
  			<p style="color:red;"><?php echo "<script>alert('$message');</script>"; ?></p>
  		<?php endif?>
  		<?php $this->load->view($temp, $this->data);?>
  		<div class="footer">
		   	<?php $this->load->view('site/footer.php');?>
		</div>
	</body>
</html>