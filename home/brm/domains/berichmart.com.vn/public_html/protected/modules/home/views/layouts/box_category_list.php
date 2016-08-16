<div class="box-category">
    <ul>
    <?php
        if(strtolower(Yii::app()->controller->id) != 'adnews'){
            foreach ($list as $list2){
            $list3 = Category::model()->findAll(array('condition'=>'parent_id='.$list2->id,'order'=>'t.order asc'));
            if(!empty($list3)){
            ?>
            <li class="root"><a href="<?php echo getURL().'cat'.'-'.$list2->id.'/'.$list2->alias;?>" class="cat-name"><?php echo $list2->name;?>&nbsp;<img src="<?php echo Yii::app()->controller->module->registerImage('icon_arrow_down.gif');?>" alt="" /></a>
                <div class="sub-category" style="display:none;"> 
                    <?php foreach ($list3 as $cat3){?>
                    <a href="<?php echo getURL().'cat'.'-'.$cat3->id.'/'.$cat3->alias;?>"><?php echo $cat3->name;?></a>    
                    <?php } ?>
                </div>
            </li>
            <?php } else { ?>
            <li><a href="<?php echo getURL().'cat'.'-'.$list2->id.'/'.$list2->alias;?>" class="cat-name"><?php echo $list2->name;?></a></li>
    <?php }}} else {?>
            <?php
           foreach ($list as $list2){
            $list3 = Category::model()->findAll(array('condition'=>'parent_id='.$list2->id,'order'=>'t.order asc'));
            if(!empty($list3)){
            ?>
            <li class="root"><a href="<?php echo getURL().'rao-vat-cat'.'-'.$list2->id.'/'.$list2->alias;?>" class="cat-name"><?php echo $list2->name;?>&nbsp;<img src="<?php echo Yii::app()->controller->module->registerImage('icon_arrow_down.gif');?>" alt="" /></a>
                <div class="sub-category" style="display:none;"> 
                    <?php foreach ($list3 as $cat3){?>
                    <a href="<?php echo getURL().'rao-vat-cat'.'-'.$cat3->id.'/'.$cat3->alias;?>"><?php echo $cat3->name;?></a>    
                    <?php } ?>
                </div>
            </li>
            <?php } else { ?>
            <li><a href="<?php echo getURL().'rao-vat-cat'.'-'.$list2->id.'/'.$list2->alias;?>" class="cat-name"><?php echo $list2->name;?></a></li> 
      <?php }}} ?>      
    </ul>
</div>