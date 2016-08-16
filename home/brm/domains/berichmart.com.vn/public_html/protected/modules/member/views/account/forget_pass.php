<div class="box-right box-common" style="max-height:none;">
    <div class="title-box">Quên mật khẩu thẻ</div>
    <form method="post">
    <table width="770px" border="0" cellspacing="1" cellpadding="0" class="table-form">
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtXacNhanMatKhau">Mã bảo mật website:</label></td>
        <td align="left" valign="top">

        <input class="text" type="text" autocomplete="off" title="Mã số an toàn" id="security_code" name="security_code" value="" style="width:70px; height:px">        
        <?php $this->widget('CCaptcha', array(
                      'buttonLabel'=>'<img src="'.Yii::app()->controller->module->registerImage('f5.png').'" alt="" align="absmiddle">',
                      'clickableImage'=>true,                      
                      'imageOptions'=>array('id'=>'captchaimg','align'=>'absmiddle')
                      ));?>  
        </td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"></td>
        <td align="left" valign="top"><div class="input">
            <input type="submit" name="btnSubmit" value="Gửi" class="btnSubmit button-form"/>
            </div></td>
        </tr>
        <tr>
        <td colspan="2" style="padding-left:60px;"><b>
        Bước 1: Nhập mã bảo mật website và ấn nút gửi<br /><br />
Bước 2: Hệ thống sẽ gửi một tin nhắn mã số bảo mật tới điện thoại của bạn. Nhập chính xác mã số bảo mật điện thoại.<br /><br />
Bước 3: Hệ thông kiểm tra mã số bảo mật điện thoại bạn nhập vào. Nếu đúng một mật khẩu thẻ mới sẽ được gửi vào số điện thoại trong gian hàng của bạn
        </b>
        <td>
        </tr>
    </table>
    </form>
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