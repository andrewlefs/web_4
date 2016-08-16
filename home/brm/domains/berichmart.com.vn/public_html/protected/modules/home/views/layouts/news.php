<?php $this->beginContent('/layouts/wraper',array('layout'=>'content')); 
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/style-news.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-1.6.js.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/javascript.js');
?>
 <?php $this->renderPartial('/news/menu_news'); ?>
    <div id="content" class="width960">
      <div class="left_content">          
        <?php         
        echo $content;?>
      </div>      
        <?php $this->renderPartial('/news/sidebar_right_home'); ?>
    
</div>
    <div class="clear"></div>
<?php $this->endContent(); ?>