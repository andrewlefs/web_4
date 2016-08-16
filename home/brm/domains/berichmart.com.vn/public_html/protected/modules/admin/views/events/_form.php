<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($Event,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($Event,'name',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($Event,'name'); ?>
                    </label>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($Event,'image'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($Event,'image',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo showUploadCKFinder('Event_image');?>
                        <?php echo $form->error($Event,'image'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Event,'content'); ?></td>
                <td align="left" valign="top">                    
                    <?php tiny($this,array('name'=>'Event[content]','id'=>'Event_content','value'=>$Event->content,'style'=>'height:300px; width:770px;')) ?>
                    <?php echo $form->error($Event,'content'); ?>
                </td>
            </tr>
            <?php if(!$Event->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Event,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($Event,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($Event,'status'); ?>
                </td>
            </tr>  
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($Event->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(function(){
        $.post('<?php echo getURL().'admin/ajax/getEventCategories';?>', {'id':$('#Event_Event_category_id').val()}, function(data){
                $('#Event_category_id_list').html(data);
            });
        $.post('<?php echo getURL().'admin/ajax/getSingerlist';?>', {'place':$('#Event_singer_id').val()}, function(data){
                $('#singer_list').html(data);
            });
            
        $('#Event_Event_category_id').change(function(){
            $.post('<?php echo getURL().'admin/ajax/getEventCategories';?>', {'id':this.value}, function(data){
                $('#Event_category_id_list').html(data);
            });
        });
        
        $('#Event_singer_id').change(function(){
            $.post('<?php echo getURL().'admin/ajax/getSingerlist';?>', {'place':this.value}, function(data){
                $('#singer_list').html(data);
            });
        });
    });
</script>