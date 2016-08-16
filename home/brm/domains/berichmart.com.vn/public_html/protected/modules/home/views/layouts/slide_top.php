<div class="top">
    <div class="slide">
    <div id="bigPic"> 
        <?php $data =  Gallery::model()->findAll('status=1')?>
        <?php  $y=1;
        foreach($data as $gallery){?>
        <a href="<?php echo getURL().$gallery->link ;?>">
            <img src="<?php echo getURL().$gallery->images?>" alt="" <?php if($y>1){echo "style='display:none'";} $y++; ?> />
        </a>
        <?php
         }
        ?>
      
    </div>
    <ul id="thumbs">
        <?php 
      $count= count($data);
      for($x=1;$x<=$count;$x++)
      {
         ?>
        <li <?php if($x==1) echo "class='active'";?> rel='<?php echo $x;?>'></li>    
     <?php    
      }
        ?>
    </ul>
    </div>
    <div class="hot-products box-common">
    <div class="title-box">Sản phẩm <span class="orange">nổi bật</span></div>
    <ul id="mycarousel" class="jcarousel-skin-tango">
        <?php $productfamous = Product::model()->findAll('famous=1 and status = 1 order by id desc');
        foreach($productfamous as $pro){
        ?>
        <li>
            <a href="<?php echo getURL().'view-'.$pro->id.'/'.$pro->alias.'.html';?>">
                <div class="product-image-wrapper"><img class="img-product-thumb" src="<?php echo getURL().$pro->image;?>" alt="<?php echo $pro->title;?>" /></div>
                <p class="title-center"><?php echo substring($pro->title,45);?></p>
            </a>
            <div class="price content-center"><?php  echo number_format($pro->price_sell);?> VNĐ</div>
            <div class="content-center">
                <a href="<?php echo getURL().'add-'.$pro->id.'/'.$pro->alias.'.html'?>" class="addtocart"><span class="point">(<?php echo $pro->bonus;?>đ)</span><img src="<?php echo Yii::app()->controller->module->registerImage('cart-icon2.png')?>" alt="" /></a>
            </div>
        </li>
        <?php }?>
    </ul>
    </div>
    <div class="clear"></div>
</div>