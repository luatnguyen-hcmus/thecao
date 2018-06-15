


<div class="container">
<div class="page-header">
<h3>RÚT TIỀN VỀ TCSR</h3>
</div>
<div class="row">

<div class="col-xs-12 col-md-7 col-sm-7">
<form id="ftcsr" name="ftcsr" method="POST" role="form" novalidate="">
    
<div class="form-group">
<label class="control-label sr-only"></label>
<div class="text-danger" id="msg_err_tcsr" style="display: none">
<img src="http://thecao247.vn/images/loading.gif">
Loading ...
</div>
</div>
<div class="form-group">
<label class="control-label" for="tktcsr">Tài khoản TCSR</label>
<input type="text" id="tktcsr" name="tktcsr" autocomplete="on" class="form-control" placeholder="Tài khoản nhận tiền">
<div class="error"><?php echo form_error('tktcsr')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password_login">Số tiền muốn rút</label>
<input type="text" id="sotien" name="sotien" autocomplete="off" class="form-control number" placeholder="Số tiền muốn rút phải từ 100.000đ">
<div class="error"><?php echo form_error('sotien')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password_login">Số điện thoại liên lạc</label>
<input type="text" id="sdt" name="sdt" autocomplete="on" class="form-control" placeholder="Vui lòng nhập đúng, admin sẽ liên hệ với bạn">
<div class="error"><?php echo form_error('sdt')?></div>
</div>
<div class="form-group">
<label class="control-label" for="password_login">Mật khẩu cấp 2</label>
<input type="password" id="pass2" name="pass2" autocomplete="off" class="form-control" placeholder="">
<div class="error"><?php echo form_error('pass2')?></div>
<?php if(isset($message1)) : ?>
	<p style="color:red;"><?php echo $message1; ?></p>
<?php endif?>
</div>
<div class="form-group">
<label class="control-label sr-only"></label>
<input type="submit" class="btn btn-success btn-block" value="Yêu cầu rút tiền về TCSR">
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
        <p><?=$info_menber->content?></p>
    </div> 
</div>

</div>
</div>