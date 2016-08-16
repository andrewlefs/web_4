<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Sửa đơn hàng</p>
</div><!--.top-main-->
<div class="middle-main">
    <?php echo $this->renderPartial('_form',array('products'=>$products,'donhang'=>$donhang,'id'=>$id));?>   
    <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->