<?php $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
?>
<div class="leftmain">
    <div class="module taikhoan">
            <h2 class="tieude">Quản lí tài khoản</h2>
        <div class="noidung">
            <div class="avatar">
                <img src="<?php echo getURL().$member->avatar;?>" alt="" style=" width: 105px; height: auto;" />
                <p><a style="color:#40a314" href=""><?php echo $member->fullname;?></a></p>
                <!-- <p>Cấp bậc: gold member</p> -->
            </div>
            <ul>
                    <li><a href="<?php echo getURL().'member/default/memberInfo';?>">Thông tin cá nhân</a></li>
                <li><a href="<?php echo getURL().'member/default/treeMember';?>">Cây thành viên</a></li>
                <li><a href="<?php echo getURL().'member/default/rose';?>">Doanh thu hoa hồng</a></li>
                <li><a href="<?php echo getURL().'member/default/donHang';?>">Quản lý đơn hàng</a></li>
                <li><a href="<?php echo getURL().'member/default/searchMember';?>">Tìm kiếm thành viên</a></li>
            </ul>
        </div><!--e:noidung-->
    </div><!--e:danhmuc-->
</div><!--e:leftmain-->