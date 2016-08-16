<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Đóng tài khoản thành viên</p>
    <a href="#" class="edit" onclick="$('#frm').submit(); return false;">
    <span ></span>
    Cập nhật
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
                    <td align="left" valign="top">Đóng tài khoản</td>
                    <td align="left" valign="top">                    
                        <input type="checkbox" id="statusmember" name="data[status]" > 
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
        name = $.trim($('#name_mem').val());
        if(name==''){
            alert('Tên đăng nhập chưa nhập')
            return false;
        }
    });
    
    })
</script>