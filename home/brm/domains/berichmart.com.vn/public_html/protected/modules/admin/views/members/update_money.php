<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Nạp tiền vào tài khoản</p>
    <a href="#" class="edit" onclick="$('#frm').submit(); return false;">
    <span ></span>
    Nạp tiền
    </a>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
        <form method="post" id="frm">
            <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
                <tr>
                    <td align="left" valign="top" style="width:150px;">Tài khoản</td>
                    <td align="left" valign="top">
                        <label> 
                            <input type="text" name="account" class='text-input' style='width:200px;'>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="width:150px;">Số tiền</td>
                    <td align="left" valign="top">
                        <label> 
                            <input id="moneyformat" type="text" name="money" class='text-input' style='width:200px;'>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Mã giao dịch</td>
                    <td align="left" valign="top">                    
                        <?php $this->widget('CCaptcha', array(
                      'buttonLabel'=>'<img src="'.  getURL().'images/f5.png'.'" alt="" align="absmiddle" style="height:30px; width:auto; margin-left:10px;">',
                      'clickableImage'=>true,                      
                      'imageOptions'=>array('id'=>'captchaimg','align'=>'absmiddle')
                      ));?> 
                    </td>
                </tr>    
                <tr>
                    <td align="left" valign="top">Nhập mã giao dịch</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="captcha" class='text-input' style='width:200px;'>
                    </td>
                </tr>                 
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                            <input type="submit" value ="Nạp tiền"
                    </label></td>
                </tr>
            </table> 
        </form>

    </div><!-- form -->
    <div class="cleare-fix"></div>    
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->
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
    $('#moneyformat').keyup(function(){
            if($(this).val().length>3){
                $.post('<?php echo getURL().'member/account/createNumber';?>',{'number':this.value}, function(data){                    
                   $('#moneyformat').val(data);
                });
            }
        });
});
</script>