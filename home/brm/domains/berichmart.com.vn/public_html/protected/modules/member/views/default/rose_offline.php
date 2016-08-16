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
            <td colspan="2"><?php echo number_format($total['success']);?></td>  
        </tr>
        <tr>
            <td colspan="4"><input type="submit" value="Quay lại" onclick="window.history.back();"></td>
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