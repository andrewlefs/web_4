<div class="form">

<?php /* $form=$this->beginWidget('CActiveForm', array(
	'id'=>'frm',
	'enableAjaxValidation'=>true,    
));
 *
 */
?>
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($banner,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($banner,'name',array('maxlength'=>250,'class'=>'text-input')); ?>
                        <?php echo $form->error($banner,'name'); ?>
                    </label>
                </td>
            </tr>
           
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($banner,'position'); ?></td>
                <td align="left" valign="top"><label>                    
                    <?php echo $form->dropDownList($banner,'position', array('Left'=>'Left','Right'=>'Right','Top'=>'Top','Bottom'=>'Bottom','Logo'=>'Logo'), array('prompt'=>'Lựa chọn vị trí','class'=>'text-input','style'=>'width:214px;')); ?>
                         
                    <?php echo $form->error($banner,'position'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($banner,'images'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($banner,'images',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo showUpload('Banner_images');?>
                    <?php echo $form->error($banner,'images'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($banner,'stt'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($banner,'stt',array('maxlength'=>256,'class'=>'text-input')); ?>
                   
                    <?php echo $form->error($banner,'stt'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($banner,'link'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($banner,'link',array('maxlength'=>256,'class'=>'text-input')); ?>
                   
                    <?php echo $form->error($banner,'link'); ?>
                </td>
            </tr>
            <?php if(!$banner->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($banner,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($banner,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($banner,'status'); ?>
                </td>
            </tr> 
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($banner->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->