<div class="top-main"><p>sua member</p></div><!--.top-main--> <!--LUU Ý:TÊN CỦA VIEW PHẢI TRÙNG VS TÊN Ở CONTROLLER -->

<div class="middle-main"> 
<form method="post">
    <input type="hidden" name='Member[id]' value="<?php echo $model['id']; ?>">
   Ho ten <input type="text" name ="Member[name]" value="<?php echo $model['name']; ?>">
   ma nguoi gioi thieu <input type="text" name ="Member[parents]" value="<?php echo $model['parents']; ?>">
 <!--  <select name ="Member[parents]">
       <?php foreach($data as $member){?>
       <option value="<?php echo $member['id'];?>">
           <?php 
           if($member['level']>1)
               for($i=1;$i<$member['level'];$i++)
                    echo '--';
           echo $member['name'];?>
       </option>
       <?php } ?>
   </select> -->
   <input type="submit" value='sua'>
</form>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->