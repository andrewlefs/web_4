<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0">
             
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($gallery,'name'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($gallery,'name',array('maxlength'=>50,'class'=>'text-input')); ?>
                    <?php echo $form->error($gallery,'name'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($gallery,'images'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($gallery,'images',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                     <?php echo showUpload('Gallery_images');?>
                    <?php echo $form->error($gallery,'images'); ?>
                </td>
            </tr>
          
               <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($gallery,'link'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($gallery,'link',array('maxlength'=>256,'class'=>'text-input')); ?>
                    <?php echo $form->error($gallery,'link'); ?>
                </td>
            </tr>
            
           <?php if(!$gallery->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($gallery,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($gallery,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($gallery,'status'); ?>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($gallery->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table>	

<?php $this->endWidget(); ?>

</div><!-- form -->