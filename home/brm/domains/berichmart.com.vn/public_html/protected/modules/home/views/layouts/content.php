<?php $this->beginContent('/layouts/wraper',array('layout'=>'content')); 
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/style-news.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-1.6.js.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/javascript.js');
?>
	<?php $this->widget('TopMenuContent'); ?>
    <div id="content" class="width960">
      <div class="left_content" style="float:left;overflow: hidden;">          
        <?php         
        echo $content;?>
      </div>
      <div id="right_content">
			<?php $this->widget('RightMenuContent'); ?>
			<div class="quangcao"><img src="/images/quangcao.png" /></div>
	</div>    
    
</div>
    <div class="clear"></div>
<?php $this->endContent(); ?>