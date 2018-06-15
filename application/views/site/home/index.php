<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12">
<p style="width:100%;float:left;">  
<span id='tb' style="color:red; width:10%;float:left;position: relative;font-weight: bold;">
    <b style="font-size:35px;position: absolute;top:5px;left:-10px;border-top:5px solid transparent;border-bottom:5px solid transparent;border-left:7px solid red;">
     </b> THÔNG BÁO:</span>   
<marquee id='tbcontent' direction="left" style="width:90%;float:left;">
    <span style="color:blue;"><?=$info_top->content?></span>
</marquee>
</p>
</div>  
<div id="dtc" class="col-sm-7 col-md-7" style="width:57%;background: #f5f5f5; border:1px solid #ccc;padding:0px;margin-right:2%;">
<div role="tabpanel" >

<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"  style="text-align:center;">
    <a href="#nap-the" aria-controls="nap-the" role="tab" data-toggle="tab">
        <h3 style="color:#333;padding:0px;">Đổi thẻ cào</h3>
    </a>
</li>

</ul>
<div class="tab-content">

<div role="tabpanel" class="tab-pane active fade in" id="nap-the">
<form  name="fcash" method="POST" role="form" novalidate="">



<div class="row"><div style="margin-left: 15px;">
  

<ul class="card">
<?php foreach($card_list as $cl):?>
    <li class="thumbnail cate_card<?=$cl->id?>" style= "height:40px;" onclick="Click_image(<?=$cl->id?>)">
        <input id="card_<?=$cl->id?>" name="card_type_id" type="radio" value="<?=$cl->id?>" style="display: none;"/>
        <img src="<?php echo base_url('upload/typecard/'.$cl->image) ?>" class="img_card_click" title=""  style="background:transparent;overflow: hidden;border:1px double blue;width:83px; height:32px;">
    </li> 
<?php endforeach?>

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
        <?php foreach($cash_card as $cs):?>
        <option value="<?=$cs->id?>"><?=number_format($cs->cash)?> đ</option>
        <?php endforeach ?>
        </select>
        <div class="error"><?php echo form_error('cash')?></div>
</div>

<div class="form-group">
<label class="control-label" for="pin">Mã thẻ</label>
<input type="number" name="pin" id="pin" value="<?php echo set_value('pin') ?>" autocomplete="off" class="form-control pin" placeholder="Vui lòng nhập đúng và đủ mã số thẻ!">

<?php foreach($card_list as $cl):?>
    <input type="<?php if($cl->name == 'ZING') echo 'text'; else echo 'number' ?>" style="display: none;" onchange="valuess_code(this.value)" value="<?php echo set_value('pin') ?>" autocomplete="off" class="form-control pin pin_<?=$cl->id?>" placeholder="<?php if($cl->min_code == $cl->max_code){echo 'Nhập mã số sau lớp bạc mỏng, Mã thẻ '.$cl->min_code.' kí tự';}else{echo 'Nhập mã số sau lớp bạc mỏng, Mã thẻ '.$cl->min_code.' hoặc '.$cl->max_code.' kí tự';}
        ?>">
<?php endforeach ?>

<div class="error"><?php echo form_error('pin')?></div>
</div>

<div class="form-group">
<label class="control-label" for="seri">Số seri</label>
<input type="number" name="seri" id="seri"  value="<?php echo set_value('seri') ?>" autocomplete="off" class="form-control seri" placeholder="Vui lòng nhập đúng và đủ mã số seri!">
<?php foreach($card_list as $cl):?>
<input type="<?php if($cl->name == 'ZING' || $cl->name == 'GATE') echo 'text'; else echo 'number' ?>"  style="display: none;" onchange="valuess_seri(this.value)" value="<?php echo set_value('seri') ?>" autocomplete="off" class="form-control seri seri_<?=$cl->id?>" placeholder="<?php if($cl->min_seri == $cl->max_seri){echo 'Nhập mã serial nằm sau thẻ, Seri thẻ '.$cl->min_seri.' kí tự';}else{echo 'Nhập mã serial nằm sau thẻ, Seri thẻ '.$cl->min_seri.' hoặc '.$cl->max_seri.' kí tự';}
        ?>">
<?php endforeach ?>
<div class="error"><?php echo form_error('seri')?></div>
</div>

<!-- <div class="form-group">
<label class="control-label" for="kieu">Kiểu nạp</label>
    <select class="form-control" name="kieu">
    <option>Chọn kiểu nạp</option>
    <option value="1">Xử lý nhanh</option>
    <option value="2">Xử lý chậm</option>
    </select>
    <div class="error"><?php echo form_error('kieu')?></div>
</div> -->

<input type="hidden" name="pin" id="pinn" />
<input type="hidden" name="seri" id="serii" />
    
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


<div id="chieckhau" class="col-sm-4 col-md-4" style="width:41%;background: #f5f5f5;border:1px solid #ccc;text-align: center;">
    <div class="table-responsive">  

      <table class="table">
        <thead>
        <tr>
            <h3 style="color:#333;padding:5px;background-color:#fff;">Phí đổi thẻ </h3>
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
            <b><?=$hr->name?></b>
        </td>
        <td>
            <?php 
                if($hr->featured_change == 1)
                {
                    echo "<span style='padding:1px; border-radius:5px;' class='btn-success'>Hoạt động</span>";
                }
                else if($hr->featured_change == 0){echo "<span style='padding:1px; border-radius:5px;' class='btn-warning'>Bảo trì</span>";}
            ?>
        </td>

        <?php foreach($hr->subs as $sub) :?>
            <td>
                <b style='color:blue;'><?=$sub->hunress_change?>%</b>
            </td>
        <?php endforeach?>
        
        </tr>
        <?php endforeach ?>

        
             
        </tbody>
      </table>
      </div> 


</div>


<div id="tbbottom" class="col-sm-4 col-md-4" style="width:41%;background: #f5f5f5;border:1px solid #ccc;text-align: center; margin-top:10px">
    <div class="table-responsive"> 
        <span style="color:red;float:left;">THÔNG BÁO:</span> <br/>
        <p><?=$info_change->content?></p>
    </div> 
</div>
</div>
</div>
<style type="text/css">
    .navbar-default{
        background:#fff !important;
    }
    table th{
        color: #000;
    }
    table td{
        color: #000;
    }
    table td p{
        color: #000;
    }
    .nav-tabs>li {
         float: none !important; 
         margin-bottom: 0px; 
    }
    ul li.thumbnail{
        border:none !important;
    }

    .actives{
        box-shadow: 0 0 0.45em 0.45em #eb8932;
        background-color: #eb8932;
    }
    input[type="number"] {
        -moz-appearance: textfield !important;
        appearance: none !important;
        -webkit-appearance: none !important;
    }
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    .hidee{
        display:none;
    }
    .showw{
        display:block !important;
    }
</style>

<script type="text/javascript">
    function Click_image(id){
        $('ul li').removeClass('actives');
        document.getElementById("card_"+id).checked = true;
        $('ul li.cate_card'+id).addClass('actives');


        $('#pin').addClass('hide');
        $('.pin').removeClass('showw');
        $('.pin.pin_'+id).addClass('showw');

        $('#seri').addClass('hide');
        $('.seri').removeClass('showw');
        $('.seri.seri_'+id).addClass('showw');
    }

    function valuess_code(vall){
        $('#pinn').val(vall);
    }
    function valuess_seri(vall){
        $('#serii').val(vall);
    }
</script>