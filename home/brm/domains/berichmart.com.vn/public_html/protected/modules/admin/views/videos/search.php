<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Tìm kiếm video - bài hát</p>
    <a href="#" class="edit" onclick="$('#frm').submit(); return false;">
    <span ></span>
    Tìm kiếm
    </a>
</div><!--.top-main-->
<div class="middle-main">
    <?php echo $this->renderPartial('_frmsearch', array('Video'=>$Video,'Video_category'=>$Video_category,'singer_category'=>$singer_category,'albums'=>$albums,'subjects'=>$subjects,'events'=>$events));?>   
    <div class="cleare-fix"></div>    
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->