<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh sách đơn hàng online</p>
</div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã đơn</a></th>
                                <th align="center" valign="top" scope="col" style="width:120px;"><a href="#">Tổng bán</a></th>
                                <th align="center" valign="top" scope="col" style="width:120px;"><a href="#">Tổng điểm HT</a></th>
                                <th align="center" valign="top" scope="col" style="width:120px;"><a href="#">Tổng điểm KM</a></th>                          
                                <th align="center" valign="top" scope="col" style="width:180px;"><a href="#">Người mua</a></th>
                                <th align="center" valign="top" scope="col" style="width:180px;"><a href="#">Người nhận</a></th>
                                <th align="center" valign="top"> Ngày làm đơn</th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $item){
                            $personbuy = Member::model()->findByPk($item['member_id']);
                            $personget = !empty($item['personget'])?unserialize($item['personget']):'';
                            $products = !empty($item['products'])?unserialize($item['products']):''; // pr($products); die;
                            $sodiem=$sodiem_km=0;
                            foreach ($products as $pro){
                                $sodiem += $pro['sl']*$pro['sodiem'];
                                $sodiem_km += $pro['sl']*$pro['sodiem_km'];
                            }
                            ?>
                        <tr>
                                <td align="center" valign="top"><?=$item->id;?></td>
                                <td align="right" valign="top"><?php echo $item->total.' Điểm';?></td>  
                                <td align="right" valign="top"><?php echo $sodiem.' Điểm';?></td> 
                                <td align="right" valign="top"><?php echo $sodiem_km.' Điểm';?></td>
                                <td align="left" valign="top"><?php echo  !empty($personbuy)?$personbuy->fullname:'';?></td>
                               <td align="left" valign="top"><?php echo  !empty($personget)?$personget['name']:'';?></td>
                               <td><?php echo date('d/m/Y',  strtotime($item->created));?></td>
                                <td align="center" valign="top">
                                        <?=$item->msg_status;?>
                                </td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/memberBuying/delete/'.$item->id.'?index=1';?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>                                    
                                    <a title="Sửa mục này" href="<?=getURL().'admin/memberBuying/editOnline/'.$item->id?>" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                    <a title="<?php echo ($item->status==0)?'Kích hoạt':'Ngừng kích hoạt';?>" href="<?=getURL().'admin/memberBuying/updateStatus/'.$item->id.'?index=1';?>">
                                        <?php if($item->status==0){?>
                                            <img src="<?php echo getURL().'images/admin/Play-icon.png';?>">
                                        <?php } else { ?>
                                            <img src="<?php echo getURL().'images/admin/success-icon.png';?>">
                                        <?php } ?>
                                    </a>
                                    <a href="<?=getURL(1).'admin/memberBuying/view/'.$item->id?>" title="Chi tiết"><img src="<?php echo getURL().'images/details-icon.png';?>"></a>
                                </td>
                        </tr>
                        <?php } ?>
                </table>				
               <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>    
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->