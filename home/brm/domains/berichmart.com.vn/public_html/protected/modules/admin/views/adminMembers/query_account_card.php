<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Truy vấn thông tin tài khoản</p>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
            <table width="949" border="0" cellspacing="1" cellpadding="0">
                <tr>
                    <td align="left" valign="top">Số tài khoản</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[numberaccount]" id="name_mem" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>               
                
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                        <?php echo CHtml::submitButton('Truy vấn',array('class'=>'button')); ?>
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