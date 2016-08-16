<?php $this->beginContent('/layouts/wraper',array('layout'=>'detail_rao_vat','layout2'=>'detail_rao_vat')); ?>
<div class="content detailProductPage categoryPage chitiet-raovat">
    <div class="wrap-content">
      <div class="content-left">          
        <?php         
        echo $content;?>
      </div>
      <?php 
        $this->renderPartial('/layouts/content_right_detail_rao_vat');
        ?>      
    </div>
    <div class="clear"></div>
</div>
<?php $this->endContent(); ?>