<style>
    #listsp{ border-collapse: collapse;}
    #listsp td{ padding: 5px; border: 1px solid #ccc;}
    #table2 td{padding: 5px;}
</style>
<div class="form">
<?php 
$action = getURL().'admin/memberBuying/';
if(!isset($id))
    $action .='add';
else
    $action .='edit/'.$id;
?>
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm','action'=>$action));?>
	<table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
            <tr>
                <td align="left" valign="top" style="width:150px;">Mã Sản phẩm</td>
                <td align="left" valign="top">
                    <label> 
                        <input id="codesp" type="text" name="data[code]" class="text-input">
                    </label>
                </td>
            </tr> 
            <tr>
                <td align="left" valign="top" style="width:150px;">Số lượng</td>
                <td align="left" valign="top">
                    <label> 
                        <input type="text" name="data[sl]" class="text-input">
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
<?php $this->endWidget(); ?>   
    
    
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="listsp">
            <tr style="font-weight: bold; text-align: center;">
                <td valign="top" style="width:150px;">Mã Sản phẩm</td>
                <td valign="top">Tên sản phẩm</td>
                <td valign="top">Hình ảnh</td>
                <td valign="top">Số lượng</td>
                <td valign="top">Điểm bán</td>
                <td valign="top">Điểm HT</td>
                <td valign="top">Điểm KM</td>
                <td valign="top">Thao tác</td>
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
                <td align="left" valign="top" style="width:150px;"><input type="text" id="namesp<?php echo $key;?>" value="<?php echo $item['code'];?>"></td>
                <td align="left" valign="top"><?php echo $product->title;?></td>
                <td align="left" valign="top" style="text-align: center;"><img src="<?=  getURL().$product->image;?>" style="width: 40px;"></td>
                <td align="left" valign="top"><input type="text" id="slsp<?php echo $key;?>" value="<?php echo $item['sl'];?>"></td>
                <td align="left" valign="top"><?php echo $product->price.' điểm';?></td>
                <td align="left" valign="top"><?php echo $diem_ht.' điểm';?></td>
                <td align="left" valign="top"><?php echo $diem_km.' điểm';?></td>
                <td style="text-align: center;">
                    <a title="Xóa mục này" href="<?=getURL().'admin/memberBuying/deleteSP?masp='.$key.'&&madh='.$id;?>"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                    <a title="Sửa mục này" onclick="window.location='<?=getURL().'admin/memberBuying/editSP?id='.$key;?>&&name='+$('#namesp<?php echo $key;?>').val()+'&&sl='+$('#slsp<?php echo $key;?>').val()+'&&action=<?php echo Yii::app()->controller->action->id;?>&&id_dh=<?php echo $id;?>';return false;" href="#"  ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                </td>
            </tr>
            <?php }?>
            <tr style="color:red;">
                <td>Tổng</td>
                <td colspan="3"></td>
                <td align="right" class="price"><?php echo $total.' điểm';?></td>
                <td align="right" class="price"><?php echo $sodiem.' điểm';?></td>
                <td align="right" class="price"><?php echo $sodiem_km.' điểm';?></td>
                <td align="center"></td>
            </tr>
        </table> 
    <?php
        $member_name = '';
        $ngay='';
        $msg_status='';
        if(isset($donhang)){
            $ngay = date('m-d-Y',  strtotime($donhang->created));
            $member = Member::model()->findByPk($donhang->member_id);
            $member_name = $member->name;
            $msg_status = $donhang->msg_status;
        }
    ?>
    <form id="frm2" method="post" action="<?php echo ($id=='')?getURL().'admin/memberBuying/createDH':getURL().'admin/memberBuying/saveDH/'.$id;?>">
            <table width="949" border="0" cellspacing="1" cellpadding="0" id="table2" style='margin-top:30px;'>
                <tr>
                    <td align="left" valign="top" style="width:150px;">Tên đăng nhập :</td>
                    <td align="left" valign="top">
                        <label> 
                            <input type="text" name="donhang[member_name]" value ="<?php echo $member_name;?>" class="text-input" style="width:300px;">
                        </label>
                    </td>
                </tr> 
                <tr>
                    <td align="left" valign="top" style="width:150px;">Ngày làm đơn</td>
                    <td align="left" valign="top">
                        <label> 
                            <input type="text" name="donhang[created]" value ="<?php echo $ngay;?>" class="text-input" style="width:300px;"> (dd-mm-yyyy)
                        </label>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="width:150px;">Trạng thái đơn hàng :</td>
                    <td align="left" valign="top">
                        <label> 
                            <input type="text" name="donhang[msg_status]" value ="<?php echo $msg_status;?>" class="text-input">
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
<input type="hidden" id="checkcode">
<script>
    $(function(){
        $('#codesp').blur(function(){
            $.post('<?php echo getURL().'admin/memberBuying/checkCode';?>', {'code':$('#codesp').val()}, function(data){
                $('#checkcode').val(data);
                
            }); 
        });
        $('#frm').submit(function(){            
            if($('#checkcode').val()!='1'){
                    alert('Mã sản phẩm không tồn tại');
                    return false;
                }
                else 
                    return true;
        });
    });
</script>