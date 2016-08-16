<div id="topleft">
<div id="slide">
    <div id="slide_top">
        <?php $i=1;foreach($slidenews as $news){?>
        <div id="<?php echo $i; $i++;?>" class="img">
            <img src="<?php echo getURL().$news->image;?>" /> <br />
            <div class="summary-hotnews">
                <a href="<?php echo getURL().'tin-tuc-'.$news->id.'/'.$news->alias.'.html';?>"><?php echo $news->title;?></a>
                <div><?php echo $news->introduction;?></div>                
            </div>            
        </div>   
        <?php } ?>
    </div><!--slide_top-->
    <div id="slide_bottom">
        <ul>
            <?php $i=1;foreach($slidenews as $news){?>
            <li><a title="#<?php echo $i; $i++;?>" <?php if($i==1) echo 'class="active"';?>><img src="<?php echo getURL().$news->image;?>" /></a></li>
            <?php } ?>
        </ul>
    </div><!--slide_bottom-->
</div><!--silde-->
<div id="rtopleft">
    <div id="tin">
        <?php if(isset($hotnews[0])){ ?>
        <div><a href="<?php echo getURL().'tin-tuc-'.$hotnews[0]->id.'/'.$hotnews[0]->alias.'.html';?>"><?php echo $hotnews[0]->title;?></a></div>
        <span><?php echo $hotnews[0]->introduction;?></span>
        <img  src="<?php echo getURL().$hotnews[0]->image;?>"/>
        <?php } ?>
    </div>
    <div class="cleaner"></div>
    <div id="linklk">
        <ul>
            <?php 
            $count = count($hotnews);
            if($count>1)
                for($i=1;$i<$count;$i++){?>
            <li><a href="<?php echo getURL().'tin-tuc-'.$hotnews[$i]->id.'/'.$hotnews[$i]->alias.'.html';?>"><img src="images/iconlink.png" /><?php echo $hotnews[$i]->title;?></a></li>
            <?php } ?>
        </ul>
    </div>
</div><!--rtopfleft-->
</div><!--toplefft-->
<div class="cleaner"></div>
<div id="bottomleft">
<div class="cot">
        <div class="tieude">
        <div class="ten">Tin tức khuyễn mại</div>
        <div class="them"><a href="<?php echo getURL().'tin-tuc-cat-368/tin-tuc-khuyen-mai.html';?>">Xem thêm</a></div>
    </div>
    <div class="noidung">
        <div class="leftnoidung">
            <?php if(isset($bonus_news[0])){?>
            <div class="imgnoidung"><a href="<?php echo getURL().'tin-tuc-'.$bonus_news[0]->id.'/'.$bonus_news[0]->alias.'.html';?>"><img src="<?php echo getURL().$bonus_news[0]->image;?>" /></a></div>
            <div class="chitiet">
                <div><a href="<?php echo getURL().'tin-tuc-'.$bonus_news[0]->id.'/'.$bonus_news[0]->alias.'.html';?>"><b><?php echo $bonus_news[0]->title;?></b></a></div>
                <span><?php echo $bonus_news[0]->introduction;?></span>
            </div>
            <?php } ?>
        </div>
        <div class="rightnoidung">
                <ul>
                 <?php for($i=1;$i<count($bonus_news);$i++)  {?> 
                <li><a href="<?php echo getURL().'tin-tuc-'.$bonus_news[$i]->id.'/'.$bonus_news[$i]->alias.'.html';?>"><?php echo $bonus_news[$i]->title;?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div><!--cot-->
<div class="cot">
        <div class="tieude">
        <div class="ten">Lịch sự kiện</div>
        <div class="them"><a href="<?php echo getURL().'tin-tuc-cat-369/lich-su-kien.html';?>">Xem thêm</a></div>
    </div>
    <div class="noidung">
        <div class="leftnoidung">
            <?php if(isset($even_news[0])){?>
            <div class="imgnoidung"><a href="<?php echo getURL().'tin-tuc-'.$even_news[0]->id.'/'.$even_news[0]->alias.'.html';?>"><img src="<?php echo getURL().$even_news[0]->image;?>" /></a></div>
            <div class="chitiet">
                <div><a href="<?php echo getURL().'tin-tuc-'.$even_news[0]->id.'/'.$even_news[0]->alias.'.html';?>"><b><?php echo $even_news[0]->title;?></b></a></div>
                <span><?php echo $even_news[0]->introduction;?></span>
            </div>
            <?php } ?>
        </div>
        <div class="rightnoidung">
                <ul>
                 <?php for($i=1;$i<count($even_news);$i++)  {?> 
                <li><a href="<?php echo getURL().'tin-tuc-'.$even_news[$i]->id.'/'.$even_news[$i]->alias.'.html';?>"><?php echo $even_news[$i]->title;?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div><!--cot-->
<div class="cot">
        <div class="tieude">
        <div class="ten">Sản phẩm & dịch vụ</div>
        <div class="them"><a href="<?php echo getURL().'tin-tuc-cat-370/san-pham-dich-vu.html';?>">Xem thêm</a></div>
    </div>
    <div class="noidung">
        <div class="leftnoidung">
            <?php if(isset($product_news[0])){?>
            <div class="imgnoidung"><a href="<?php echo getURL().'tin-tuc-'.$product_news[0]->id.'/'.$product_news[0]->alias.'.html';?>"><img src="<?php echo getURL().$product_news[0]->image;?>" /></a></div>
            <div class="chitiet">
                <div><a href="<?php echo getURL().'tin-tuc-'.$product_news[0]->id.'/'.$product_news[0]->alias.'.html';?>"><b><?php echo $product_news[0]->title;?></b></a></div>
                <span><?php echo $product_news[0]->introduction;?></span>
            </div>
            <?php } ?>
        </div>
        <div class="rightnoidung">
                <ul>
                 <?php for($i=1;$i<count($product_news);$i++)  {?> 
                <li><a href="<?php echo getURL().'tin-tuc-'.$product_news[$i]->id.'/'.$product_news[$i]->alias.'.html';?>"><?php echo $product_news[$i]->title;?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div><!--cot-->
<div class="cot">
        <div class="tieude">
        <div class="ten">Kiến thức kinh doanh</div>
        <div class="them"><a href="<?php echo getURL().'tin-tuc-cat-371/kien-thuc-kinh-doanh.html';?>">Xem thêm</a></div>
    </div>
    <div class="noidung">
        <div class="leftnoidung">
            <?php if(isset($business_news[0])){?>
            <div class="imgnoidung"><a href="<?php echo getURL().'tin-tuc-'.$business_news[0]->id.'/'.$business_news[0]->alias.'.html';?>"><img src="<?php echo getURL().$business_news[0]->image;?>" /></a></div>
            <div class="chitiet">
                <div><a href="<?php echo getURL().'tin-tuc-'.$business_news[0]->id.'/'.$business_news[0]->alias.'.html';?>"><b><?php echo $business_news[0]->title;?></b></a></div>
                <span><?php echo $business_news[0]->introduction;?></span>
            </div>
            <?php } ?>
        </div>
        <div class="rightnoidung">
                <ul>
                 <?php for($i=1;$i<count($business_news);$i++)  {?> 
                <li><a href="<?php echo getURL().'tin-tuc-'.$business_news[$i]->id.'/'.$business_news[$i]->alias.'.html';?>"><?php echo $business_news[$i]->title;?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div><!--cot-->
</div><!--bottomleft-->