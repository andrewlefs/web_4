<style>
    .select_type ul{ margin-left: 170px;}
    .tb_form,.tb_form td{ border:0px !important;}
    .tb_form input[type='text']{width: 300px;}
    .tb_form .thongtin{border:1px solid #E2E2E2 !important; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; text-align: center; width: 116px;padding: 10px !important;}
    .tb_form .thongtin .radio{margin: 0px;}
    .activebox{background-color: #ffffdd;}
</style>
<div class="cart-page">
	<div class="continuous">
            <a href="<?php echo getURL();?>xoa-gio-hang" class="deleteCart">Xóa toàn bộ giỏ hàng<img src="<?php echo Yii::app()->controller->module->registerImage('dash_remove_icon.png')?>" alt=""></a><a href="<?php echo getURL();?>" class="continuousBuy">Tiếp tục mua hàng<img src="template/home/images/next-icon.png" alt=""></a>
	</div>
	<form action="<?php echo getURL().'home/products/EditShoppingCart';?>" method="post" accept-charset="utf-8" id="myform" class="cssform">
        <div class="list-cart">
        <h2>Đơn hàng của bạn</h2>		
          <table cellspacing="0" cellpadding="0" class="show_cart_table">
            <tbody>
              <tr class="text_title">
                <td width="1%">STT</td>
                <td width="1%">Ảnh</td>
                <td>Tên sản phẩm</td>
                <td width="1%">Xóa</td>
                <td width="13%">Giá (VNĐ)</td>
                <td width="11%">Số Lượng</td>                
                <td width="11%">Điểm</td>
                <td width="14%">Tổng (VNĐ)</td>
              </tr>
              <?php $total=0; $total_diem=0; $i=0; foreach($shopingcart as $key=>$product) { 
                    $total_diem +=$product['bonus'];?>
                <tr>
                    <td class="No"><?php echo $i+1;?></td>
                    <td align="center"><div class="picture_small"><img width="20" height="25" src="<?php echo $product['images']; ?>" maxheight="25" maxwidth="25"></div></td>
                    <td><a rel="nofollow" href="<?php //echo getUrl().'view-'.$key.'/'.$product['alias'].'.html';?>" class="text_link"><?php echo $product['name']; ?></a></td>
                    <td align="center"><a href="<?php echo getURL().'delete-'.$key;?>" class="delete-item-in-cart"><img src="<?php echo Yii::app()->controller->module->registerImage('dash_remove_icon.png')?>" alt=""></a></td>
                    <td align="right" class="price"><?php echo number_format($product['price_sell']); ?> VNĐ</td>                    
                    <td align="center"><input type="text" style="text-align:right; width:50px" value="<?php echo $product['sl']; ?>" name="quantity[<?php echo $key;?>]" class="pro-qual"></td>
                    <td align="right"><?php echo $product['bonus'].' đ ';?></td>
                    <td align="right" class="price">
                    <?php echo number_format($product['total']); ?> VNĐ
                    </td>
                </tr>
		<?php $total +=$product['total']; $i++; } ?> 
                <tr>
                  <td align="center" colspan="4">
                  <input type="button" value="Tiếp tục mua hàng" class="form_button" onclick="window.location.href='<?php echo getURL();?>'">
                  &nbsp;
                  <input type="submit" value="Tính lại" class="form_button recalculate">
                  &nbsp;
                  <input type="button" value="Xóa hết" onclick="window.location.href='<?php echo getURL();?>xoa-gio-hang'" class="form_button del-all-in-shop" id="189">
                  <div class="payment_recount_notice">(* Khi bạn đổi số lượng hãy click vào nút <b>Tính lại</b> để hệ thống cập nhật lại giỏ hàng)</div></td>
                  <td colspan="4" class="total_money" align="center" id="remake">Thành tiền: <b class="price"><?php echo number_format($total);?> VNĐ</b></td>
              </tr>                
                <tr>
                    <td colspan="8">
                        <table class="tb_form" cellpadding="0" cellspacing="0" style="width:50%; float: left;">
                            <tr>
                                <td colspan="2" style="text-align:center; font-weight: bold; text-transform: uppercase; color: red;">A. Thông tin người đặt hàng</td>
                            </tr>
                            <tr>
                                <td>Họ tên : <span style="color:red; font-weight: bold;">*</span></td>
                                <td><input type="text" name="personbuy[fullname]" id="fullname_b" value="<?php echo (isset($member)&&!empty($member))?$member->fullname:'';?>"></td>
                            </tr>
                            <tr>
                                <td>Giới tính : </td>
                                <td>
                                    <select name="personbuy[sex]" id="sex_b">
                                        <option value="">Chọn giới tính</option>
                                        <option value="0">Nữ</option>
                                        <option value="1">Nam</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ : <span style="color:red; font-weight: bold;">*</span></td>
                                <td><input type="text" name="personbuy[address]" id="address_b" value="<?php echo (isset($member)&&!empty($member))?$member->address:'';?>" ></td>
                            </tr>
                            <tr>
                                <td>Email : <span style="color:red; font-weight: bold;">*</span></td>
                                <td><input type="text" name="personbuy[email]" id="email_b" value="<?php echo (isset($member)&&!empty($member))?$member->email:'';?>"></td>
                            </tr>
                            <tr>
                                <td>Điện thoại : <span style="color:red; font-weight: bold;">*</span></td>
                                <td><input type="text" name="personbuy[phone]" id="phone_b" value="<?php echo (isset($member)&&!empty($member))?$member->phone:'';?>"></td>
                            </tr>
                            <tr>
                                <td>Di đông : </td>
                                <td><input type="text" name="personbuy[mobile]" id="mobile_b" value="<?php echo (isset($member)&&!empty($member))?$member->name:'';?>"></td>
                            </tr>
                            <tr>
                                <td>Fax : </td>
                                <td><input type="text" name="personbuy[fax]" id="fax_b" ></td>
                            </tr>
                            <tr>
                                <td>Ghi chú : </td>
                                <td><input type="text" name="personbuy[info]" id="info_b" ></td>
                            </tr>                            
                        </table>
                        <table class="tb_form" cellpadding="0" cellspacing="0" style="width:50%;float: left;">
                            <tr>
                                <td colspan="2" style="text-align:center; font-weight: bold;text-transform: uppercase; color: red;">
                                    B. Thông tin người nhận hàng
                                    <p style="font-weight:normal; color:blue; margin: 0px; text-transform: none;"><input type="checkbox" id="samepersonbuy" name="samebuy"> (Thông tin người nhận trùng với người đặt hàng)</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Họ tên : <span style="color:red; font-weight: bold;">*</span></td>
                                <td><input type="text" name="personget[fullname]" id="fullname_g"></td>
                            </tr>
                            <tr>
                                <td>Giới tính : </td>
                                <td>
                                    <select name="personget[sex]" id="sex_g">
                                        <option value="">Chọn giới tính</option>
                                        <option value="0">Nữ</option>
                                        <option value="1">Nam</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ : <span style="color:red; font-weight: bold;">*</span></td>
                                <td><input type="text" name="personget[address]" id="address_g"></td>
                            </tr>
                            <tr>
                                <td>Email : <span style="color:red; font-weight: bold;">*</span></td>
                                <td><input type="text" name="personget[email]" id="email_g"></td>
                            </tr>
                            <tr>
                                <td>Điện thoại : <span style="color:red; font-weight: bold;">*</span></td>
                                <td><input type="text" name="personget[phone]" id="phone_g"></td>
                            </tr>                            
                            <tr>
                                <td>Di đông : </td>
                                <td><input type="text" name="personget[mobile]" id="mobile_g" ></td>
                            </tr>
                            <tr>
                                <td>Fax : </td>
                                <td><input type="text" name="personget[fax]" id="fax_g" ></td>
                            </tr>
                            <tr>
                                <td>Ghi chú : </td>
                                <td><input type="text" name="personget[info]" id="info_g" ></td>
                            </tr>
                        </table>
                        <table class="tb_form" cellpadding="10" cellspacing="10" style="margin:auto;">
                            <tr>
                                <td colspan="3" style="border: none !important;text-align:center; font-weight: bold; text-transform: uppercase; color: red;">C. phương thức thanh toán</td>
                            </tr>
                            <tr>
                                <td class="thongtin activebox">
                                    <p class="radio">Thanh toán bằng thẻ thành viên</p>
                                    <p class="radio"><input type="radio" class="thanhtoan" name="thanhtoan" checked="checked" value="the"></p>                                        
                                </td>
                                <td class="thongtin">
                                    <p class="radio">Thanh toán bằng tiền mặt</p>
                                    <p class="radio"><input type="radio" class="thanhtoan" name="thanhtoan" value="tienmat"></p>     
                                </td>
                                <td class="thongtin">
                                    <p class="radio">Chuyển khoản qua ngân hàng</p>
                                    <p class="radio"><input type="radio" class="thanhtoan" name="thanhtoan" value="chuyenkhoan"></p>     
                                </td>
                            </tr>
                        </table>
                        <table class="tb_form" cellpadding="10" cellspacing="10" style="margin:auto;">
                            <tr>
                                <td colspan="3" style="border: none !important;text-align:center; font-weight: bold; text-transform: uppercase; color: red;">D. Hình thức vận chuyển</td>
                            </tr>
                            <tr>
                                <td class="thongtin activebox">
                                    <p class="radio">Đến địa chỉ người nhận</p>
                                    <p class="radio"><input type="radio" name="vanchuyen" checked="checked" value="Đến địa chỉ người nhận"></p>                                        
                                </td>
                                <td class="thongtin">
                                    <p class="radio">Khác hàng đến nhận hàng</p>
                                    <p class="radio"><input type="radio" name="vanchuyen" value="Khác hàng đến nhận hàng"></p>     
                                </td>
                                <td class="thongtin">
                                    <p class="radio">Qua bưu điện</p>
                                    <p class="radio"><input type="radio" name="vanchuyen" value="Qua bưu điện"></p>     
                                </td>
                                <td class="thongtin">
                                    <p class="radio">Hình thức khác</p>
                                    <p class="radio"><input type="radio" name="vanchuyen" value="Hình thức khác"></p>     
                                </td>
                            </tr>
                        </table>
                        <p style="text-align:center; width: 100%;">
                            <span>Thời gian mong muốn nhận hàng : </span>
                            <input type="text" name="time[hi]" style="width:100px;">
                            <select name="time[d]">
                                <option value="">Chọn ngày</option>
                                <?php for($i=1;$i<=31;$i++){?>
                                <option value="<?=$i;?>" <?php if($i==date('d')) echo 'selected="selected"';?>><?=$i;?></option>
                                <?php }?>
                            </select>
                            <select name="time[m]">
                                <option value="">Chọn tháng</option>
                                <?php for($i=1;$i<=12;$i++){?>
                                <option value="<?=$i;?>" <?php if($i==date('m')) echo 'selected="selected"';?>><?=$i;?></option>
                                <?php }?>
                            </select>
                            <select name="time[y]">
                                <option value="">Chọn năm</option>
                                <option value="<?=date('Y');?>" selected="selected"><?=date('Y');?></option>
                                <option value="<?=(date('Y')+1);?>"><?=(date('Y')+1);?></option>
                            </select>
                            <span style="color:#4d4d4d;"> ( Giờ:Phút-Ngày/Tháng/Năm )</span>
                        </p>
                        <p style="text-align:center; width: 100%;"><input type="button" id="thanhtoan"  value="Thanh toán" style="font-weight:bold;" class="form_button"></p>
                    </td>
                </tr> 
            </tbody>
          </table>
        </div>        
    </form>
</div>
<script>
    var tvkn =<?php echo Yii::app()->tree->getRoseConsuming('tvkn');?>;
    var money =<?php echo Yii::app()->tree->getRoseConsuming('money');?>;
    var member_id =<?php echo isset(Yii::app()->session['member'])? Yii::app()->session['member']['id']:0;?>;
    var card =<?php echo Yii::app()->tree->getRoseConsuming('card');?>;
    var total_diem = <?php echo $total_diem; ?>;
    var diemoff=0,tongtienoff=0;   
    function remake(level){
        thanhtoan = $('.thanhtoan:checked').val();
        if(level=='tvct'){
            if(thanhtoan !='tienmat')
                diemoff = total_diem*card;
            else
                diemoff = total_diem*money;
        } else diemoff = total_diem*tvkn;
        
        moneyoff = Math.round(diemoff*1000);
        total = <?php echo $total;?>;
        totaloff =Math.round(total-moneyoff); tongtienoff=totaloff;
        $.post('<?php echo getURL().'home/products/fomat' ?>', {'number':moneyoff}, function(data){
            moneyoff=data;
            $.post('<?php echo getURL().'home/products/fomat' ?>', {'number':totaloff}, function(data){
                totaloff=data;
                msg ='Thành tiền: <b class="price"><?php echo number_format($total);?> VNĐ</b><br>Hoa hồng tiêu dùng : <b class="price">'+moneyoff +' VNĐ</b><br> Tổng tiền thực cần thanh toán : <b class="price">'+totaloff+' VNĐ</b>';
                $('#remake').html(msg);
            });
        });
        
    }
    
    function checkinfo(selector){
        if($.trim($(selector).val())==''){
            alert('Chưa nhập đầy đủ thông tin. Qúy khách vui lòng kiểm tra lại những mục có dấu "*" đã được nhập thông tin chưa ?');
            $(selector).focus();
            return false;
        } 
    }
    
    $(function(){
    $('#sex_b').val(<?php echo (isset($member)&&!empty($member))?$member->sex:'';?>);
        $('#samepersonbuy').click(function(){
            if(this.checked){
                $('#fullname_g').val($('#fullname_b').val());
                $('#address_g').val($('#address_b').val());
                $('#phone_g').val($('#phone_b').val());
                $('#email_g').val($('#email_b').val());
                $('#mobile_g').val($('#mobile_b').val());
                $('#fax_g').val($('#fax_b').val()); 
                $('#info_g').val($('#info_b').val()); 
                $('#sex_g').val($('#sex_b').val());
            }
            else {
                $('#fullname_g').val('');
                $('#address_g').val('');
                $('#phone_g').val('');
                $('#email_g').val('');                  
                $('#mobile_g').val('');
                $('#fax_g').val(''); 
                $('#info_g').val(''); 
                $('#sex_g').val('');
            }
        });
        
    $('#thanhtoan').click(function(){
        $('#myform').attr('action','<?php echo getURL().'home/products/paymoney';?>');
        result = checkinfo('#fullname_b');
        if(result==false)
            return false;
        result = checkinfo('#address_b');
        if(result==false)
            return false;
        result = checkinfo('#email_b');
        if(result==false)
            return false;
        result = checkinfo('#phone_b');
        if(result==false)
            return false;
        result = checkinfo('#fullname_g');
        if(result==false)
            return false;
        result = checkinfo('#address_g');
        if(result==false)
            return false;
        result = checkinfo('#email_g');
        if(result==false)
            return false;
        result = checkinfo('#phone_g');
        if(result==false)
            return false;
        if(member_id==0 && $('.thanhtoan:checked').val()=='the'){
                alert('Qúy khách chưa phải là thành viên. Vui lòng chọn phương thức thanh toán khác');
            return false;
        }
        if(member_id >0 && $('.thanhtoan:checked').val()=='the'){             
            <?php
            if(isset(Yii::app()->session['member'])){
                $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
                if(empty($member->CardAccount))
                    echo 'card=0;'; // thanh vien chua dang ky the
                else{
                    echo 'card=1;';
                    echo 'moneycard='.($member->CardAccount['money']-50000).';'; // tien trong tai khoan cua thanh vien
                }
            }
            ?>
            if(card==0){              
                alert('Thành viên chưa đăng ký thẻ tài khoản. Hãy vào trang quản trị của bạn, đăng ký thẻ và nạp tiền vào tài khoản hoặc chọn phương thức thanh toán khác');
                return false;
            }
            else{
                if(moneycard<tongtienoff){
                    alert('Tài khoản thành viên không đủ tiền để thanh toán. Hãy nạp thêm tiền hoặc chọn phương thức thanh toán khác');
                    return false;
                }
            }
        } 
        $('#myform').submit();
    });
    <?php if(isset(Yii::app()->session['member'])){
            $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
            if($member->title>0){
     ?>
    $('.thanhtoan').click(function(){
        remake('tvct');        
    });
    remake('tvct');
    <?php } else {?>
        remake('tvkn');
    <?php }}?>
    })
</script>