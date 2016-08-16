<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Nhà cung cấp</p>
    <a href="<?=getURL().'admin/Producers/add';?>" class="add">
    <span ></span>
    Thêm mới
    </a>
</div><!--.top-main--> <!--LUU Ý:TÊN CỦA VIEW PHẢI TRÙNG VS TÊN Ở CONTROLLER -->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

               <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></th>
                                <th align="left" valign="top" scope="col"><a href="#">Tên nhà cung cấp</a></th>
                                  <th align="left" valign="top" scope="col"><a href="#">Tên danh mục</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $producer){?>
                        <tr>
                                <td align="center" valign="top"><?=$producer->id;?></td>
                                <td align="left" valign="top"><a href='<?=  getURL()."admin/Producers/view/".$producer->id?>'><?=$producer->name;?></a></td>
                                <td align="left" valign="top"><?=$producer['GroupProduct']['name'];?></td>
                              
                                 
                                   
                              
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/Producers/delete/'.$producer->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/Producers/edit/'.$producer->id?>" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>                                    
                                </td>
                        </tr>
                        <?php } ?>
                </table>				
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>              
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->