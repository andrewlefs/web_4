<?php $this->beginContent('/layouts/wraper',array('layout'=>'listproduct','layout2'=>'list')); ?>
<div class="content list-products">
    <div class="wrap-content">      
      <?php 
        $this->renderPartial('/layouts/content_left_listproduct');
        ?>     
        <div class="content-right">          
        <?php  
        $this->renderPartial('/layouts/slide_logo_list');
        echo $content;?>
      </div>
    </div>
    <div class="clear"></div>
</div>
<?php $this->endContent(); ?>