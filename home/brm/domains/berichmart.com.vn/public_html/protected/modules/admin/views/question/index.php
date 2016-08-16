<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Hỏi đáp</p>    
</div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                                <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></th>
                                <th align="left" valign="top" scope="col" ><a href="#">Tiêu đề</a></th>
                                <th align="left" valign="top" scope="col" style="width:100px;"><a href="#">Số lượt xem</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;"><a href="#">Ngày hỏi</a></th>
                                <th align="center" valign="top" scope="col" style="width:100px;">Thao tác</th>
                        </tr>
                        <?php foreach($data as $question){?>
                        <tr>
                                <td align="center" valign="top"><?=$question->id;?></td>
                                <td align="left" valign="top"><a href='<?=getURL()."admin/question/view/".$question->id;?>'><?=$question->title?></a></td>
                                <td align="left" valign="top"><?=$question->view;?></td>
                                <td align="center" valign="top">
                                        <a href='#'><?=($question->status==0)?'Chưa trả lời':'Đã trả lời';?></a>
                                </td>
                                <td><?php echo $question->created;?></td>
                                <td align="center" valign="top">
                                    <a title="Xóa mục này" href="<?=getURL().'admin/question/delete/'.$question->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                                    <a title="Sửa mục này" href="<?=getURL().'admin/question/answer/'.$question->id?>" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>                                    
                                </td>
                        </tr>
                        <?php } ?>
                </table>				
                <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>           
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->