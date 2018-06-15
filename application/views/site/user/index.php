<style>
	table td{
		padding: 10px;
		border: 1px solid #f0f0f0;
	}
</style>

<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Thông Tin Thành Viên</h2>
    </div>
    <div class="box-content-center product"><!-- The box-content-center -->
    	<table>
    		<tr>
    			<td>Họ Tên</td>
    			<td><?php echo $user->name ?></td>
    		</tr>
    		<tr>
    			<td>Email</td>
    			<td><?php echo $user->email ?></td>
    		</tr>
    		<tr>
    			<td>Số điện thoại</td>
    			<td><?php echo $user->phone ?></td>
    		</tr>
    		<tr>
    			<td>Địa Chỉ</td>
    			<td><?php echo $user->address ?></td>
    		</tr>

    	</table>
    	<a href="<?php echo site_url('user/edit') ?>" class="button"> Sửa thông tin</a>
    </div>
</div>
