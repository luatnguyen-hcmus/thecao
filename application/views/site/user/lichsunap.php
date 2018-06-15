<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://vitalets.github.io/bootstrap-datepicker/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">
<script src="https://vitalets.github.io/bootstrap-datepicker/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>    

<div class="container">
<div class="page-header">
<h3>Lịch sử nạp thẻ </h3>
</div>
<div class="table-responsive project-stats">  



<form class="list_filter form" action="<?php echo base_url('user/lichsunap') ?>" method="get">
<div class="">



<!-- <div class="col-xs-6 col-sm-4 col-md-2">
<div class="form-group">
  <input name="findcode" type="text" class="form-control border-input" value="<?php echo $this->input->get('findcode')?>" id="filter_iname" value="" placeholder="Mã thẻ">
</div>
</div>

<div class="col-xs-6 col-sm-4 col-md-2">
<div class="form-group">
  <input name="findseri" type="text" class="form-control border-input" id="findseri" value="<?php echo $this->input->get('findseri')?>" placeholder="Serial">
</div>
</div> -->
<div class="col-xs-6 col-sm-4 col-md-2">
<div class="form-group">
    <div class="input-append date" id="dp3" data-date="" data-date-format="yyyy-mm-dd">
        <input value="<?php echo $this->input->get('findday')?>" class="form-control border-input" size="16" type="text" id="timeCheckInback" name="findday"  value="" placeholder="Từ ngày" readonly>
        <span class="add-on"><i class="icon-th"></i></span>
    </div>
</div>
</div>
<div class="col-xs-6 col-sm-4 col-md-2">
<div class="form-group">
    <div class="input-append date" id="dp4" data-date="" data-date-format="yyyy-mm-dd">
        <input value="<?php echo $this->input->get('finddayout')?>" class="form-control border-input" size="16" type="text" id="timeCheckOutback" name="finddayout"  value="" placeholder="Đến ngày" readonly>
        <span class="add-on"><i class="icon-th"></i></span>
    </div>
</div>
</div>
<div class="col-xs-6 col-sm-4 col-md-1">
<div class="form-group">
  <input name="findid" type="number" class="form-control border-input" value="<?php echo $this->input->get('id') ?>" id="filter_id" value="" placeholder="Mã số">
</div>
</div>
<div class="col-xs-6 col-sm-4 col-md-2">    
<div class="form-group">
		<select class="form-control border-input" name="findstatus">
    		<option value="">Trạng thái</option>
    		<option value="'0'">Chờ Duỵêt</option>
    		<option value="1">Thành công</option>
        <option value="2">Thất Bại</option>
		</select>
</div>
</div>

<div class="col-xs-6 col-sm-4 col-md-1">
<div class="form-group">
<button type="submit" class="btn btn-warning" style="padding: 6px 12px;"><i class="fa fa-search"></i> Tìm kiếm</button>
</div>


</div>
</div>
</form>

<div style="clear: both;">
<div class="col-xs-6 col-sm-4 col-md-6 pull-left">
<div class="form-group">
    Tổng số giao dịch: <span><?= $totalget ?></span>
</div>
</div>

<div class="col-xs-6 col-sm-4 col-md-6 pull-right">
<div class="form-group">
     <span style="float: right;">Tổng tiền: <?= number_format($amount_total1)?> vnđ</span>
</div>
</div>
</div>


<table class="table table-striped table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>Loại thẻ</th>
        <th>Mã Thẻ</th>
        <th>Seri</th>
        <th>Mệnh giá</th>
        <th>Thực nhận</th>
        <th>Số dư cuối</th>
        <th>Trạng thái</th>
        <th>Thời gian</th>
    </tr>
</thead>
<tbody>

  <?php if($user != ""):?>
      <?php
       $i=0; foreach($user as $us) :$i++;?>
        <tr>
          <td class="text-center"><?=$us->id?></td>
          <td class="text-center">
            <?php 
              if($us->type == 1){echo 'VIETTEL';} 
              else if($us->type == 2){echo 'VINAFONE';}
              else if($us->type == 3){echo 'MOBIFONE';}
              else if($us->type == 4){echo 'ZING';}
              else if($us->type == 5){echo 'GATE';}
              else if($us->type == 6){echo 'MEGACARD';}
              else if($us->type == 7){echo 'BIT';}
              else if($us->type == 8){echo 'VCOIN';}
            ?>
          </td>
          <td class="text-center"><p class='code'><?=$us->pin?></p> <b class="codehideshow">+</b></td>
          <td class="text-center"><p class='seri'><?=$us->seri?></p> <b class="serihideshow">+</b></td>
          

          <?php foreach($us->subs as $sub) :?>
            <td class="text-center">
                <b><?=number_format($sub->cash)?></b>
            </td>
          <?php endforeach?>
          <td class="text-center">
            <?= number_format($us->amount)?> đ
          </td>

          <td class="text-center"><?=number_format($user_info->bag)?> đ</td> 
          <td class="text-center">
            <?php if($us->status == 0)
            {
              echo "<button type='submit' class='btn btn-primary btn-block' name='tinhgia'>Chờ duyệt</buton>";
            }else if($us->status == 1){
              echo "<button type='submit' class='btn btn-success btn-block' name='tinhgia'>Thành công</buton>";
            }else if($us->status == 2){
              echo "<button type='submit' class='btn btn-danger btn-block' name='tinhgia'>Thất Bại</buton>";
            }

            ?></td>

          <td class="text-center"><?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date("Y-m-d H:i:s" , $us->created)?></td>

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


</div>


<script type="text/javascript">
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
  });
</script>
<script>
    $(function(){
      $('#dp3').datepicker()
        .on('changeDate', function(ev){
          $('#timeCheckInback').val();
          $('#dp3').datepicker('hide');
        });      
      $('#dp4').datepicker()
        .on('changeDate', function(ev){
          $('#timeCheckOutback').val();
          $('#dp4').datepicker('hide');
        });     
    });
  </script>