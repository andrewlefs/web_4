<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($Regulation,'title'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($Regulation,'title',array('maxlength'=>250,'class'=>'text-input')); ?>
                        <?php echo $form->error($Regulation,'title'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($Regulation,'content'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php tiny($this,array('name'=>'Regulation[content]','id'=>'Regulation_content','value'=>$Regulation->content,'style'=>'height:300px; width:770px;')) ?>
                        <?php echo $form->error($Regulation,'content'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="l
                    eft" valign="top"><label>
                    <?php echo CHtml::submitButton($Regulation->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->