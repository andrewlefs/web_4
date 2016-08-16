<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh sách album</p>
    <a href="<?=getURL().'admin/albums/add';?>" title="Thêm album" class="add">
    <span ></span>
    Thêm album mới
    </a>
</div><!--.top-main-->

<div class="middle-main">
        <form id="frm" name="frm" method="post" action="">
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></th>
                                <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Tên album</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Ảnh album</a></th>
                                <th align="center" valign="top" scope="col"><a href="#">Số lượng video/bài hát</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Nghệ sĩ</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Thể loại album</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $album){?>
                        <tr>
                                <td align="center" valign="top"><?=$album->id;?></td>
                                <td align="left" valign="top"><a href='<?=getURL()."admin/albums/view/".$album->id;?>'><?=$album->name?></a></td>
                                <td align="left" valign="top"><img src="<?=  getURL().$album->image;?>" style="width:40px;"></td>
                                <td align="center" valign="top"><?php echo $album->getCountVideo();?></td>
                                <td align="left" valign="top"><?php echo $album->getSingersLabel();?></td>
                                <td align="left" valign="top"><?php echo $album->getALbumCatsLabel(); ?></td>
                                <td align="center" valign="top">
                                        <a href="<?=getURL(1).'admin/albums/updateStatus/'.$album->id?>"><?=($album->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></a>
                                </td>
                                <td align="center" valign="top">
                                    <a title="thêm video/bài hát cho album này" href="<?=getURL().'admin/videos/add?album_id='.$album->id?>" ><img src="<?php echo getURL().'images/admin/add-icon.png';?>"></a>
                                    <a title="Xóa mục này" href="<?=getURL().'admin/albums/delete/'.$album->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/albums/edit/'.$album->id?>" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                    <a title="<?php echo ($album->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'admin/albums/updateStatus/'.$album->id?>">
                                        <?php if($album->status==0){?>
                                            <img src="<?php echo getURL().'images/admin/Play-icon.png';?>">
                                        <?php } else { ?>
                                            <img src="<?php echo getURL().'images/admin/success-icon.png';?>">
                                        <?php } ?>
                                    </a>
                                    <a title="Danh sách video / bài hát thuộc album này" href="<?=getURL().'admin/videos/getVideoList?album_id='.$album->id?>" ><img src="<?php echo getURL().'images/admin/list.png';?>"></a>
                                </td>
                        </tr>
                        <?php } ?>
                </table>				
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>           
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->