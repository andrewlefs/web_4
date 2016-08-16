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
                <td align="left" valign="top"><?php echo $form->labelEx($producer,'name'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($producer,'name',array('maxlength'=>50,'class'=>'text-input')); ?>
                    <?php echo $form->error($producer,'name'); ?>
                </td>
            </tr>
            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($producer,'group_product_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($producer,'group_product_id', $listgroup, array('prompt'=>'Lựa chọn danh mục','class'=>'text-input','style'=>'width:214px;')); ?>
                        <?php echo $form->error($producer,'group_product_id'); ?>
                    </label>
                </td>
            </tr> 
            
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($producer->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table>	

<?php $this->endWidget(); ?>

</div><!-- form -->