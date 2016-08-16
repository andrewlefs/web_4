<style>
    .content-right .box-right{
        max-height: none;
    }
</style>
<div class="box-right box-common">
    <div class="title-box">Sản phẩm <span class="orange">khuyến mãi</span></div>
    <ul id="mycarousel-km" class="jcarousel-skin-tango-km">
    <?php foreach($productreduce as $pro){?>
        <li><a href="<?php echo getURL().'view-'.$pro->id.'/'.$pro->alias.'.html';?>">
        <div class="product-image-wrapper">
            <img  class="img-product-thumb" src="<?php echo getURL().$pro->image;?>" alt="<?php echo $pro->title;?>" />
        </div>
        <p class="title-center"><?php echo substring($pro->title,45);?></p>
        </a>
        <div class="price content-center"><?php  echo number_format($pro->price_sell);?> VNĐ</div>
        <div class="content-center">
            <a href="<?php echo getURL().'add-'.$pro->id.'/'.$pro->alias.'.html'?>" class="addtocart"><span class="point">(<?php echo $pro->bonus;?>đ)</span><img src="<?php echo Yii::app()->controller->module->registerImage('cart-icon2.png')?>" alt="" /></a>
        </div>
    </li>    
    <?php } ?>
    </ul>
</div><!--Box sp khuyen mai-->
<?php
foreach($categorylist as $category){
    $subcatid = Category::model()->getListId($category->id);
    $products = Product::model()->findAll('category_id IN(' . implode(',',$subcatid) . ') order by t.id desc limit 4');
    ?>
<div class="box-right box-common">
    <div class="title-box"><?php echo $category->name;?> <a href="<?php echo getURL().'cat-'.$category->id.'/'.$category->alias;?>" class="view-all">Xem tất cả</a></div>
    <ul>
    <?php
    foreach($products as $pro){?>   
    <li><a href="<?php echo getURL().'view-'.$pro->id.'/'.$pro->alias.'.html';?>">
        <div class="product-image-wrapper"><img  class="img-product-thumb" src="<?php echo getURL().$pro->image;?>" alt="<?php echo $pro->title;?>" /></div>
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
<?php } ?>
<div class="box-right box-common" style="height:auto;">
    <div class="title-box">Sản phẩm được xem nhiều nhất <a href="" class="view-all"></a></div>
    <ul>
    <?php
    foreach($productviews as $pro){?>   
    <li><a href="<?php echo getURL().'view-'.$pro->id.'/'.$pro->alias.'.html';?>">
            <div class="product-image-wrapper"><img  class="img-product-thumb" src="<?php echo getURL().$pro->image;?>" alt="<?php echo $pro->title;?>" /></div>
            <p class="title-center"><?php echo substring($pro->title,45);?></p>
        </a>
        <div class="price content-center"><?php echo number_format($pro->price_sell);?> VNĐ</div>
        <div class="content-center">
            <a href="<?php echo getURL().'add-'.$pro->id.'/'.$pro->alias.'.html'?>" class="addtocart"><span class="point">(<?php echo $pro->bonus;?>đ)</span><img src="<?php echo Yii::app()->controller->module->registerImage('cart-icon2.png')?>" alt="" /></a>
        </div>
    </li>    
    <?php }?>
    </ul>
</div>