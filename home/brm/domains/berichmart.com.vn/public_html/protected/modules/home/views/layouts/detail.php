<?php $this->beginContent('/layouts/wraper',array('layout'=>'detail')); ?>
<div class="content detailProductPage">
    <div class="wrap-content">
      <div class="content-left">
        <?php         
        echo $content;?>
      </div>
      <?php 
        $this->renderPartial('/layouts/content_right_detail');
        ?>      
    </div>
    <div class="clear"></div>
</div>
<?php $this->endContent(); ?>