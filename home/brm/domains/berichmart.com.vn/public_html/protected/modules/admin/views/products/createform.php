<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p><?php if(isset($_GET['product'])) echo 'Sửa sản phẩm'; else echo 'Thêm sản phẩm';?></p>
    <a href="#" class="edit" onclick="$('#frm').submit(); return false;">
    <span ></span>
    Tiep tuc
    </a>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
            <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
                
                <tr>
                    <td align="left" valign="top">Danh mục</td>
                    <td align="left" valign="top">
                        <label>
                            <select id="category_id" name="category_id"  class='text-input' style='width:214px;'>                                
                                <?php foreach($listcat as $key=>$value){?>
                                <option value="<?echo $key;?>"><?echo $value;?></option>
                                <?php }?>
                            </select>
                        </label>
                    </td>
                </tr> 

                <tr>
                    <td align="left" valign="top">Nhóm sản phẩm</td>
                    <td align="left" valign="top">
                        <label>
                             <select id="group_product_id" name="group_product_id"  class='text-input' style='width:214px;'>
                                <option value="">Chọn nhóm sản phẩm</option>
                                <?php foreach($listgroup as $key=>$value){?>
                                <option value="<?echo $key;?>"><?echo $value;?></option>
                                <?php }?>
                            </select>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                        <?php echo CHtml::submitButton('Tiep tuc',array('class'=>'button')); ?>
                    </label></td>
                </tr>
            </table> 
    <?php $this->endWidget(); ?>

    </div><!-- form --> 
    <div class="cleare-fix"></div>    
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->
<?php 
if(isset($_GET['product'])){?>
<script>
    $(function(){
        $('#frm').attr('onsubmit', 'return checksubmit();');
        $('#category_id option').each(function(){
            if($(this).val()=='<?php echo $product->category_id;?>')
                $(this).attr('selected','selected');            
        });
        $('#group_product_id option').each(function(){
            if($(this).val()=='<?php echo $product->group_product_id;?>')
                $(this).attr('selected','selected');            
        });        
    });
    
    function checksubmit(){
        if($('#category_id').val()==''||$('#group_product_id').val()==''){
            alert('Chưa chọn đầy đủ thông tin. Vui lòng kiểm tra lại !')
            return false;}
        else
            return true;
    }
</script>
<?php } ?> 
<script>
    function checksubmit(){
        if($('#category_id').val()==''||$('#group_product_id').val()==''){
            alert('Chưa chọn đầy đủ thông tin. Vui lòng kiểm tra lại !')
            return false;}
        else
            return true;
    }
    $(function(){
        $('#frm').submit(function(){
            return checksubmit();
        });
        
    $('#category_id').change(function(){
        $.post('<?php echo getURL().'admin/products/getGroup'; ?>', {'cat':$('#category_id').val()}, function(data){
            
            $('#group_product_id option').each(function(){
                if(this.value==data)
                    $(this).attr('selected', 'selected');
            });
        });
    });
    });
</script>
