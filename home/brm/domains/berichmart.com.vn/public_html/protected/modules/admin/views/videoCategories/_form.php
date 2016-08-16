<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($VideoCategory,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($VideoCategory,'name',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($VideoCategory,'name'); ?>
                    </label>
                </td>
            </tr>            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($VideoCategory,'parent_id'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->dropDownList($VideoCategory,'parent_id', $listcat, array('prompt'=>'Lựa chọn danh mục cha','class'=>'text-input','style'=>'width:214px;')); ?>                  
                    <?php echo $form->error($VideoCategory,'parent_id'); ?>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($VideoCategory,'position'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($VideoCategory,'position',array('maxlength'=>14,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($VideoCategory,'position'); ?>
                </td>
            </tr>           
            <?php if(!$VideoCategory->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($VideoCategory,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($VideoCategory,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($VideoCategory,'status'); ?>
                </td>
            </tr>  
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($VideoCategory->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->