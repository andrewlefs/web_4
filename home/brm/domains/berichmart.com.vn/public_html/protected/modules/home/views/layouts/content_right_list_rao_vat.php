<div class="content-right">
<div class="list-tinraomoi">
    <ul>
        <?php foreach($this->freshnews as $news){?>
        <li>HN:<a href="<?php echo getURL().'rao-vat-'.$news->id.'/'.$news->alias.'.html';?>"><?php echo $news->title;?></a></li>   
        <?php } ?>
    </ul>
</div>
<div class="adv"><a href=""><img src="<?php echo Yii::app()->controller->module->registerImage('qc2.jpg')?>" alt="" /></a> </div>
</div>
<!--Content right--> 