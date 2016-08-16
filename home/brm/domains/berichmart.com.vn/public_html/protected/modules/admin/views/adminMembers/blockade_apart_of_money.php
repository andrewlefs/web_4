<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Phong tỏa một phần số dư</p>
    <a href="#" class="edit" onclick="$('#frm').submit(); return false;">
    <span ></span>
    Phong tỏa
    </a>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
            <table width="949" border="0" cellspacing="1" cellpadding="0">
                <tr>
                    <td align="left" valign="top">Số CMTND</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[cmnd]" id="cmnd" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Số tài khoản</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[numberaccount]" id="numberaccount" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Số tiền hiện tại</td>
                    <td align="left" valign="top">                    
                        <input type="text" id="currentmoney"  disabled="disabled" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Số tiền phong tỏa</td>
                    <td align="left" valign="top">                    
                        <input type="text" id="blockedmoney" name="data[blockedmoney]" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Diễn giải</td>
                    <td align="left" valign="top">                    
                        <input type="text" id="info" name="data[information]" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                        <?php echo CHtml::submitButton('Phong tỏa',array('class'=>'button')); ?>
                    </label></td>
                </tr>
            </table>	

    <?php $this->endWidget(); ?>

    </div><!-- form -->  
    <!-- thong tin ca nhan -->
    <div class="info_member">
        
    </div>
    <!-- end thong tin ca nhan -->
    <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->
<script>
    $(function(){
        $('#cmnd').blur(function(){
            $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'cmnd':this.value}, function(data){
                $('.info_member').html(data);
            })
        });
        $('#numberaccount').blur(function(){
            $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'numberaccount':this.value}, function(data){
                $('.info_member').html(data);
            })
        });
        
    $('#frm').submit(function(){    
        password = $.trim($('#password').val());
        re_password = $.trim($('#re_password').val());
        if(password!=re_password){
            alert('Mật khẩu xác nhận không chính xác !')
            return false;
        }
        if($('#name_mem').val()=='')
            return false;
    });
    
    })
</script>