<style>
    .button2 {
        background: url("../images/bg-button-green.gif") repeat-x scroll left top #459300 !important;
        border: 1px solid #459300 !important;
        border-radius: 4px 4px 4px 4px;
        color: #FFFFFF !important;
        cursor: pointer;
        display: inline-block;
        font-family: Verdana,Arial,sans-serif;
        font-size: 11px !important;
        padding: 4px 7px !important;
        height: auto;
        font-weight: normal;
        line-height: 11px;
        text-shadow: none;
    }
</style>
<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
    <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>    
    <table class="table-member" border="0" cellspacing="0" style="margin-top: 0px;">
        <thead>
            <tr><td colspan="4">Danh sách tin rao vặt</td><td colspan="2" align="center"><a class="button2" href="<?=getURL().'member/adNews/add';?>">Thêm mới</a></td></tr>
        <tr>
            <td align="center" valign="top" scope="col" style="width:40px;"><a href="#">Mã</a></td>
            <td align="left" valign="top" scope="col" style="width:auto;"><a href="#">Tiêu đề tin rao vặt</a></td>
            <td align="center" valign="top" scope="col" style="width:40px;"><a href="#">Ảnh</a></td>
            <td align="center" valign="top" scope="col" style="width:66px"><a href="#">Danh mục</a></td>
            <td align="center" valign="top" scope="col" style="width:66px;"><a href="#">Trạng thái</a></td>
            <td align="center" valign="top" scope="col" style="width:55px;"><a href="#">Thao tác</a></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $news){?>
            <tr>
                <td align="center" valign="middle"><?=$news->id;?></td>
                <td align="left" valign="middle">
                    <a href="<?=getURL().'rao-vat-'.$news->id.'/'.$news->alias;?>"><?=$news->title;?></a></td>
                <td align="left" valign="middle"><img src="<?=  getURL().$news->image;?>" style="width: 40px; height: auto;"></td>
                <td align="left" valign="middle"><?=$news['Category']['name'];?></td>
                <td align="center" valign="middle">
                        <a href="<?=getURL(1).'member/adNews/updateStatus/'.$news->id?>"><?=($news->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></a>
                </td>
                <td align="center" valign="middle">
                    <a title="Xóa mục này" href="<?=getURL().'member/adNews/delete/'.$news->id?>" onclick="return confirm(&#039;Bạn chắc chắn muốn xóa ?&#039;);"><img src="<?php echo getURL().'images/admin/cross.png';?>"></a>
                    <a title="Sửa mục này" href="<?=getURL().'member/adNews/edit/'.$news->id?>"><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>
                    <a title="<?php echo ($news->status==0)?'Hiện mục này':'Không hiện mục này';?>" href="<?=getURL().'member/adNews/updateStatus/'.$news->id?>">
                        <?php if($news->status==0){?>
                            <img src="<?php echo getURL().'images/admin/Play-icon.png';?>">
                        <?php } else { ?>
                            <img src="<?php echo getURL().'images/admin/success-icon.png';?>">
                        <?php } ?>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
    </table>  
    <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>    
</div>