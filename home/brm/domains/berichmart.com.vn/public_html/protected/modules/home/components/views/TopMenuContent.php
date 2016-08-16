<?php
switch(date('D')){
	case Mon:$thu="Th&#7913; hai";break;
	case Tue:$thu="Th&#7913; ba";break;
	case Wed:$thu="Th&#7913; t&#432;";break;
	case Thu:$thu="Th&#7913; n&#259;m";break;
	case Fri:$thu="Th&#7913; s&#225;u";break;
	case Sat:$thu="Th&#7913; b&#7849;y";break;
	case Sun:$thu="Ch&#7911; nh&#7853;t";break;
}
?>
<div class="navmenu" >
        	<ul class="width960">
            	<li class="current"><a href="#" title="Trang nhất">Trang nhất</a></li>
                <li><a href="#" title="Giớ thiệu">Giới thiệu</a></li>
                <li><a href="#" title="Tin tức khuyễn mãi">Tin tức khuyễn mãi</a></li>
                <li><a href="#" title="Lịch sự kiện">Lịch sự kiện</a></li>
                <li><a href="#" title="Sản phẩm & dịch vụ">Sản phẩm & Dịch vụ</a></li>
                <li><a href="#" title="Kiến thức kinh doanh">Kiến thức kinh doanh</a></li>
                <li><a href="#" title="Đời sống">Đời sống</a></li>
                <li><a href="#" title="Xã hội">Xã hội</a></li>
            </ul>
  </div><!--navmenu-->
  <div class="bottomnavmenu">
   		<div class="width960 stv">
   		<div  id="ngaythang"><?php echo date('g:i A');?> <?php echo $thu;?>, ngày <?php echo date('d');?> tháng <?php echo date('m');?> năm <?php echo date('Y');?></div>
        <div id="serch">
<form action="Search" method="post">
<input type="text"  name="name" /><input type="image" src="/images/serch.png" style="width:39px">
</form>
</div>
        <div id="sothanhvien"> Tổng số thành viên:<b style="color:#F00;"><?php echo $num; ?></b></div>
        
        </div>
   </div>