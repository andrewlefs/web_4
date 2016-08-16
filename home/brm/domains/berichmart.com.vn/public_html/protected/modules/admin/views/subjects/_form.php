<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($subject,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($subject,'name',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($subject,'name'); ?>
                    </label>
                </td>
            </tr>            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($subject,'position'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($subject,'position',array('maxlength'=>5,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($subject,'position'); ?>
                </td>
            </tr> 
            <?php if(!$subject->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($subject,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($subject,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($subject,'status'); ?>
                </td>
            </tr>  
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($subject->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->