<div class="content-left"> 
        <!--Menu Left-->
        <div class="left-cat">
          <ul class="lv1">
           <?php
             $stt=1; foreach($this->listCat as $cat){ ?>
            <li class="lv1 alias<?php echo $stt; $stt++;?>"><a  href="<?php echo getURL().'cat'.'-'.$cat->id.'/'.$cat->alias;?>"><?php echo $cat->name;?>
              <div class="arrow-selected"></div>
              </a>
                <div class="category-detail" style="top:-17px;background:url(<?php echo getURL().$cat->image;?>) right top no-repeat;">
                <div class="content-category">
                  <ul style="width:320px;">
                    <?php $listcat2 = Category::model()->findAll(array('condition'=>'parent_id = '.$cat->id,'order'=>'t.order asc'));
                    foreach($listcat2 as $list2){?>
                    <li><b><?php echo $list2->name;?></b>
                      <ul>
                        <?php $listcat3 = Category::model()->findAll(array('condition'=>'parent_id = '.$list2->id,'order'=>'t.order asc'));
                        foreach($listcat3 as $list3){?>
                          <li><a href="<?php echo getURL().'cat'.'-'.$list3->id.'/'.$list3->alias;?>"><?php echo $list3->name;?></a></li>
                        <?php }?>
                      </ul>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </li> 
            <?php } ?>
          </ul>
        </div>
        
        <!--Menu Left End-->
        
        <div class="hot-shop box-common">
          <div class="title-box">Thông tin<span class="orange">BerichMart</span></div>
          <ul>
             <?php $listnews = News::model()->findAll('category_id=388 order by id desc limit 3');
            foreach($listnews as $news){
            ?>
            <li> <a href="<?php echo getURL().'tin-tuc-cat-388/thong-tin-tu-berichmart.html';?>"><?php echo $news->title;?></a><br />
              <span class="summary"><?php echo $news->introduction;?></span> </li>
            <?php } ?>
          </ul>
          <a href="<?php echo getURL().'tin-tuc-cat-388/thong-tin-tu-berichmart.html';?>" class="view-all">Xem hết</a>
        </div>
         <?php $data = Banner::model()->findAll('status=1 and position="left" ')?>
        <div class="adv-left">
            
             <?php 
        foreach($data as $banner){?>
        <a href="<?php echo getURL().$banner->link ;?>">
            <img src="<?php echo getURL().$banner->images?>" alt="" />
            
        </a> 
        
        <?php
         }
        ?>
     
        </div>
      </div>