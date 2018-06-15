
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url() ?>"></a>
        </div>

        <div class="collapse navbar-collapse bs-navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <a href="<?php echo base_url() ?>">
                        <div class="logo pull-left">
                            <img src="<?php echo public_url('site/images/logo1.png') ?>" width="250px"/>
                            
                        </div>
                    </a>
                     <div class="hotline pull-left">
                        <img src="<?php echo public_url('site/images/hotline.png') ?>" width="150px"/>
                        <span id="hotlines">
                            <?php foreach($phone_list as $pl) : ?>
                                <a href="tel:<?=$pl->phone?>">
                                    <?=$pl->phone_show;?>
                                </a>    
                            <?php endforeach?>
                        </span>        
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if(isset($user_info)) : ?>
                        <li class="dropdown">
                            
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><b><b>Số dư: <b><?=number_format($user_info->bag)?></b><sup>vnđ</sup></b> Chào:</b> <?php echo $user_info->user_name?> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                
                                    <li class="divider"></li>
                                <li><a href="<?php echo base_url('user/')?>lichsunap">Lịch sử nạp thẻ cào</a></li>    
                                <li><a href="<?php echo base_url('user/')?>lichsuruttien">Lịch sử rút tiền về ngân hàng</a></li>      
                                <li><a href="<?php echo base_url('user/')?>lichsuruttientcsr">Lịch sử rút tiền về TCSR</a></li>       
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url('user/')?>pass">Đổi mật khẩu đăng nhập</a></li>
                                <li><a href="<?php echo base_url('user/')?>logout">Đăng xuất</a></li>
                            </ul>
                        </li>
                        <?php else : ?>
                        <li id="reg"><a href="<?php echo base_url('/reg') ?>"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li>
                        <li id="log"><a href="<?php echo base_url('/log') ?>"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
            <div  style="border-top:1px solid #ccc;position:absolute; left:0;top:50px;width:100%;" ></div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <ul class="nav navbar-nav menus">
                        <li><a href="<?php echo base_url() ?>">TRANG CHỦ</a></li>
                        <li><a href="<?php echo base_url() ?>">ĐỔI THẺ CÀO</a></li>
                        <li><a href="<?php echo base_url('/muathe') ?>">ĐẶT THẺ</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">RÚT TIỀN<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url('/bank') ?>">Rút tiền về ngân hàng</a></li>
                                <li><a href="<?php echo base_url('/tcsr') ?>">Chuyển tiền cho thành viên</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
<style type="text/css">
     @media (max-width: 1024px){
        .col-md-6 {
            width: 47% !important;
        }
    }
    @media (max-width: 768px){
        .logo.pull-left img{
            width:170px;
            height:40px;
        }
        #tb{
            width:15% !important;
        }
        #tbcontent{
            width:85% !important;
        }
    }

    @media (max-width: 480px){
        .table-responsive{
            border:none !important;
        }
        #dtc,#tbbottom,#chieckhau{
            margin-top:20px;
            width:100% !important;
        }
        #tb{
            width:30% !important;
        }
        #tbcontent{
            width:70% !important;
        }
        .logo.pull-left img{
            width:150px;
            height:40px;
        }
        #banner{
            margin-top:0px !important;
            height:200px !important;
        }
        #banner img{
            height:200px !important;
        }
    }
    @media (max-width: 320px){
         #tb{
            width:40% !important;
        }
        #tbcontent{
            width:60% !important;
        }
    }
</style>