<div class="form">

<?php /* $form=$this->beginWidget('CActiveForm', array(
	'id'=>'frm',
	'enableAjaxValidation'=>true,    
));
 *
 */
?>
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($user,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($user,'name',array('maxlength'=>200,'class'=>'text-input')); ?>
                        <?php echo $form->error($user,'name'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($user,'password'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->passwordField($user,'password',array('maxlength'=>200,'class'=>'text-input')); ?>
                        <?php echo $form->error($user,'password'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><label for="re_password">Xác nhận mật khẩu *</label></td>
                <td align="left" valign="top">
                    <label><input id="re_password" name="re_password" type="password" class="text-input"/></label>                    
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($user,'power'); ?></td>
                <td align="left" valign="top"><label>                    
                    <?php echo $form->dropDownList($user,'power', array('0'=>'Admin','1'=>'Nhân viên','2'=>'Kế toán'), array('prompt'=>'Chọn cấp độ')); ?>
                    <?php echo $form->error($user,'power'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($user,'fullname'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($user,'fullname',array('maxlength'=>256,'class'=>'text-input')); ?>
                    <?php echo $form->error($user,'fullname'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($user,'email'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($user,'email',array('maxlength'=>200,'class'=>'text-input')); ?>
                    <?php echo $form->error($user,'email'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($user,'phone'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($user,'phone',array('maxlength'=>15,'class'=>'text-input')); ?>
                    <?php echo $form->error($user,'phone'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($user,'birth_date'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($user,'birth_date',array('maxlength'=>15,'class'=>'text-input')); ?>
                    <?php echo $form->error($user,'birth_date'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($user,'sex'); ?></td>
                <td align="left" valign="top"><label>                    
                    <?php echo $form->dropDownList($user,'sex', array('Nam'=>'Nam','Nữ'=>'Nữ'), array('prompt'=>'Lựa chọn giới tính')); ?>
                    <?php echo $form->error($user,'sex'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($user,'images'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($user,'images',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($user,'images'); ?>
                      <?php echo showUpload('user_images');?>
                </td>
            </tr>
            
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($user,'content'); ?></td>
                <td align="left" valign="top">                    
                    <?php tiny($this,array('name'=>'users[content]','id'=>'users_content','value'=>$user->content,'style'=>'height:300px; width:770px;')) ?>
                    <?php echo $form->error($user,'content'); ?>
                  
                </td>
            </tr>
            <?php if(!$user->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($user,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($user,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($user,'status'); ?>
                </td>
            </tr> 
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($user->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->