<div class="tieudetintuc">
<div class="title-news"><?php echo $news->title;?></div>
</div>
<div class="cottintuc">
    <div class="ndtintuc tiny"> 
    <span><?php echo $news->content;?> </span> 
    </div>
    <br />
    

<div class="cleaner"></div>
<?php if(!empty($othernews)){?>
<div class="tieudetintuc">
    <h2>Các tin khác:</h2>
</div>
<div id="linklk" class="other-news">
    <ul>
    <?php foreach($othernews as $news){?>
    <li><a href="<?php echo getURL().'tin-tuc-view-'.$news->category_id.'/'.$news->alias.'.html';?>"><?php echo $news->title;?></a></li>
    <?php } ?>
    </ul>
    <div class="readmore"><a href=""></a></div>
</div>
<?php } ?>
</div>
<!--cot--> 