<style>
    #security_code{
        float: left;
        margin-top: 13px;
    }
    .captcha_div{
        width: 214px;
       /* float: left;*/
    }
    .captcha_div img{
       /* float: left;*/
    }
    #err_cap{
        width: 100%;
        float: left;
    }
    #formdangky{padding-top: 0px;}
</style>
<script> 
    <?php if(isset($error)){?>
        alert('<?php echo $error;?>');
    <?php } ?>    
function checkDate(){
    b_day =$.trim($('#birth_day').val());
    b_month =$.trim($('#birth_month').val());
    b_year =$.trim($('#birth_year').val());
    if(b_day==''||b_month==''||b_year==''){
        $('#birthdayerror').show();
        return false;}
    else
        $('#birthdayerror').hide();
    
    b_day =$.trim($('#day_create').val());
    b_month =$.trim($('#month_create').val());
    b_year =$.trim($('#year_create').val());
    if(b_day==''||b_month==''||b_year==''){
        $('#createdayerror').show();
        return false;}
    else
        $('#createdayerror').hide();
    
    return true;
}

function setValueChecked(objSelect,value){
    $(objSelect + ' option').each(function(){
        if(this.value==value)
            $(this).attr('selected', 'selected');
    });
}

$(function(){
    //$('#frm').attr('onsubmit', 'return checkRegister();'); 
    $('#frm').submit(function(){        
        result=checkDate();
        if(result==false)
            return false;        
    }); 
    setValueChecked('#birth_day','<?php echo date('d',  strtotime($member->birthday));?>');
    setValueChecked('#birth_month','<?php echo date('m',  strtotime($member->birthday));?>');
    setValueChecked('#birth_year','<?php echo date('Y',  strtotime($member->birthday));?>');
    setValueChecked('#day_create','<?php echo date('d',  strtotime($member->date_create));?>');
    setValueChecked('#month_create','<?php echo date('m',  strtotime($member->date_create));?>');
    setValueChecked('#year_create','<?php echo date('Y',  strtotime($member->date_create));?>');
    
});
</script>
<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Thay đổi thông tin thành viên</p>
    <a href="#" class="edit" onclick="$('#frm').submit(); return false;">
    <span ></span>
    Lưu
    </a>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form" id="formdangky">
        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm','enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true),'htmlOptions' => array('enctype' => 'multipart/form-data') ));?>
<table class="form_table" cellpadding="0" cellspacing="0" align="center">
    <tbody>        
    <tr>
        <td colspan="2"><h3>Thông tin cá nhân</h3></td>
    </tr>
    <tr>
        <td class="form_name"><font class="form_asterisk">* </font>Tên đăng nhập :</td>
        <td class="form_text">            
            <?php echo $form->textField($member,'name',array('maxlength'=>256,'style'=>'width:300px;height:px;','class'=>'form_control')); ?>
            <?php echo $form->error($member,'name'); ?>
        </td>
    </tr>
    <tr>
        <td class="form_name"><font class="form_asterisk">* </font>Họ và tên :</td>
        <td class="form_text">            
            <?php echo $form->textField($member,'fullname',array('maxlength'=>256,'style'=>'width:300px;height:px;','class'=>'form_control')); ?>
            <?php echo $form->error($member,'fullname'); ?>
        </td>
    </tr>
    <tr>
        <td class="form_name"><font class="form_asterisk">* </font>Giới tính :</td>
        <td class="form_text">
            <?php echo $form->dropDownList($member,'sex', array('1'=>'Nam','0'=>'Nữ'), array('prompt'=>'Lựa chọn giới tính')); ?>
                    <?php echo $form->error($member,'sex'); ?>
        </td>
    </tr>
    <tr>
        <td class="form_name"><span class="form_asterisk">*</span> Ngày sinh :</td>
        <td class="form_text"><select class="form_control" id="birth_day" name="birth_day">
            <option value="">Ngày</option>
            <?php for($i=1;$i<=31;$i++){ ?>
            <option value="<?php if($i>9) echo $i; else echo '0'.$i;?>"><?php if($i>9) echo $i; else echo '0'.$i;?></option>
            <?php }?>
        </select>
        -
        <select class="form_control" id="birth_month" name="birth_month">
            <option value="">Tháng</option>
            <?php for($i=1;$i<=12;$i++){ ?>
            <option value="<?php if($i>9) echo $i; else echo '0'.$i;?>"><?php if($i>9) echo $i; else echo '0'.$i;?></option>
            <?php }?>
        </select>
        -
        <select class="form_control" id="birth_year" name="birth_year">
            <option value="">Năm</option>
            <?php for($i=1950;$i<=date('Y');$i++){ ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php }?>
        </select>
        (dd-mm-yyyy) 
        <div id="birthdayerror" style="display: none;" class="errorMessage" style="">Chưa chọn đầy đủ thông tin ngày sinh</div>
        </td>
    </tr>
    <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Địa chỉ hiện tại :</td>
              <td class="form_text">                  
                  <?php echo $form->textField($member,'address',array('maxlength'=>500,'style'=>'width:300px;height:px;','class'=>'form_control')); ?>
                  <?php echo $form->error($member,'address'); ?>
              </td>
     </tr>
    <tr>
        <td class="form_name"><font class="form_asterisk">* </font>Tỉnh/ Thành phố :</td>
        <td class="form_text">
        <?php         
        echo $form->dropDownList($member,'city_id', $cities, array('prompt'=>'--[Chọn]--','class'=>'form_control')); ?>
        <?php echo $form->error($member,'city_id'); ?>
        </td>
    </tr>
    <tr>
        <td class="form_name">Avatar/ Logo :</td>
        <td class="form_text">
           <!-- <input class="form_control" type="file" title="Avatar/ Logo" id="use_image" name="use_image" size="34"> -->
            <?php
            echo $form->fileField($member, 'avatar',array('class'=>'form_control','size'=>34));
            echo $form->error($member, 'avatar');
            ?>
        <div class="form_text_warning">(Ảnh không được quá <span style="color:#FF0000">50 KB</span> và có phần mở rộng là: <span style="color:#FF0000">.gif, .jpg, .png</span>)</div></td>
    </tr>
    <tr>
        <td colspan="2"><h3>Thông tin chứng thực</h3></td>
    </tr>
    <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Số CMND :</td>
              <td class="form_text">                  
                  <?php echo $form->textField($member,'cmnd',array('maxlength'=>12,'style'=>'width:300px;height:px;','class'=>'form_control')); ?>
                  <?php echo $form->error($member,'cmnd'); ?>
              </td>
     </tr>
     <tr>
        <td class="form_name"><span class="form_asterisk">*</span> Ngày cấp :</td>
        <td class="form_text">
        <select class="form_control" id="day_create" name="day_create">
            <option value="">Ngày</option>
            <?php for($i=1;$i<=31;$i++){ ?>
            <option value="<?php if($i>9) echo $i; else echo '0'.$i;?>"><?php if($i>9) echo $i; else echo '0'.$i;?></option>
            <?php }?>
        </select>
        -
        <select class="form_control" id="month_create" name="month_create">
            <option value="">Tháng</option>
            <?php for($i=1;$i<=12;$i++){ ?>
            <option value="<?php if($i>9) echo $i; else echo '0'.$i;?>"><?php if($i>9) echo $i; else echo '0'.$i;?></option>
            <?php }?>
        </select>
        -
        <select class="year_create" id="year_create" name="year_create">
            <option value="">Năm</option>
            <?php for($i=1950;$i<=date('Y');$i++){ ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php }?>
        </select>
        (dd-mm-yyyy) 
        <div id="createdayerror" style="display: none;" class="errorMessage" style="">Chưa chọn đầy đủ thông tin ngày cấp</div>
        </td>
    </tr>
    <tr>
        <td class="form_name"><font class="form_asterisk">* </font>Nơi cấp :</td>
        <td class="form_text">
        <?php         
        echo $form->dropDownList($member,'place_create', $cities, array('prompt'=>'--[Chọn]--','class'=>'form_control')); ?>
        <?php echo $form->error($member,'place_create'); ?>
        </td>
    </tr>
    <tr>
            <td class="form_name"><font class="form_asterisk">* </font>Địa chỉ theo CMND :</td>
            <td class="form_text">                  
                <?php echo $form->textField($member,'address_cmnd',array('maxlength'=>250,'style'=>'width:300px;height:px;','class'=>'form_control')); ?>
                <?php echo $form->error($member,'address_cmnd'); ?>                
            </td>
     </tr>
     <tr>
            <td class="form_name"><font class="form_asterisk">* </font>Số điện thoại :</td>
            <td class="form_text">                  
                <?php echo $form->textField($member,'phone',array('maxlength'=>15,'style'=>'width:300px;height:px;','class'=>'form_control')); ?>
                <?php echo $form->error($member,'phone'); ?>
                <div class="form_text_warning">Số điên thoại đang sử dụng - có thể là số máy bàn hoặc số di động khác.</div>                
            </td>
     </tr>
    <tr>
        <td class="form_name"><font class="form_asterisk">* </font>Email :</td>
        <td class="form_text">            
            <?php echo $form->textField($member,'email',array('maxlength'=>256,'style'=>'width:300px;height:px;','class'=>'form_control')); ?>
            <?php echo $form->error($member,'email'); ?>
        </td>
    </tr>    
    
    <tr>
        <td></td>
        <td>
            <?php $this->widget('CCaptcha', array(
                      'buttonLabel'=>'<img src="'.  getURL().'images/f5.png'.'" alt="" align="absmiddle">',
                      'clickableImage'=>true,                      
                      'imageOptions'=>array('id'=>'captchaimg','align'=>'absmiddle')
                      ));?> 
        </td>
    </tr>
    <tr>
        <td class="form_name"><font class="form_asterisk">* </font>Mã số an toàn :</td>
        <td class="form_text">
            <?php echo $form->textField($member,'captcha',array('maxlength'=>256,'style'=>'width:134px;height:px;','class'=>'form_control','align'=>'absmiddle')); ?>
            <?php echo $form->error($member,'captcha'); ?>
            <div id="err_cap" style="display: none;" class="errorMessage" style="">Mã bảo vệ không chính xác</div>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="" value="Thay đổi thông tin"/></td>
    </tr>
    </tbody>
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
        
    $('#name_mem').blur(function(){
            $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'name':this.value}, function(data){
                $('.info_member').html(data);
            })
        });
    /*    
    $('#cmnd').blur(function(){
        $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'cmnd':this.value}, function(data){
            $('.info_member').html(data);
        })
    });
    $('#numberaccount').blur(function(){
        $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'numberaccount':this.value}, function(data){
            $('.info_member').html(data);
        })
    });
    */
});
</script>
<?php
/* simulate a click on "refresh captcha" for GET requests */
if (!Yii::app()->request->isPostRequest)// neu form ko dc submit
    Yii::app()->clientScript->registerScript(
        'initCaptcha',
        '$("#captchaimg_button").trigger("click");',
        CClientScript::POS_READY
    );
?>