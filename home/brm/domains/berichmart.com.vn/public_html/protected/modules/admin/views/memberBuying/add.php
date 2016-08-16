<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Thêm đơn hàng</p>
</div><!--.top-main-->
<div class="middle-main">
    <?php echo $this->renderPartial('_form',array('products'=>$products));?>   
    <div class="cleare-fix"></div>    
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->