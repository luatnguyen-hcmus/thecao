<div class="topNav">
	<div class="wrapper">
		<div class="welcome">
			<?php if(isset($admin_info)) : ?>
				<span>Xin chào: <b><?php echo ($admin_info->name)?></b></span>
			<?php endif?>
		</div>
		
		<div class="userNav">
			<ul>
				<li><a href="<?php echo admin_url('transaction/put?findstatus=%270%27') ?>">
					<img  id="napthei" style="display: block; margin-top:0px;" src="<?php echo public_url()?>/admin/images/icons/middlenav/messages.png">

					<span id="napthe" style="display: block;"><?=$total_transaction_get?></span>
					<input type="hidden" id="napthehide"/>
					<span>Nạp Thẻ</span>
				</a></li>

				<audio id="myAudio">
					<source src="<?php echo public_url()?>/admin/audio/message.mp3" type="audio/mpeg">
				</audio>

				<li>
					<a href="<?php echo admin_url('transaction/get_bank?findstatus=%270%27') ?>">
						<img id="get_banki" style="display: block; margin-top:0px;" src="<?php echo public_url()?>/admin/images/icons/middlenav/messages.png">
						<span id="get_bank" style="display: block;"><?=$total_transaction_bank?></span>
						<input type="hidden" id="nghanghide"/>
						<span>Rút Về Ngân Hàng</span>
					</a>
				</li>
				<li><a href="<?php echo admin_url() ?>">
					<img style="margin-top:7px;" src="<?php echo public_url()?>/admin/images/icons/light/home.png">
					<span>Trang chủ</span>
				</a></li>
				
				<!-- Logout -->
				<li><a href="<?php echo admin_url('home/logout') ?>">
					<img src="<?php echo public_url()?>/admin/images/icons/topnav/logout.png" alt="">
					<span>Đăng xuất</span>
				</a></li>
				
			</ul>
		</div>
		
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
	$('#napthehide').val($('#napthe').html());
	$('#nghanghide').val($('#get_bank').html());

	function loadput(){
		$.ajax({
            url:"<?php echo admin_url(); ?>/transaction/napthe",
            method:"GET",
            success:function(data){
                $('#napthe').html(data);
            }
        });
	}
	setInterval(loadput,10000);

	function loadaudioput(){
		var x = document.getElementById("myAudio"); 
		if(parseInt($('#napthe').html()) > 0){
			x.play();
		}
	}

	function loadputhehide(){
		var nt = $('#napthe').html();
		var nthide = $('#napthehide').val();
		if(nt > nthide){
			loadaudioput();
			$('#napthehide').val($('#napthe').html());
		}
	}
	setInterval(loadputhehide,6000);

	function loadput1(){
		if($('#napthe').html() >= $('#napthehide').val() && $('#napthe').html() > 0){
			document.getElementById('napthei').style.background = document.getElementById('napthei').style.background == "red"?"yellow":"red";
			document.getElementById('napthei').style.width = document.getElementById('napthei').style.width == "30px"?"40px":"30px";
			document.getElementById('napthei').style.transition = "all 500ms linear";
		}
	}
	setInterval(loadput1,5000);





	function loadbank(){
		$.ajax({
            url:"<?php echo admin_url(); ?>/transaction/rutvenh",
            method:"GET",
            success:function(data){
                $('#get_bank').html(data);
            }
        });
	}
	setInterval(loadbank,15000);

	function loadaudiobank(){
		var x = document.getElementById("myAudio"); 
		if(parseInt($('#get_bank').html()) > 0){
			x.play();
		}
	}

	function loadbankhide(){
		var nt = $('#get_bank').html();
		var nthide = $('#nghanghide').val();
		if(nt > nthide){
			loadaudiobank();
			$('#nghanghide').val($('#get_bank').html());
		}
	}
	setInterval(loadbankhide,10000);

	function loadbank1(){
		if($('#get_bank').html() >= $('#nghanghide').val() && $('#get_bank').html() > 0){
			document.getElementById('get_banki').style.background = document.getElementById('get_banki').style.background == "blue"?"green":"blue";
			document.getElementById('get_banki').style.width = document.getElementById('get_banki').style.width == "30px"?"40px":"30px";
			document.getElementById('get_banki').style.transition = "all 500ms linear";
		}
	}
	setInterval(loadbank1,5000);
	
</script>



