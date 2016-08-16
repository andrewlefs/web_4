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
</style>
<script> 
    <?php if(isset($error)){?>
        alert('<?php echo $error;?>');
    <?php } ?>
    
function success(){ 
    error =$('#Member_name_em_').css('display');
        if(error=='none'){
            $('#Member_name_em_').text('Tên truy cập hợp lệ!');
            $('#Member_name_em_').show();
        }
}
function checkName(){
    name = $('#Member_name').val();
    spaceIndex = name.search(' ');
    if(spaceIndex > -1){
        $('#Member_name_em_').text('Tên không chứa dấu khoảng trống');
        $('#Member_name_em_').show();
        return false;
    }
    else
        $('#Member_name_em_').hide()
}
function checkPass(){
    pass = $('#Member_password').val();
    confirmpass = $('#use_confirm_password').val();
    if($.trim(confirmpass)=='') {
        $('#confrimpass').text('Xác nhận mật khẩu không được để trống');
        $('#confrimpass').show(); 
        return false;
    }          
    else 
        if($.trim(pass)!=$.trim(confirmpass)){ 
            $('#confrimpass').text('Xác nhận mật khẩu không chính xác');
            $('#confrimpass').show(); 
            return false;
        }
        else $('#confrimpass').hide();
    return true;
}

function checkEmail(){
    email=$('#Member_email').val();
    confirmemail=$('#confirm_email').val();
    if($.trim(confirmemail)==''){
        $('#confrimemail').text('Xác nhận email không được để trống');
        $('#confrimemail').show();
        return false;
    }            
    else
        if($.trim(email)!=$.trim(confirmemail)){
            $('#confrimemail').text('Xác nhận email không chính xác');
            $('#confrimemail').show();
            return false;
        } 
        else $('#confrimemail').hide();    
    return true;
}
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
function checkRegister(){            
            if($('#agree').attr('checked')!='checked'){
                alert('Bạn chưa đồng ý với các quy định và điều khoản của BeRichMart. Hãy check nó.');
                return false;
            }
    return true;        
}

$(function(){
    //$('#frm').attr('onsubmit', 'return checkRegister();'); 
    $('#frm').submit(function(){
        result=checkName();
        if(result==false)
            return false;
        result=checkPass();
        if(result==false)
            return false;
        result=checkEmail();
        if(result==false)
            return false;
        result=checkDate();
        if(result==false)
            return false;
        result=checkRegister(); 
        if(result==false)
            return false;
    });
    $('#use_confirm_password').blur(function(){
        checkPass();
    });
    $('#confirm_email').blur(function(){
        checkEmail();
    }); 
    $('#Member_name').blur(function(){
        checkName(); 
        setTimeout('success()',1000);
        //success();
    });
    
    $('#Member_person1').blur(function(){
        $.post('<?php echo getURL().'home/members/checkmember'?>', {'name':$('#Member_person1').val()}, function(data){
            $('#per1').text(data);
        });
    });
    $('#Member_person2').blur(function(){
        $.post('<?php echo getURL().'home/members/checkmember'?>', {'name':$('#Member_person2').val()}, function(data){
            $('#per2').text(data);
        });
    });
});
</script>
<div id="formdangky">
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm','enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true),'htmlOptions' => array('enctype' => 'multipart/form-data') ));?>
<table class="form_table" cellpadding="0" cellspacing="0" align="center">
    <tbody>
        <tr>
        <td colspan="2"><h3>Đăng ký thành viên</h3></td>
    </tr>
    <tr>
        <td class="form_name_top"><span class="form_asterisk">*</span> Tên truy cập :</td>
        <td class="form_text">
        <div>            
            <?php echo $form->textField($member,'name',array('maxlength'=>200,'class'=>'form_control')); ?>
            <span id="Check_button">( Là số điên thoại đang sử dụng )</span>
            <?php echo $form->error($member,'name'); ?>
        </div>
        </td>
    </tr>
    <tr>
        <td class="form_name_top"><span class="form_asterisk">*</span> Mật khẩu :</td>
        <td class="form_text">
            <div>            
            <?php echo $form->passwordField($member,'password',array('maxlength'=>50,'style'=>'width:300px','class'=>'form_control')); ?>
            <?php echo $form->error($member,'password'); ?>
        </div>        
        </td>
    </tr>
    <tr>
        <td class="form_name"><font class="form_asterisk">* </font>Xác nhận mật khẩu :</td>
        <td class="form_text">
            <input class="form_control" type="password" title="Xác nhận mật khẩu" id="use_confirm_password" name="confirm_password" value="" style="width:300px; height:px" maxlength="50">
            <div id="confrimpass" style="display: none;" class="errorMessage" style=""></div>
        </td>
    </tr>
    <tr>
        <td colspan="2"><h3>Thông tin cá nhân</h3></td>
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
            <option value="<?php echo $i;?>"><?php if($i>9) echo $i; else echo '0'.$i;?></option>
            <?php }?>
        </select>
        -
        <select class="form_control" id="birth_month" name="birth_month">
            <option value="">Tháng</option>
            <?php for($i=1;$i<=12;$i++){ ?>
            <option value="<?php echo $i;?>"><?php if($i>9) echo $i; else echo '0'.$i;?></option>
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
            <option value="<?php echo $i;?>"><?php if($i>9) echo $i; else echo '0'.$i;?></option>
            <?php }?>
        </select>
        -
        <select class="form_control" id="month_create" name="month_create">
            <option value="">Tháng</option>
            <?php for($i=1;$i<=12;$i++){ ?>
            <option value="<?php echo $i;?>"><?php if($i>9) echo $i; else echo '0'.$i;?></option>
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
        <td class="form_name"><font class="form_asterisk">* </font>Xác nhận Email :</td>
        <td class="form_text">
            <input class="form_control" type="text" autocomplete="off" title="Xác nhận Email" id="confirm_email" name="confirm_email" value="" style="width:300px; height:px" maxlength="255">
            <div id="confrimemail" style="display: none;" class="errorMessage" style=""></div>
        </td>
    </tr>
    <tr>
        <td colspan="2"><h3>Thông tin người giới thiệu</h3></td>
    </tr>
    <tr>
        <td class="form_name"><font class="form_asterisk">* </font>Người giới thiệu 1 :</td>
        <td class="form_text">            
            <?php echo $form->textField($member,'person1',array('maxlength'=>256,'style'=>'width:300px;height:px;','class'=>'form_control')); ?>
            <?php echo $form->error($member,'person1'); ?>
        </td>
    </tr>
    <tr>
        <td class="form_name" valign="top">Tên người giới thiệu:</td>
        <td class="form_text"><span id="per1" style="color:#0073AE; font-weight:bold;">Undefine</span>
        </td>
    </tr>
          	    <tr>
        <td class="form_name"><font class="form_asterisk">* </font>Người giới thiệu 2 :</td>
        <td class="form_text">
            <?php echo $form->textField($member,'person2',array('maxlength'=>256,'style'=>'width:300px;height:px;','class'=>'form_control')); ?>
            <?php echo $form->error($member,'person2'); ?>
        </td>
    </tr>
    <tr>
        <td class="form_name" valign="top">Tên người giới thiệu:</td>
        <td class="form_text"><span id="per2" style="color:#0073AE; font-weight:bold;">Undefine</span>        
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <div class="form_text_warning" style="color:red;">Nhập đúng tài khoản người giới thiệu, người giới thiệu sẽ không được thay đổi trong bất kỳ trường hợp nào.</div>
        </td>
    </tr>
    <tr>
              <td class="form_name" valign="top">Điều khoản đăng ký:</td>
              <td class="form_text">
              <textarea name="textarea"  rows="8" disabled="disabled" class="uniform" style="font-size:11px; color:#444; width:100%;">
Quy định tham gia phát triển hệ thống người tiêu dùng tại Công ty cổ phần TMDV BeRichMart Việt Nam.
Bằng việc đăng ký tham gia trở thành Thành Viên của Công ty, Bạn đồng ý chấp nhận và tuân thủ các quy định sau đây:
1. Thông tin cá nhân:
- Thành viên đồng ý cung cấp cho Công ty cổ phần TMDV BeRichMart Việt Nam các thông tin trung thực về bản thân bằng cách điền vào "Phiếu đăng ký" và "Hồ sơ". Các thông tin này sẽ giúp Công ty thực hiện tốt hơn việc quản lý hồ sơ và công tác chăm sóc khách hàng.
- BeRichMart cam kết bảo mật thông tin cá nhân của thành viên và chỉ cung cấp cho bên thứ 3 khi có sự đồng ý của thành viên.

2. Quyền lợi Thành viên:
- Thành viên được sử dụng các tiện ích của Công ty:
- Các giao dịch thanh toán trên tài khoản thanh toán BRM.
- Hưởng quyền lợi về chính sách bán hàng dành cho Thành viên :
- Hoa hồng tiêu dùng 10% khi thành viên thanh toán bằng thẻ và 5% khi thành viên thanh toán bằng tiền mặt (trừ thẳng vào đơn hàng khi mua hàng áp dụng cho tất cả các thành viên chính thức và thành viên kết nối)
- Hoa hồng giới thiệu Thành viên.
- Hoa hồng thụ động.
- Được tham gia quỹ thưởng dành cho Thành viên.
- Được chuyển đổi hoa hồng thành tiền mặt.
- Được cấp văn phòng làm việc tại website: www.BeRichMart.com.vn

3. Nghĩa vụ Thành viên:
a. Thanh toán tiền hàng đầy đủ cho Công ty.
b. Tư vấn chính xác về chính sách bán hàng và chế độ trả thưởng của Công ty.
c. Thành viên có trách nhiệm hướng dẫn, hỗ trợ Thành viên trực thuộc hệ thống Thành viên của mình.
d. Cung cấp đầy đủ, chính xác thông tin xác thực thành viên trực thuộc hệ thống Thành viên của Công ty BRM.

4. Những điều khoản cấm:
a. Nghiêm cấm tuyệt đối việc đăng ký giả mạo hoặc dùng nhiều địa chỉ chứng minh thư khác nhau để đăng ký nhiều tài khoản cho một người.
b. Thành viên sẽ không được phép sử dụng bất kỳ nhãn hiệu thương mại, tên, biểu tượng, khẩu ngữ của Công ty vào mục đích khác mà không được sự đồng ý của Công ty ngoài việc phân phối, quảng cáo như đã được Công ty đồng ý.
c. Nghiêm cấm tuyệt đối việc dùng danh nghĩa Công ty cổ phần TMDV BeRichMart Việt Nam và lợi dụng mạng lưới thành viên của Công ty vào mục đích cá nhân, để quảng bá các chương trình kinh doanh không có liên quan đến Công ty bằng e-mail hoặc trên mạng Internet.
d. Công ty cổ phần TMDV BeRichMart Việt Nam sẽ áp dụng các chế tài xử lý vi phạm đối với các trường hợp vi phạm những điều khoản nói trên. Các chế tài xử lý vi phạm có thể là cảnh cáo, phạt tiền, xóa tài khoản  vĩnh viễn khỏi danh sách thành viên hoặc tổng hợp cả 3 biện pháp trên. Việc lựa chọn biện pháp phạt phụ thuộc vào mức độ và số lần vi phạm của thành viên.  

5. Hủy bỏ tài khoản:
a. Thành viên có quyền thông báo cho Công ty cổ phần TMDV BeRichMart Việt Nam về quyết định ngừng tham gia phát triển hệ thống mạng lưới vào bất cứ lúc nào. Trường hợp này đồng nghĩa với việc Thành viên đồng ý hủy bỏ toàn bộ những quyền lợi của mình với tư cách là thành viên hệ thống tính đến thời điểm đó.
b. Công ty cổ phần TMDV BeRichMart Việt Nam có quyền xóa tài khoản của Bạn nếu tài khoản đó không có hoạt động mua hàng trong vòng 6 tháng
c. Công ty cổ phần TMDV BeRichMart Việt Nam có quyền xóa tên và tài khoản của Bạn nếu Bạn có những hành động đi ngược lại với quyền lợi của công ty như nêu trong mục 4 ("Những điều khoản cấm").
d. Trong trường hợp tài khoản bị xóa vì các lý do nêu trên, việc đăng ký lại tài khoản khác tại Công ty cổ phần TMDV BeRichMart Việt Nam chỉ có thể được thực hiện sau thời gian ít nhất là 6 tháng.   
e. Trong trường hợp thành viên không nâng cấp lên thành viên chính thức thì công ty có thể thay thế hoặc xóa bỏ bất cứ lúc nào.

6. Các quy định khác:
a. Khi quý khách giới thiệu cho khách hàng, quý khách tuyệt đối phải giới thiệu một cách trung thực.
b. Công ty cổ phần TMDV BeRichMart Việt Nam có quyền thay đổi điều kiện và phương thức rút tiền và thông báo đến thành viên bằng việc công bố công khai trên website hoặc gửi tin nhắn tới mã số Thành viên .
c. Công ty cổ phần TMDV BeRichMart Việt Nam có thể bổ sung, mở rộng hoặc thu hẹp các chương trình kinh doanh theo nhu cầu. Những thay đổi (nếu có) sẽ được thông báo đến các Thành viên bằng tin nhắn về mã số Thành viên hoặc công bố trên website và chỉ được áp dụng từ sau ngày công bố.  

7. Thuế (Thuế Giá Trị Gia Tăng và Thuế Thu Nhập cá nhân)
7.1. Mỗi bên tự chịu trách nhiệm đối với các nghĩa vụ thuế của mình trước cơ quan thuế của Việt Nam theo quy định của phát luật. khi được BeRichMart yêu cầu, các Thành viên sẽ phải cung cấp các bằng chứng chứng minh mình đã hoàn thành các nghĩa vụ thuế (nếu có). Theo quy định của pháp luật,  BeRichMart sẽ khấu trừ thuế thu nhập cá nhân 10% - 20% trên thu nhập hoa hồng của Thành Viên để thực hiện việc nộp thuế thay cho các thành viên.
7.2. Thành viên đồng ý rằng BeRichMart có quyền
a) Thông báo cho các cơ quan có thẩm quyền của Việt Nam mọi thông tin liên quan đến việc bán hợp tác giữa BeRichMart và Thành viên; và 
b) Nếu pháp luật quy định hoặc theo yêu cầu của các cơ quan thuế Việt Nam, BeRichMart sẽ thực hiệp việc thu các khoản thuế đến hạn áp dụng cho các hoạt động của Thành viên theo hợp đồng này và trực tiếp nộp các khoản thuế đó cho các cơ quan thuế của Việt Nam.
 

                Công ty cổ phần TMDV BeRichMart Việt Nam
                E-mail: Website: http://www. BeRichMart.com.vn
          

              </textarea>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <?php $this->widget('CCaptcha', array(
                      'buttonLabel'=>'<img src="'.Yii::app()->controller->module->registerImage('f5.png').'" alt="" align="absmiddle">',
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
        <td colspan="2"><input type="checkbox" id="agree" name="agree" />&nbsp;Tôi đã đọc và đồng ý với <a href="" style="color:#0073AE; text-decoration:underline;"> các quy định và điều khoản</a> của BeRichMart</td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="" value="Đăng ký thành viên"/></td>
    </tr>
    </tbody>
</table>
<?php $this->endWidget(); ?>
</div>

<!-- anh quang cao -->
<div class="adv-right">
    <?php $data = Banner::model()->findAll('status=1 and position="right"  order by t.stt asc')?>
    <?php 
        foreach($data as $banner){?>
        <a href="<?php echo getURL().$banner->link ;?>">
            <img src="<?php echo getURL().$banner->images?>" alt="" />
            
        </a> 
        
        <?php
         }
        ?>
</div>
<?php
/* simulate a click on "refresh captcha" for GET requests */
if (!Yii::app()->request->isPostRequest)// neu form ko dc submit
    Yii::app()->clientScript->registerScript(
        'initCaptcha',
        '$("#captchaimg_button").trigger("click");',
        CClientScript::POS_READY
    );
?>