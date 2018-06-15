




    
<div class="container">
<div class="page-header">
<h3>ĐẶT MUA THẺ CÀO</h3>
</div>
<div class="row">

<div class="col-sm-8 col-md-8" style="height: 500px;">

<div role="tabpanel" >

<ul class="nav nav-tabs" role="tablist">

    <li role="presentation" class="active"><a href="#nap-the" aria-controls="nap-the" role="tab" data-toggle="tab">Đặt thẻ</a></li>
    <li role="presentation"><a href="#bang-gia" aria-controls="bang-gia" role="tab" data-toggle="tab">Lịch sử trả thẻ</a></li>
</ul>
<div class="tab-content">

<div role="tabpanel" class="tab-pane active fade in" id="nap-the">

<form id="fmuathe" name="fmuathe" method="POST" role="form" novalidate="">
    
<div class="form-group">
<div class="col-md-offset-4 col-md-8">
<div class="msg_success" id="msg_success_muathe"></div>
<div class="msg_err" id="msg_err_muathe"></div>
</div>
</div>

<div class="form-group">
<label class="control-label" for="card_type_id">Loại thẻ</label>
    <select class="form-control" name="card_type_id">
        <option>Chọn loại thẻ</option>
        <?php foreach($typecard as $hr):?>
            <option value="<?=$hr->id?>"><?=$hr->name?></option>
        <?php endforeach?>
    </select>
    <div class="error"><?php echo form_error('card_type_id')?></div>
</div>
<div class="form-group">
<label class="control-label" for="cash">Mệnh giá</label>
    <select class="form-control" name="cash" id="cash">
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
<label class="control-label" for="fb">Link facebook</label>
<input type="text" id="fb" value="<?php echo set_value('fb') ?>" name="fb" autocomplete="off" class="form-control" placeholder="http://facebook.com/username">
<div class="error"><?php echo form_error('fb')?></div>
</div>

<div class="form-group">
<label class="control-label" for="phone">Số điện thoại cần nạp - hoặc tài khoản game</label>
<input type="text" id="phone" name="phone" value="<?php echo set_value('phone') ?>" autocomplete="off" class="form-control">
<div class="error"><?php echo form_error('phone')?></div>
</div>
<div class="form-group">
<label class="control-label" for="soluong">Số lượng cần mua</label>
<input type="number" id="soluong" name="soluong" value="<?php echo set_value('soluong')?set_value('soluong'):'1' ?>" autocomplete="off" class="form-control"  min='1' max='5'>
<div class="error"><?php echo form_error('soluong')?></div>
</div>
<!-- <div class="form-group">
<label class="control-label" for="username">Mã bảo vệ</label>
    <div class="input-group">
      <span class="input-group-addon" id="basic-addon1"><img src="http://thecao247.vn/captcha.php" title="Nhập dãy số này vào ô trống" class="captcha_pic"></span>
      <input type="text" class="form-control" placeholder="Nhập mã bảo vệ" name="captcha">
    </div>
</div> -->

<div class="form-group" id="btn-nap">
<label class="control-label sr-only"></label>
<input type="submit" class="btn btn-success btn-block" name="mua" value="Gửi yêu cầu">
<!-- <input type="submit" class="btn btn-info btn-block" name="tinhgia" value="Xem số tiền cần trả"> -->
</div>



</form>
</div>
<div role="tabpanel" class="tab-pane fade in" id="bang-gia">
    
<div class="page-header">
<h3>Lịch sử trả thẻ </h3>
</div>
<div class="table-responsive project-stats">  
<div class="">

<form action="" method="post">
<div class="col-xs-6 col-sm-4 col-md-2">
<div class="form-group">
  <input name="findcode" type="text" class="form-control border-input" id="findcode" value="" placeholder="Mã thẻ">
</div>
</div>
<div class="col-xs-6 col-sm-4 col-md-2">
<div class="form-group">
  <input name="findseri" type="text" class="form-control border-input" id="findseri" value="" placeholder="Serial">
</div>
</div>
<div class="col-xs-6 col-sm-4 col-md-2">    
<div class="form-group">
        <select class="form-control border-input" name="findstatus">
        <option value="">Trạng thái</option>
        <option value="1">Bị hủy</option>
        <option value="0">Đang chờ</option>
        <option value="2">Thành công</option>
        </select>
</div>
</div>
<div class="col-xs-6 col-sm-4 col-md-4">
<div class="form-group">
  <input name="finddate" type="date" class="form-control border-input" id="finddate" value="" placeholder="tháng-ngày-năm" title="tháng-ngày-năm">
</div>
</div>
<div class="col-xs-6 col-sm-4 col-md-2">
<div class="form-group">
<button type="submit" name="timkiem" class="btn btn-warning" style="padding: 6px 12px;"><i class="fa fa-search"></i> Tìm kiếm</button>
</div>
</div>
</form>

</div><table class="table table-striped table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>Username</th>
        <th>Loại thẻ</th>
        <th>Mệnh giá</th>
        <th>Seri</th>
        <th>Mã thẻ</th>
        <th>Facebook</th>
        <th>Số điện thoại</th>
        <th>Trạng thái</th>
        <th>Ngày tạo</th>
    </tr>
</thead>
<tbody>

  <?php if($user != ""):?>
      <?php $i=0; foreach($users as $us) :$i++;?>
        <tr>
          <td class="text-center"><?=$i?></td>
          <td class="text-center"><?=$user->user_name?></td>
          <td class="text-center">
            <?php 
              if($us['type'] == 1){echo 'VIETTEL';} 
              else if($us['type'] == 2){echo 'VINAFONE';}
              else if($us['type'] == 3){echo 'MOBIFONE';}
              else if($us['type'] == 4){echo 'ZING';}
              else if($us['type'] == 5){echo 'GATE';}
              else if($us['type'] == 6){echo 'MEGACARD';}
              else if($us['type'] == 7){echo 'BIT';}
              else if($us['type'] == 8){echo 'VCOIN';}
            ?>
          </td>
          <td class="text-center">
            <?php 
              if($us['cash'] == 1){echo 10000;} 
              else if($us['cash'] == 2){echo 20000;}
              else if($us['cash'] == 3){echo 30000;}
              else if($us['cash'] == 4){echo 50000;}
              else if($us['cash'] == 5){echo 100000;}
              else if($us['cash'] == 6){echo 200000;}
              else if($us['cash'] == 7){echo 500000;}
              else if($us['cash'] == 8){echo 1000000;}
            ?>
            đ
          </td>

          <td class="text-center"><p class='seri'><?=$us['seri']?></p> <b class="serihideshow">+</b></td>
          <td class="text-center"><p class='code'><?=$us['code']?></p> <b class="codehideshow">+</b></td>

          <td class="text-center"><?=$us['fb']?></td>

          <td class="text-center"><?=$us['phone']?></td> 
          <td class="text-center">
            <?php if($us['status'] == 0)
            {
              echo "<button type='submit' class='btn btn-primary btn-block' name='tinhgia'>Chờ duyệt</buton>";
            }else{
              echo "<button type='submit' class='btn btn-success btn-block' name='tinhgia'>Thành công</buton>";
            }
            ?></td>
        

          <td class="text-center"><?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date("Y-m-d H:i:s" , $us['created'])?></td>

      <?php endforeach?>
      </tr>
  <?php else:?>
    <tr>
      <td colspan="9" class="text-center">Không có dữ liệu</td>
    </tr>
  <?php endif;?>
  


                                                         
</tbody>
</table>
</div>

<div style="float: left; margin: 10px"><span>Tổng mệnh giá: 0<sup>đ</sup>. Tổng thực nhận 0<sup>đ</sup></span></div>


</div>
</div>

</div>
</div>

<div id="chieckhau" class="col-sm-4 col-md-4" style="background: #f5f5f5;border:1px solid #ccc;text-align: center;">
    <!-- <p>Số Tiền cần trả: 
        <b><img id="msg_err_bank" style="display: none" src="http://thecao247.vn/images/loading.gif"></b>
        <b id="moneys"></b>
    </p> -->
    <div class="table-responsive">  

      <table class="table">
        <thead>
        <tr>
            <h3 style="color:#333;padding:5px;background-color:#fff;">Phí mua thẻ </h3>
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
                if($hr->featured_buy == 1)
                {
                    echo "<span style='padding:1px; border-radius:5px;' class='btn-success'>Hoạt động</span>";
                }
                else if($hr->featured_buy == 0){echo "<span style='padding:1px; border-radius:5px;' class='btn-warning'>Bảo trì</span>";}
            ?>
        </td>

        <?php foreach($hr->subs as $sub) :?>
            <td>
                <b style='color:blue;'><?=$sub->hunress_buy?>%</b>
            </td>
        <?php endforeach?>
        
        </tr>
        <?php endforeach ?>

        
             
        </tbody>
      </table>
      </div> 


</div>


<div id="tbbottom" class="col-sm-4 col-md-4" style="background: #f5f5f5;border:1px solid #ccc;text-align: center; margin-top:10px">
    <div class="table-responsive"> 
        <span style="color:red;float:left;">THÔNG BÁO:</span> <br/>
        <p><?=$info_buy->content?></p>
    </div> 
</div>    
</div>
</div>
<style type="text/css">
    .hide{
      display: none;
      transition: all 900ms linear;
    }
    .show{
      display: block;
      transition: all 900ms linear;
    }
</style>
<script>
$(document).ready(function (){
    $('.seri').addClass('hide');
    $('.code').addClass('hide');

    $('.seri').click(function(){
        $('.seri').addClass('hide');
        $('.seri').removeClass('show');
        $('.serihideshow').addClass('show');
        $('.serihideshow').removeClass('hide');
    });
    $('.serihideshow').click(function(){
       $('.serihideshow').addClass('hide');
       $('.serihideshow').removeClass('show');
       $('.seri').addClass('show');
       $('.seri').removeClass('hide');
    });

    $('.code').click(function(){
        $('.code').addClass('hide');
        $('.code').removeClass('show');
        $('.codehideshow').addClass('show');
        $('.codehideshow').removeClass('hide');
    });
    $('.codehideshow').click(function(){
       $('.codehideshow').addClass('hide');
       $('.codehideshow').removeClass('show');
       $('.code').addClass('show');
       $('.code').removeClass('hide');
    });

    $('#soluong').change(function(){
        
        var soluong = $('#soluong').val();
        var cash = $('#cash').val();
       // alert(cash);
        // alert(parseInt(cash));
        if(cash == "Chọn mệnh giá"){
            $('#moneys').html("Chưa chọn mệnh giá");
        }
        

        else if(soluong != '' && cash != '' && cash != "Chọn mệnh giá")
        {
            $('#msg_err_bank').css("display","block");
            $.ajax({
                url:"<?php echo base_url(); ?>/buy/check_money",
                method:"POST",
                data:{sl:soluong,cs:cash},
                success:function(data){
                    $('#moneys').html(data);
                }
            });

        }
    });
});
</script>
