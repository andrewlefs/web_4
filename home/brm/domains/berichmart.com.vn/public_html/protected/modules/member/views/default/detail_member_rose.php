<?php
$totalmemberlevel1=Yii::app()->db->createCommand('select count(*) as sum from members where level ='.($member->level+1).' and lft>'.$member->lft.' and rgt<'.$member->rgt)->queryRow();           
$totalmemberlevel2=Yii::app()->db->createCommand('select count(*) as sum from members where level ='.($member->level+2).' and lft>'.$member->lft.' and rgt<'.$member->rgt)->queryRow();           
$totalmember14level=Yii::app()->db->createCommand('select count(*) as sum from members where level <='.($member->level+14).' and lft>'.$member->lft.' and rgt<'.$member->rgt)->queryRow();
$levels = Yii::app()->db->createCommand('SELECT  distinct level FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' order by level asc')->queryColumn();
$data = Yii::app()->tree->sumRoseMember($member);
$total = $data['buying']['total']['success'] + $data['offline']['total']['success'] + $data['online']['total']['success']+$data['hoahongtieudung'];
?>
<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
<table class="table-member" border="0" cellspacing="0" style="margin-top:0;">
    <thead>
    <tr><td colspan="2">Thông tin thành viên</td></tr>
</thead>
<tbody>
    <tr>
        <td>Tên thành viên: <b class="cap12"><?php echo $member->fullname;?></b></td>            
        <td>Tổng số thành viên cấp 1: <b><?php echo $totalmemberlevel1['sum'];?></b></td>
    </tr>
    <tr>
        <td>Doanh số tiêu dùng tháng <?php echo date('m/Y');?>: <span class="red"><?php echo number_format(Yii::app()->tree->sumProfit($member->id,date('m'),date('Y'))).' đ';?></span>&nbsp;<a href="<?php echo getURL().'doan-so-tieu-dung';?>" class="blue" style="font-size:11px; text-decoration:underline;">Chi tiết</a></td>
        <td>Tổng số thành viên cấp 2: <b><?php echo $totalmemberlevel2['sum'];?></b></td>
    </tr>
    <tr>
            <td>Cấp độ thành viên: 
                <?php 
                echo Yii::app()->tree->getTitleLevelMember($member);
        ?>&nbsp; <?php if($member->title==0){?><a href="<?php echo getURL().'nang-cap';?>" class="blue"  style="font-size:11px;  text-decoration:underline;">Nâng cấp</a><?php }?></td>

        <td>Tổng số thành viên 14 cấp: <b><?php echo $totalmember14level['sum'];?></b></td>
    </tr>
    <tr>
        <td >Hoa hồng tháng <?php echo date('m/Y');?> tới thời điểm hiện tại: <span class="red"><?php echo number_format($total);?> VNĐ</span></td>
        <td>Tổng số thành viên cấp 14 đến n : <b><?php echo Yii::app()->db->createCommand('SELECT count(*)as sum FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level >'.($member->level+14))->queryScalar();?></b></td>
    </tr>
</tbody>
</table>
</div>