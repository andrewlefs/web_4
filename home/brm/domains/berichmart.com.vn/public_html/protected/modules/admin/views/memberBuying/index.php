<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh sách đơn hàng</p>
</div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã đơn</a></th>
                                <th align="center" valign="top" scope="col" style="width:160px;"><a href="#">Tổng tiền</a></th>
                                <th align="center" valign="top" scope="col" style="width:180px;"><a href="#">Người mua</a></th>
                                 <th align="center" valign="top" scope="col" style="width:180px;"><a href="#">Người nhận</a></th>
                                <th align="center" valign="top"> Ngày làm đơn</th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $item){
                            $personbuy = !empty($item['personbuy'])?unserialize($item['personbuy']):'';
                            $personget = !empty($item['personget'])?unserialize($item['personget']):'';?>
                        <tr>
                                <td align="center" valign="top"><?=$item->id;?></td>
                                <td align="left" valign="top"><?php echo number_format($item->total).' đ';?></td>
                                <td align="left" valign="top"><?php echo  !empty($personbuy)?$personbuy['fullname']:'';?></td>
                               <td align="left" valign="top"><?php echo  !empty($personget)?$personget['fullname']:'';?></td>
                               <td><?php echo date('d/m/Y',  strtotime($item->created));?></td>
                                <td align="center" valign="top">
                                        <a href="<?=getURL(1).'admin/memberBuying/updateStatus/'.$item->id?>"><?=($item->status==0)?'Chưa xử lý':'Đã xử lý';?></a>
                                </td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/memberBuying/delete/'.$item->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>                                    
                                    <a title="<?php echo ($item->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'admin/memberBuying/updateStatus/'.$item->id?>">
                                        <?php if($item->status==0){?>
                                            <img src="<?php echo getURL().'images/admin/Play-icon.png';?>">
                                        <?php } else { ?>
                                            <img src="<?php echo getURL().'images/admin/success-icon.png';?>">
                                        <?php } ?>
                                    </a>
                                    <a href="<?=getURL(1).'admin/memberBuying/view/'.$item->id?>">Chi tiết</a>
                                </td>
                        </tr>
                        <?php } ?>
                </table>				
               <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>    
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->