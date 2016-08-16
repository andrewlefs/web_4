<div class="content-left"> 
<div class="box-common" style="margin-top:0px;">
    <div class="title-box"><a href="<?php echo getURL().'member';?>">Thành viên</a>&nbsp;|&nbsp;<a href="<?php echo getURL().'member/account';?>" class="orange">Tài khoản</a></div>
    <div id="left-menu-member">
                <div class="root" style="margin-top:0;">Truy vấn tài khoản</div>
    <ul>
        <li><a href="">Tài khoản</a>
                <div class="sub-menu">
                <a href="<?php echo getURl().'member/account/infoAccount';?>">Thông tin tài khoản</a>
                <a href="<?php echo getURl().'member/account/listAccount';?>">Danh sách tài khoản</a>                
                <!-- <a href="<?php echo getURl().'member/account/updateTVCT';?>">Nâng cấp thành viên</a> -->
                <a href="<?php echo getURl().'member/account/detailTransaction';?>">Chi tiết giao dịch</a>
            </div>
        </li>
        <li><a href="">Thẻ</a>
                <div class="sub-menu">
                <a href="<?php echo getURl().'member/account/infoCard';?>">Thông tin thẻ</a>  
                <a href="<?php echo getURl().'member/account/changePasswordCard';?>">Thay đổi mật khẩu thẻ</a>
                <a href="<?php echo getURl().'member/account/forgetPass';?>">Quên mật khẩu thẻ</a>
            </div>
        </li>
    </ul>
    <div class="clear"></div>
    <div class="root">Thanh toán</div>
    <ul style="padding-left: 12px;">        
         <li><a href="<?php echo getURl().'member/account/transfer';?>">Chuyển khoản</a></li>
         <li><a href="<?php echo getURl().'member/account/registerService';?>" style="font-weight: normal;">Thay đổi hạn mức chuyển khoản</a></li>
         <li><a href="<?php echo getURL();?>member/card/download">Mua thẻ</a></li>
    </ul>

    <div class="clear"></div>
    <div class="root">Đăng ký sử dụng dịch vụ</div>
    <ul>
        <?php $membercheck = CardAccount::model()->find('member_id='.Yii::app()->session['member']['id']) ;
                if(empty($membercheck)){
        ?>
        <li><a href="<?php echo getURl().'member/account/registerCard';?>">Đăng ký sử dụng</a></li>
        <?php } else {?>
        <li><a href="<?php echo getURl().'member/account/changeMobile';?>">Thay đổi số điện thoại OTP</a></li>
        <?php }?>        
    </ul>

    <div class="clear"></div>
    <div class="root">Hỗ trợ</div>
    <ul>
        <li><a href="<?php echo getURl().'member/account/changePassword';?>">Đổi mật khẩu</a></li>
        <li><a href="">Hướng dẫn sử dụng</a></li>
        <li><a href="">In trang này</a></li>
        <li><a href="<?php echo getUrl();?>home/members/logout">Thoát</a></li>
    </ul>
    </div><!--Left menu member-->
</div>
</div>