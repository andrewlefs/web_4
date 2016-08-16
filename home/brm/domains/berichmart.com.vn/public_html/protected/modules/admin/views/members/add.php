
<div class="top-main"><p>them member</p></div><!--.top-main--> <!--LUU Ý:TÊN CỦA VIEW PHẢI TRÙNG VS TÊN Ở CONTROLLER -->

<div class="middle-main"> 
    <h2>khi them thanh vien moi se tinh hoa hong gioi thieu cho 10 cap phia tren (con 1 so dk khac chua lam)</h2>
<form method="post">
   Ho ten <input type="text" name ="Member[name]">
   ma nguoi gioi thieu <input type="text" name ="Member[parents]">
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
   <input type="submit" value='them'>
</form>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->