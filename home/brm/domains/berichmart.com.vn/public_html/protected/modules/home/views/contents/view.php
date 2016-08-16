<div class="tieudetintuc">
        <div class="title-news"><?php echo $data[0]['title'] ?></div>
      </div>
	  <div class="cleaner"></div>
	  <div class="cottintuc">
	   <div class="ndtintuc">
		<?php echo $data[0]['content']; ?>
		<div class="cleaner"></div>
			<div class="tieudetintuc">
          <h2>Các tin khác:</h2>
        </div>
        <div id="linklk" class="other-news">
          <ul>
			<?php for($i=0;$i<10;$i++){
				if($other[$i]['id']!=null){
				?>
            <li><a href="view?id=<?php echo $other[$i]['id'];?>"><?php echo $other[$i]['title']; ?></a></li>
			<?php } } ?>
          </ul>
          <div class="readmore"><a href="index?catid=<?php echo $data[0]['category_id'];?>">Xem thêm</a></div>
        </div>
	   </div>
	  </div>