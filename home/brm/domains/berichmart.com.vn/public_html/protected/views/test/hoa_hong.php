<table border="1">
    <tr>
        <td>Tai khoan</td>
        <td>Thang bao luu</td>
        <td>So tien</td>
    </tr>

<?php
$total=0;
foreach($members as $member){
    $count_month = Yii::app()->db->createCommand('select count(*) from rose_months where member_id="'.$member->id.'"')->queryScalar();                        
    if($count_month<3){ 
        $oldRoseMonth = RoseMonth::model()->findAll('member_id="'.$member->id.'" and status="fail"');
        foreach($oldRoseMonth as $oldRose){
           $oldRoseData = unserialize($oldRose['totalrose']);
           $moneyRose = Yii::app()->tree->getRoseMonthCardLastMonth($oldRoseData,$card);
           $realTotal = $moneyRose['realTotal'];$total +=$realTotal;
           ?>
<tr>
    <td>
        <?php echo $member->name;?>
    </td>
    <td>
        <?php echo $oldRose->month.'/'.$oldRose->year;?>
    </td>
    <td>
        <?php echo $realTotal;?>
    </td>
</tr>  
        <?php
        }
    }
}?>
<tr>
    <td colspan="2">Tong tien</td>
    <td><?php echo $total;?></td>
</tr>
</table>