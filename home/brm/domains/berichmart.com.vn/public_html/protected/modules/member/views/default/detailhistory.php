<style>
    .unsuccess_reason{display: none;}
</style>
<?php echo $this->renderPartial('detail_member_rose',array('member'=>$member));?>
<center><h3>Hoa hồng tháng <?php echo $month?> năm <?php echo $year;?></h3></center>
<div class="box-right box-common box-common-table nobdr">    
    <?php
        $data = unserialize($rosemonth->totalrose);
        $arrLevel=$data['buying']['level'];
        $total = $data['buying']['total'];
    ?>
    <table class="table-member" border="0" cellspacing="0">
        <thead>
        <tr><td colspan="5">Chi tiết hoa hồng thụ động</td></tr>
    </thead>
    <tbody class="text-center">
        <tr class="title">
            <td>Cây thành viên</td>
            <td>Tổng số thành viên</td>
            <td>Tổng số doanh thu</td>
            <td colspan="2" style="width:230px;">Tổng hoa hồng (VND)</td>  
        </tr>
         <?php foreach($arrLevel as $level){?>
        <tr>
            <td><?php echo $level['level'];?></td>
            <td><?php echo $level['count'];?></td>               
            <td class="text-right"><?php echo number_format($level['sum']).' d'; ?></td>  
            <td class="text-right"><?php echo number_format($level['totalrose']);?></td>
            <td style="width:124px;">
                <!--
                <?php echo ($level['success']==true)?number_format($level['totalrose']):'<span style="color:red;">0 - <span style="margin-left:32px;">Không đạt</span></span>';?>
                -->
                <?php echo ($level['success']==false)?'<a class="blue reason">Lý do</a><span class="fail">Không đạt</span>':'';?>
                <?php if($level['success']==false){?>
                    <div class="unsuccess_reason">
                        <ul>
                        <?php
                        if(isset($level['reason'])){
                        foreach($level['reason'] as $reason){
                            echo '<li>'.$reason.'</li>';
                        }}
                        ?>
                        </ul>
                    </div>
                <?php }?>
            </td>
        </tr>
        <?php }?>
        <tr class="title">
            <td>Tổng số</td>
            <td><?php echo $total['count'];?></td>
            <td><?php echo number_format($total['sum']).' d';?></td>
            <td colspan="2"><?php echo number_format($total['success']);?></td>
        </tr>
    </tbody>
    </table>
</div>

<div class="box-right box-common box-common-table nobdr">
    <?php       
        $arrLevel=$data['offline']['level'];
        $total = $data['offline']['total'];
    ?>
    <table class="table-member" border="0" cellspacing="0">
        <thead>
        <tr><td colspan="4">Chi tiết hoa hồng giới thiệu gián tiếp</td></tr>
    </thead>
    <tbody class="text-center">
        <tr class="title">
            <td style="width:190px;">Cây thành viên</td>
            <td style="width:190px;">Tổng số thành viên đăng ký mới</td>
            <td colspan="2">Tổng hoa hồng (VND)</td>
        </tr>
        <?php foreach($arrLevel as $level){?>
        <tr>
            <td><?php echo $level['level'];?></td>
            <td><?php echo $level['count'];?></td>               
            <td class="text-right" style="width:190px;"><?php echo number_format($level['sum']); ?></td>            
            <td>
                <?php echo ($level['success']==false)?'<a class="blue reason" >Lý do</a><span class="fail">Không đạt</span>':'';?>
                <?php if($level['success']==false){?>
                    <div class="unsuccess_reason">
                        <ul>
                        <?php
                        if(isset($level['reason']))
                        foreach($level['reason'] as $reason){
                            echo '<li>'.$reason.'</li>';
                        }
                        ?>
                        </ul>
                    </div>
                <?php }?>
            </td>
        </tr>
        <?php }?>
        <tr class="title">
            <td>Tổng số</td>
            <td><?php echo $total['count'];?></td>
            <td colspan="2"><?php echo number_format($total['success']);?></td>          
        </tr>
    </tbody>
    </table>
</div>


<div class="box-right box-common box-common-table nobdr">
    <?php       
        $arrLevel=$data['online']['level'];
        $total = $data['online']['total'];
    ?>
    <table class="table-member" border="0" cellspacing="0">
        <thead>
        <tr><td colspan="3">Chi tiết hoa hồng giới thiệu trực tiếp</td></tr>
    </thead>
    <tbody class="text-center">
        <tr class="title">
            <td>Cây thành viên</td>
            <td>Tổng số thành viên chinh thuc</td>
            <td>Tổng hoa hồng (VND)</td>
        </tr>
        <?php foreach($arrLevel as $level){?>
        <tr>
            <td><?php echo $level['level'];?></td>
            <td><?php echo $level['count'];?></td>               
            <td><?php echo number_format($level['sum']); ?>
                <?php echo ($level['success']==false)?'<a class="blue reason" >Lý do</a><span class="fail">Không đạt</span>':'';?>
                <?php if($level['success']==false){?>
                    <div class="unsuccess_reason">
                        <ul>
                        <?php 
                        if(isset($level['reason']))
                        foreach($level['reason'] as $reason){
                            echo '<li>'.$reason.'</li>';
                        }
                        ?>
                        </ul>
                    </div>
                <?php }?>
            </td>
        </tr>
        <?php }?>
        <tr class="title">
            <td>Tổng số</td>
            <td><?php echo $total['count'];?></td>
            <td><?php echo number_format($total['success']);?></td>            
        </tr>
    </tbody>
    </table>
    
</div>
<script>
    $(function(){
        $('a.reason').click(function(){
            TINY.box.show({html:$(this).parent().find('.unsuccess_reason').html(),animate:false,width:300,height:100,boxid:'error',top:200});
            return false;
        });
    });
</script>