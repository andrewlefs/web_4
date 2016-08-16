<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Cấp lại mật khẩu</p>
    <a href="#" class="edit" onclick="$('#frm').submit(); return false;">
    <span ></span>
    Lưu
    </a>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
            <table width="949" border="0" cellspacing="1" cellpadding="0">
                <tr>
                    <td align="left" valign="top">Tên đăng nhập</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[name]" id="name_mem" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Mật khẩu mới</td>
                    <td align="left" valign="top">                    
                        <input type="password" id="password" name="data[password]" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Nhập lại mật khẩu mới</td>
                    <td align="left" valign="top">                    
                        <input type="password" id="re_password" name="data[re_password]" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                        <?php echo CHtml::submitButton('Cập nhật',array('class'=>'button')); ?>
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
        $('#name_mem').blur(function(){
            $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'name':this.value}, function(data){
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