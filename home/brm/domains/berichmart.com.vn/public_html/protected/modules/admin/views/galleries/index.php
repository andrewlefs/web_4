<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Thư viện ảnh</p>
    <a href="<?=getURL().'admin/galleries/add';?>" class="add">
    <span ></span>
    Thêm mới
    </a>
</div><!--.top-main--> <!--LUU Ý:TÊN CỦA VIEW PHẢI TRÙNG VS TÊN Ở CONTROLLER -->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Name</a></th>
                                 <th align="left" valign="top" scope="col"><a href="#">images</a></th>
                                 
                                   <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">link</a></th>
                                   
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $gallery){?>
                        <tr>
                                <td align="center" valign="top"><?=$gallery->id;?></td>
                                <td align="left" valign="top"><a href='<?=  getURL()."admin/galleries/view/".$gallery->id?>'><?=$gallery->name;?></a></td>
                                <td align="left" valign="top"><img src="<?=  getURL().$gallery->images;?>" style="width:40px;"></td>
                                 
                                   <td align="left" valign="top"><?=$gallery->link;?></td>
                                    
                                <td align="center" valign="top">
                                        <a href="<?=getURL(1).'admin/galleries/updateStatus/'.$gallery->id?>"><?=($gallery->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></a>
                                </td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/galleries/delete/'.$gallery->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/galleries/edit/'.$gallery->id?>" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                    <a title="<?php echo ($gallery->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'admin/galleries/updateStatus/'.$gallery->id?>">
                                        <?php if($gallery->status==0){?>
                                            <img src="<?php echo getURL().'images/admin/Play-icon.png';?>">
                                        <?php } else { ?>
                                            <img src="<?php echo getURL().'images/admin/success-icon.png';?>">
                                        <?php } ?>
                                    </a>
                                </td>
                        </tr>
                        <?php } ?>
                </table>				
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->