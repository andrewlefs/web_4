<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($Album,'name'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($Album,'name',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo $form->error($Album,'name'); ?>
                    </label>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $form->labelEx($Album,'image'); ?></td>
                <td align="left" valign="top">
                    <label> 
                        <?php echo $form->textField($Album,'image',array('maxlength'=>256,'class'=>'text-input')); ?>
                        <?php echo showUploadCKFinder('Album_image');?>
                        <?php echo $form->error($Album,'image'); ?>
                    </label>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Album,'album_category_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($Album,'album_category_id', $album_category, array('prompt'=>'Chọn thể loại cha','class'=>'text-input','style'=>'width:214px;')); ?>                        
                        <?php echo $form->error($Album,'album_category_id'); ?>
                    </label>
                    <p id="album_category_id_list"> 
                    </p>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Album,'singer_id'); ?></td>
                <td align="left" valign="top">
                    <label>
                        <?php echo $form->dropDownList($Album,'singer_id', array('VN'=>'Việt Nam','AM'=>'Âu Mỹ','CA'=>'Châu Á'), array('prompt'=>'Chọn địa điểm','class'=>'text-input','style'=>'width:214px;')); ?>                        
                        <?php echo $form->error($Album,'singer_id'); ?>
                    </label>
                    <p id="singer_list"> 
                    </p>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">Tùy chọn</td>
                <td align="left" valign="top">                    
                    <?php echo $form->checkBox($Album,'famous'); ?><span>Nổi bật</span>
                    <?php echo $form->error($Album,'famous'); ?>
                    <?php echo $form->checkBox($Album,'new'); ?><span>Mới</span>
                    <?php echo $form->error($Album,'new'); ?>
                </td>
            </tr>  
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Album,'content'); ?></td>
                <td align="left" valign="top">                    
                    <?php tiny($this,array('name'=>'Album[content]','id'=>'Album_content','value'=>$Album->content,'style'=>'height:300px; width:770px;')) ?>
                    <?php echo $form->error($Album,'content'); ?>
                </td>
            </tr>
            <?php if(!$Album->isNewRecord){?>
            <tr>
                <td align="left" valign="top"><?php echo $form->labelEx($Album,'status'); ?></td>
                <td align="left" valign="top">                    
                    <?php echo $form->radioButtonList($Album,'status',array('1'=>'Đã kích hoạt','0'=>'Chưa kích hoạt')); ?>
                    <?php echo $form->error($Album,'status'); ?>
                </td>
            </tr>  
            <?php } ?>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                    <?php echo CHtml::submitButton($Album->isNewRecord ? 'Tạo mới' : 'Cập nhật',array('class'=>'button')); ?>
                </label></td>
            </tr>
        </table> 
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(function(){
        $.post('<?php echo getURL().'admin/ajax/getAlbumCategories';?>', {'id':$('#Album_album_category_id').val()}, function(data){
                $('#album_category_id_list').html(data);
            });
        $.post('<?php echo getURL().'admin/ajax/getSingerlist';?>', {'place':$('#Album_singer_id').val()}, function(data){
                $('#singer_list').html(data);
            });
            
        $('#Album_album_category_id').change(function(){
            $.post('<?php echo getURL().'admin/ajax/getAlbumCategories';?>', {'id':this.value}, function(data){
                $('#album_category_id_list').html(data);
            });
        });
        
        $('#Album_singer_id').change(function(){
            $.post('<?php echo getURL().'admin/ajax/getSingerlist';?>', {'place':this.value}, function(data){
                $('#singer_list').html(data);
            });
        });
    });
</script>