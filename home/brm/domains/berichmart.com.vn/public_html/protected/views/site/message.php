<style>    
    #error .tcontent{
        padding-top: 30px;
    }
</style>
<?php
$message[1]['text']='Thêm sản phẩm vào giỏ hàng thành công.';
$message[1]['url']=  '';

$message[2]['text']='Hết hàng!';
$message[2]['url']=  '';

$message[3]['text']='Đã đặt hàng thêm 1 sản phẩm này!';
$message[3]['url']=  '';

$message[4]['text']='Qúy khách đã đăng ký thành công. Bạn có muốn đăng nhập luôn không ?';
$message[4]['url']=  getURL().'home/members/autoLogin';

$message[5]['text']='Đăng nhập thành công.';
$message[5]['url']=  getURL().'member';

$message[6]['text']='Chưa có sản phẩm nào trong giỏ hàng của bạn!';
$message[6]['url']=  getURL();

$message[7]['text']='Nâng cấp thành công.';
$message[7]['url']=  getURL().'member';

$message[8]['text']='Thay thế thành công.';
$message[8]['url']=  getURL().'member/default/treeMember';

$message[9]['text']='Tên người thay thế sai.';
$message[9]['url']=  '';

$message[10]['text']='Qúy khách đã đăng ký thành công. Thông tin số thẻ, số tài khoản xem trong mục thông tin cá nhân hoặc mục thông tin tài khoản, thông tin thẻ hoặc xem trong email của quý khách. Qúy khách lưu ý cần thay đổi mật khẩu thẻ mặc định đã được gửi trong email để đảm bảo bảo mật, dễ nhớ.';
$message[10]['url']=  getURL().'thong-tin-tai-khoan';

$message[11]['text']='Chuyển tiền thành công';
$message[11]['url']=  getURL().'member/account/infoAccount';

$message[12]['text']='Qúy khách đã đăng ký thành công hạn mức chuyển khoản trong ngày';
$message[12]['url']=  getURL().'member/account/infoAccount';

$message[13]['text']='Thành viên thay thế đã có con. Hãy thay đổi thành viên khác !';
$message[13]['url']='';

$message[14]['text']='Cấp mật khẩu mới thành công !';
$message[14]['url']=getURL().'admin/adminMembers';

$message[15]['text']='Phong tỏa số dư thành công !';
$message[15]['url']=getURL().'admin/adminMembers';

$message[16]['text']='Mở phong tỏa số dư thành công !';
$message[16]['url']=getURL().'admin/adminMembers';

$message[17]['text']='Đóng tài khoản thành công !';
$message[17]['url']=getURL().'admin/adminMembers';

$message[18]['text']='Khôi phục tài khoản thành công !';
$message[18]['url']=getURL().'admin/adminMembers';

$message[19]['text']='Gửi đơn hàng thành công. Đơn hàng đã được gửi đến người quản trị và đến email của quý khách. Qúy khách có thể xem lai thông tin đơn hàng của mình trong email.';
$message[19]['url']=getURL();

$message[20]['text']='Thay đổi số điện thoại thành công.';
$message[20]['url']=getURL().'member/account/infoAccount';


$message[50]['text']='Số tiền chuyển khoản vượt quá số tiền trong tài khoản của quý khách. Số tiền lưu lại trong tài khoản tối thiểu là 50000 đồng';
$message[50]['url']='';
$message[51]['text']='Qúy khách đã chuyển khoản đủ tối đa lượng tiền quy định trong ngày.';
$message[51]['url']='';
$message[52]['text']='Số tiền quý khách muốn chuyển làm vượt mức quy định trong ngày. Hãy giảm số tiền cần chuyển hoặc đợi đến ngày hôm sau.';
$message[52]['url']='';
$message[53]['text']='Nạp tiền thành công !';
$message[53]['url']=  '';
$message[54]['text']='Rút tiền thành công !';
$message[54]['url']=  '';
$message[55]['text']='Số tiền rút lớn hơn số tiền trong tài khoản của quý khách. Số tiền lưu lại trong tài khoản tối thiểu là 50000 đồng.';
$message[55]['url']=  '';
$message[56]['text']='Thành viên này không tồn tại. Qúy khách vui lòng xem lai thông tin CMTND và số tài khoản đã chính xác chưa ?';
$message[56]['url']=  '';
$message[57]['text']='Thao tác không thành công';
$message[57]['url']=  '';
$message[58]['text']='Thanh viên này không tồn tại';
$message[58]['url']=  '';
$message[59]['text']='Chuyển tiền thành công';
$message[59]['url']=  '';
$message[60]['text']='Người gửi không tồn tại';
$message[60]['url']=  '';
$message[61]['text']='Người nhận không tồn tại';
$message[61]['url']=  '';
$message[62]['text']='Đã thu phí làm lại thẻ';
$message[62]['url']=  '';
$message[63]['text']='Tài khoản đã bị phong tỏa, không thể thực hiện chức năng này';
$message[63]['url']=  '';
$message[64]['text']='Tài khoản đã bị khóa';
$message[64]['url']=  '';
$message[65]['text']='Tài khoản người gửi đã bị khóa';
$message[65]['url']=  '';
$message[66]['text']='Thiết lập mức thuế thành công';
$message[66]['url']=  '';
$message[67]['text']='Thiết lập mức thuế không thành công';
$message[67]['url']=  '';
$message[68]['text']='Thanh toán tiền hoa hồng thành công';
$message[68]['url']=  '';
$message[69]['text']='Thiết lập mức phí SMS thành công';
$message[69]['url']=  '';
$message[70]['text']='Thiết lập mức phí SMS không thành công';
$message[70]['url']=  '';
$message[71]['text']='Thiết lập thành công thành viên này là tự đóng thuế';
$message[71]['url']=  '';
$message[72]['text']='Thiết lập thành công thành viên này là không tự đóng thuế';
$message[72]['url']=  '';
$message[73]['text']='Thiết lập thành công thành viên thừa kế';
$message[73]['url']=  '';
$message[74]['text']='Điều chỉnh điều kiện nhận hoa hồng thành công';
$message[74]['url']=  '';
$message[75]['text']='Điều chỉnh điều kiện nhận hoa hồng không thành công';
$message[75]['url']=  '';
$message[76]['text']='Danh mục này không được xóa vì sẽ làm mất một số chức năng của website nhưng có thể được sửa lại.';
$message[76]['url']=  '';
$message[77]['text']='Tài khoản thành viên không đủ tiền mua thẻ!';
$message[77]['url']=  getURL().'home';
$message[78]['text']='Mua thẻ thành công!';
$message[78]['url']=  getURL().'home';
$message[79]['text']='Chưa có tài khoản thẻ!';
$message[79]['url']=  '';
$message[80]['text']='Tài khoản của bản không có đủ tiền để thực hiên giao dịch này.';
$message[80]['url']=  '';
$message[81]['text']='Thiết lập phân quyền thành công';
$message[81]['url']=  '';
$message[82]['text']='Thiết lập phân quyền không thành công';
$message[82]['url']=  '';
$message[83]['text']='Bạn không có quyền thực hiện chức năng này.';
$message[83]['url']=  '';
$message[84]['text']='Tài khoản thẻ đã được tạo rồi.';
$message[84]['url']=  '';
$message[85]['text']='Mật khẩu thẻ không chính xác.';
$message[85]['url']=  '';
$message[86]['text']='Mã xác nhận không chính xác.';
$message[86]['url']=  '';
$message[87]['text']='Nạp điểm thành công';
$message[87]['url']=  '';
$message[88]['text']='Không tồn tại thành viên này';
$message[88]['url']=  ''; 
$message[89]['text']='Nạp điểm thất bại. Chưa nhập đầy đủ thông tin';
$message[89]['url']=  '';
$message[90]['text']='Thay thế thành công.';
$message[90]['url']=  '';
?>
<script>
$(function(){ 
    var key = <?php echo $key;?>;
    if(key==4){
        if(confirm('<?php echo $message[$key]['text'];?>'))
            window.location='<?php echo $message[$key]['url'];?>';
        else
            window.location='<?php echo getURL();?>';
    }
    else{
        alert('<?php echo $message[$key]['text'];?>');  
        if(key<=3||key==9||key==13||key>=50){
             window.history.back();
        }           
        else{
            window.location='<?php echo $message[$key]['url'];?>';
        }
    }
    
});
</script>