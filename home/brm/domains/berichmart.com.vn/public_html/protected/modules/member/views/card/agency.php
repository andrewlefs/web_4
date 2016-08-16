<style>
    .tbl_right td{
        color: #555555;
    }
</style>
<div class="rightmain">
        <div class="quangcao"></div><!--e:quangcao-->
    <div class="bang">
        <div class="tenbang b1"><a class="list" href="#"><h3>Chính sách hoa hồng đại lý</h3></a></div>        
        <table cellpadding="5" cellspacing="0" border="0" class="tbl_right">
                <tbody>
                <tr>
                        <th>Gói</th>
                        <th>Loại thẻ</th>
                        <th>Hoa hồng</th>
                        
                </tr>
                <?php              
                foreach ($packages as $item){  ?>                
                    <tr>
                        <td rowspan="<?php echo count($item->PackageBonus);?>" style="font-weight: bold; color: red;"><?php echo number_format($item->value).' đ';?></td>                   
                        <td >                       
                            <?php echo isset($item->PackageBonus[0])?$item->PackageBonus[0]->name:'';?>  
                        </td>  
                        <td>
                            <?php echo isset($item->PackageBonus[0])?$item->PackageBonus[0]->value.' %':'';?>
                        </td>
                    </tr>
                    <?php for($i=1;$i<count($item->PackageBonus);$i++){?>
                    <tr> 
                        <td >                       
                            <?php echo $item->PackageBonus[$i]->name;?>  
                        </td>  
                        <td>
                            <?php echo $item->PackageBonus[$i]->value.' %';?>
                        </td>                     
                    </tr>
                    <?php }?>
                <?php }?> 				
            </tbody>
        </table>
    </div><!--e:bang-->
</div><!--e:rightmain-->