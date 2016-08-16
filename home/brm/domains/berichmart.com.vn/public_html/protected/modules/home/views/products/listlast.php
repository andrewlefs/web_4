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
<div class="box-right box-common">
    <div class="title-box">
        <span class="view-style">Xem: &nbsp;
            <a href="<?php echo getURL().'catl-'.$this->cat->id.'/'.$this->cat->alias.'.html'?>">
                <img src="<?php echo Yii::app()->controller->module->registerImage('icon_view_list_off.gif')?>" alt="" />
            </a>&nbsp;
            <a href="<?php echo getURL().'cat-'.$this->cat->id.'/'.$this->cat->alias.'.html'?>">
                <img src="<?php echo Yii::app()->controller->module->registerImage('icon_view_thumbnail_on.gif')?>" alt="" /> 
            </a>
        </span>
        <?php echo $this->cat->name;?> 
        <span class="orange">
            mới cập nhật
        </span>
        <a href="" class="view-all">Xem tất cả</a>
    </div>
    <?php if(Yii::app()->controller->action->id=='listlast'){?>
    <!-- hien thi kieu thu nhat mac dinh -->
    <ul>
     <?php foreach($products as $product){ ?>   
    <li><a href="<?php echo getUrl().'view-'.$product->id.'/'.$product->alias.'.html';?>">
            <div class="product-image-wrapper"><img  class="img-product-thumb" src="<?php echo getURL().$product->image;?>" alt="<?php echo $product->title;?>" /></div>
            <p class="title-center""><?php echo substring($product->title,45);?></p>
        </a>        
        <div class="price content-center"><?php echo number_format($product->price_sell);?> VNĐ</div>
        <div class="content-center">
            <a href="<?php echo getURL().'add-'.$product->id.'/'.$product->alias.'.html'?>" class="addtocart"><span class="point">( <?php echo $product->bonus;?>đ )</span><img src="<?php echo Yii::app()->controller->module->registerImage('cart-icon2.png')?>" alt="" /></a>
        </div>
    </li>
     <?php } ?>
    </ul>
    <?php } else { ?>
    <table class="table-list-products" cellspacing="0" cellpadding="0">
         	<thead>
            <tr>
                <td colspan="2"><a href=""><img src="<?php echo Yii::app()->controller->module->registerImage('ssgia.png')?>" alt="" /></a></td>
                <td>Tên sản phẩm<br /><a href=""><img src="<?php echo Yii::app()->controller->module->registerImage('sortdesc.gif')?>" alt=""  /></a>&nbsp;<a href=""><img src="<?php echo Yii::app()->controller->module->registerImage('sortasc.gif')?>" alt=""  /></a></td>
                <td>Giá bán thấp nhất<br /><a href=""><img src="<?php echo Yii::app()->controller->module->registerImage('sortdesc.gi')?>f" alt=""  /></a>&nbsp;<a href=""><img src="<?php echo Yii::app()->controller->module->registerImage('sortasc.gif')?>" alt=""  /></a></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach($products as $product){ ?> 
            <tr>
            	<td class="check"><input type="checkbox" name=""  /></td>
                <td class="image">
                    <a href="<?php echo getUrl().'view-'.$product->id.'/'.$product->alias.'.html';?>">
                        <img src="<?php echo getURL().$product->image;?>" alt="<?php echo $product->title;?>" style=" max-height: 140px; max-width: 140px;" /></a>
                    <br /><a href=""><?php echo $product->title;?>
                    </a>
                </td>
                <td class="info">
                    <div class="full-name">
                        <a href=""<?php echo getUrl().'view-'.$product->id.'/'.$product->alias.'.html';?>">
                           <!-- Asus X42F-VX121 (K42F-1AVX) (Intel Core i3-370M 2.4GHz, 2GB RAM, 320GB HDD, VGA Intel HD Graphics, 14 inch, ,PC DOS)-->
                           <?php echo $product->title;?>
                        </a>
                    </div>
                    <div class="summary">
                        Hãng sản xuất: <?php echo $product['Producer']['name'];?> / Màu sắc: <?php echo $product->color;?> / Xuất xứ : <?php echo $product->origin;?>
                    </div>
                </td>
                <td class="price"><span class="price"><?php echo number_format($product->price_sell);?> VNĐ</span><br /><b>Trong kho: <?php echo $product->quantity;?></b><br /><a href="<?php echo getURL().'add-'.$product->id.'/'.$product->alias.'.html'?>"><img src="<?php echo Yii::app()->controller->module->registerImage('buy.png')?>" alt="" /></a></td>
            </tr>
            <?php }?>
            </tbody>
         </table>
    <?php } ?>     
</div><!--Box right-->
<div class="paging" style="margin-top:15px;">
    <!-- <a href="">Trước</a><a href="">1</a><a href="" class="current">2</a><a href="">3</a><a href="">4</a><a href="">5</a><a href="">6</a><a href="">7</a><a href="">8</a><a href="">9</a><a href="">10</a><a href="">Sau</a> -->
    <?php $this->widget("CLinkPager",array('pages'=>$pages,'nextPageLabel'=>'Sau','prevPageLabel'=>'Trước','firstPageLabel'=>"Đầu tiên",'lastPageLabel'=>'Cuối cùng','header'=>'','footer'=>''));?> 
</div><!--Paging-->