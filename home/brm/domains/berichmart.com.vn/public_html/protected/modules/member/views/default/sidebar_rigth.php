<div class="info-detail">
<h3 style="font-size: 13px;">Thông Tin Thành Viên</h3>
<ul>
    <li><a href="">Họ và tên : <span class="cap12"><?php echo $member->fullname;?></span></a></li>
    <li><a href="">Cấp độ: 
            <?php echo Yii::app()->tree->getTitleLevelMember($member);
        ?>
        </a></li>
    <li><a href="">Danh hiệu: <?php echo $member->title2;?></a></li>
    <li><a href="">Tên tài khoản: <?php echo $member->name;?></a></li>
    <?php foreach($levels1 as $level){
        $count = Yii::app()->db->createCommand('select count(*) as sum from members where level='.$level['level'].' and lft>'.$member->lft.' and rgt<'.$member->rgt)->queryRow();           
        ?>
    <li><a href="">Số thành viên cấp <?php echo $level['level']-$member->level;?>: <?php echo $count['sum'];?></a></li>
    <?php } ?>
    <li><a href="">Số thành viên 10 cấp : <?php echo $total71['sum'];?></a></li>
    <li><a href="">TVKN: <?php echo $tvkn['total'];?></a></li>
    <li><a href="">TVCT: <?php echo $tvct['total'];?></a></li>
    <li><a href="">DSTD thang <?php echo date('m/Y');?>: <?php echo number_format(Yii::app()->tree->sumProfit($member->id,date('m'),date('Y'))).' đ';?></a></li>
</ul>
<a href="<?php echo getURL();?>member/default/rose/<?php echo $member->id;?>" class="red" style="font-size:11px; text-decoration:underline;">Chi tiết hoa hồng</a> </div>
<!--info detail-->

<div class="info-detail">
<h3 style="font-size: 13px;">Thông Tin Thành Viên Giới Thiệu</h3>
<ul>
    <li><a href="">Họ và tên : <span class="cap12"><?php echo $person->fullname;?></span></a></li>
    <li><a href="">Cấp độ: 
        <?php echo Yii::app()->tree->getTitleLevelMember($person);
        ?>
        </a></li>
    <li><a href="">Danh hieu: <?php echo $person->title2;?></a></li>
    <li><a href="">Tên tài khoản: <?php echo $person->name;?></a></li>
    <?php foreach($levels2 as $level){
        $count = Yii::app()->db->createCommand('select count(*) as sum from members where level='.$level['level'].' and lft>'.$person->lft.' and rgt<'.$person->rgt)->queryRow();           
        ?>
    <li><a href="">Số thành viên cấp <?php echo $level['level']-$person->level;?>: <?php echo $count['sum'];?></a></li>
    <?php } ?>
    <li><a href="">Số thành viên 10 cấp : <?php echo $total72['sum'];?></a></li>
    <li><a href="">TVKN: <?php echo $tvkn2['total'];?></a></li>
    <li><a href="">TVCT: <?php echo $tvct2['total'];?></a></li>
    <li><a href="">DSTD thang <?php echo date('m/Y');?>: <?php echo number_format(Yii::app()->tree->sumProfit($person->id,date('m'),date('Y'))).' đ';?></a></li>
</ul>
</div>
<!--info detail--> 