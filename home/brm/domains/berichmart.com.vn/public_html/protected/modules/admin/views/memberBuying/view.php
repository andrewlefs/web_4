<style>
    .tb_form,.tb_form td{border: 0px;}
</style>
<?php
$shopingcart = unserialize($donhang['products']);
$personbuy=unserialize($donhang['personbuy']);
$personget=unserialize($donhang['personget']);
?>
<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Chi tiết đơn hàng</p>
</div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                    <tr class="text_title" style="text-align: center; font-weight: bold;">
                        <td width="4%" style="padding: 5px;">STT</td>
                        <td width="9%" style="padding: 5px;">Ảnh</td>
                        <td style="padding: 5px;">Tên sản phẩm</td>
                        <td width="15%" style="padding: 5px;">Giá (VNĐ)</td>
                        <td width="10%" style="padding: 5px;">Số Lượng</td> 
                        <td>Điểm</td>
                        <td width="15%" style="padding: 5px;">Tổng (VNĐ)</td>
                    </tr>
                    <?php $total=0; $i=0; foreach($shopingcart as $key=>$product) {?>
                    <tr>
                        <td class="No" style="padding: 5px;"><?php echo $i+1;?></td>
                        <td align="center" style="padding: 5px;"><div class="picture_small"><img width="20" height="25" src="<?php echo $product['images']; ?>" maxheight="25" maxwidth="25"></div></td>
                        <td style="padding: 5px;"><a rel="nofollow" href="#" class="text_link"><?php echo $product['name']; ?></a></td>                    
                        <td align="right" class="price" style="padding: 5px;"><?php echo number_format($product['price_sell']); ?> VNĐ</td>                    
                        <td align="center" style="padding: 5px;"><?php echo $product['sl']; ?></td>
                        <td align="right"><?php echo $product['bonus'].' đ ';?></td>
                        <td align="right" class="price" style="padding: 5px;">
                        <?php echo number_format($product['total']); ?> VNĐ
                        </td>
                    </tr>
                    <?php $total +=$product['total']; $i++; } ?> 
                    <tr class="select_type">
                        <td colspan="7" style="padding: 5px;">
                            <p>Thành tiền: <b class="price"><?php echo number_format($total);?> VNĐ</b></p>
                            <p>Phương thức thanh toán : <?php echo ($content['thanhtoan']=='the')?'Thẻ':'Tiền mặt';?></p>
                            <p>Phương thức vận chuyển : <?php echo ($content['vanchuyen']=='buudien')?'Gửi qua bưu điên':'Nhận trực tiếp tại siêu thị';?></p>
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
                                    <td>Địa chỉ : </td>
                                    <td><?php echo $personbuy['address'];?></td>
                                </tr>
                                <tr>
                                    <td>Điện thoại : </td>
                                    <td><?php echo $personbuy['phone'];?></td>
                                </tr>
                                <tr>
                                    <td>Email : </td>
                                    <td><?php echo $personbuy['email'];?></td>
                                </tr>
                            </table>
                        </td>
                        <td colspan="4" style="padding: 5px;">
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
                                    <td>Địa chỉ : </td>
                                    <td><?php echo $personget['address'];?></td>
                                </tr>
                                <tr>
                                    <td>Điện thoại : </td>
                                    <td><?php echo $personget['phone'];?></td>
                                </tr>
                                <tr>
                                    <td>Email : </td>
                                    <td><?php echo $personget['email'];?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>			
                   
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->