<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($cities,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($cities,'name',array('maxlength'=>250,'class'=>'text-input')); ?>
                        <?php echo $form->error($cities,'name'); ?>
                    </label>
                </td>
            </tr>            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($cities,'stt'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($cities,'stt',array('maxlength'=>5,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($cities,'stt'); ?>
                </td>
            </tr> 
            <?php if(!$cities->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($cities,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($cities,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($cities,'status'); ?>
                </td>
            </tr>  
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($cities->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->