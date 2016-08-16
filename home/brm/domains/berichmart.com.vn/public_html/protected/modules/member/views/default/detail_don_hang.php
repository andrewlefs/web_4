<style>
    .tb_form,.tb_form td{border: 0px;}
</style>
<?php
$shopingcart = unserialize($donhang['products']);
$personbuy=unserialize($donhang['personbuy']);
$personget=unserialize($donhang['personget']);
?>
<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
<table class="table-member style2" border="0" cellspacing="0" style="margin-top:0;">
    <thead>
        <tr>
                <td colspan="7">Thông tin chi tiết đơn hàng</td>
        </tr>
    </thead>    
    <tbody>
       <tr class="text_title" style="text-align: center; font-weight: bold;">
            <td width="4%" style="padding: 5px;">Mã hàng</td>
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
                <p>Thành tiền: <b class="price" style="color:red;"><?php echo number_format($total);?> VNĐ</b></p>
                <p>Hoa hồng tiêu dùng: <b class="price" style="color:red;"><?php echo number_format($donhang['money_off']);?> VNĐ</b></p>
                <p>Tổng tiền thực cần thanh toán: <b class="price" style="color:red;"><?php echo number_format($donhang['total_off']);?> VNĐ</b></p>                
            </td>
        </tr>
    </tbody>
</table>
<table class="table-member style2" border="0" cellspacing="0" >
    <thead>
        <tr>
        <td colspan="2">
            Thông tin người nhận
        </td>
    </tr>
    </thead>
    <tbody>    
    <tr>
        <td align="right" style="font-weight: bold; width: 35%;">Họ tên : </td>
        <td><?php echo $personget['fullname'];?></td>
    </tr>
    <tr>
        <td align="right" style="font-weight: bold;">Địa chỉ : </td>
        <td><?php echo $personget['address'];?></td>
    </tr>
    <tr>
        <td align="right" style="font-weight: bold;">Điện thoại : </td>
        <td><?php echo $personget['phone'];?></td>
    </tr>
    <tr>
        <td align="right" style="font-weight: bold;">Email : </td>
        <td><?php echo $personget['email'];?></td>
    </tr>
    </tbody>
</table>
<table class="table-member style2" border="0" cellspacing="0" >
    <thead>
        <tr>
        <td colspan="2">
            Thanh toán và chuyển hàng
        </td>
    </tr>
    </thead>
    <tbody>    
    <tr>
        <td align="right" style="font-weight: bold; width: 35%;">Phương thức thanh toán :</td>
        <td><?php echo ($content['thanhtoan']=='the')?'Thẻ':'Tiền mặt';?></td>
    </tr>
    <tr>
        <td align="right" style="font-weight: bold;">Hình thức vận chuyển : </td>
        <td><?php echo ($content['vanchuyen']=='buudien')?'Gửi qua bưu điên':'Nhận trực tiếp tại siêu thị';?></td>
    </tr>
    <tr>
        <td align="right" style="font-weight: bold;">Thời gian vận chuyển: </td>
        <td></td>
    </tr>
    </tbody>
</table>
</div>