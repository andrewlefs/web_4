<div class="top-main" style="float: left; margin-top: 20px;">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh sách sản phẩm đã sửa số lượng</p>
</div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">STT</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Mã sản phẩm</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Số lượng</a></th>
                                 <th align="center" valign="top" scope="col" style="width:150px;"><a href="#">Ngày sửa</a></th>
                                <th align="center" valign="top" scope="col"><a href="#">Chú thích</a></th>
                        </tr>
                        <?php foreach($data as $pro){ ?>
                        <tr>
                                <td align="center" valign="top"><?=$pro->id;?></td>
                                <td align="left" valign="top"><?=$pro->product_code;?></td>
                                <td align="left" valign="top"><?=$pro->soluong;?></td>
                                <td align="left" valign="top"><?php echo date('d/m/Y H:i:s',  strtotime($pro->created));?></td>
                                <td align="left" valign="top"><?php echo $pro->note;?></td>
                        </tr>
                        <?php } ?>
                </table>				
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->