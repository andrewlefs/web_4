<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm'));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($Video,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($Video,'name',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($Video,'name'); ?>
                    </label>
                </td>
            </tr>            
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Video,'album_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($Video,'album_id',$albums, array('prompt'=>'Chọn album','class'=>'text-input','style'=>'width:214px;')); ?>                        
                        <?php echo $form->error($Video,'album_id'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Video,'event_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($Video,'event_id',$events, array('prompt'=>'Chọn sự kiên','class'=>'text-input','style'=>'width:214px;')); ?>                        
                        <?php echo $form->error($Video,'event_id'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Video,'video_category_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($Video,'video_category_id', $Video_category, array('prompt'=>'Chọn thể loại cha','class'=>'text-input','style'=>'width:214px;')); ?>                        
                        <?php echo $form->error($Video,'video_category_id'); ?>
                    </label>
                    <p id="Video_category_id_list"> 
                    </p>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Video,'singer_category_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($Video,'singer_category_id', $singer_category, array('prompt'=>'Chọn thể loại cha','class'=>'text-input','style'=>'width:214px;')); ?>                        
                        <?php echo $form->error($Video,'singer_category_id'); ?>
                    </label>
                    <p id="singer_category_id_list"> 
                    </p>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Video,'singer_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($Video,'singer_id', array('VN'=>'Việt Nam','AM'=>'Âu Mỹ','CA'=>'Châu Á'), array('prompt'=>'Chọn địa điểm','class'=>'text-input','style'=>'width:214px;')); ?>                        
                        <?php echo $form->error($Video,'singer_id'); ?>
                    </label>
                    <p id="singer_list"> 
                    </p>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Video,'subject_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo CHtml::activeCheckBoxList($Video,'subject_id', $subjects, array('prompt'=>'Chọn chủ đề','class'=>'text-input','style'=>'width:auto;'));?>
                        <?php echo $form->error($Video,'subject_id'); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">Tùy chọn</td>
                <td align="left" valign="top">                    
                    <?php echo $form->checkBox($Video,'famous'); ?><span>Nổi bật</span>
                    <?php echo $form->error($Video,'famous'); ?>
                    <?php echo $form->checkBox($Video,'new'); ?><span>Mới</span>
                    <?php echo $form->error($Video,'new'); ?>
                </td>
            </tr>            
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton('Tìm kiếm',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(function(){
        $.post('<?php echo getURL().'admin/ajax/getVideoCategories';?>', {'id':$('#Video_video_category_id').val()}, function(data){
                $('#Video_category_id_list').html(data);
            });
            
        $.post('<?php echo getURL().'admin/ajax/getSingerCategories';?>', {'id':$('#Video_singer_category_id').val()}, function(data){
                $('#singer_category_id_list').html(data);
            });
            
        $.post('<?php echo getURL().'admin/ajax/getSingerlist';?>', {'place':$('#Video_singer_id').val()}, function(data){
                $('#singer_list').html(data);
            });
            
        $('#Video_video_category_id').change(function(){
            $.post('<?php echo getURL().'admin/ajax/getVideoCategories';?>', {'id':this.value}, function(data){
                $('#Video_category_id_list').html(data);
            });
        });
        $('#Video_singer_category_id').change(function(){
            $.post('<?php echo getURL().'admin/ajax/getSingerCategories';?>', {'id':this.value}, function(data){
                $('#singer_category_id_list').html(data);
            });
        });
        
        $('#Video_singer_id').change(function(){
            $.post('<?php echo getURL().'admin/ajax/getSingerlist';?>', {'place':this.value}, function(data){
                $('#singer_list').html(data);
            });
        });
    });
</script>