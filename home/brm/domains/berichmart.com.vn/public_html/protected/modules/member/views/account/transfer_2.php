<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
    <!-- .title -->
    <form action="" method="post" accept-charset="utf-8" id="myform" class="cssform">
    <input type="hidden" name="txtMa" value="135"  class="text"/>
    <table width="100%" border="0" style="margin-top:0;" cellspacing="1" cellpadding="0" class="table-form table-member style2">
        <thead>
            <tr>
                <td colspan="2">Chuyển khoản</td>
            </tr>
        </thead>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical" style="width:220px;">Tài khoản trích nợ:</td>
            <td align="left" valign="top">
                <?php echo $transfer['data']['account_send'];?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Số dư tài khoản trích nợ hiện tại:</td>
            <td align="left" valign="top">
                <?php echo number_format($transfer['account_send']['money']).' VNĐ';?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Tài khoản ghi nợ:</td>
            <td align="left" valign="top">
                <?php echo $transfer['data']['account_get'];?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Tên chủ tài khoản ghi nợ:</td>
            <td align="left" valign="top" style="text-transform: capitalize; color: red; font-weight: bold;">
                <?php                 
                echo $member_get->fullname;?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Số tiền chuyển khoản:</td>
            <td align="left" valign="top">
                <?php echo $transfer['data']['money'].' VNĐ';?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Nội dung thanh toán:</td>
            <td align="left" valign="top">
                <?php echo $transfer['data']['information'];?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Phí:</td>
            <td align="left" valign="top">
                Phí người chuyển trả
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Số tiền phí:</td>
            <td align="left" valign="top">
                0 VNĐ
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Hình thức nhận mã giao dịch:</td>
            <td align="left" valign="top">
                <select name="type_send" style="width: 160px;" onchange="if(this.value=='email'){$('#email_text').show();$('#ssm_text').hide();} else {$('#email_text').hide();$('#ssm_text').show();}">
                    <option value="sms">Qua SMS</option>
                    <option value="email">Qua Email</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span id="ssm_text">Qúy khách đã đăng ký số điện thoại nhận bằng SMS. Sau giây lát, mã giao dịch sẽ được gửi đến số điện thoại của quý khách</span>
                <span id="email_text" style="display: none;">Sau giây lát, mã giao dịch sẽ được gửi đến địa chỉ email của quý khách</span>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="middle" class="title-vertical">Mã kiểm tra:</td>
            <td align="left" valign="top">
                <?php $this->widget('CCaptcha', array(
                      'buttonLabel'=>'<img src="'.Yii::app()->controller->module->registerImage('f5.png').'" alt="" align="absmiddle">',
                      'clickableImage'=>true,                      
                      'imageOptions'=>array('id'=>'captchaimg','align'=>'absmiddle','style'=>'height:30px; width:auto;')
                      ));?>  
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="middle" class="title-vertical">Nhập lai đãy số trên:</td>
            <td align="left" valign="top">
                <input type="text" name="captcha">
            </td>
        </tr>
        <tr>        
            <td align="left" valign="top" colspan="2"><div class="input">
                <input type="submit" name="btnSubmit" value="Xác nhận" class="btnSubmit button-form">
                <input type="button" name="btnReset" value="Quay lại" class="btnReset" id="btnReset button-form" onclick="window.history.back();">
                </div></td>
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