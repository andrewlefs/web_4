<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-ProductOption.png';?>">
    <p>Trường thông số
    <select id="se_cat" style="float: right; padding: 5px 0px; margin-top: -4px;" onchange="window.location='<?php echo getURL().'admin/ProductOptions/search/';?>'+ this.value;">
            <option value="">Tất cả</option>
            <?php foreach($listgroup as $key=>$value){?>
            <option value="<?echo $key;?>"><?echo $value;?></option>
            <?php }?>
        </select>
    </p>
    <a href="<?=getURL().'admin/ProductOptions/add';?>" class="add">
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
                                <th align="left" valign="top" scope="col" ><a href="#">Tên trường</a></th>
                                <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Nhóm sản phẩm</a></th>
                                <th align="left" valign="top" scope="col" style="width:100px;"><a href="#">Tìm kiếm</a></th>
                                <th align="left" valign="top" scope="col" style="width:100px;"><a href="#">Kiểu nhập liệu</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $pro_op){?>
                        <tr>
                                <td align="center" valign="top"><?=$pro_op->id;?></td>
                                <td align="left" valign="top"><a href='#'><?=$pro_op->name?></a></td>
                                <td align="left" valign="top"><?=$pro_op['GroupProduct']['name'];?></td>
                                <td align="left" valign="top"><?php echo ($pro_op->issearch==0)?'Không':'Có';?></td>
                                <td align="left" valign="top"><?=$pro_op->type?></td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/ProductOptions/delete/'.$pro_op->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/ProductOptions/edit/'.$pro_op->id?>"><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                                   
                                    
                                </td>
                        </tr>
                        <?php } ?>
                </table>				
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->