<div class="container">
<div class="page-header">
<h3>Lịch sử yêu cầu rút tiền về TCSR </h3>
</div>
<div class="table-responsive project-stats">  
<table class="table">
<thead>
    <tr>
        <th>#</th>
        <th>Tài khoản nhận</th>
        <th>Số tiền</th>
        <th>Số dư cuối</th>
        <th>Trạng thái</th>
        <th>Thông tin</th>
        <th>Thời gian</th>
    </tr>
</thead>
<tbody>
<?php if($user != ""):?>
    <?php $i=0; foreach($user as $us) :$i++;?>
    <tr>
        <td class="text-center"><?=$i?></td>
        <td class="text-center"><?=$us->name_bank?></td>
        <td class="text-center"><?=$us->current?></td>
        <td class="text-center"><?=number_format($user_info->bag)?></td>
        <td class="text-center"> 
            <?php if($us->status == 0)
                {
                  echo "<button type='submit' class='btn btn-primary btn-block' name='tinhgia'>Chờ duyệt</buton>";
                }else{
                  echo "<button type='submit' class='btn btn-success btn-block' name='tinhgia'>Thành công</buton>";
                }
            ?>
        </td>
        <td class="text-center"><?=$us->type?></td>
        <td class="text-center"><?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date("Y-m-d H:i:s" , $us->created)?></td>
    </tr>
    <?php endforeach;?>
<?php else:?>
    <tr><td colspan="9" class="text-center">Không có dữ liệu</td></tr>
<?php endif; ?>
                                                         
</tbody>
</table>
</div>
                  
</div>