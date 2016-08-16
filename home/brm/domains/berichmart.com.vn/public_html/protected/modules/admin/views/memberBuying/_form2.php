<style>
    #listsp{ border-collapse: collapse;}
    #listsp td{ padding: 5px; border: 1px solid #ccc;}
    #table2 td{padding: 5px;}
</style>
<div class="form">
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="listsp">
            <tr style="font-weight: bold; text-align: center;">
                <td valign="top" style="width:150px;">Mã Sản phẩm</td>
                <td valign="top">Tên sản phẩm</td>
                <td valign="top">Hình ảnh</td>
                <td valign="top">Số lượng</td>
                <td valign="top">Điểm bán</td>
                <td valign="top">Điểm HT</td>
                <td valign="top">Điểm KM</td>
            </tr>
            <?php   //   pr($products) 
            if(!isset($id))
                $id='';
            $total=0;$sodiem=0;$sodiem_km=0;
            foreach($products as $key => $item){ 
                $product=Product::model()->find('code="'.$item['code'].'"');
                $diem_ht =  $product->sodiem*$item['sl'];
                $diem_km = $product->sodiem_km*$item['sl'];                
                $total +=$product->price*$item['sl'];
                $sodiem +=$diem_ht; $sodiem_km += $diem_km;
                ?>
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $item['code'];?></td>
                <td align="left" valign="top"><?php echo $product->title;?></td>
                <td align="left" valign="top" style="text-align: center;"><img src="<?=  getURL().$product->image;?>" style="width: 40px;"></td>
                <td align="left" valign="top"><?php echo $item['sl'];?></td>
                <td align="left" valign="top"><?php echo $product->price.' điểm';?></td>
                <td align="left" valign="top"><?php echo $diem_ht.' điểm';?></td>
                <td align="left" valign="top"><?php echo $diem_km.' điểm';?></td>                
            </tr>
            <?php }?>
            <tr style="color:red;">
                <td>Tổng</td>
                <td colspan="3"></td>
                <td align="right" class="price"><?php echo $total.' điểm';?></td>
                <td align="right" class="price"><?php echo $sodiem.' điểm';?></td>
                <td align="right" class="price"><?php echo $sodiem_km.' điểm';?></td>
            </tr>
        </table> 
    <?php
        $member_name = '';
        $ngay='';
        if(isset($donhang)){
            $ngay = date('m-d-Y',  strtotime($donhang->created));
            $member = Member::model()->findByPk($donhang->member_id);
            $member_name = $member->name;
        }
    ?>
    <form id="frm2" method="post">
            <table width="949" border="0" cellspacing="1" cellpadding="0" id="table2" style='margin-top:30px;'>
                <tr>
                    <td align="left" valign="top" style="width:150px;">Tên đăng nhập :</td>
                    <td align="left" valign="top">
                        <label> 
                            <?php echo $member_name;?>
                        </label>
                    </td>
                </tr> 
                <tr>
                    <td align="left" valign="top" style="width:150px;">Ngày làm đơn</td>
                    <td align="left" valign="top">
                        <label> 
                            <?php echo $ngay;?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="width:150px;">Trạng thái đơn hàng :</td>
                    <td align="left" valign="top">
                        <label> 
                            <input type="text" name="donhang[msg_status]" value ="<?php echo $donhang->msg_status;?>" class="text-input">
                        </label>
                    </td>
                </tr> 
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                            <input name="savesp" type="submit" value="Lưu đơn hàng">
                    </label></td>
                </tr>
            </table> 
      </form>
</div><!-- form -->