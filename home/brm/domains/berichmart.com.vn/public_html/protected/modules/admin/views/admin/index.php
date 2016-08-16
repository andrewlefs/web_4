<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh sách sản phẩm được xem nhiều nhất</p>
</div><!--.top-main-->

<div class="middle-main"> 
        <form id="frm" name="frm" method="post" action="">

                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></th>
                                <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Tên sản phẩm</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Danh mục</a></th>
                                 <th align="left" valign="top" scope="col"><a href="#">Nhà sản xuất</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Hình ảnh</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Số lượt view</a></th>
                        </tr>
                        <?php foreach($data as $pro){?>
                        <tr>
                                <td align="center" valign="top"><?=$pro->id;?></td>
                                <td align="left" valign="top"><a target="_blank" href="<?=getURL().'view-'.$pro->id.'/'.$pro->alias.'.html';?>"><?=$pro->title;?></a></td>
                                <td align="left" valign="top"><?=$pro['Category']['name'];?></td>
                                 <td align="left" valign="top"><?=$pro['Producer']['name'];?></td>
                                
                              
                                <td align="left" valign="top"><img src="<?=  getURL().$pro->image;?>" style="width: 40px;"></td>
                                <td align="center" valign="top">
                                        <?php echo $pro->view;?>
                                </td>
                        </tr>
                        <?php } ?>
                </table>				
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->