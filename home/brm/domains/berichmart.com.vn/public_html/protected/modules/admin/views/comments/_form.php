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
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($comment,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($comment,'name',array('maxlength'=>50,'class'=>'text-input')); ?>
                        <?php echo $form->error($comment,'name'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($comment,'content'); ?></td>
                <td align="left" valign="top">                    
                    <?php tiny($this,array('name'=>'Comment[content]','id'=>'comment_content','value'=>$comment->content,'style'=>'height:300px; width:770px;')) ?>
                    <?php echo $form->error($comment,'content'); ?>
                </td>
            </tr>
          
            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($comment,'email'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($comment,'email',array('maxlength'=>100,'class'=>'text-input')); ?>
                    <?php echo $form->error($comment,'email'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($comment,'product_id'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($comment,'product_id',array('maxlength'=>100,'class'=>'text-input')); ?>
                    <?php echo $form->error($comment,'product_id'); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($comment,'news_id'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->textField($comment,'news_id',array('maxlength'=>100,'class'=>'text-input')); ?>
                    <?php echo $form->error($comment,'news_id'); ?>
                </td>
            </tr>
           <?php if(!$comment->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($comment,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($comment,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($comment,'status'); ?>
                </td>
            </tr>  
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($comment->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'btn-input')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->