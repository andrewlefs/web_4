<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Banner</p>
    <a href="<?=getURL().'admin/banners/add';?>" class="add">
    <span ></span>
    Thêm mới
    </a>
</div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

                <!-- <div class="information"><div id="flashMessage" class="message">Không được hiển thị</div></div> -->
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></th>
                                <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Tên</a></th>
                                <th align="left" valign="top" scope="col"><a href ="#">Ảnh</a></th>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">stt</a></th>
                                <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Link</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $banner){?>
                        <tr>
                                <td align="center" valign="top"><?=$banner->id;?></td>
                                <td align="left" valign="top"><a href="<?=getURL().'admin/banners/view/'.$banner->id;?>"><?=$banner->name;?></a></td>
                                <td align="left" valign="top"><img src="<?=  getURL().$banner->images;?>" style="width:40px;"></td>
                                <td align="center" valign="top"><?=$banner->stt;?></td>
                                <td align="left" valign="top"><?=$banner->link;?></td>
                               
                                <td align="center" valign="top">
                                        <a href="<?=getURL(1).'admin/banners/updateStatus/'.$banner->id?>"><?=($banner->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></a>
                                </td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/banners/delete/'.$banner->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/banners/edit/'.$banner->id?>" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                    <a title="<?php echo ($banner->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'admin/banners/updateStatus/'.$banner->id?>">
                                        <?php if($banner->status==0){?>
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