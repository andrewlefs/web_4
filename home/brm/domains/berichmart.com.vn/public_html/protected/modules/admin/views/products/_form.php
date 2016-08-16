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
                <td align="left" valign="top"><?php echo $form->labelEx($product,'code'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($product,'code',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                        <?php echo $form->error($product,'code'); ?>
                    </label>
                </td>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'quantity'); ?></td>
                <td align="left" valign="top" colspan="3">
                    <label>
                        <?php echo $form->textField($product,'quantity',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                        <?php echo $form->error($product,'quantity'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'price_buy'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($product,'price_buy',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <span>(VNĐ)</span>
                    <?php echo $form->error($product,'price_buy'); ?>
                </td>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'price_sell'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($product,'price_sell',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <span>(VNĐ)</span>
                    <?php echo $form->error($product,'price_sell'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'shipping'); ?></td>
                <td align="left" valign="top" >                    
                    <?php echo $form->textField($product,'shipping',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <span>(VNĐ)</span>
                    <?php echo $form->error($product,'shipping'); ?>
                </td>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'bog'); ?></td>
                <td align="left" valign="top" >                    
                    <?php echo $form->textField($product,'bog',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <span>(%)</span>
                    <?php echo $form->error($product,'bog'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'km'); ?></td>
                <td align="left" valign="top" >                    
                    <?php echo $form->textField($product,'km',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <span>(%)</span>
                    <?php echo $form->error($product,'km'); ?>
                </td>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'hhh'); ?></td>
                <td align="left" valign="top" >                    
                    <?php echo $form->textField($product,'hhh',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <span>(%)</span>
                    <?php echo $form->error($product,'hhh'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'color'); ?></td>
                <td align="left" valign="top" >                    
                    <?php echo $form->textField($product,'color',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($product,'color'); ?>
                </td>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'type'); ?></td>
                <td align="left" valign="top" >                    
                    <?php echo $form->textField($product,'type',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($product,'type'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'quality'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($product,'quality',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($product,'quality'); ?>
                </td>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'material'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($product,'material',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($product,'material'); ?>
                </td>
            </tr>
           
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'origin'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($product,'origin',array('maxlength'=>100,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo $form->error($product,'origin'); ?>
                </td>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'donvitinh'); ?></td>
                <td align="left" valign="top">
                    <?php echo $form->dropDownList($product,'donvitinh', $donvitinh, array('prompt'=>'Lựa chọn đơn vị tính','class'=>'text-input','style'=>'width:214px;')); ?>
                    <?php echo $form->error($product,'donvitinh'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'image'); ?></td>
                <td align="left" valign="top" colspan="3">                  
                    <?php echo $form->textField($product,'image',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo showUpload('Product_image');?>
                    <?php echo $form->error($product,'image'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'image1'); ?></td>
                <td align="left" valign="top" colspan="3">                  
                    <?php echo $form->textField($product,'image1',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo showUpload('Product_image1');?>
                    <?php echo $form->error($product,'image1'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'image2'); ?></td>
                <td align="left" valign="top" colspan="3">                  
                    <?php echo $form->textField($product,'image2',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                    <?php echo showUpload('Product_image2');?>
                    <?php echo $form->error($product,'image2'); ?>
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
            <?php
            if($product->isNewRecord){
            foreach($fields as $key=>$value){?>
             <tr>
                <td align="left" valign="top"><?php echo $value; ?></td>
                <td align="left" valign="top" colspan="3">
                    <?php switch ($fieldall[$key]['type']){
                        case 'text':                            
                            echo '<input type="text" name ="fields['.$key.']" class="text-input">';
                            break;
                        case 'checkbox':
                            echo 'Có <input type="radio" name ="fields['.$key.']" value="Có"> Không <input type="radio" value="Không" name ="fields['.$key.']" checked="checked">';
                            break;
                        case 'textarea':
                            echo '<textarea name ="fields['.$key.']" cols="93" rows="5"></textarea>';
                            break;
                        case 'editor':
                            tiny($this,array('name'=>'fields['.$key.']','id'=>'fields['.$key.']','value'=>'','style'=>'height:300px; width:770px;')); 
                            break;
                        case 'select':
                             $str='<select name ="fields['.$key.']" style="width:214px;" class="text-input">';
                             $str .= '<option value=""> Chọn '.$value.'</option>';
                            $options = unserialize($fieldall[$key]['value']); 
                            foreach($options as $key2=>$value2)
                                $str .= '<option value="'.$key2.'">'.$value2.'</option>';
                            $str .= '</select>';
                            echo $str;
                            break;
                        default :
                            echo '<input type="text" name ="fields['.$key.']" class="text-input">';
                    }?>
                </td>
            </tr>  
            <?php } ?>
            <?php } else {?>
                <?php $otherfields = unserialize($product['fields']); 
                foreach($fieldall as $key=>$value){
                    if(isset ($otherfields[$key]))
                        $data = $otherfields[$key];
                    else
                        $data=null;
                ?>                    
            <tr>
                    <td align="left" valign="top"><?php echo $value['name'];?></td>
                    <td align="left" valign="top" colspan="3"> 
                        <?php switch ($value['type']){
                        case 'text':                            
                            echo '<input type="text" name ="fields['.$key.']" class="text-input" value="'.$data.'">';
                            break;
                        case 'checkbox':
                            if($data=='Không')
                                echo 'Có <input type="radio" name ="fields['.$key.']" value="Có"> Không <input type="radio" value="Không" name ="fields['.$key.']" checked="checked">';
                            else
                                echo 'Có <input type="radio" name ="fields['.$key.']" value="Có" checked="checked"> Không <input type="radio" value="Không" name ="fields['.$key.']">';
                            break;
                        case 'textarea':
                            echo '<textarea name ="fields['.$key.']" cols="93" rows="5">'.$data.'</textarea>';
                            break;
                        case 'editor':
                            tiny($this,array('name'=>'fields['.$key.']','id'=>'fields['.$key.']','value'=>$data,'style'=>'height:300px; width:770px;')); 
                            break;
                        case 'select':
                             $str='<select name ="fields['.$key.']" id ="fields_'.$key.'" style="width:214px;" class="text-input">';
                             $str .= '<option value=""> Chọn '.$value['name'].'</option>';
                            $options = unserialize($value['value']); 
                            foreach($options as $key2=>$value2)
                                $str .= '<option value="'.$key2.'">'.$value2.'</option>';
                            $str .= '</select>';
                            echo $str;
                            echo '<script>setSelected("#fields_'.$key.'","'.$data.'");</script>';
                            break;
                        default :
                            echo '<input type="text" name ="fields['.$key.']" class="text-input" value="'.$data.'">';
                    }?>
                    </td>
                </tr>  
                <?php } ?>
            <?php } ?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($product,'content'); ?></td>
                <td align="left" valign="top" colspan="3">                    
                    <?php  tiny($this,array('name'=>'Product[content]','id'=>'product_content','value'=>$product->content,'style'=>'height:300px; width:770px;')) ?>
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