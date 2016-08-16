<?php $this->beginContent('/layouts/wraper'); ?>
<div class="content member-page">
    <div class="wrap-content">
      <?php 
        $this->renderPartial('/layouts/sidebar_left_account');
        ?>
        <div class="content-right" style="min-height:none;">
        <?php         
        echo $content;?>
      </div>
    </div>
    <div class="clear"></div>
</div>
<?php $this->endContent(); ?>