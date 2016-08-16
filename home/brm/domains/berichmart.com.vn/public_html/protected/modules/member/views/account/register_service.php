<script>
$(function(){
   <?php if($account->max_transfer==20000000){ ?> 
           $('#max1').attr('checked', 'checked')
   <?php } else {?>
        $('#max2').attr('checked', 'checked')
   <?php } ?>
       $('#register').submit(function(){
           if(document.register.check1.checked && document.register.check2.checked)
               return true;
           else{
               alert('Qúy khách chưa đồng ý với các điều khoản khi đăng ky.');
               return false;  }
       });
});
</script>
<form method="post" id="register" name="register">
<div class="box-right box-common" style="max-height:none;">
        	<div class="title-box">Đăng ký sử dụng dịch vụ chuyển khoản</div>
            <div class="box-content" style="line-height:22px; padding:10px 20px;">
                <b>Tên tôi là:</b><span style="text-transform: capitalize;"><?php echo $member->fullname; ?></span><br />
                <b>Tôi đăng ký hạn mức chuyển khoản trong ngày trên chương trình VCB như sau:</b><br />
                <span><input type="radio" name="maxtransfer" id="max1"  value="20000000"/><label>20.000.000 VNĐ(Hai mươi triệu đồng)</label></span><br />
                <span><input type="radio"  name="maxtransfer" id="max2" value="50000000"/><label>50.000.000 VNĐ(Năm mươi triệu đồng)</label></span><br /><br />
                <b>Hợp đồng sử dụng dịch vụ NHDT:</b><br />
                <div class="ndhopdong tiny">
                    <?php echo $regulation->content;?>
                </div><!--Nội dung hợp đồng--><br />
                <span><input type="checkbox" name="check1"/><label>Tôi đã tìm hiểu về cách thức bảo mật và có trách nhiệm bảo mật thông tin về tên truy cập và mật khẩu sử dụng dịch vụ VCB- IB@nking của Ngân hàng TMCP Ngoại Thương Việt Nam cung cấp.</label></span><br />
                <span><input type="checkbox" name="check2"/><label>
Tôi đã đọc, hiểu rõ, đồng ý và cam kết tuân thủ các điều khoản, điều khiển của Hợp đồng sử dụng dịch vụ Ngân hàng điện tử. Hướng dẫn sử dụng dịch vụ VCB-iB@nking và các quy định, thông báo của Ngân hàng TMCP Ngoại Thương Việt Nam liên quan đến dịch vụ VCB-iB@nking</label></span>
<div class="clear"></div>
<a class="button-blue" href="" style="display:block; margin:auto; margin-top:20px; float:left;" onclick="$('#register').submit(); return false;">Xác nhận</a>
            </div>
</div>
</form>
<script>
$(function(){
     $('.ndhopdong > p').css({'margin-top':'0px'});
});
</script>