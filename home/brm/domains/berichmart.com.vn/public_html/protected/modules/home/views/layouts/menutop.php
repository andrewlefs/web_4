<style>
    #menu-top  .menu2{
        float: right;
        font-weight: bold;
    }
    #menu-top  .menu2 li a,#menu-top  .menu2 li{
        padding-right: 10px;
    }
    #menu-top  .menu2 a{
        color:#7a1aa4;
    }
    #menu-top  .menu2 a:hover{
        text-decoration: underline;
    }
    #menu-top  .menu2 .hello a{
        color: #2894df;
        text-transform: capitalize;
    }
</style>
<div id="menu-top">
    <div class="wrap-content">
        <ul>
            <?php if(empty(Yii::app()->session['member'])){?>
            <li><a href="<?php echo getUrl();?>dang-nhap"><img src="<?php echo Yii::app()->controller->module->registerImage('login-icon.png')?>" alt="" height="15px"/>Đăng nhập</a></li>
            <li><a href="<?php echo getUrl();?>dang-ky"><img src="<?php echo Yii::app()->controller->module->registerImage('icon_register.png')?>" alt="" height="15px"/>Đăng ký</a></li>
            <?php } ?>
            <li><a href="<?php echo getUrl();?>gio-hang"><img src="<?php echo Yii::app()->controller->module->registerImage('cart.png')?>" alt="" height="15px"/>Giỏ hàng</a></li>
            <li><a href="<?php echo getUrl();?>lien-he"><img src="<?php echo Yii::app()->controller->module->registerImage('email-icon.png')?>" alt="" height="15px"/>Liên hệ</a></li>
            <li><a href="<?php echo getUrl();?>tuyen-dung"><img src="<?php echo Yii::app()->controller->module->registerImage('people.png')?>" alt="" height="15px"/>Tuyển dụng</a></li>
            <li><a href="<?php echo getUrl();?>rao-vat"><img src="<?php echo Yii::app()->controller->module->registerImage('speaker.png')?>" alt="" height="15px"/>Rao vặt</a></li>
        </ul>
        <?php if(!empty(Yii::app()->session['member'])){?>
        <?php
        $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
        ?>
            <ul class="menu2">
                <li class="hello"><span>Chào </span><a href="<?php echo getUrl();?>member"><?php echo $member->fullname;?></a>|</li>        
                <li><a href="<?php echo getUrl();?>thong-tin-tai-khoan">Thông tin cá nhân</a>|</li>
                <li><a href="<?php echo getUrl();?>member/account/changePassword">Đổi mật khẩu</a>|</li>
                <li><a href="<?php echo getUrl();?>home/members/logout">Thoát</a></li>
            </ul>
        <?php } else { ?>
        <div class="hotline"><a href="ymsgr:sendim?<?php echo $this->sale->yahoo;?>"><img src="<?php echo Yii::app()->controller->module->registerImage('icon-support.png')?>" alt="" /></a><a href="ymsgr:sendim?<?php echo $this->sale->yahoo;?>">Tư vấn trực tuyến</a></div>
        <?php }?>
    </div>
</div>