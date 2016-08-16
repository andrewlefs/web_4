<style>
    ul.yiiPager li{
        width: auto !important;
        height: auto !important;
        margin: 0px !important;
        padding: 0px !important;
    }
</style>
<div class="paging">
    <!-- <a href="">Trước</a><a href="">1</a><a href="" class="current">2</a><a href="">3</a><a href="">4</a><a href="">5</a><a href="">6</a><a href="">7</a><a href="">8</a><a href="">9</a><a href="">10</a><a href="">Sau</a> -->
    <?php $this->widget("CLinkPager",array('pages'=>$pages,'nextPageLabel'=>'Sau','prevPageLabel'=>'Trước','firstPageLabel'=>"Đầu tiên",'lastPageLabel'=>'Cuối cùng','header'=>'','footer'=>''));?> 
</div><!--Paging-->
<div class="box-common list-products">
    <div class="title-box"><?php echo $this->cat->name;?> <span class="orange">nhiều người xem</span></div>
    <ul>
    <?php foreach($products as $product){ ?>
    <li><a href="<?php echo getUrl().'view-'.$product->id.'/'.$product->alias.'.html';?>">
            <div class="product-image-wrapper"><img  class="img-product-thumb" src="<?php echo getURL().$product->image;?>" alt="<?php echo $product->title;?>" /></div>
            <p class="title-center"><?php echo substring($product->title,45);?></p>
        </a>
        <div class="price content-center"><?php echo number_format($product->price_sell);?> VNĐ</div>
        <div class="content-center">
            <a href="<?php echo getURL().'add-'.$product->id.'/'.$product->alias.'.html'?>" class="addtocart"><span class="point">(<?php echo $product->bonus;?>đ)</span><img src="<?php echo Yii::app()->controller->module->registerImage('cart-icon2.png')?>" alt="" /></a>
        </div>
    </li>
    <?php } ?>
    </ul>    
</div>
<div class="paging" style="margin-top: 20px;">        
       <?php $this->widget("CLinkPager",array('pages'=>$pages,'nextPageLabel'=>'Sau','prevPageLabel'=>'Trước','firstPageLabel'=>"Đầu tiên",'lastPageLabel'=>'Cuối cùng','header'=>'','footer'=>''));?>
</div>