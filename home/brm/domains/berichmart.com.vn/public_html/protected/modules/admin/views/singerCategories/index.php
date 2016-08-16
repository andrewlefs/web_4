<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh sách thể loại nghệ sĩ</p>
    <a href="<?=getURL().'admin/albumCategories/add';?>" class="add">
    <span ></span>
    Thêm mới
    </a>
</div><!--.top-main-->

<div class="middle-main">
        <form id="frm" name="frm" method="post" action="">
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></th>
                                <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Tên thể loại album</a></th>
                                <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Thể loại cha</a></th>
                                <th align="center" valign="top" scope="col"><a href="#">Số lượng video/bài hát</a></th>
                                <th align="center" valign="top" scope="col"><a href="#">vị trí</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php
                        $page =(isset($_GET['page']))?$_GET['page']:1;
                        $page--;
                        for($i=12*$page;$i<count($data)&&$i<(($page+1)*12);$i++){
                            $SingerCategory=$data[$i];
                        ?>
                        <tr>
                                <td align="center" valign="top"><?=$SingerCategory['cat']->id;?></td>
                                <td align="left" valign="top"><a href='<?=getURL()."admin/singerCategories/view/".$SingerCategory['cat']->id;?>'><?=$SingerCategory['separator'].$SingerCategory['cat']->name?></a></td>
                                <td align="left" valign="top"><?=$SingerCategory['cat']->Parent['name'];?></td>
                                <td align="center" valign="top"><?=$SingerCategory['cat']->getCountVideo();?></td>
                                <td align="center" valign="top"><?=$SingerCategory['cat']->position;?></td>
                                <td align="center" valign="top">
                                        <a href="<?=getURL(1).'admin/singerCategories/updateStatus/'.$SingerCategory['cat']->id?>"><?=($SingerCategory['cat']->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></a>
                                </td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/singerCategories/delete/'.$SingerCategory['cat']->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/singerCategories/edit/'.$SingerCategory['cat']->id?>" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                    <a title="<?php echo ($SingerCategory['cat']->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'admin/singerCategories/updateStatus/'.$SingerCategory['cat']->id?>">
                                        <?php if($SingerCategory['cat']->status==0){?>
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