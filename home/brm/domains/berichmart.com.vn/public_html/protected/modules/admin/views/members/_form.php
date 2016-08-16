<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'name'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($member,'name',array('maxlength'=>256,'class'=>'text-input','disabled'=>'disabled')); ?>
                    <?php echo $form->error($member,'name'); ?>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($member,'password'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($member,'password',array('maxlength'=>250,'class'=>'text-input','style'=>'width:200px;')); ?>
                        <?php echo $form->error($member,'password'); ?>
                    </label>
                </td>
            </tr>            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'fullname'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($member,'fullname',array('maxlength'=>256,'class'=>'text-input')); ?>
                    <?php echo $form->error($member,'fullname'); ?>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'email'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($member,'email',array('maxlength'=>256,'class'=>'text-input')); ?>
                    <?php echo $form->error($member,'email'); ?>
                </td>
            </tr> <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'address'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($member,'address',array('maxlength'=>256,'class'=>'text-input')); ?>
                    <?php echo $form->error($member,'address'); ?>
                </td>
            </tr> <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'cmnd'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($member,'cmnd',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($member,'cmnd'); ?>
                </td>
            </tr> <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'date_create'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($member,'date_create',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($member,'date_create'); ?>
                </td>
            </tr> <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'place_create'); ?></td>
                <td align="left" valign="top">                    
                    <?php 
                       echo $form->dropDownList($member,'place_create', $cities, array('prompt'=>'--[Chọn]--','class'=>'text-input','style'=>'width:200px;'));
                    ?>
                    <?php echo $form->error($member,'place_create'); ?>
                </td>
            </tr> <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'address_cmnd'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($member,'address_cmnd',array('maxlength'=>256,'class'=>'text-input')); ?>
                    <?php echo $form->error($member,'address_cmnd'); ?>
                </td>
            </tr> <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'phone'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($member,'phone',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($member,'phone'); ?>
                </td>
            </tr> <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'sex'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->dropDownList($member,'sex', array('1'=>'Nam','0'=>'Nữ'), array('prompt'=>'Lựa chọn giới tính')); ?>
                    <?php echo $form->error($member,'sex'); ?>
                </td>
            </tr> <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'birthday'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($member,'birthday',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($member,'birthday'); ?>
                </td>
            </tr> <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'city_id'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->dropDownList($member,'city_id', $cities, array('prompt'=>'--[Chọn]--','class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($member,'city_id'); ?>
                </td>
            </tr> 
            <?php if(!$member->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($member,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($member,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($member,'status'); ?>
                </td>
            </tr>  
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($member->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->