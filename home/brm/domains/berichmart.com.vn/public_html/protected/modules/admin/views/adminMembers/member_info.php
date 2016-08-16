<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Kết quả kiểm tra</p>    
</div><!--.top-main-->
<div class="middle-main">    
    <!-- thong tin ca nhan -->
    <div class="info_member">
        <table class="member-table" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                        <td colspan="4">Thông tin cá nhân</td>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($member)){?>
                <tr>
                    <td class="title-vertical">Tên tài khoản</td>
                    <td style="text-transform:capitalize"><?php echo $member->fullname;?></td>
                    <td class="title-vertical">Tên đăng nhập</td>
                    <td><?php echo $member->name;?></td>
                </tr>

                <tr>
                    <td class="title-vertical">Số CMND</td>
                    <td><?php echo $member->cmnd;?></td>
                    <td class="title-vertical">Ngày gia nhập</td>
                    <td><?php echo date('d-m-Y',  strtotime($member->created));?></td>
                </tr>
                <tr>
                    <td class="title-vertical">Cấp thành viên</td>
                    <td><?php echo Yii::app()->tree->getTitleLevelMember($member);;?></td>
                    <td class="title-vertical">Thư điện tử</td>
                    <td><?php echo $member->email;?></td>
                </tr>
                <tr>
                    <td class="title-vertical">Điện thoại liên hệ</td>
                    <td><?php echo $member->phone;?></td>
                    <td class="title-vertical">Địa chỉ theo CMTND</td>
                    <td><?php echo $member->address_cmnd;//place_create;?></td>
                </tr>
                <tr>
                    <td class="title-vertical">Điện thoại di động</td>
                    <td><?php echo $member->CardAccount['mobile'];?></td>
                    <td class="title-vertical">Nơi ở hiện tại</td>
                    <td><?php echo $member->address;?></td>
                </tr>
                <tr>
                    <td class="title-vertical">Số thẻ</td>
                    <td><?php echo createNumberCard($member->CardAccount['numbercard']);?></td>
                    <td class="title-vertical">Số tài khoản</td>
                    <td><?php echo createNumberCard($member->CardAccount['numberaccount']);?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center; font-weight: bold;"><a href="<?php echo getURl().'admin/adminMembers/changeMemberInfo/'.$member->id;?>" style=" padding: 5px; border: 1px solid #ccc; background-color: #fff;">Thay đổi</a></td>
                </tr>
                <?php } else {?>
                <tr>
                    <td colspan="4" style="color: red; font-weight: bold; text-align: center; line-height: 50px; background-color: #fff;">Thành viên này không tồn tại</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- end thong tin ca nhan -->
    <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->
<script>
$(function(){
    $('.member-table tbody tr td:even').addClass('background_td');
});
</script>