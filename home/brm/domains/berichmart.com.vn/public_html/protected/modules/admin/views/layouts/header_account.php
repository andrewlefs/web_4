<div class="ad_boxmenu">
    <!-- box -->
    <div class="ad_box">
            <div class="ad_main_box">
            <ul>
                <li><a href="<?php echo getURL();?>admin/adminMembers/createPassword">Cấp lại mật khẩu đăng nhập</a></li>
                <li><a href="<?php echo getURL();?>admin/adminMembers/queryAccount">Kiểm tra thông tin tv</a></li>
                <li><a href="<?php echo getURL();?>admin/adminMembers/thuaKe">Thực hiện thừa kế</a></li>
            </ul>
        </div>
        <div class="ad_bottom_box">Thông tin TV</div>
    </div>
    <!-- end box -->
    <!-- box -->
    <div class="ad_box">
            <div class="ad_main_box">                    	
            <ul>
                <li><a href="<?php echo getURL();?>admin/adminMembers/updateMoney">Nạp tiền</a></li>
                <li><a href="<?php echo getURL();?>admin/adminMembers/getMoney">Rút tiền</a></li>                                
                <li><a href="<?php echo getURL();?>admin/adminMembers/blockadeAllMoney">Phong tỏa toàn bộ số dư</a></li>
                <li><a href="<?php echo getURL();?>admin/adminMembers/blockAccount">Đóng tài khoản tv</a></li>                                
                <li><a href="<?php echo getURL();?>admin/adminMembers/queryAccountCard">Truy vấn thông tin tài khoản</a></li>
                <li><a href="<?php echo getURL();?>admin/adminMembers/listMemberNoCard">DS thành viên chưa đăng ký thẻ</a></li>
                <li><a href="<?php echo getURL();?>admin/adminMembers/listBlockAll">DS thành viên bị phong tỏa</a></li>
                <li><a href="<?php echo getURL();?>admin/adminMembers/listBlockAccount">DS thành viên bị khóa TK</a></li>
                <li><a href="<?php echo getURL();?>admin/adminMembers/listVip">DS thành viên đạt sao</a></li>
            </ul>
        </div>
        <div class="ad_bottom_box">Tài khoản</div>
    </div>
    <!-- end box -->    
    <!-- box -->
    <div class="ad_box">
            <div class="ad_main_box">                    	
            <ul>
                <li><a href="<?php echo getURL();?>admin/adminMembers/setFeeSMS">Thu phí SMS</a></li>
                                <li><a href="<?php echo getURL();?>admin/adminMembers/remakeCard">Thu phí làm lại thẻ</a></li>    
            </ul>
        </div>
        <div class="ad_bottom_box">Thu phí</div>
    </div>
    <!-- end box -->
    <?php if(Yii::app()->session['user']['data_user']->power==2){?>
    <!-- box -->
    <div class="ad_box">
            <div class="ad_main_box">                    	
            <ul>               
                <li><a href="<?php echo getURL();?>admin/adminMembers/browseRose">Xét duyệt tiền hoa hồng của các tv</a></li>
                <li><a href="<?php echo getURL();?>admin/adminMembers/makeRose">Lập lệnh thanh toán tiền hoa hồng cho các tv</a></li>  
            </ul>
        </div>
        <div class="ad_bottom_box">Thanh toán tiền hoa hồng</div>
    </div>
    <!-- end box -->
     <?php }?>
    <!-- box -->
    <div class="ad_box">
            <div class="ad_main_box">                    	
            <ul>
                  <li><a href="<?php echo getURL();?>admin/adminMembers/setTax">Thiết lập mức đóng thuế thu nhập cá nhân cho tv</a></li>    
                    <li><a href="<?php echo getURL();?>admin/adminMembers/setNoTax">Loại bỏ các thành viên tự đóng thuế</a></li>                           
            </ul>
        </div>
        <div class="ad_bottom_box">Thuế thu nhập cá nhân</div>
    </div>
    <!-- end box -->    
</div>