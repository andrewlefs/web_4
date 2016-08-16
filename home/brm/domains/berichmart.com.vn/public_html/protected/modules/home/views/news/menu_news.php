<?php
switch(date('D')){
	case 'Mon':$thu="Th&#7913; hai";break;
	case 'Tue':$thu="Th&#7913; ba";break;
	case 'Wed':$thu="Th&#7913; t&#432;";break;
	case 'Thu':$thu="Th&#7913; n&#259;m";break;
	case 'Fri':$thu="Th&#7913; s&#225;u";break;
	case 'Sat':$thu="Th&#7913; b&#7849;y";break;
	case 'Sun':$thu="Ch&#7911; nh&#7853;t";break;
}
?>
<div class="navmenu width960" >
            <ul class="width960">
            <li class="current"><a href="<?php echo getURL();?>tin-tuc" title="Trang nhất">Trang nhất</a></li>
            <li><a href="<?php echo getURL();?>gioi-thieu" title="Giớ thiệu">Giới thiệu</a></li>
            <li><a href="<?php echo getURL();?>tin-tuc-cat-368/tin-tuc-khuyen-mai" title="Tin tức khuyễn mãi">Tin tức khuyễn mãi</a></li>
            <li><a href="<?php echo getURL();?>tin-tuc-cat-369/lich-su-kien" title="Lịch sự kiện">Lịch sự kiện</a></li>
            <li><a href="<?php echo getURL();?>tin-tuc-cat-370/san-pham-dich-vu" title="Sản phẩm & dịch vụ">Sản phẩm & Dịch vụ</a></li>
            <li><a href="<?php echo getURL();?>tin-tuc-cat-371/kien-thuc-kinh-doanh" title="Kiến thức kinh doanh">Kiến thức kinh doanh</a></li>
            <li><a href="<?php echo getURL();?>tin-tuc-cat-372/doi-song" title="Đời sống">Đời sống</a></li>
            <li><a href="<?php echo getURL();?>tin-tuc-cat-373/xa-hoi" title="Xã hội">Xã hội</a></li>
        </ul>
</div><!--navmenu-->
<div class="bottomnavmenu width960">
            <div class="width960 stv">
            <div  id="ngaythang"> 
                <?php echo date('g:i A');?> <?php echo $thu;?>, ngày <?php echo date('d');?> tháng <?php echo date('m');?> năm <?php echo date('Y');?>
            </div>
    <div id="serch">
        <form method="post" action="<?php echo getURL().'home/news/search' ?>" id="frm_search">
            <input type="text"  name="key" /><a href="#" onclick="$('#frm_search').submit(); return false;"><img src="<?php echo getURL();?>images/serch.png" alt="" /></a>
        </form>
    </div>
    <div id="sothanhvien"> Tổng số thành viên:<b style="color:#F00;"><?php echo Yii::app()->db->createCommand('select count(*) from members')->queryScalar();?></b></div>

    </div>
</div><!--bottomnavmenu-->