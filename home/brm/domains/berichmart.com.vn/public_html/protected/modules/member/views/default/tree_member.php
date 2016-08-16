<div class="member-tree" style="min-height: 529px;">
<h3>Cây thành viên</h3>
    <?php echo $tree;?>
</div>
<div class="info-member">
    <div class="info-detail">
    <h3 style="font-size: 13px;">Thông Tin Thành Viên</h3>
    <ul>
        <li><a href="">Họ và tên : <span class="cap12"><?php echo $member->fullname;?></span></a></li>
        <li><a href="">Cấp độ: 
             <?php echo Yii::app()->tree->getTitleLevelMember($member);
            ?>
            </a></li>
        <li><a href="">Danh hiệu: <?php echo Yii::app()->tree->getVipMember($member);?></a></li>
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
        <li><a href="">Danh hieu: <?php echo Yii::app()->tree->getVipMember($person);?></a></li>
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
</div>
<!-- thong ke -->
<div id="thongke"> 
    <h3>Chi tiết cây thành viên <span><?php echo $member->fullname;?></span></h3>
<table class="tabletotal text-center" border="1" cellpadding="5" cellspacing="5"  >
    <tr class="titleds">
        <td>Cây thành viên</td>
        <td>TVKN</td>
        <td>TVCT</td>
        <td>Silver</td>
        <td>Gold</td>
        <td>1 sao</td>
        <td>2 sao</td>
        <td>3 sao</td>
        <td>4 sao</td>
        <td>5 sao</td>
    </tr>
    <?php foreach($thongke['levels'] as $level){?>
    <tr>
        <td><?php echo $level['level'];?></td>
        <td><?php echo $level['tvkn'];?></td>
        <td><?php echo $level['tvct'];?></td>
        <td><?php echo $level['silver'];?></td>
        <td><?php echo $level['gold'];?></td>
        <td><?php echo $level['vip1'];?></td>
        <td><?php echo $level['vip2'];?></td>
        <td><?php echo $level['vip3'];?></td>
        <td><?php echo $level['vip4'];?></td>
        <td><?php echo $level['vip5'];?></td>
    </tr>
    <?php } ?>
    <tr>
        <td>Tổng</td>
        <td><?php echo $thongke['totals']['tvkn'];?></td>
        <td><?php echo $thongke['totals']['tvct'];?></td>
        <td><?php echo $thongke['totals']['silver'];?></td>
        <td><?php echo $thongke['totals']['gold'];?></td>
        <td><?php echo $thongke['totals']['vip1'];?></td>
        <td><?php echo $thongke['totals']['vip2'];?></td>
        <td><?php echo $thongke['totals']['vip3'];?></td>
        <td><?php echo $thongke['totals']['vip4'];?></td>
        <td><?php echo $thongke['totals']['vip5'];?></td>
    </tr>
</table>
</div>
<script>
    $(function(){
        $('.member-tree li span').click(function(){
            $.post('<?php echo getURL().'member/default/getSidebarRight'; ?>', {'member':$(this).attr('value')}, function(data){
                $('.info-member').html(data);
            });
        });
        
    $('#mixed > li >ul').show();
    
    });
</script>