<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh sách thể loại video</p>
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
                                <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Tên thể loại video</a></th>                                
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
                            $albumCategory=$data[$i];
                        ?>
                        <tr>
                                <td align="center" valign="top"><?=$albumCategory['cat']->id;?></td>
                                <td align="left" valign="top"><a href='<?=getURL()."admin/videoCategories/view/".$albumCategory['cat']->id;?>'><?=$albumCategory['separator'].$albumCategory['cat']->name?></a></td>
                                <td align="left" valign="top"><?=$albumCategory['cat']->Parent['name'];?></td>
                                <td align="center" valign="top"><?=$albumCategory['cat']->getCountVideo();?></td>
                                <td align="center" valign="top"><?=$albumCategory['cat']->position;?></td>
                                <td align="center" valign="top">
                                        <a href="<?=getURL(1).'admin/videoCategories/updateStatus/'.$albumCategory['cat']->id?>"><?=($albumCategory['cat']->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></a>
                                </td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/videoCategories/delete/'.$albumCategory['cat']->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/videoCategories/edit/'.$albumCategory['cat']->id?>" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                    <a title="<?php echo ($albumCategory['cat']->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'admin/videoCategories/updateStatus/'.$albumCategory['cat']->id?>">
                                        <?php if($albumCategory['cat']->status==0){?>
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