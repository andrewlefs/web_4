<div class="content-left">
<div class="box-common" style="margin-top:0px; padding-bottom:0;">
    <div class="title-box"><a href="<?php echo getURL().'member';?>" class="orange">Thành viên</a>&nbsp;|&nbsp;<a href="<?php echo getURL().'member/account';?>">Tài khoản</a></div>
    <div id="left-menu-member" class="member-info">
    <div class="avatar"> <img src="<?php 
    if(!empty($this->member->avatar))
        echo getURL ().$this->member->avatar;
    else
        echo Yii::app()->controller->module->registerImage('avatar.jpg');
    ?>" alt="" /> <span class="cap12"><?php echo $this->member->fullname;?></span> </div>
    <div class="root" style="margin-top:0;"><a href="<?php echo getURL();?>member/default/rose/<?php echo $this->member->id;?>">Doanh thu hoa hồng</a></div>
    <div class="root"><a href="<?php echo getURL();?>member/default/treeMember">Cây thành viên</a></div>
    <div class="root"><a href="<?php echo getURL();?>member/default/getListMemberSubOnline">DS thành viên giới thiệu trực tiếp</a></div>
    <div class="root"><a href="<?php echo getURL();?>lich-su-hoa-hong">Lịch sử hoa hồng</a></div>
    <div class="root"><a href="<?php echo getURL();?>tim-kiem-thanh-vien">Tìm kiếm thành viên</a></div> 
    <div class="root"><a href="<?php echo getURL();?>member/default/donHang">Quán lý hóa đơn</a></div> 
    </div>
    <!--Left menu member--> 
</div>
</div>