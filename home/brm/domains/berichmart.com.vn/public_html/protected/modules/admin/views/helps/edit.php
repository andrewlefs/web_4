<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Sửa hotline</p>
    <a href="#" class="edit" onclick="$('#frm').submit(); return false;">
    <span ></span>
    Lưu
    </a>
</div><!--.top-main-->
<div class="middle-main">
    <?php echo $this->renderPartial('_form', array('help'=>$help));?>
    <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->