<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Hỗ trợ trực tuyến</p>
    <a href="<?=getURL().'admin/helps/add';?>" class="add">
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
                                <th align="left" valign="top" scope="col"><a href="#">Email</a></th>
                                 <th align="left" valign="top" scope="col"><a href="#">Yahoo</a></th>
                                  <th align="left" valign="top" scope="col"><a href="#">Skype</a></th>
                                   <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Hotline</a></th>
                                    <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Sdt</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $help){?>
                        <tr>
                                <td align="center" valign="top"> <?=$help->id;?></td>
                                <td align="left" valign="top"><a href="<?=getURL().'admin/helps/view/'.$help->id;?>"><?=$help->email;?></a></td>
                                <td align="left" valign="top"><?=$help->yahoo;?></td>
                                  <td align="left" valign="top"><?=$help->skype;?></td>
                                   <td align="left" valign="top"><?=$help->hotline;?></td>
                                    <td align="left" valign="top"><?=$help->sdt;?></td>
                                <td align="center" valign="top">
                                        <a href="<?=getURL(1).'admin/helps/updateStatus/'.$help->id?>"><?=($help->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></a>
                                </td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/helps/delete/'.$help->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/helps/edit/'.$help->id?>"><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                    <a title="<?php echo ($help->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'admin/helps/updateStatus/'.$help->id?>">
                                        <?php if($help->status==0){?>
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