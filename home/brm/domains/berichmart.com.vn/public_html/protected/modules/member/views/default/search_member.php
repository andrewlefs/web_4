<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
    <table class="table-member" border="0" cellspacing="0" style="margin-top: 0px;">
        <thead>
        <tr><td colspan="5">Tìm kiếm thành viên</td></tr>
    </thead>
    <tbody>
        <tr class="title">
                <td>Thông báo</td>
            <td>Nhập chính xác tên thành viên để tìm kiếm</td>
        </tr>
        <tr>
            <td>Tên thành viên</td>
            <td>
                <form method="post">
                <input TYPE="text" name='member_name' style="margin-right: 20px;">
                <input type="submit" value="Tim kiem">
                </form>
            </td>
        </tr>
    </tbody>
    </table>
    <?php if(!empty($member)){?>
    <table class="table-member style2" border="0" cellspacing="0">
        <thead>
        <tr>
                <td colspan="4">Thông tin thành viên</td>
        </tr>
    </thead>
        <tbody>        
            <tr>
                <td class="title-vertical">Tên tài khoản</td>
                <td style="text-transform: capitalize;"><a href="<?php echo getURL().'member/default/treeMember/'.$member->id;?>"><?php echo $member->fullname;?></a></td>
                <td class="title-vertical">Tên đăng nhập</td>
                <td><a href="<?php echo getURL().'member/default/treeMember/'.$member->id;?>"><?php echo $member->name;?></a></td>
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
                <td><?php echo $member->address_cmnd;?></td>
            </tr>
            <tr>
                <td class="title-vertical">Điện thoại di động</td>
                <td></td>
                <td class="title-vertical">Nơi ở hiện tại</td>
                <td><?php echo $member->address;?></td>
            </tr>
            <tr>
                <td class="title-vertical">Số thẻ</td>
                <td><?php echo createNumberCard($member->CardAccount['numbercard']);?></td>
                <td class="title-vertical">Số tài khoản</td>
                <td><?php echo createNumberCard($member->CardAccount['numberaccount']);?></td>
            </tr>            
        </tbody>
    </table>
    <?php } ?>
</div>