<?php $this->beginContent('/layouts/wraper',array('layout'=>'listproduct','layout2'=>'listlastraovat')); ?>
<div class="content list-products">
    <div class="wrap-content">      
      <?php 
        $this->renderPartial('/layouts/content_left_listlast_raovat');
        ?>     
        <div class="content-right">          
        <?php
        echo $content;?>
      </div>
    </div>
    <div class="clear"></div>
</div>
<?php $this->endContent(); ?>