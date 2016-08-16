<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($singer,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($singer,'name',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($singer,'name'); ?>
                    </label>
                </td>
            </tr>   
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($singer,'image'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($singer,'image',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo showUploadCKFinder('Singer_image');?>
                        <?php echo $form->error($singer,'image'); ?>
                    </label>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($singer,'place'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->dropDownList($singer,'place', array('VN'=>'Việt Nam','AM'=>'Âu Mỹ','CA'=>'Châu Á'), array('prompt'=>'Lựa chọn nơi sống','class'=>'text-input','style'=>'width:214px;')); ?>                  
                    <?php echo $form->error($singer,'place'); ?>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($singer,'birthday'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($singer,'birthday',array('maxlength'=>14,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($singer,'birthday'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($singer,'information'); ?></td>
                <td align="left" valign="top">                    
                    <?php tiny($this,array('name'=>'Singer[information]','id'=>'singer_information','value'=>$singer->information,'style'=>'height:300px; width:770px;')) ?>
                    <?php echo $form->error($singer,'information'); ?>
                </td>
            </tr>
            <?php if(!$singer->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($singer,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($singer,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($singer,'status'); ?>
                </td>
            </tr>  
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($singer->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->