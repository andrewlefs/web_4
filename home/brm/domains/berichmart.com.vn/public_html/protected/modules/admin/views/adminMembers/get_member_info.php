<table cellpadding="0" cellspacing="0">
    <thead>
        <tr align="center" style="font-weight: bold; font-size: 14px;">
            <td colspan="2">Thông tin thành viên</td>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($member)){?>
        <tr>
            <td>Tên đăng nhập :</td>
            <td><?php echo $member->name; ?></td>
        </tr>
        <tr>
            <td>Tên thành viên :</td>
            <td><?php echo $member->fullname; ?></td>
        </tr>
        <tr>
            <td>Số tài khoản :</td>
            <td><?php echo createNumberCard($member->CardAccount['numberaccount']);?></td>
        </tr>
        <tr>
            <td>Số dư tài khoản :</td>
            <td><span style="color: red;"><?php echo number_format($member->CardAccount['money']).' vnđ';?></span></td>
        </tr>
        <tr>
            <td>Địa chỉ thành viên :</td>
            <td><?php echo $member->address; ?></td>
        </tr>
        <tr>
            <td>Số điện thoại :</td>
            <td><?php echo $member->phone; ?></td>
        </tr>
        <tr>
            <td>CMND :</td>
            <td><?php echo $member->cmnd; ?></td>
        </tr>
        <tr>
            <td>Ngày cấp CMND :</td>
            <td><?php echo date('d/m/Y',  strtotime($member->date_create)); ?></td>
        </tr> 
        <?php }else { ?>
        <tr>
            <td colspan="2" style="color: red; font-weight: bold; text-align: center; line-height: 50px;">Thành viên này không tồn tại</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
 
<script>
$(function(){
    <?php if(!empty($member)){?>
        $('#currentmoney').val('<?php echo number_format($member->CardAccount['money']);?>');
        <?php if($member->CardAccount['blockade']>0)
            echo "$('#blockedmoney').attr('checked', 'checked');";
        if($member->status<1)
            echo "$('#statusmember').attr('checked', 'checked');";
        if($member->CardAccount['no_tax']<1)
            echo "$('#no_tax').attr('checked', 'checked');";
        ?>
                $('#name_mem').val('<?php echo $member->name;?>');
                $('#cmnd').val('<?php echo $member->cmnd;?>');
                $('#numberaccount').val('<?php echo createNumberCard($member->CardAccount['numberaccount']);?>');
                
    <?php }
    else {
    ?>
            $('#currentmoney').val(''); $('#blockedmoney').removeAttr('checked');
             $('#statusmember').removeAttr('checked');
             $('#no_tax').removeAttr('checked');
    <?php }?>
})
</script> 

