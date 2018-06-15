<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12">
<p>    
<marquee direction="left"><span style="color:red">THÔNG BÁO:</span> <span style="color:blue">HỆ THỐNG HOẠT ĐỘNG BÌNH THƯỜNG. CÁC NHÀ MẠNG ĐỀU ỔN ĐỊNH. DUYỆT THẺ TỐC ĐỘ SIÊU TỐC  !!!</span></marquee>
</p>
</div>  
<div class="col-sm-7 col-md-7" style="border:1px solid #ccc;padding:5px;margin-right:5%;">
<div role="tabpanel">

<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#nap-the" aria-controls="nap-the" role="tab" data-toggle="tab">Nạp thẻ cào</a></li>
<li role="presentation"><a href="#bang-gia" aria-controls="bang-gia" role="tab" data-toggle="tab">Bảng giá</a></li>
</ul>
<div class="tab-content">

<div role="tabpanel" class="tab-pane active fade in" id="nap-the">
<form id="fcash" name="fcash" method="POST" role="form" novalidate="">



<div class="row"><div style="margin-left: 15px;">
  

<ul class="card">
    
<li class="thumbnail" id="vt">
    <input id="vtcard" name="card_type_id" type="radio" />
    <img src="<?php echo public_url('site/images/') ?>viettel.png" class="img_card_click" title="Chiếc khấu 40%">
</li>
    
<li class="thumbnail" id="vn">
    <input id="vncard" name="card_type_id" type="radio"/>
<img src="<?php echo public_url('site/images/') ?>vinaphone.png" class="img_card_click" title="Chiếc khấu 35%">

</li>
    
<li class="thumbnail" id="mb">
    <input id="mbcard" name="card_type_id" type="radio"/>
<img src="<?php echo public_url('site/images/') ?>mobiphone.png" class="img_card_click" title="Chiếc khấu 40%">

</li>
    
<li class="thumbnail" id="zing">
    <input id="zingcard" name="card_type_id" type="radio"/>
<img src="<?php echo public_url('site/images/') ?>zing.png" class="img_card_click" title="Chiếc khấu 40%">

</li>
    
<li class="thumbnail" id="gate">
    <input id="gatecard" name="card_type_id" type="radio"/>
<img src="<?php echo public_url('site/images/') ?>gate.png" class="img_card_click" title="Chiếc khấu 50%">

</li>
    
<li class="thumbnail" id="mega">
    <input id="megacard" name="card_type_id" type="radio"/>
<img src="<?php echo public_url('site/images/') ?>megacard.png" class="img_card_click" title="Chiếc khấu 35%">

</li>
    
<li class="thumbnail" id="bit">
    <input id="bitcard" name="card_type_id" type="radio"/>
<img src="<?php echo public_url('site/images/') ?>bit.png" class="img_card_click" title="Chiếc khấu 50%">

</li>
    
<li class="thumbnail" id="vcoin">
    <input id="vcoincard" name="card_type_id" type="radio"/>
<img src="<?php echo public_url('site/images/') ?>vcoin.jpg" class="img_card_click" title="Chiếc khấu 40%">

</li>
<div class="error"><?php echo form_error('card_type_id')?></div>
</ul>
</div>
</div>

<div class="form-group">
<div class="col-md-offset-4 col-md-8">
<div class="msg_success" id="msg_success_napthe"></div>
<div class="msg_err" id="msg_err_napthe"></div>
</div>
</div>

<div class="form-group">
<label class="control-label" for="pin">Mệnh giá</label>
    <select class="form-control" name="cash">
    <option>Chọn mệnh giá</option>
        <option value="1">10.000đ</option>
        <option value="2">20.000đ</option>
        <option value="3">30.000đ</option>
        <option value="4">50.000đ</option>
        <option value="5">100.000đ</option>
        <option value="6">200.000đ</option>
        <option value="7">500.000đ</option>
        <option value="8">1.000.000đ</option>
        </select>
        <div class="error"><?php echo form_error('cash')?></div>
</div>

<div class="form-group">
<label class="control-label" for="pin">Mã thẻ</label>
<input type="text" id="pin" name="pin" value="<?php echo set_value('pin') ?>" autocomplete="off" class="form-control">
<div class="error"><?php echo form_error('pin')?></div>
</div>

<div class="form-group">
<label class="control-label" for="seri">Số seri</label>
<input type="text" id="seri" name="seri" value="<?php echo set_value('seri') ?>" autocomplete="off" class="form-control">
<div class="error"><?php echo form_error('seri')?></div>
</div>

<div class="form-group">
<label class="control-label" for="kieu">Kiểu nạp</label>
    <select class="form-control" name="kieu">
    <option>Chọn kiểu nạp</option>
    <option value="1">Xử lý nhanh</option>
    <option value="2">Xử lý chậm</option>
    </select>
    <div class="error"><?php echo form_error('kieu')?></div>
</div>


    
<div class="form-group" id="btn-nap">
<label class="control-label sr-only"></label>
<input type="submit" class="btn btn-success btn-block" value="Nạp tài khoản">
</div>
</form><hr>

    

</div>
<div role="tabpanel" class="tab-pane fade in" id="bang-gia">
 
</div>
</div>

</div>
</div>


<div class="col-sm-4 col-md-4" style="border:1px solid #ccc;">
    <div class="table-responsive">  

      <table class="table">
        <thead>
        <tr>
            <h3 style="color:blue;padding:5px;">Phí đổi thẻ </h3>
        </tr>
          <tr>
            <th>Nhà Mạng</th>
            <th>Trạng Thái</th>
            <th>Chiếc khấu </th>
          </tr>
        </thead>
        <tbody>
           
        <?php $i=0; foreach($typecard as $hr) : $i++;?>
        <tr class="text-center">
        
        <td>
            <?php 
                if($hr->cate_card == 1){echo 'VIETTEL';} 
                else if($hr->cate_card == 2){echo 'VINAFONE';}
                else if($hr->cate_card == 3){echo 'MOBIFONE';}
                else if($hr->cate_card == 4){echo 'ZING';}
                else if($hr->cate_card == 5){echo 'GATE';}
                else if($hr->cate_card == 6){echo 'MEGACARD';}
                else if($hr->cate_card == 7){echo 'BIT';}
                else if($hr->cate_card == 8){echo 'VCOIN';}
            ?>
        </td>
        <td>
            <?php 
                if($hr->status == 1)
                {
                    echo "<span class='btn btn-success'>Hoạt động</span>";
                }
                else if($hr->status == 0){echo "<span class='btn tbn-warning'>Bảo trì</span>";}
            ?>
        </td>

        <?php foreach($hr->subs as $sub) :?>
            <td>
                <b><?=$sub->hunress_slow?>%</b>
            </td>
        <?php endforeach?>
        
        </tr>
        <?php endforeach ?>

        
             
        </tbody>
      </table>
      </div> 
</div>
</div>
</div>
<style type="text/css">
    table th{
        color: #000;
    }
    table td{
        color: #000;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $("#vt").click(function(){
            $('#vtcard').val(1);
            $('#vtcard').attr("checked",true);
        });
    });
</script>