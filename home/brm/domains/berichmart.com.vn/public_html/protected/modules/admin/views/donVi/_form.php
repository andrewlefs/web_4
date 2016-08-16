<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($donvi,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($donvi,'name',array('maxlength'=>250,'class'=>'text-input')); ?>
                        <?php echo $form->error($donvi,'name'); ?>
                    </label>
                </td>
            </tr>
            <?php if(!$donvi->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($donvi,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($donvi,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($donvi,'status'); ?>
                </td>
            </tr>  
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($donvi->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->