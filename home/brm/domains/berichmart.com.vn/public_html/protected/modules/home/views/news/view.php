<div class="tieudetintuc">
<div class="title-news"><?php echo $news->title;?></div>
</div>
<div class="cottintuc">
    <div class="ndtintuc tiny"> 
    <span><?php echo $news->content;?> </span> 
    </div>
    <br />
    

<div class="cleaner"></div>
<div class="tieudetintuc">
    <h2>Các tin khác:</h2>
</div>
<div id="linklk" class="other-news">
    <ul>
    <?php foreach($othernews as $news){?>
    <li><a href="<?php echo getURL().'tin-tuc-'.$news->id.'/'.$news->alias.'.html';?>"><?php echo $news->title;?></a></li>
    <?php } ?>
    </ul>
    <div class="readmore"><a href="">Xem thêm</a></div>
</div>
</div>
<!--cot--> 