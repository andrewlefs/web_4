<?php
$shopingcart = unserialize($content['products']);
$personbuy=unserialize($content['personbuy']);
$personget=unserialize($content['personget']);
?>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <table cellspacing="0" cellpadding="0" class="show_cart_table" border="1" style="border-collapse: collapse;">
            <tbody>
              <tr class="text_title" style="text-align: center; font-weight: bold;">
                <td width="4%" style="padding: 5px;">STT</td>
                <td width="9%" style="padding: 5px;">Ảnh</td>
                <td style="padding: 5px;">Tên sản phẩm</td>
                <td width="15%" style="padding: 5px;">Giá (VNĐ)</td>
                <td width="10%" style="padding: 5px;">Số Lượng</td> 
                <td width="15%" style="padding: 5px;">Tổng (VNĐ)</td>
              </tr>
              <?php $total=0; $i=0; foreach($shopingcart as $key=>$product) {?>
                <tr>
                    <td class="No" style="padding: 5px;"><?php echo $i+1;?></td>
                    <td align="center" style="padding: 5px;"><div class="picture_small"><img width="20" height="25" src="<?php echo $_SERVER['SERVER_NAME'].$product['images']; ?>" maxheight="25" maxwidth="25"></div></td>
                    <td style="padding: 5px;"><a rel="nofollow" href="#" class="text_link"><?php echo $product['name']; ?></a></td>                    
                    <td align="right" class="price" style="padding: 5px;"><?php echo number_format($product['price_sell']); ?> VNĐ</td>                    
                    <td align="center" style="padding: 5px;"><?php echo $product['sl']; ?></td>                    
                    <td align="right" class="price" style="padding: 5px;">
                    <?php echo number_format($product['total']); ?> VNĐ
                    </td>
                </tr>
		<?php $total +=$product['total']; $i++; } ?> 
                <tr class="select_type">
                    <td colspan="6" style="padding: 5px;">
                        <p>Thành tiền: <b class="price"><?php echo number_format($total);?> VNĐ</b></p>
                        <?php if(!empty($content['member_id'])){?>
                        <p>Hoa hồng tiêu dùng: <b class="price"><?php echo number_format($content['money_off']);?> VNĐ</b></p>
                        <p>Tổng tiền thực cần thanh toán: <b class="price"><?php echo number_format($content['total_off']);?> VNĐ</b></p>
                        <?php }?>
                        <p>Phương thức thanh toán : 
                            <?php switch ($content['thanhtoan']){
                                case 'the': echo 'Thanh toán bằng thẻ thành viên';
                                    break;
                                case 'chuyenkhoan': echo 'Chuyển khoản qua ngân hàng';
                                    break;
                                default : echo 'Thanh toán bằng tiền mặt';
                            }
                            ?>
                        </p>
                        <p>Hình thức vận chuyển : <?php echo $content['vanchuyen'];?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 5px;">
                        <table class="tb_form" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="2" style="text-align:center; font-weight: bold;">Thông tin người mua</td>
                            </tr>
                            <tr>
                                <td>Họ tên : </td>
                                <td><?php echo $personbuy['fullname'];?></td>
                            </tr>
                            <tr>
                                <td>Giới tính : </td>
                                <td><?php echo ($personbuy['sex']==0)?'Nữ':'Nam';?></td>
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
                                <td>Di động : </td>
                                <td><?php echo $personbuy['mobile'];?></td>
                            </tr>  
                        </table>
                    </td>
                    <td colspan="3" style="padding: 5px;">
                        <table class="tb_form" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="2" style="text-align:center; font-weight: bold;">
                                    Thông tin người nhận
                                </td>
                            </tr>
                            <tr>
                                <td>Họ tên : </td>
                                <td><?php echo $personget['fullname'];?></td>
                            </tr>
                            <tr>
                                <td>Giới tính : </td>
                                <td><?php echo ($personget['sex']==0)?'Nữ':'Nam';?></td>
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
                                <td>Di động : </td>
                                <td><?php echo $personget['mobile'];?></td>
                            </tr> 
                        </table>
                    </td>
                </tr>
            </tbody>
          </table>
    </body>
</html>

