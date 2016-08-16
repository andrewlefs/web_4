<div class="box-right box-common box-common-table" style="max-height:none;">
    <div class="title-box">SMS Banking - Thay đổi số điện thoại truy vấn</div>
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
        <td align="left" valign="top" class="title"><label for="txtMatKhauCu">Số điện thoại sử dụng:</label></td>
        <td align="left" valign="top">
                <select class="text droplist" name="data[combomobile]">
                    <option value="<?php echo $member->name;?>"><?php echo $member->name;?></option>
                    <?php 
                    $first = substr($member->phone, 0, 1);
                    $second = substr($member->phone, 1, 1);
                    if($first==0 && ($second==1||$second==9)){
                    ?>
                    <option value="<?php echo $member->phone;?>"><?php echo $member->phone;?></option>
                    <?php } ?>
            </select>
        </td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtMatKhau">Số tài khoản mặc định:</label></td>
        <td align="left" valign="top"><b class="blue"><?php echo createNumberCard($member->CardAccount['numberaccount']);?> </b></td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtXacNhanMatKhau">Số điện thoại mới:</label></td>
        <td align="left" valign="top"><div class="input">
            <input type="text"  autocomplete="off" class="text" name="data[mobile]"  />
            </div></td>
        </tr>
        <tr>
        <td></td>
            <td>
            <span class="orange" style="width:440px; padding:5px 0; display:block;">Qúy khách đã đăng  ký số điện thoại nhận bằng SMS. Khi xác nhận hoàn tất, sau giây lát BeRichMart sẽ gửi mã giao dịch  vào số điện thoại đăng ký của quý khách</span>
            </td>
        </tr>
            <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtMatKhauCu">Số điện thoại nhận :</label></td>
        <td align="left" valign="top"><b class="blue"><?php echo $member->CardAccount['mobile'];?></b></td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtXacNhanMatKhau">Mã bảo mật:</label></td>
        <td align="left" valign="top">
            <?php echo $form->textField($cardaccount,'captcha',array('class'=>'text','style'=>'width:70px; height:px')); ?>
        
        <?php $this->widget('CCaptcha', array(
                      'buttonLabel'=>'<img src="'.Yii::app()->controller->module->registerImage('f5.png').'" alt="" align="absmiddle">',
                      'clickableImage'=>true,                      
                      'imageOptions'=>array('id'=>'captchaimg','align'=>'absmiddle')
                      ));?>  
            <?php echo $form->error($cardaccount,'captcha'); ?>
        </td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"></td>
        <td align="left" valign="top"><div class="input">
            <input type="submit" name="btnSubmit" value="Thay đổi" class="btnSubmit button-form" />
            <input type="reset" name="btnReset" value="Làm lại" class="btnReset" id="btnReset button-form"/>
            </div></td>
        </tr>
    </table>
    <?php $this->endWidget(); ?>
</div>
<?php
/* simulate a click on "refresh captcha" for GET requests */
if (!Yii::app()->request->isPostRequest)// neu form ko dc submit
    Yii::app()->clientScript->registerScript(
        'initCaptcha',
        '$("#captchaimg_button").trigger("click");',
        CClientScript::POS_READY
    );
?>