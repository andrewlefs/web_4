<div class="form">

<?php /* $form=$this->beginWidget('CActiveForm', array(
	'id'=>'frm',
	'enableAjaxValidation'=>true,    
));
 */
  
?>
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($field,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($field,'name',array('maxlength'=>250,'class'=>'text-input')); ?>
                        <?php echo $form->error($field,'name'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($field,'type'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($field,'type', array('text'=>'TextBox','textarea'=>'TextArea','editor'=>'Editor','checkbox'=>'CheckBox','select'=>'SelectBox'), array('prompt'=>'Chọn kiểu nhập liệu','class'=>'text-input','style'=>'width:214px;')); ?>
                        <?php echo $form->error($field,'type'); ?>
                    </label>
                </td>
            </tr>
            <tr class="messinfo">
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($field,'value'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <p>Nhập các giá trị ngăn cách nhau bởi ký tự #</p>
                        <?php echo $form->textArea($field,'value',array('rows'=>5,'cols'=>93)); ?>
                        <?php echo $form->error($field,'value'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($field,'group_product_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($field,'group_product_id', $listgroup, array('prompt'=>'Chọn nhóm sản phẩm','class'=>'text-input','style'=>'width:214px;')); ?>
                        <?php echo $form->error($field,'group_product_id'); ?>
                    </label>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($field,'issearch'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($field,'issearch',array('1'=>'Có','0'=>'Không')); ?>
                    <?php echo $form->error($field,'issearch'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($field->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$(function(){
    type = $('#ProductOption_type').val();
    if(type=='select'){
        $('.messinfo').show();
    }
    else{
        $('.messinfo').hide();
    }
    $('#ProductOption_type').change(function(){
        if(this.value=='select'){
            $('.messinfo').show();
    }
        else{
            $('.messinfo').hide();
    }
    });
});
</script>