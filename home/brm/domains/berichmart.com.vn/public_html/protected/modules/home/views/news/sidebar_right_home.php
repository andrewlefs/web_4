<style>
    .linklk ul li:last-child{
        border-bottom:none !important;
    } 
</style>
<div id="right_content">
    <?php if(Yii::app()->controller->action->id=='cooperation'){?>
    <div class="cotright ">
        <div class="tieuderight cot1">Cơ hội hợp tác</div>
        <div id="linklk" class="linklk">
                <ul>
                    <?php 
                    $listcatbook = Category::model()->findAll('parent_id = 400 order by t.order asc');
                    foreach($listcatbook as $cat){
                    ?>
                    <li><a href="<?php echo getURL().'hop-tac-'.$cat->id.'/'.$cat->alias.'.html';?>"><?php echo $cat->name;?></a></li>
                    <?php } ?>
                </ul>
            </div>   
    </div><!--cotright-->
    <?php } else {?>
    <div class="cotright ">
        <div class="tieuderight cot1">Danh mục sách</div>
        <div id="linklk" class="linklk">
                <ul>
                    <?php 
                    $listcatbook = Category::model()->findAll('parent_id = 374 order by t.order asc');
                    foreach($listcatbook as $cat){
                    ?>
                    <li><a href="<?php echo getURL().'tin-tuc-cat-'.$cat->id.'/'.$cat->alias.'.html';?>"><?php echo $cat->name;?></a></li>
                    <?php } ?>
                </ul>
            </div>   
    </div><!--cotright-->
        <div class="cotright ">
        <div class="tieuderight cot1">Tài liệu kĩ năng</div>
        <div id="linklk" class="linklk">
                <ul>
                    <?php 
                    $listcatbook = Category::model()->findAll('parent_id = 377 order by t.order asc');
                    foreach($listcatbook as $cat){
                    ?>
                    <li><a href="<?php echo getURL().'tin-tuc-cat-'.$cat->id.'/'.$cat->alias.'.html';?>"><?php echo $cat->name;?></a></li>
                    <?php } ?>
                </ul>
            </div>   
    </div><!--cotright-->
    <div class="cotright">
        <div class="tieuderight">Thông tin từ BeRichMart</div>
        <div class="noidungright">
            <?php $listnews = News::model()->findAll('category_id=388 order by id desc limit 3');
            foreach($listnews as $news){
            ?>
            <div class="tintuc"><a href="<?php echo getURL().'tin-tuc-'.$news->id.'/'.$news->alias.'.html';?>"><?php echo $news->title;?></a><div><?php echo $news->introduction;?></div></div>
            <?php } ?>
            <div class="xemthem"><a href="<?php echo getURL().'tin-tuc-cat-388/thong-tin-tu-berichmart.html';?>">Xem thêm</a></div>
        </div>
    </div><!--cotright-->
    <?php }?>
    <div class="quangcao"><img src="<?php echo getURL(); ?>images/quang cao.png" /></div>
</div><!--rightcontent-->