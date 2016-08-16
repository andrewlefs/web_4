<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Báo cáo tổng tiền các thành viên đã nạp</p>
    
</div><!--.top-main-->
<div class="middle-main">
    <div class="form info_member report">        
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form" class="member-table">
            <!--
            <thead class="text-center">
                <tr style="background: none;">
                    <td colspan="2"><span id="in_excel" class="btnbutton">In ra Excel</span></td>
                    <td colspan="3">                        
                    </td>
                </tr>                
            </thead>
            -->
            <tbody class="text-center">
                <tr class="text-title">
                    <td style="width: 80px;">STT</td>                   
                    <td style="width: 150px;">Tên đăng nhập</td>
                    <td >Họ tên</td>
                    <td style="width: 150px;">Tổng tiền đã nạp</td>
                    <td style="width: 150px;">Ngày giờ xem</td>
                </tr>
                <?php 
                if(isset($naptienlist)){
                    $i=0;
                foreach($naptienlist as $member){?>
                <tr>  
                    <td><?php echo ++$i;?></td>
                    <td><?php echo $member['name'];?></td>
                    <td style="text-align:left; padding-right: 10px;"><?php echo $member['fullname'];?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($member['total'],0,'.',',').' vnđ';?></td>
                    <td><?php echo date('d/m/Y H:i:s');?></td>
                </tr>
                <?php }} ?>
            </tbody>
        </table> 

    </div><!-- form -->
    
    <!-- thong tin ca nhan  nguoi gui -->
    <div class="info_member info_member_send">        
    </div>
    <!-- end thong tin ca nhan -->
    
    <!-- thong tin ca nhan  nguoi nhan -->
    <div class="info_member info_member_get">        
    </div>
    <!-- end thong tin ca nhan -->
    
    <div class="cleare-fix"></div>    
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->
<script>
$(function(){
    $('#in_excel').click(function(){
        location.href= '<?php echo getURL();?>admin/report/reportTransfer?d_from='+$('#d_from').val()+'&&d_to='+$('#d_to').val();     
    });
});
</script>