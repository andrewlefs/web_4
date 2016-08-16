<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0">
           
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($news,'title'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($news,'title',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($news,'title'); ?>
                    </label>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($news,'category_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($news,'category_id', $listcat, array('prompt'=>'Lựa chọn danh mục','class'=>'text-input','style'=>'width:214px;')); ?>
                        <?php echo $form->error($news,'category_id'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($news,'slidenews'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($news,'slidenews',array('1'=>'Hiện','0'=>'Không hiên')); ?>
                    <?php echo $form->error($news,'slidenews'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($news,'hotnews'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($news,'hotnews',array('1'=>'Hiện','0'=>'Không hiện')); ?>
                    <?php echo $form->error($news,'hotnews'); ?>
                </td>
            </tr>
            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($news,'introduction'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textArea($news,'introduction',array('class'=>'text-input','rows'=>7)); ?>
                    <?php echo $form->error($news,'introduction'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($news,'content'); ?></td>
                <td align="left" valign="top">                    
                    <?php tiny($this,array('name'=>'News[content]','id'=>'news_content','value'=>$news->content,'style'=>'height:300px; width:770px;')) ?>
                    <?php echo $form->error($news,'content'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($news,'image'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->textField($news,'image',array('maxlength'=>256,'class'=>'text-input','style'=>'width:200px;')); ?>
                        <?php echo showUpload('News_image');?>
                        <?php echo $form->error($news,'image'); ?>
                    </label>
                </td>
            </tr> 
            <?php if(!$news->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($news,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($news,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($news,'status'); ?>
                </td>
            </tr>
            <?php }?>
           <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($news,'meta_key'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textArea($news,'meta_key',array('class'=>'text-input','rows'=>7)); ?>
                    <?php echo $form->error($news,'meta_key'); ?>
                </td>
            </tr>
             <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($news,'meta_des'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textArea($news,'meta_des',array('class'=>'text-input','rows'=>7)); ?>
                    <?php echo $form->error($news,'meta_des'); ?>
                </td>
            </tr>             
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($news->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table>	

<?php $this->endWidget(); ?>

</div><!-- form -->
