<style>
    .error2{
        display: none;
        color: red;
    }
    .errorMessage{color: red;}
    .doimatkhau td{ padding: 5px;}
    .doimatkhau td.title{ vertical-align: middle;}
    .doimatkhau tr td:first-child{ width: 200px; text-align: right;}
    .doimatkhau form input.text{
        height: 26px; line-height: 26px; width: 200px;
    }
    #Member_captcha{float: left; margin-top: 10px;}
    #captchaimg_button img{margin-bottom: 12px;}
</style>
<div class="cotmain">
    <div class="tieude">
            <h2>Đổi mật khẩu truy cập</h2>
    </div>
        <div class="thongtin-ct doimatkhau">
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
                    <?php $this->widget('CCaptcha', array(
                                'buttonLabel'=>'<img src="'.getURL().'images/f5.png'.'" alt="" align="absmiddle">',
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
</div><!--ecotmain-->
<?php
/* simulate a click on "refresh captcha" for GET requests */
if (!Yii::app()->request->isPostRequest)// neu form ko dc submit
    Yii::app()->clientScript->registerScript(
        'initCaptcha',
        '$("#captchaimg_button").trigger("click");',
        CClientScript::POS_READY
    );
?>
<script>
$(function(){
    $('#frm').submit(function(){
        if($('#Member_newpass').val()!=$('#Member_confirmpass').val())
            {
                $('#Member_confirmpass_em_').text('Xác nhận mật khẩu không chính xác');
                $('#Member_confirmpass_em_').show();
                return false;
            }
            else{$('#Member_confirmpass_em_').hide();}
    });
    $('#Member_confirmpass').blur(function(){
        if($('#Member_newpass').val()!=$('#Member_confirmpass').val())
            {
                $('#Member_confirmpass_em_').text('Xác nhận mật khẩu không chính xác');
                $('#Member_confirmpass_em_').show();
            }
            else{$('#Member_confirmpass_em_').hide();}
    })
})
</script>