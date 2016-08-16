
<div id="topleft">
<?php
echo Content::model()->slideContent(array(137,138));
echo Content::model()->loadContentNew();
?>
</div>
<div class="cleaner"></div>
 <div id="bottomleft">
 <?php
 echo Content::model()->loadContentCategory(257);
 echo Content::model()->loadContentCategory(257);
 ?>
 </div>
