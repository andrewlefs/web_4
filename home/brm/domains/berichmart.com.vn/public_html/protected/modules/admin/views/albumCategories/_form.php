<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($AlbumCategory,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($AlbumCategory,'name',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($AlbumCategory,'name'); ?>
                    </label>
                </td>
            </tr>            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AlbumCategory,'parent_id'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->dropDownList($AlbumCategory,'parent_id', $listcat, array('prompt'=>'Lựa chọn danh mục cha','class'=>'text-input','style'=>'width:214px;')); ?>                  
                    <?php echo $form->error($AlbumCategory,'parent_id'); ?>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AlbumCategory,'position'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($AlbumCategory,'position',array('maxlength'=>14,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($AlbumCategory,'position'); ?>
                </td>
            </tr>           
            <?php if(!$AlbumCategory->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AlbumCategory,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($AlbumCategory,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($AlbumCategory,'status'); ?>
                </td>
            </tr>  
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($AlbumCategory->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->