 <!--Slide logo-->        
<div id="slide-logo">
    <ul id="home-manufacturers" class="jcarousel-skin-tango-logo" style="width:2000px !important;">
       
         <?php $data = Banner::model()->findAll('status=1 and position="logo"  order by t.stt asc')?>
          <?php foreach($data as $banner){?>
    <li>
        
      <a href="<?php echo getURL().$banner->link;?>">
                  <div class="product-image-wrapper">
                 
                 <img class="img-product-thumb" src="<?php echo getURL().$banner->images?>" alt="Cadino" />
                
               
            </div>
      </a>
    </li>
    <?php } ?>
    </ul>
</div>
<!--Slidelogo-->