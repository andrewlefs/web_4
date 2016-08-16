<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($SingerCategory,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($SingerCategory,'name',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($SingerCategory,'name'); ?>
                    </label>
                </td>
            </tr>            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($SingerCategory,'parent_id'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->dropDownList($SingerCategory,'parent_id', $listcat, array('prompt'=>'Lựa chọn danh mục cha','class'=>'text-input','style'=>'width:214px;')); ?>                  
                    <?php echo $form->error($SingerCategory,'parent_id'); ?>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($SingerCategory,'position'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($SingerCategory,'position',array('maxlength'=>14,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($SingerCategory,'position'); ?>
                </td>
            </tr>           
            <?php if(!$SingerCategory->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($SingerCategory,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($SingerCategory,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($SingerCategory,'status'); ?>
                </td>
            </tr>  
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($SingerCategory->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->