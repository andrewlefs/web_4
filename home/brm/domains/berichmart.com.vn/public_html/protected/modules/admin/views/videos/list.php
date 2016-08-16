<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh sách video 
        <?php if(!empty($event)) echo 'thuộc sự kiện : '.$event->name;?>
        <?php if(!empty($album)) echo 'thuộc album : '.$album->name;?>
    </p>
    <a href="<?=getURL().'admin/videos/add';?>" class="add">
    <span ></span>
    Thêm video - bài hát mới 
    </a>
</div><!--.top-main-->

<div class="middle-main">
        <form id="frm" name="frm" method="post" action="">
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></th>
                                <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Tên video</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Thể loại video</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Thể loại nghệ sĩ</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Nghệ sĩ</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Chủ đề</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Album</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $video){?>
                        <tr>
                                <td align="center" valign="top"><?=$video->id;?></td>
                                <td align="left" valign="top"><a href='<?=getURL()."admin/videos/view/".$video->id;?>'><?=$video->name?></a></td>
                                <td align="left" valign="top"><?=$video->getVideoCatsLabel();?></td>
                                <td align="left" valign="top"><?php echo $video->getSingerCatsLabel();?></td>
                                <td align="left" valign="top"><?php echo $video->getSingersLabel(); ?></td>
                                <td align="left" valign="top"><?php echo $video->getSubjectsLabel(); ?></td>
                                <td align="left" valign="top"><?php echo $video->Album['name']; ?></td>
                                <td align="center" valign="top">
                                        <a href="<?=getURL(1).'admin/videos/updateStatus/'.$video->id?>"><?=($video->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></a>
                                </td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/videos/delete/'.$video->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/videos/edit/'.$video->id?>" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                    <a title="<?php echo ($video->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'admin/videos/updateStatus/'.$video->id?>">
                                        <?php if($video->status==0){?>
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