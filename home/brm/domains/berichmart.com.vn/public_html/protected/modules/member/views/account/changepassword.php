<style>
    .error2{
        display: none;
        color: red;
    }
</style>

<div class="box-right box-common box-common-table" style="max-height:none;">
    <div class="title-box">Đổi mật khẩu truy cập</div>
    <!-- .title -->
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm','enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true),'htmlOptions' => array('enctype' => 'multipart/form-data') ));?>
    <input type="hidden" name="txtMa" value="135"  class="text"/>
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table-form">
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtTenSuDung">Tên truy cập:</label></td>
        <td align="left" valign="top"><div class="input">
            <b><?php echo $member->name;?></b>
            </div></td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtMatKhauCu">Mật khẩu cũ:</label></td>
        <td align="left" valign="top">
            <div class="input">            
            <?php echo $form->passwordField($member,'oldpass',array('class'=>'text','value'=>'')); ?>
            </div>         
            <?php echo $form->error($member,'oldpass'); ?>
            
        </td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtMatKhau">Mật khẩu:</label></td>
        <td align="left" valign="top"><div class="input">
            <?php echo $form->passwordField($member,'newpass',array('class'=>'text')); ?>
            </div>
            <?php echo $form->error($member,'newpass'); ?>
        </td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtXacNhanMatKhau">Gõ lại mật khẩu:</label></td>
        <td align="left" valign="top"><div class="input">
            <?php echo $form->passwordField($member,'confirmpass',array('class'=>'text')); ?>
            </div>
            <?php echo $form->error($member,'confirmpass'); ?>
        </td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtXacNhanMatKhau">Mã bảo mật:</label></td>
        <td align="left" valign="top">        
        <?php echo $form->textField($member,'captcha',array('class'=>'text','style'=>'width:70px; height:px')); ?>
        <img align="absmiddle" hspace="5" src="images/getcaptcha.png" alt="">&nbsp;&nbsp;<a href=""><img src="images/f5.png" alt="" align="absmiddle"></a>
        <?php $this->widget('CCaptcha', array(
                      'buttonLabel'=>'<img src="'.Yii::app()->controller->module->registerImage('f5.png').'" alt="" align="absmiddle">',
                      'clickableImage'=>true,                      
                      'imageOptions'=>array('id'=>'captchaimg','align'=>'absmiddle')
                      ));?>  
        <?php echo $form->error($member,'captcha'); ?>
        </td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"></td>
        <td align="left" valign="top"><div class="input">
            <input type="submit" name="btnSubmit" value="Thay đổi" class="btnSubmit button-form" />
            <input type="reset" name="btnReset" value="Làm lại" class="btnReset" id="btnReset button-form" />
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