<div class="content-right">
<div class="box-common related-products">
    <?php $data= Product::model()->findAll(' producer_id = "'.$this->product->producer_id.'" limit 9' ); ?>
    <div class="title-box">Cùng hãng sản xuất</div>
    <ul>
          <?php 
        foreach($data as $product)
        {
            ?>
    <li>
        <div class="img">
      
             <img src="<?php echo getURL().$product->image?>" alt="<?php echo $product->title;?>" />
       
        </div>
       
        <div class="clear">
       
            <a href="<?php echo getURL().'view-'.$product->id.'/'.$product->alias.'.html';?>"><br>
            <?php echo substring($product->title,45);?></a></a>
       
        </div>
        
        <div class="price"><?php echo number_format($product->price_sell);?> VNĐ </div>
   
       
    </li>
      <?php
        }
        ?>
    </ul>
</div>
<!--BoxCommon-->

<div class="box-common related-products">
     <?php $data= Product::model()->findAll('price_sell = "'.$this->product->price_sell.'" limit 6' ); ?>
    <div class="title-box">Sản phẩm cùng giá bán</div>
    <ul>
         <?php 
        foreach($data as $product)
        {
            ?>
         <li>
        <div class="img">
       
             <img src="<?php echo getURL().$product->image?>" alt="<?php echo $product->title;?>" />
       
        </div>
       
        <div class="clear">
       
            <a href="<?php echo getURL().'view-'.$product->id.'/'.$product->alias.'.html';?>"><br>
            <?php echo substring($product->title,45);?></a></a>
       
        </div>
        
        <div class="price"><?php echo number_format($product->price_sell);?> VNĐ </div>
   
    </li>
   
          <?php
        }
        ?>
   
    </ul>
</div>
<!--BoxCommon-->
 <?php $data = Banner::model()->findAll('status=1 and position="right" ')?>
        <div class="adv">
            
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
<!--Content right--> 