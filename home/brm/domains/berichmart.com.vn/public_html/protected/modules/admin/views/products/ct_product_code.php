<style>
    #listsp{ border-collapse: collapse; margin: 20px 0px;}
    #listsp td{ padding: 5px; border: 1px solid #ccc;}
    #table2 td{padding: 5px;}
    .middle-main{padding: 20px;}
</style>
<script>
function check(){
    if($('#product_id').val()==''){
        alert('Chưa nhập ID sản phẩm');
        return false;
    }
    if($('#code_sp').val()==''){
        alert('Chưa nhập mã sản phẩm');
        return false;
    }
    return true;
}
</script>
<div class="form">
    <form  id ="frm" method="post" onsubmit="return check();">
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;">ID Sản phẩm</td>
                <td align="left" valign="top">
                    <label> 
                        <input type="text" id="product_id" name="data[product_id]" class="text-input">
                    </label>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top" style="width:150px;">Mã sản phẩm</td>
                <td align="left" valign="top">
                    <label> 
                        <input type="text" id="code_sp" name="data[code]" class="text-input">
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" style="width:150px;">Số lượng</td>
                <td align="left" valign="top">
                    <label> 
                        <input type="text" id="soluong" name="data[soluong]" class="text-input">
                    </label>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">Thao tác</td>
                <td align="left" valign="top"><label>
                        <input name="savesp" type="submit" value="Lưu sản phẩm">
                </label></td>
            </tr>
        </table> 
    </form> 
    
        <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="listsp">
            <tr style="font-weight: bold; text-align: center;">
                <td valign="top" style="width:150px;">Mã Sản phẩm</td>
                <td valign="top">Tên sản phẩm</td>
                <td valign="top">Số lượng</td>
                <td valign="top">Hình ảnh</td>
                <td valign="top">Thao tác</td>
            </tr>
            <?php foreach($data as $item){
                $product = Product::model()->find('id ="'.$item->product_id.'"');
                ?>
            <tr>
                <td align="left" valign="top" style="width:150px;"><?php echo $item->code;?></td>
                <td align="left" valign="top"><?php echo $product->title;?></td>
                <td align="left" valign="top"><?php echo $item->soluong;?></td>
                <td align="left" valign="top" style="text-align: center;"><img src="<?=  getURL().$product->image;?>" style="width: 40px;"></td>                
                <td style="text-align: center;">
                    <a title="Xóa mục này" href="<?=getURL().'admin/products/deleteProductCode?code='.$item->code;?>"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>                    
                </td>
            </tr>
            <?php }?>
        </table>
        <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
    
</div><!-- form -->