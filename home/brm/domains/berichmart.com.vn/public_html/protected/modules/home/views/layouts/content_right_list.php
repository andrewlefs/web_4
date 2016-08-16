<div class="content-right">
    <div class="adv"> 
      
         <?php $data = Banner::model()->findAll('status=1 and position="right"  order by t.stt asc')?>
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
</div>
<!--Content right--> 