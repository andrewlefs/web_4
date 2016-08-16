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
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($cat,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($cat,'name',array('maxlength'=>250,'class'=>'text-input')); ?>
                        <?php echo $form->error($cat,'name'); ?>
                    </label>
                </td>
            </tr>            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($cat,'parent_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($cat,'parent_id', $listcat, array('prompt'=>'Lựa chọn danh mục cha','class'=>'text-input','style'=>'width:214px;')); ?>                        
                        <?php echo $form->error($cat,'parent_id'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($cat,'group_product_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($cat,'group_product_id', $listgroup, array('prompt'=>'Lựa chọn nhóm sản phẩm','class'=>'text-input','style'=>'width:214px;')); ?>
                        <span style="color: red;">Chỉ áp dụng cho danh mục sản phẩm</span>
                        <?php echo $form->error($cat,'group_product_id'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($cat,'order'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($cat,'order',array('maxlength'=>5,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($cat,'order'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($cat,'show'); ?></td>
                <td align="left" valign="top" >
                    <div style="position: relative;">
                        <?php echo $form->radioButtonList($cat,'show',array('1'=>'Hiện','0'=>'Không hiện')); ?>
                        <span style="color: red; position: absolute; top: 12px; left: 112px;">Lựa chọn chỉ dành cho danh mục sản phẩm </span>
                        <?php echo $form->error($cat,'show'); ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($cat,'icon'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($cat,'icon',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo showUpload('Category_icon');?>
                    <?php echo $form->error($cat,'icon'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($cat,'image'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($cat,'image',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo showUpload('Category_image');?>
                    <?php echo $form->error($cat,'image'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($cat,'meta_key'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textArea($cat,'meta_key',array('class'=>'text-input','rows'=>5)); ?>
                    <?php echo $form->error($cat,'meta_key'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($cat,'meta_des'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textArea($cat,'meta_des',array('class'=>'text-input','rows'=>7)); ?>
                    <?php echo $form->error($cat,'meta_des'); ?>
                </td>
            </tr>
            <?php if(!$cat->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($cat,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($cat,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($cat,'status'); ?>
                </td>
            </tr>  
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($cat->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->