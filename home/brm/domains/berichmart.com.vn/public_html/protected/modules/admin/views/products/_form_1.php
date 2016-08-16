<script>
    function setSelected(id,value){ 
        $(id+' option').each(function(){ 
            if(this.value==value)
                $(this).attr('selected', 'selected');
        });
    }
    $(function(){
        $('#Product_title').blur(function(){
            if($('#Product_meta_key').val()=='')
                $('#Product_meta_key').val(this.value);
            if($('#Product_meta_des').val()=='')
                $('#Product_meta_des').val(this.value);
        });
    })
</script>
    
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($product,'title'); ?></td>
                <td align="left" valign="top" colspan="3">
                    <label> 
                        <?php echo $form->textField($product,'title',array('maxlength'=>250,'class'=>'text-input')); ?>
                        <?php echo $form->error($product,'title'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'category_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($product,'category_id', $listcat, array('prompt'=>'Lựa chọn danh mục','class'=>'text-input','style'=>'width:214px;')); ?>
                        <?php echo $form->error($product,'category_id'); ?>
                    </label>
                </td>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'producer_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($product,'producer_id', $arrmember, array('prompt'=>'Lựa chọn nhà sản xuất','class'=>'text-input','style'=>'width:214px;')); ?>
                        <?php echo $form->error($product,'producer_id'); ?>
                    </label>
                </td>
            </tr>            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'price'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($product,'price',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <span>(USD)</span>
                    <?php echo $form->error($product,'price'); ?>
                </td> 
                <td align="left" valign="top"><?php echo $form->labelEx($product,'quantity'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($product,'quantity',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($product,'quantity'); ?>
                </td> 
            </tr>            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'km'); ?></td>
                <td align="left" valign="top" >                    
                    <?php echo $form->textField($product,'km',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <span>(usd)</span>
                    <?php echo $form->error($product,'km'); ?>
                </td>  
                <td align="left" valign="top"><?php echo $form->labelEx($product,'origin'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($product,'origin',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($product,'origin'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'image'); ?></td>
                <td align="left" valign="top" colspan="3">                  
                    <?php echo $form->textField($product,'image',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo showUploadCKFinder('Product_image');?>
                    <?php echo $form->error($product,'image'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'image1'); ?></td>
                <td align="left" valign="top" colspan="3">                  
                    <?php echo $form->textField($product,'image1',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo showUploadCKFinder('Product_image1');?>
                    <?php echo $form->error($product,'image1'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'image2'); ?></td>
                <td align="left" valign="top" colspan="3">                  
                    <?php echo $form->textField($product,'image2',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo showUploadCKFinder('Product_image2');?>
                    <?php echo $form->error($product,'image2'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'image3'); ?></td>
                <td align="left" valign="top" colspan="3">                  
                    <?php echo $form->textField($product,'image3',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo showUploadCKFinder('Product_image3');?>
                    <?php echo $form->error($product,'image3'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($product,'famous'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->radioButtonList($product,'famous',array('0'=>'Bình thường','1'=>'Nổi bật')); ?>
                        <?php echo $form->error($product,'famous'); ?>
                    </label>
                </td>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($product,'reduce'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->radioButtonList($product,'reduce',array('0'=>'Bình thường','1'=>'Giảm giá')); ?>
                        <?php echo $form->error($product,'reduce'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'content'); ?></td>
                <td align="left" valign="top" colspan="3">                    
                    <?php ckeditor($this,array('name'=>'Product[content]','id'=>'product_content','value'=>$product->content,'style'=>'height:300px; width:770px;')) ?>
                    <?php echo $form->error($product,'content'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'meta_key'); ?></td>
                <td align="left" valign="top" colspan="3">                    
                    <?php echo $form->textArea($product,'meta_key',array('rows'=>7,'cols'=>93)); ?>
                    <?php echo $form->error($product,'meta_key'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'meta_des'); ?></td>
                <td align="left" valign="top" colspan="3">                    
                    <?php echo $form->textArea($product,'meta_des',array('rows'=>7,'cols'=>93)); ?>
                    <?php echo $form->error($product,'meta_des'); ?>
                </td>
            </tr>
            <?php if(!$product->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'status'); ?></td>
                <td align="left" valign="top" colspan="3">                    
                    <?php echo $form->radioButtonList($product,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($product,'status'); ?>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top" colspan="3"><label>
                    <?php echo CHtml::submitButton($product->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->