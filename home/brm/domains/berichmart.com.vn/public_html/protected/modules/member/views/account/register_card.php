<style>
    .mobile{ display: none ;}
    #other{ font-weight: bold;}
</style>
<div class="box-right box-common" style="max-height:none;">
    <form method="post" onsubmit="return checksubmit();" id="form" name="form12">
    <div class="title-box">Đăng ký thẻ thanh toán điện tử</div>
    <div class="box-content" style="line-height:22px; padding:10px 20px;"> BeRichMart sẽ cung cấp cho Thành Viên một tài khoản thẻ, Mỗi Thành Viên chỉ được cung cấp một thẻ duy nhất. <br>
    <i>Chú ý</i>: Khi Thành Viên đánh mất thẻ phải thông báo ngay cho công ty
    <br />
    <table width="98%" border="0" cellspacing="1" cellpadding="0" class="table-form" style="background-color:#d5e3f3;">
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtMatKhauCu"><b>Tên truy cập:</b></label></td>
        <td align="left" valign="top"><label><?php echo $member->name;?></label></td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtMatKhauCu"><b>Số điện thoại nhận thông báo:</b></label></td>
        <td align="left" valign="top">
        <select class="text droplist" style="width:200px !important;" name="data[combomobile]">
            <option value="<?php echo $member->name;?>"><?php echo $member->name;?></option>
            <?php 
            $first = substr($member->phone, 0, 1);
            $second = substr($member->phone, 1, 1);
            if($first==0 && ($second==1||$second==9)){
            ?>
            <option value="<?php echo $member->phone;?>"><?php echo $member->phone;?></option>
            <?php } ?>
            </select>
            <input type="text" id="mobile" class="text mobile" name="data[mobile]" style="width:200px;vertical-align: middle;">
            <span id="other"><a href="#">Khác</a></span>
        </td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtMatKhauCu"><b>Địa chỉ nhận thẻ:</b></label></td>
        <td align="left" valign="top">
            <input type="text" id="address" class="text" name="data[address]" style="width:500px;vertical-align: middle;">            
        </td>
        </tr>
    </table>
    <br />
    <b style="font-size:13px;" class="orange">Quy định sử dụng dịch vụ:</b><br />
    <div class="ndhopdong tiny">
        <?php echo $regulation->content;?>
    </div>
    <!--Nội dung hợp đồng--><br />
    <span>
    <input type="checkbox" name="accept" class="accept"/>
    <label>Tôi đã đọc, hiểu và chấp nhận với quy định sử dụng dịch vụ của BeRichMart</label>
    </span>
    <div class="clear"></div>
    <a class="button-blue btnsubmit" href="#" style="display:block; margin:auto; margin-top:20px; float:left;">Chấp nhận</a> </div>
    </form>
</div>
<script>
    function checksubmit(){
       if($('#address').val()==''){
           alert('Chưa nhập địa chỉ nhận thẻ !');
           return false;
       }
       if(!document.form12.accept.checked)
           {
              alert('Bạn chưa chấp nhận quy định sử dụng dịch vụ của BeRichMart')
              return false;
           }
       else 
           return true;
    }
    
    $(function(){
        $('#other a').click(function(){
            $('#mobile').show();
            $(this).parent().text('Nhập số mới')
            return false;
        });  
        $('.btnsubmit').click(function(){ 
            $('#form').submit(); 
            return false;
        });
        $('.ndhopdong > p').css({'margin-top':'0px'});
    })
</script>