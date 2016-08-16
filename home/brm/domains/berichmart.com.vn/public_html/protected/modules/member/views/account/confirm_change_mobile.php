<div class="box-right box-common box-common-table" style="max-height:none;">
    <div class="title-box">Xác nhận thay đổi số điện thoại truy vấn</div>
    <!-- .title -->
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm','enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true),'htmlOptions' => array('enctype' => 'multipart/form-data') ));?>
    <input type="hidden" name="txtMa" value="135"  class="text"/>
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table-form">
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtTenSuDung">Tên truy cập:</label></td>
        <td align="left" valign="top"><div class="input">
            <b class="blue"><?php echo $member->name;?></b>
            </div></td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtTenSuDung">Họ tên:</label></td>
        <td align="left" valign="top"><div class="input">
            <?php echo $member->fullname;?>
            </div></td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtTenSuDung">Địa chỉ:</label></td>
        <td align="left" valign="top"><div class="input">
            <?php echo $member->address;?>
            </div></td>
        </tr>        
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtMatKhauCu">Số điện thoại cũ:</label></td>
        <td align="left" valign="top"> <?php echo $cardaccount->mobile;?>
        </td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtMatKhauCu">Số điện thoại mới:</label></td>
        <td align="left" valign="top"> <?php echo $change_mobile['mobile'];?>
        </td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtMatKhau">Số tài khoản mặc định:</label></td>
        <td align="left" valign="top"><b class="blue"><?php echo createNumberCard($member->CardAccount['numberaccount']);?> </b></td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtXacNhanMatKhau">Mã xác nhân:</label></td>
        <td align="left" valign="top"><div class="input">
            <input type="text"  autocomplete="off" class="text" name="code" style="width: 100px;"/>
            <input type="hidden" name="code2" value="<?php echo $change_mobile['code'];?>">
            </div></td>
        </tr>
        <tr>        
        <tr class="tr">
        <td align="left" valign="top" class="title"></td>
        <td align="left" valign="top"><div class="input">
            <input type="submit" name="btnSubmit" value="Xác nhận" class="btnSubmit button-form" />
            </div></td>
        </tr>
    </table>
    <?php $this->endWidget(); ?>
</div>