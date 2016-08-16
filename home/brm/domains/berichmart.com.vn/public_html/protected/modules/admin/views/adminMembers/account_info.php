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
                        <td colspan="4">Thông tin tài khoản</td>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($member)){?>
                <tr>
                    <td class="title-vertical">Tên tài khoản</td>
                    <td style="text-transform:capitalize" ><?php echo $member->fullname;?></td>
                    <td class="title-vertical">Tên đăng nhập</td>
                    <td><?php echo $member->name;?></td>
                </tr>
                <tr>
                    <td class="title-vertical">Địa chỉ</td>
                    <td><?php echo $member->address;?></td>
                    <td class="title-vertical">Số CMND/Hộ chiếu</td>
                    <td><?php echo $member->cmnd;?></td>
                </tr>
                <tr>
                    <td class="title-vertical">Số tài khoản</td>
                    <td><?php echo createNumberCard($member->CardAccount['numberaccount']);?></td>
                    <td class="title-vertical">Loại tiền</td>
                    <td>VNĐ</td>
                </tr>
                <tr>
                    <td class="title-vertical">Số dư hiện tại</td>
                    <td><?php echo number_format($member->CardAccount['money']);?> VNĐ</td>
                    <td class="title-vertical">Ngày mở tài khoản</td>
                    <td><?php echo date('d/m/Y',  strtotime($member->CardAccount['created']));?></td>
                </tr>
                <tr>
                    <td class="title-vertical">Số dư khả dụng</td>
                    <td><?php echo number_format($member->CardAccount['money']);?> VNĐ</td>
                    <td class="title-vertical">Ngày thực hiện giao dịch gần nhất</td>
                    <td>No</td>
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