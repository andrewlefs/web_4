<?php
$shopingcart = unserialize($member_buying['products']);
$personbuy= unserialize($member_buying['personbuy']);
$personget= unserialize($member_buying['personget']);
$time = unserialize($member_buying['time']); 
?>
<style>
    .select_type ul{ margin-left: 170px;}
    .tb_form,.tb_form td{ border:0px !important;}
    .tb_form input[type='text']{width: 300px;}
    .tb_form .thongtin{border:1px solid #E2E2E2 !important; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; text-align: center; width: 116px;padding: 10px !important;}
    .tb_form .thongtin .radio{margin: 0px;}
    .activebox{background-color: #ffffdd;}
    .infotb tr td:first-child{text-align: right; padding-right: 10px; font-weight:bold;}
    .boxbt{border:1px solid #E2E2E2 !important; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;padding: 10px;background-color: #ffffdd;}}
</style>
<div class="cart-page">
	<div class="continuous">
            <a href="<?php echo getURL();?>xoa-gio-hang" class="deleteCart">Xóa toàn bộ giỏ hàng<img src="<?php echo Yii::app()->controller->module->registerImage('dash_remove_icon.png')?>" alt=""></a><a href="<?php echo getURL();?>" class="continuousBuy">Tiếp tục mua hàng<img src="template/home/images/next-icon.png" alt=""></a>
	</div>
	<form action="" method="post" accept-charset="utf-8" id="myform" class="cssform">
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
                  <td align="center" colspan="4"></td>
                  <td colspan="4" class="total_money" align="center" id="remake">Thành tiền: <b class="price"><?php echo number_format($total);?> VNĐ</b></td>
              </tr>  
            </tbody>
          </table>  
          <table cellspacing="0" cellpadding="0" class="show_cart_table infotb" style="margin-top:10px;">
            <tr class="text_title">
                <td colspan="2" style="text-align:left;">Thông tin người đặt hàng</td>
            </tr>
            <tr>
                <td style="width: 30%;">Họ tên : </td>
                <td><?php echo $personbuy['fullname'];?></td>
            </tr>
            <tr>
                <td>Giới tính : </td>
                <td><?php echo ($personbuy['sex']==0)? 'Nữ':'Nam';?></td>
            </tr>
            <tr>
                <td>Địa chỉ : </td>
                <td><?php echo $personbuy['address'];?></td>
            </tr>
            <tr>
                <td>Email : </td>
                <td><?php echo $personbuy['email'];?></td>
            </tr>
            <tr>
                <td>Điện thoại : </td>
                <td><?php echo $personbuy['phone'];?></td>
            </tr>
            <tr>
                <td>Di đông : </td>
                <td><?php echo $personbuy['mobile'];?></td>
            </tr>
            <tr>
                <td>Fax : </td>
                <td><?php echo $personbuy['fax'];?></td>
            </tr>
            <tr>
                <td>Ghi chú : </td>
                <td><?php echo $personbuy['info'];?></td>
            </tr>                            
        </table>
        <table cellspacing="0" cellpadding="0" class="show_cart_table infotb" style="margin-top:10px;">
            <tr class="text_title">
                <td colspan="2" style="text-align:left;">Thông tin người nhận hàng</td>
            </tr>
            <tr>
                <td style="width: 30%;">Họ tên : </td>
                <td><?php echo $personget['fullname'];?></td>
            </tr>
            <tr>
                <td>Giới tính : </td>
                <td><?php echo ($personget['sex']==0)? 'Nữ':'Nam';?></td>
            </tr>
            <tr>
                <td>Địa chỉ : </td>
                <td><?php echo $personget['address'];?></td>
            </tr>
            <tr>
                <td>Email : </td>
                <td><?php echo $personget['email'];?></td>
            </tr>
            <tr>
                <td>Điện thoại : </td>
                <td><?php echo $personget['phone'];?></td>
            </tr>
            <tr>
                <td>Di đông : </td>
                <td><?php echo $personget['mobile'];?></td>
            </tr>
            <tr>
                <td>Fax : </td>
                <td><?php echo $personget['fax'];?></td>
            </tr>
            <tr>
                <td>Ghi chú : </td>
                <td><?php echo $personget['info'];?></td>
            </tr>                            
        </table>
        <table cellspacing="0" cellpadding="0" class="show_cart_table infotb" style="margin-top:10px;">
            <tr class="text_title">
                <td colspan="2" style="text-align:left;">Thanh toán và chuyển hàng</td>
            </tr>
            <tr>
                <td style="width: 30%;">Phương thức thanh toán : </td>
                <td><?php switch ($member_buying['thanhtoan']){
                    case 'the': echo 'Thanh toán bằng thẻ thành viên';
                        break;
                    case 'chuyenkhoan': echo 'Chuyển khoản qua ngân hàng';
                        break;
                    default : echo 'Thanh toán bằng tiền mặt';
                }
                ?></td>
            </tr>
            <tr>
                <td>Hình thức vận chuyển : </td>
                <td><?php echo $member_buying['vanchuyen'];?></td>
            </tr>
            <tr>
                <td>Thời gian nhận hàng : </td>
                <td><?php echo $time['hi'].'-'.$time['d'].'/'.$time['m'].'/'.$time['y'];?></td>
            </tr>             
        </table> 
        <input type="hidden" name="senđonhang" value="1">
        <div class="boxbt" style="margin-top:10px;">
            <span><img src="<?php echo getURL().'images/canhbao.png';?>"></span>
            <span style="margin-right:10px; color:red;">Bạn hãy kiểm tra kỹ thông tin trước khi tiếp tuc</span>
            <input type="submit" value=" Gửi đơn hàng ">
            <input type="button" onclick="window.location.href='<?php echo getURL().'home/products/suaDonHang/';?>'" value=" Quay lại bước 1 ">
        </div> 
     </div>        
    </form>
</div>
<script>   
    function remake(){
        moneyoff = Math.round(<?php echo $member_buying['money_off'];?>);
        totaloff =Math.round(<?php echo $member_buying['total_off'];?>);
        $.post('<?php echo getURL().'home/products/fomat' ?>', {'number':moneyoff}, function(data){
            moneyoff=data;
            $.post('<?php echo getURL().'home/products/fomat' ?>', {'number':totaloff}, function(data){
                totaloff=data;
                msg ='Thành tiền: <b class="price"><?php echo number_format($total);?> VNĐ</b><br>Hoa hồng tiêu dùng : <b class="price">'+moneyoff +' VNĐ</b><br> Tổng tiền thực cần thanh toán : <b class="price">'+totaloff+' VNĐ</b>';
                $('#remake').html(msg);
            });
        });
        
    }
    $(function(){
        remake();
    });
</script>