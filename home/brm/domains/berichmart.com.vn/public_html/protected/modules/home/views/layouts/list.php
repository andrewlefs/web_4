<?php $this->beginContent('/layouts/wraper',array('layout'=>'list')); ?>
<div class="content detailProductPage categoryPage">
    <div class="wrap-content">
      <div class="content-left">          
        <?php         
        echo $content;?>
      </div>
      <?php 
        $this->renderPartial('/layouts/content_right_list');
        ?>      
    </div>
    <div class="clear"></div>
</div>
<?php $this->endContent(); ?>