<style>
    .content-right{
        position: relative;
    }
    .unsuccess_reason{
        display: none;
    }
    #popup_error{
        background-color: #FFFFFF;
        border: 1px solid #000000;
        left: 145px;
        padding: 30px;
        position: absolute;
        top: 220px;
        width: 300px;
        display: none;
        
    }
</style>
<?php echo $this->renderPartial('detail_member_rose',array('member'=>$member));?>
<div class="box-right box-common box-common-table nobdr">
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
            <td class="text-right">
                <?php echo number_format($level['totalrose']);?>
            </td>
            <td style="width:124px;">
                <?php echo ($level['success']==false)?'<a class="blue reason">Lý do</a><span class="fail">Không đạt</span>':'';?>
                <?php if($level['success']==false){?>
                    <div class="unsuccess_reason">
                        <ul>
                        <?php foreach($level['reason'] as $reason){
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
            <td><?php echo number_format($total['sum']).' d';?></td>
            <td colspan="2"><?php echo number_format($total['success']);?></td>
        </tr>
        <tr>
            <td colspan="5"><input type="submit" value="Quay lại" onclick="window.history.back();"></td>
        </tr>
    </tbody>
    </table>
</div>

<div id="popup_error">
    
</div>
<script>
    $(function(){
        $('a.reason').click(function(){
           TINY.box.show({html:$(this).parent().find('.unsuccess_reason').html(),animate:false,width:300,height:100,boxid:'error',top:200});
            return false;
        });
    });
</script>