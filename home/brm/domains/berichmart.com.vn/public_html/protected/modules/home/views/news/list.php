<style>
    ul.yiiPager li{
        width: auto !important;
        height: auto !important;
        margin: 0px !important;
        padding: 0px !important;
    }
</style>
<script>
    $(function(){
        $('#content').addClass('list-news-page');
        $('.left_content').css('width','730px');
    });
</script>
<div class="tieudetintuc"><h1><?php echo $cat->name;?></h1></div>
<?php foreach($news as $news){?>
<div class="cottintuc">
    <div class="immg"><img src="<?php echo getURL().$news->image;?>" /></div>
    <div class="ndtintuc">
            <div class="tentintuc">
                <a href="<?php echo getURL().'tin-tuc-'.$news->id.'/'.$news->alias.'.html';?>">
                    <b><?php echo $news->title;?></b>
                </a>
            </div>
            <span><?php echo $news->introduction;?></span>   
</div><!--nđ tin tuc-->            
</div><!--cot-->
<?php } ?>
<div class="clear"></div>
<div class="paging" style="margin-top:15px;">
    <!-- <a href="">Trước</a><a href="">1</a><a class="current" href="">2</a><a href="">3</a><a href="">4</a><a href="">5</a><a href="">6</a><a href="">7</a><a href="">8</a><a href="">9</a><a href="">10</a><a href="">Sau</a> -->
    <?php $this->widget("CLinkPager",array('pages'=>$pages,'nextPageLabel'=>'Sau','prevPageLabel'=>'Trước','firstPageLabel'=>"Đầu tiên",'lastPageLabel'=>'Cuối cùng','header'=>'','footer'=>''));?> 
</div>
