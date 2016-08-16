<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm','enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true),'htmlOptions' => array('enctype' => 'multipart/form-data') ));?>
<table class="table-member style2" border="0" cellspacing="0" style="margin-top:0;">
        <thead>
        <tr>
                <td colspan="4">Thông tin cá nhân</td>
        </tr>
    </thead>
        <tbody>
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
        <td><a href="<?php echo getURL().'member/account/infoCard';?>"><?php echo createNumberCard($member->CardAccount['numbercard']);?></a></td>
        <td class="title-vertical">Số tài khoản</td>
        <td><a href="<?php echo getURL().'member/account/infoAccount';?>"><?php echo createNumberCard($member->CardAccount['numberaccount']);?></a></td>
    </tr>
    <!--
    <tr>
        <td class="title-vertical">Đổi ảnh đại diện</td>
        <td colspan="3">
         <?php
            echo $form->fileField($member, 'avatar');
            echo $form->error($member, 'avatar');
            ?>
        </td>
    </tr>
    -->
    <tr>
        <td colspan="4" style="text-align:center;">
            <a href="<?php echo getURL().'member/default/updateMemberInfo';?>"><input type="button" name="btnSubmit" value="Thay đổi" class="button-blue" style="border:solid 1px #ccc; cursor:pointer;"></a>
        <input type="button" onclick="window.history.back();" name="btnSubmit" value="Quay lại"  class="button-blue" style="border:solid 1px #ccc; cursor:pointer;">
        </td>
    </tr>
    </tbody></table>
<?php $this->endWidget(); ?>
</div>