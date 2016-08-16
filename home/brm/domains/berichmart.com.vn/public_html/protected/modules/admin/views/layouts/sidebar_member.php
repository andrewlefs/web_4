<div id="slide-bar">
				
        <div id="control-user">
            <?php 
           $session = getSession();
           if(isset($session['user']['id'])){ ?>           
            Chào <?=$session['user']['name'] ?> | <a href="<?php echo getURL();?>admin/login/logout" class="">Đăng xuất</a>
           <?php }  ?>
        </div><!--#control-user-->
        <div id="control-title">
            <a href="<?php echo getURL();?>">Trang chủ</a> | <a href="<?php echo getURL();?>admin">Admin</a>
            | <a href="<?php echo getURL();?>account">Account</a>
        </div><!--#control-title-->

        <div id="left-menu">
                <ul class="main-menu">
                        <li><a>Quan lý thông tin TV</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu">                                
                                <li><a href="#" class="meunu-title">Thông tin TV</a><div class="cleare-fix"></div>
                                    <ul> 
                                        <li><a href="<?php echo getURL();?>admin/adminMembers/createPassword">Cấp lại mật khẩu đăng nhập</a><div class="cleare-fix"></div></li>
                                        <li><a href="<?php echo getURL();?>admin/adminMembers/queryAccount">Kiểm tra thông tin tv</a><div class="cleare-fix"></div></li>
                                    </ul>
                                </li>                                
                                <li><a href="#" class="meunu-title">Thừa kế mã số </a><div class="cleare-fix"></div>
                                    <ul>
                                        <li><a href="<?php echo getURL();?>admin/adminMembers/thuaKe">Thực hiện thừa kế</a></li>
                                    </ul>
                                </li>                                
                        </ul>
                        
                        <li><a href="#">Tài khoản</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu">
                                <li><a href="<?php echo getURL();?>admin/adminMembers/blockadeAllMoney">Phong tỏa toàn bộ số dư</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/adminMembers/blockAccount">Đóng tài khoản tv</a><div class="cleare-fix"></div></li>                                
                                <li><a href="<?php echo getURL();?>admin/adminMembers/queryAccountCard">Truy vấn thông tin tài khoản</a><div class="cleare-fix"></div></li>
                                <!-- <li><a href="<?php echo getURL();?>admin/adminMembers/blockadeAPartOfMoney">Phong tỏa một phần số dư</a><div class="cleare-fix"></div></li> -->
                                <!-- <li><a href="<?php echo getURL();?>admin/adminMembers/unblockAccount">Khôi phục tài khoản đang đóng</a><div class="cleare-fix"></div></li> -->
                        </ul>
                        
                        <li><a href="#">Nghiệp vụ thu – chi tiền mặt</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu">
                                <li><a href="<?php echo getURL();?>admin/adminMembers/updateMoney">Nạp tiền</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/adminMembers/getMoney">Rút tiền</a><div class="cleare-fix"></div></li>   
                                <li><a href="<?php echo getURL();?>admin/adminMembers/transfer">Chuyển tiền</a><div class="cleare-fix"></div></li>                                      
                        </ul>
                        
                        <li><a href="#">Thu phí</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu">
                                <li><a href="<?php echo getURL();?>admin/adminMembers/setFeeSMS">Thu phí SMS</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/adminMembers/remakeCard">Thu phí làm lại thẻ</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <?php if(Yii::app()->session['user']['data_user']->power==2){?>
                        <li><a href="#">Thanh toán tiền hoa hồng</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu">
                                <li><a href="<?php echo getURL();?>admin/adminMembers/setCheckBonus">Thiết lập điều kiện tính hoa hồng</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/adminMembers/browseRose">Xét duyệt tiền hoa hồng của các tv</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/adminMembers/makeRose">Lập lệnh thanh toán tiền hoa hồng cho các tv</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <?php } ?>
                        <li><a href="#">Thuế thu nhập cá nhân </a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu">
                                <li><a href="<?php echo getURL();?>admin/adminMembers/setTax">Thiết lập mức đóng thuế thu nhập cá nhân cho tv</a><div class="cleare-fix"></div></li>    
                                <li><a href="<?php echo getURL();?>admin/adminMembers/setNoTax">Loại bỏ các thành viên tự đóng thuế</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <?php if(Yii::app()->session['user']['data_user']->power==2){?>
                        <li><a href="#">Báo cáo </a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu">
                                <li><a href="<?php echo getURL();?>admin/adminMembers/reportImport">Thu (tiền gửi)</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/adminMembers/reportExport">Chi (tiền rút)</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/adminMembers/reportTransfer">Chuyển khoản</a><div class="cleare-fix"></div></li>                                
                                <li><a href="<?php echo getURL();?>admin/adminMembers/reportFees">Tiền thu phí</a><div class="cleare-fix"></div></li>                                
                                <li><a href="<?php echo getURL();?>admin/adminMembers/reportRose">Tiền hoa hồng</a><div class="cleare-fix"></div></li> 
                                <li><a href="<?php echo getURL();?>admin/adminMembers/reportTax">Trích tiền thuế thu nhập cá nhân</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <?php }?>                        
                </ul>

        </div><!--#left-menu-->

</div><!--#slide-bar-->
<script>
    $(function(){
        url = '<?PHP echo Yii::app()->request->getUrl() ?>';
        $('a[href |= "'+url+'"]').parents('.sub-menu').show();
        $('a[href |= "'+url+'"]').css({'color':'#FF00FF'});
    });
</script>
				