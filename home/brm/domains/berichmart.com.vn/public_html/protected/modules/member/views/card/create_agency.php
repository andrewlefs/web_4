<style>
    .tbl_right td{
        color: #555555;
        text-align: left;
        line-height: 20px;
        padding-left: 10px;
    }
    .text-input{ width: 400px;}
    span.required{color: red;}
</style>
<div class="rightmain">
        <div class="quangcao"></div><!--e:quangcao-->
    <div class="bang">
        <div class="tenbang b1"><a class="list" href="#"><h3>Tạo đại lý</h3></a></div>
        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table border="0" cellspacing="0" cellpadding="5" class="tbl_right">           
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Member,'fullname'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($Member,'fullname',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($Member,'fullname'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Member,'email'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($Member,'email',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($Member,'email'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Member,'username'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($Member,'username',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                        <?php echo $form->error($Member,'username'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Member,'reusername'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($Member,'reusername',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                        <?php echo $form->error($Member,'reusername'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Member,'password'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->passwordField($Member,'password',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                        <?php echo $form->error($Member,'password'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Member,'repassword'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->passwordField($Member,'repassword',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                        <?php echo $form->error($Member,'repassword'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Member,'type'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($Member,'type', array('company'=>'Doanh nghiệp','personal'=>'Cá nhân'), array('prompt'=>'Lựa chọn loại thành viên','class'=>'text-input','style'=>'width:214px;')); ?>
                        <?php echo $form->error($Member,'type'); ?>
                    </label>
                </td>
            </tr>   
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Member,'code'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($Member,'code',array('maxlength'=>50,'class'=>'text-input','style'=>'width:200px;')); ?>
                        <?php echo $form->error($Member,'code'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Member,'package_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($Member,'package_id', $package, array('prompt'=>'Lựa chọn gói','class'=>'text-input','style'=>'width:214px;')); ?>
                        <?php echo $form->error($Member,'package_id'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Member,'address'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($Member,'address',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($Member,'address'); ?>
                    </label>
                </td>
            </tr>    
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Member,'image'); ?></td>
                <td align="left" valign="top">
                    <label>                        
                        <?php
                        echo $form->fileField($Member, 'image');
                        echo $form->error($Member, 'image');
                        ?>
                    </label>
                </td>
            </tr>            
            <?php if(!$Member->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Member,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($Member,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($Member,'status'); ?>
                </td>
            </tr>
            <?php }?> 
            <tr>
                <td align="left" valign="top" style="line-height: 52px;">Mã bảo mật</td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($Member,'captcha',array('class'=>'text','style'=>'width:70px; height:px; float:left; margin-top:18px;')); ?>        
                        <?php $this->widget('CCaptcha', array(
                                    'buttonLabel'=>'<img src="'.getURL().'f5.png'.'" alt="" align="absmiddle">',
                                    'clickableImage'=>true,                      
                                    'imageOptions'=>array('id'=>'captchaimg','align'=>'absmiddle')
                                    ));?>  
                        <?php echo $form->error($Member,'captcha'); ?>
                    </label>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($Member->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table>
        <?php $this->endWidget(); ?>
    </div><!--e:bang-->
</div><!--e:rightmain-->
<?php
/* simulate a click on "refresh captcha" for GET requests */
if (!Yii::app()->request->isPostRequest)// neu form ko dc submit
    Yii::app()->clientScript->registerScript(
        'initCaptcha',
        '$("#captchaimg").trigger("click");',
        CClientScript::POS_READY
    );
?>
<script>
$(function(){
    $('#moneyformat').keyup(function(){
            if($(this).val().length>3){
                $.post('<?php echo getURL().'admin/adminMembers/createNumber';?>',{'number':this.value}, function(data){                    
                   $('#moneyformat').val(data);
                });
            }
        });
});
</script>