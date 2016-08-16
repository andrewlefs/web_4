<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Tìm kiếm</p>
</div><!--.top-main-->
<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form class="frm" name="frm" method="post" action="">
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                            <td>Tiêu đề tin :</td>
                            <td><input type="text" name="title" id="title" style="width: 250px;"></td>   
                            <td>Danh mục :</td>
                            <td>
                                <select name="category_id" id="category_id" style="width: 250px;">
                                    <option value="">Tất cả</option>
                                    <?php foreach($treecat as $key=>$value){?>
                                    <option value="<?echo $key;?>"><?echo $value;?></option>
                                    <?php }?>
                                </select>
                            </td>  
                        </tr>
                        <tr>
                            <td colspan="4"><input type="button" value="Tìm kiếm" onclick="window.location.href='<?php echo getURL();?>admin/news/search?title='+$('#title').val()+'&&category_id='+$('#category_id').val();"></td>
                        </tr>
                </table>	
        </form>
        <div class="cleare-fix"></div>
</div><!--.middle-main-->
<div class="bottom-main"></div><!--.middle-main-->

<div class="top-main" style="float: left; margin-top: 20px;">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Tin tức</p>
    <a href="<?=getURL().'admin/news/add';?>" class="add">
    <span ></span>
    Thêm mới
    </a>
</div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></th>
                                <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Tên sản phẩm</a></th>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Ảnh</a></th>
                                 <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Danh mục</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $news){?>
                        <tr>
                                <td align="center" valign="top"><?=$news->id;?></td>
                                <td align="left" valign="top">
                                    <a href="<?=getURL().'admin/news/view/'.$news->id;?>"><?=$news->title;?></a></td>
                                <td align="left" valign="top"><img src="<?=  getURL().$news->image;?>" style="width: 40px;"></td>
                               <td align="left" valign="top"><?=$news['Category']['name'];?></td>
                                <td align="center" valign="top">
                                        <a href="<?=getURL(1).'admin/news/updateStatus/'.$news->id?>"><?=($news->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></a>
                                </td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/news/delete/'.$news->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/news/edit/'.$news->id?>" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                    <a title="<?php echo ($news->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'admin/news/updateStatus/'.$news->id?>">
                                        <?php if($news->status==0){?>
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