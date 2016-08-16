<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0">
           
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($setting,'name'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($setting,'name',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($setting,'name'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($setting,'address'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($setting,'address',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($setting,'address'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($setting,'phone'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($setting,'phone',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($setting,'phone'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($setting,'mobile'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($setting,'mobile',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($setting,'mobile'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($setting,'fax'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($setting,'fax',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($setting,'fax'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($setting,'email'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($setting,'email',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($setting,'email'); ?>
                    </label>
                </td>
            </tr>
            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($setting,'info_other'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textArea($setting,'info_other',array('class'=>'text-input','rows'=>7)); ?>
                    <?php echo $form->error($setting,'info_other'); ?>
                </td>
            </tr>      
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($setting->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table>	

<?php $this->endWidget(); ?>

</div><!-- form -->
