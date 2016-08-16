<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Thiết lập mức đóng thuế</p>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
            <table width="949" border="0" cellspacing="1" cellpadding="0">
                <tr>
                    <td align="left" valign="top">Mức thuế</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[tax]" value="<?php echo !empty($tax)?$tax:''; ?>" class='text-input' style="width: 200px;"> 
                        <span> (%)</span>
                    </td>
                </tr>               
                <tr>
                    <td align="left" valign="top">Mức thu nhập phải đóng</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[salary]" id="moneyformat" value="<?php echo !empty($salary)?$salary:''; ?>" class='text-input' style="width: 200px;"> 
                        <span> (VNĐ)</span>
                    </td>
                </tr> 
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                        <?php echo CHtml::submitButton('Thiết lập',array('class'=>'button')); ?>
                    </label></td>
                </tr>
            </table>	

    <?php $this->endWidget(); ?>

    </div><!-- form -->  
    <!-- thong tin ca nhan -->
    <div class="info_member">
        
    </div>
    <!-- end thong tin ca nhan -->
    <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->
<script>
    $(function(){
        $('#moneyformat').keyup(function(){
            if($(this).val().length>3){
                $.post('<?php echo getURL().'admin/adminMembers/createNumber';?>',{'number':this.value}, function(data){                                        
                  $('#moneyformat').val(data);
                });
            }
        });
    })
</script>