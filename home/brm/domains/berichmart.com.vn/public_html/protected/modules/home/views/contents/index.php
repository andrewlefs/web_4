<div class="tieudetintuc"><h1><?php echo $name[0]['name']; ?></h1></div>
<div class="cottintuc">
	<?php foreach($data as $value){ ?>
     <div class="cottintuc">
          <div class="immg"><img src="<?php echo Yii::app()->request->baseUrl.'/'.$value['image']; ?>" /></div>
          <div class="ndtintuc">
          <div class="tentintuc"><a href="view?id=<?php echo $value['id'];?>"><b><?php echo $value['title']; ?></b></a></div>
          <span><?php echo $value['introduction']; ?> </span>   
          </div><!--nd tin tuc-->
          </div><!--cot-->
		 <?php } ?>
</div>