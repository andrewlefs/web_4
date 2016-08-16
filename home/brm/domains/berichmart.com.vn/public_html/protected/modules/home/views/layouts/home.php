<?php $this->beginContent('/layouts/wraper',array('layout'=>'home')); ?>
<div class="content">
    <div class="wrap-content">
      <?php 
        $this->renderPartial('/layouts/content_left_home');
        ?>
      <div class="content-right">
        <?php 
        $this->renderPartial('/layouts/slide_top');
        echo $content;?>
      </div>
    </div>
    <div class="clear"></div>
</div>
<?php $this->endContent(); ?>