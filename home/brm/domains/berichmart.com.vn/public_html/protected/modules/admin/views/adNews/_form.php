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
                <td align="left" valign="top"><?php echo $form->labelEx($AdNews,'title'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($AdNews,'title',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($AdNews,'title'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AdNews,'price'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($AdNews,'price',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                        <?php echo $form->error($AdNews,'price'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AdNews,'status2'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($AdNews,'status2',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($AdNews,'status2'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AdNews,'expire'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($AdNews,'expire',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                        <?php echo $form->error($AdNews,'expire'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AdNews,'type'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($AdNews,'type', array('1'=>'Cần mua','2'=>'Cần bán','3'=>'Cần thuê','4'=>'Cho thuê'), array('prompt'=>'Chọn loại tin đăng','class'=>'text-input','style'=>'width:214px;')); ?>
                        <?php echo $form->error($AdNews,'type'); ?>
                    </label>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AdNews,'city_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($AdNews,'city_id', $cities, array('prompt'=>'Lựa chọn nơi đăng','class'=>'text-input','style'=>'width:214px;')); ?>
                        <?php echo $form->error($AdNews,'city_id'); ?>
                    </label>
                </td>
            </tr>     
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AdNews,'category_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($AdNews,'category_id', $listcat, array('prompt'=>'Lựa chọn danh mục','class'=>'text-input','style'=>'width:214px;')); ?>
                        <?php echo $form->error($AdNews,'category_id'); ?>
                    </label>
                </td>
            </tr>              
            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AdNews,'introduction'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textArea($AdNews,'introduction',array('class'=>'text-input','rows'=>7)); ?>
                    <?php echo $form->error($AdNews,'introduction'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AdNews,'content'); ?></td>
                <td align="left" valign="top">                    
                    <?php tiny($this,array('name'=>'AdNews[content]','id'=>'AdNews_content','value'=>$AdNews->content,'style'=>'height:300px; width:770px;')) ?>
                    <?php echo $form->error($AdNews,'content'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AdNews,'image'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($AdNews,'image',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                        <?php echo showUpload('AdNews_image');?>
                        <?php echo $form->error($AdNews,'image'); ?>
                    </label>
                </td>
            </tr> 
            <?php if(!$AdNews->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($AdNews,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($AdNews,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($AdNews,'status'); ?>
                </td>
            </tr>  
            <?php }?>                   
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($AdNews->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table>	

<?php $this->endWidget(); ?>

</div><!-- form -->
