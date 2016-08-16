<div id="footer">
    <div class="menu-bottom">
      <div class="wrap-content">
        <ul>
          <li><a href="<?php echo getUrl();?>dang-nhap">Đăng nhập</a></li>
          <li><a href="<?php echo getUrl();?>dang-ky">Đăng ký</a></li>
          <li><a href="<?php echo getUrl();?>gio-hang">Giỏ hàng</a></li>
          <li><a href="">Liên hệ</a></li>
          <li><a href="">Tuyển dụng</a></li>
          <li><a href="<?php echo getUrl();?>rao-vat">Rao vặt</a></li>
        </ul>
        <a href="" class="ontop">TOP^</a> </div>
    </div>
    <div class="footer-bottom">
      <div class="wrap-content">
        <ul>
          <li class="footer-lv1">
            <h4>Giới thiệu</h4>
            <ul>
              <li class="footer-lv2"><a href="<?php echo getURL().'tin-tuc-view-391/ve-chung-toi';?>">Về chúng tôi</a></li>
              <li class="footer-lv2"><a href="<?php echo getURL().'tin-tuc-view-392/quy-che';?>">Quy chế</a></li>
              <li class="footer-lv2"><a href="<?php echo getURL().'tin-tuc-view-393/tro-giup';?>">Trợ giúp</a></li>
              <li class="footer-lv2"><a href="<?php echo getURL().'tin-tuc-view-394/lien-he-quan-cao';?>">Liên hệ quảng cáo</a></li>
            </ul>
          </li>
          <li class="footer-lv1">
            <h4>Hướng dẫn mua hàng</h4>
            <ul>
              <li class="footer-lv2"><a href="<?php echo getURL().'tin-tuc-view-396/dat-hang';?>">Đặt hàng</a></li>
              <li class="footer-lv2"><a href="<?php echo getURL().'tin-tuc-view-397/hinh-thuc-thanh-toan';?>">Hình thức thanh toán</a></li>
              <li class="footer-lv2"><a href="<?php echo getURL().'tin-tuc-view-398/van-chuyen-san-pham';?>">Vận chuyển sản phẩm</a></li>
              <li class="footer-lv2"><a href="<?php echo getURL().'tin-tuc-view-399/chinh-sach-bao-hanh';?>">Chính sách bảo hành</a></li>
            </ul>
          </li>
          <li class="footer-lv1 support">
            <h4>Hỗ trợ khách hàng</h4>
            <ul>
              <li class="footer-lv2"><a href="#">Hotline: <?php  echo $this->sale->hotline;?></a></li>
              <li class="footer-lv2"><a href="#">Email: <?php echo $this->sale->email;?></a></li>
              <li class="footer-lv2"><a href="ymsgr:sendim?<?php echo $this->sale->yahoo;?>">Hỗ trợ qua Yahoo</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <div class="clear"></div>
    <?php $setting = Setting::model()->findByPk(1);  ?>
    <div class="copyright wrap-content"> <b>Địa chỉ:<?php echo $setting->address;?>   Tel: <?php echo $setting->phone;?> , Fax: <?php echo $setting->fax;?></b><br />
      <?php echo $setting->info_other;?> </div>
  </div>