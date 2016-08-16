<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh sách sự kiện</p>
    <a href="<?=getURL().'admin/events/add';?>" class="add">
    <span ></span>
    Thêm sự kiện mới
    </a>
</div><!--.top-main-->

<div class="middle-main">
        <form id="frm" name="frm" method="post" action="">
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></th>
                                <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Tên sự kiện</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Ảnh đại diện</a></th>                                
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $event){?>
                        <tr>
                                <td align="center" valign="top"><?=$event->id;?></td>
                                <td align="left" valign="top"><a href='<?=getURL()."admin/events/view/".$event->id;?>'><?=$event->name?></a></td>
                                <td align="left" valign="top"><img src="<?=  getURL().$event->image;?>" style="width:40px;"></td>                                
                                <td align="center" valign="top">
                                        <a href="<?=getURL(1).'admin/events/updateStatus/'.$event->id?>"><?=($event->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></a>
                                </td>
                                <td align="center" valign="top">
                                    <a title="thêm video/bài hát cho sự kiện này" href="<?=getURL().'admin/videos/add?event_id='.$event->id?>" ><img src="<?php echo getURL().'images/admin/add-icon.png';?>"></a>
                                    <a title="Xóa mục này" href="<?=getURL().'admin/events/delete/'.$event->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/events/edit/'.$event->id?>" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                    <a title="<?php echo ($event->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'admin/events/updateStatus/'.$event->id?>">
                                        <?php if($event->status==0){?>
                                            <img src="<?php echo getURL().'images/admin/Play-icon.png';?>">
                                        <?php } else { ?>
                                            <img src="<?php echo getURL().'images/admin/success-icon.png';?>">
                                        <?php } ?>
                                    </a>
                                    <a title="Danh sách video / bài hát thuộc sự kiện này" href="<?=getURL().'admin/videos/getVideoList?event_id='.$event->id?>" ><img src="<?php echo getURL().'images/admin/list.png';?>"></a>
                                </td>
                        </tr>
                        <?php } ?>
                </table>				
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>           
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->