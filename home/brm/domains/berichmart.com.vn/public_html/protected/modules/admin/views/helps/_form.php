<div class="form">

<?php /* $form=$this->beginWidget('CActiveForm', array(
	'id'=>'frm',
	'enableAjaxValidation'=>true,    
));
 *
 */
?>
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0">
             
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($help,'email'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($help,'email',array('maxlength'=>256,'class'=>'text-input')); ?>
                    <?php echo $form->error($help,'email'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($help,'yahoo'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($help,'yahoo',array('maxlength'=>256,'class'=>'text-input')); ?>
                    <?php echo $form->error($help,'yahoo'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($help,'skype'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($help,'skype',array('maxlength'=>256,'class'=>'text-input')); ?>
                    <?php echo $form->error($help,'skype'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($help,'hotline'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($help,'hotline',array('maxlength'=>256,'class'=>'text-input')); ?>
                    <?php echo $form->error($help,'hotline'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($help,'sdt'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($help,'sdt',array('maxlength'=>256,'class'=>'text-input')); ?>
                    <?php echo $form->error($help,'sdt'); ?>
                </td>
            </tr>
           <?php if(!$help->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($help,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($help,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($help,'status'); ?>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($help->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table>	

<?php $this->endWidget(); ?>

</div><!-- form -->