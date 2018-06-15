<div class="container">
<div class="page-header">
<h3>RÚT TIỀN VỀ NGÂN HÀNG</h3>
</div>
<div class="row">

<div class="col-xs-12 col-md-7 col-sm-7">
<form id="fbank" name="fbank" method="POST" role="form" novalidate="">
    
<div class="form-group">
<label class="control-label sr-only"></label>
<div class="text-danger" id="msg_err_bank" style="display: none">
<img src="http://thecao247.vn/images/loading.gif">
Loading ...
</div>
</div>
<div class="form-group">
<label class="control-label" for="username">Tên chủ thẻ </label>
<input type="text" id="tenchuthe" value="<?php echo set_value('tenchuthe') ?>" name="tenchuthe" autocomplete="on" class="form-control" placeholder="Viết hoa không dấu">
<div class="error"><?php echo form_error('tenchuthe')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password_login">Số tài khoản</label>
<input type="text" id="stk" name="stk" value="<?php echo set_value('stk') ?>" autocomplete="on" class="form-control" placeholder=""> 
<div class="error"><?php echo form_error('stk')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password_login">Số in trên thẻ ATM</label>
<input type="text" id="sothe" value="<?php echo set_value('sothe') ?>" name="sothe" autocomplete="on" class="form-control" placeholder="Có thể để trống nếu admin không yêu cầu">
<div class="error"><?php echo form_error('sothe')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password_login">Tên ngân hàng</label>

<select class="form-control border-input" name="type_bank">
    <option value="">Chọn Ngân Hàng</option>
        <option value="1">VIETCOMBANK</option>
        <option value="2">VIETINBANK</option>
        <option value="3">AGRIBANK</option>
        <option value="4">BIDV</option>
</select>

<div class="error"><?php echo form_error('type_bank')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password_login">Tên chi nhánh</label>
<input type="text" id="type_place" value="<?php echo set_value('type_place') ?>" name="type_place" autocomplete="off" class="form-control" placeholder=""> 
<div class="error"><?php echo form_error('type_place')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password_login">Số tiền muốn rút</label>
<input type="number" id="sotien" name="sotien" value="<?php echo set_value('sotien') ?>" autocomplete="off" class="form-control number" placeholder="Số tiền muốn rút phải từ 100.000đ">
<div class="error"><?php echo form_error('sotien')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password_login">Số điện thoại liên lạc</label>
<input type="number" id="sdt" name="sdt" autocomplete="on" value="<?php echo set_value('sdt') ?>" class="form-control" placeholder="Vui lòng nhập đúng, admin sẽ liên hệ với bạn">
<div class="error"><?php echo form_error('sdt')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password_login">Mật khẩu cấp 2</label>
<input type="password" id="pass2" name="pass2" autocomplete="off" class="form-control" placeholder="">
<div class="error"><?php echo form_error('pass2')?></div>
<?php if(isset($message1)) : ?>
	<p style="color:red;"><?php echo "<script>alert('$message1');</script>"; ?></p>
<?php endif?>
</div>
<div class="form-group">
<label class="control-label sr-only"></label>
<input type="submit" class="btn btn-success btn-block" value="Yêu cầu rút tiền">
</div>
</form>
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
        <p><?=$info_bank->content?></p>
    </div> 
</div>

</div>
</div>

<style type="text/css">
    input[type="number"] {
        -moz-appearance: textfield !important;
        appearance: none !important;
        -webkit-appearance: none !important;
    }
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>