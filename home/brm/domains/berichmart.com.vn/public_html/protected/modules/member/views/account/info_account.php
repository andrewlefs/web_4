<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
    <table class="table-member style2" border="0" cellspacing="0" style="margin-top:0;">
        <thead>
        <tr>
                <td colspan="4">Thông tin tài khoản</td>
        </tr>
    </thead>
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
    </table>

</div>