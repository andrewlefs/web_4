<div class="cotmain">
    <div class="tieude">
            <h2>Chi tiết đơn hàng <?php echo $id;?></h2>            
    </div>
        <div class="thongtin-ct">
            <table style="margin-top:0; border-collapse:collapse;" border="0" cellspacing="0" class ="detail_table">
                <thead>
                <tr>
                    <td>STT</td>
                    <td>Ảnh</td>
                    <td>Tên sản phẩm</td> 
                    <td>Số Lượng</td>
                    <td>Điểm bán</td>
                    <td>Điểm HT</td>
                    <td>Điểm KM</td>
                </tr>
                </thead>
                <tbody class="text-center">
                    
                    <?php
                        $shopingcart = unserialize($donhang['products']); 
                        ?>
                    <?php $total=0;$sodiem=0;$sodiem_km=0; $i=0; foreach($shopingcart as $key=>$product) {
                        $diem_ht =  $product['sodiem']*$product['sl'];
                        $diem_km = $product['sodiem_km']*$product['sl'];
                        $sodiem += $diem_ht;
                        $sodiem_km += $diem_km;
                        $total +=$product['total'];
                        ?>
                    <tr>
                        <td><?php echo $i+1;?></td>
                        <td style="text-align: center;"><img width="20" height="25" src="<?php echo $product['images']; ?>" maxheight="25" maxwidth="25"></td>
                        <td><?php echo $product['name']; ?></td>
                        <td>
                            <?php echo $product['sl']; ?>
                         </td>
                        <td><?php echo $product['price']; ?> điểm</td>
                        <td><?php echo $diem_ht; ?> điểm</td>
                        <td><?php echo $diem_km; ?> điểm</td>                       
                    </tr>   
                    <?php $i++; } ?> 
                    <tr>
                        <td>Tổng</td>
                        <td colspan="3"></td>
                        <td style="color: red;"><?php echo $total;?> điểm</td>
                        <td style="color: red;"><?php echo $sodiem;?> điểm</td>
                        <td style="color: red;"><?php echo $sodiem_km;?> điểm</td>
                    </tr>
                </tbody>                
            </table>
            </div>
    <div style=" padding-top: 18px;"></div>
</div><!--ecotmain-->