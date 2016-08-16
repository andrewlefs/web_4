<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh sách nghệ sĩ</p>
    <a href="<?=getURL().'admin/singers/add';?>" class="add">
    <span ></span>
    Thêm mới
    </a>
</div><!--.top-main-->

<div class="middle-main"> <?php $place=array('VN'=>'Việt Nam','AM'=>'Âu Mỹ','CA'=>'Châu Á');?>
        <form id="frm" name="frm" method="post" action="">
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></th>
                                <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Tên nghệ sĩ</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Ảnh nghệ sĩ</a></th>
                                <th align="center" valign="top" scope="col"><a href="#">Số lượng album</a></th>
                                <th align="center" valign="top" scope="col"><a href="#">Số lượng video/bài hát</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Nơi sống</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $singer){?>
                        <tr>
                                <td align="center" valign="top"><?=$singer->id;?></td>
                                <td align="left" valign="top"><a href='<?=getURL()."admin/singers/view/".$singer->id;?>'><?=$singer->name?></a></td>
                                <td align="left" valign="top"><img src="<?=  getURL().$singer->image;?>" style="width:40px;"></td>
                                <td align="center" valign="top"><?=$singer->getCountAlbum();?></td>
                                <td align="center" valign="top"><?=$singer->getCountVideo();?></td>
                                <td align="left" valign="top"><?=$place[$singer->place];?></td>
                                <td align="center" valign="top">
                                        <a href="<?=getURL(1).'admin/singers/updateStatus/'.$singer->id?>"><?=($singer->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></a>
                                </td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/singers/delete/'.$singer->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/singers/edit/'.$singer->id?>" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                    <a title="<?php echo ($singer->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'admin/singers/updateStatus/'.$singer->id?>">
                                        <?php if($singer->status==0){?>
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