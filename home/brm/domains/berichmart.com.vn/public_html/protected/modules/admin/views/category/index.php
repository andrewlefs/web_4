<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh mục
    <select id="se_cat" style="float: right; padding: 5px 0px; margin-top: -4px;" onchange="window.location='<?php echo getURL().'admin/category/search/';?>'+ this.value;">
            <option value="">Tất cả</option>
            <?php foreach($treecat as $key=>$value){?>
            <option value="<?echo $key;?>"><?echo $value;?></option>
            <?php }?>
        </select>
    </p>
    <a href="<?=getURL().'admin/category/add';?>" class="add">
    <span ></span>
    Thêm mới
    </a>
</div><!--.top-main-->

<div class="middle-main"> 
        <form id="frm" name="frm" method="post" action="">
                <!-- <div class="information"><div id="flashMessage" class="message">Không được hiển thị</div></div> -->
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></th>
                                <th align="left" valign="top" scope="col" ><a href="#">Tên</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Danh mục cha</a></th>
                                <th align="left" valign="top" scope="col" style="width:50px;"><a href="#">Thứ tự SX</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php 
                        $page =(isset($_GET['page']))?$_GET['page']:1;
                        $page--;
                        for($i=12*$page;$i<count($data)&&$i<(($page+1)*12);$i++){
                            $cat=$data[$i];
                            ?>
                        <tr>
                                <td align="center" valign="top"><?=$cat['cat']->id;?></td>
                                <td align="left" valign="top"><a href='<?=getURL()."admin/category/view/".$cat['cat']->id;?>'><?=$cat['separator'].$cat['cat']->name?></a></td>
                                <td align="left" valign="top"><?=$cat['cat']['Parent']['name'];?></td>
                                <td align="left" valign="top"><?=$cat['cat']->order;?></td>
                                <td align="center" valign="top">
                                        <a href="<?=getURL().'admin/category/updateStatus/'.$cat['cat']->id?>"><?=($cat['cat']->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></a>
                                </td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/category/delete/'.$cat['cat']->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/category/edit/'.$cat['cat']->id?>"><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                   
                                    <a title="<?php echo ($cat['cat']->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'admin/category/updateStatus/'.$cat['cat']->id?>">
                                        <?php if($cat['cat']->status==0){?>
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