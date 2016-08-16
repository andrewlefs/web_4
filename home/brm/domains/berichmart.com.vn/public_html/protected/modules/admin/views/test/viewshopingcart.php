<style>
.shoping {
	border-collapse:collapse;
    float:left;
}
.titletr td{
	text-align:center;
	height:30px;
}
.shoping td{
	text-align:center;
}
.shoping td img{
	margin-top:10px;
	margin-left:10px;
	float:left;
	display:inline;
	margin-bottom:10px;
}
.shoping input[type='text']{
	width:80px;
	margin-left:1px;
}
</style>
<div class="top-main"><p>Danh sach mat hang</p></div><!--.top-main--> 
<div class="middle-main">
<table class="shoping" border="1" cellpadding="0" cellspacing="0">
    <tr style="font-weight:bold;" class="titletr">
        <td width="100">Hình ảnh</td>
        <td width="200">Tên sản phẩm</td>
        <td width="100">Số lượng</td>
        <td width="100">Gía</td>
        <td width="100">Thành tiền</td>
        <td width="100">Xử lý</td>
    </tr>
    <?php $total=0; $i=0; foreach($shopingcart as $key=>$product) {?>
    <tr>       
        <td><img width="80" height="80" src="<?php echo $product['images']; ?>" /></td>
        <td><?php echo $product['name']; ?></td>
        <td>
            <form name="view<?php echo $i; ?>" action="<?php echo getURL();?>test/updateshopingcart/<?php echo $key;?>" method="post">
		<input type="text" name="soluong" value="<?php echo $product['sl']; ?>" />
                </form>
        </td>
        <td><?php echo $product['price_sell']; ?></td>
        <td><?php echo $product['total']; ?></td>
        <td>
        <a href="#" onclick="document.view<?php echo $i; ?>.submit();"><input  type="button" value=" Sửa " /></a>
        <a href="<?php echo getURL();?>test/deleteshopingcart/<?php echo $key;?>"><input type="button" value=" Xóa " /></a>
        </td>        
    </tr>
    <?php $total +=$product['total']; $i++; } ?>   
</table>
<div style="margin-top:14px; float:left; width:800px; padding-left:80px;">Tổng tiền thanh toán : <?php echo $total;?><br />


<style>
form{
	text-transform:uppercase;
	margin-top:20px;
	margin-bottom:20px;
	
}
form span{
	font-weight:bold;
	font-size:18px;
	margin-left:200px;
	color:#CF9;
	
}
form .ttkh{
	font-size:16px;
	color:#CF9;
	margin-top:20px;
}
form .ttkh td{
	padding-left:2px;
}

form .ttkh input[type='text']{
	width:200px;
	height:30px;
	margin-left:5px;
	margin-top:5px;
}

</style>



<form name="thongtinkhachhang" id="form" action="<?php echo getURL();?>test/sendshopingcart" method="post">
<span><b>Thông tin khách hàng</b></span><br />
<table class="ttkh">
<tr>
<td>Họ và tên : </td>
<td><input type="text" name="hoten" /></td>



<td>Ngày sinh : </td>
<td><input type="text" name="Ns" /></td>
</tr>

<tr>
<td>Giới tính : </td>
<td><input type="text" name="Gt" /></td>



<td>Số điện thoại : </td>
<td><input type="text" name="Sdt" /></td>
</tr>

<tr>
<td>Địa chỉ : </td>
<td><input type="text" name="diachi" /></td>



<td>Địa chỉ mail : </td>
<td><input type="text" name="diachim" /></td>
</tr>
<tr><td><input style="margin-left:16px;" type="submit" value=" Hoàn tất "></td></tr>
</table>
</form>


</div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->
 