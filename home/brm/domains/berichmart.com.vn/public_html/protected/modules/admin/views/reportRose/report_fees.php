<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Báo cáo tiền thu phí</p>
    
</div><!--.top-main-->
<div class="middle-main">
    <div class="form info_member report">        
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form" class="member-table">
            <thead class="text-center">
                <tr style="background: none;">
                    <td colspan="2"><span id="in_excel" class="btnbutton">In ra Excel</span></td>
                    <td colspan="5">
                        <form method="post" name="frm_search">
                        <span style="font-weight: bold; margin-right: 6px;">Từ ngày</span>
                        <input type="text" name="d_from" id="d_from" style="margin-right: 6px;" value="<?php if(isset($from)) echo $from; else echo'dd/mm/yyyy';?>" onfocus="if(this.value=='dd/mm/yyyy') this.value='';">
                        <span style="font-weight: bold; margin-right: 6px;">đến ngày</span>
                        <input type="text" name="d_to" id="d_to" style="margin-right: 6px;" value="<?php if(isset($to)) echo $to; else echo'dd/mm/yyyy';?>" onfocus="if(this.value=='dd/mm/yyyy') this.value='';">
                        <span class="btnbutton" onclick="document.frm_search.submit();">Xem báo cáo</span>
                        </form>
                    </td>
                </tr>                
            </thead>
            <tbody class="text-center">
                <tr class="text-title">
                    <td style="width: 140px;">Tên đăng nhập</td>                   
                    <td style="width: 200px;">Họ tên</td>
                    <td style="width: 140px;">Số tài khoản</td>
                    <td style="width: 140px;">Số tiền phí</td>
                    <td style="width: 140px;">Loại phí</td>
                    <td>Ngày giờ thu phí</td>
                </tr>
                <?php 
                if(isset($reports))
                foreach($reports as $report){?>
                <tr>  
                    <td><?php echo $report['Member']['name'];?></td>
                    <td style="text-align:left; padding-left: 10px;"><?php echo $report['Member']['fullname'];?></td>
                    <td ><?php echo $report['Fee']['numberaccount'];?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($report['Fee']['fee']).' VNĐ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo $report['Fee']['type'];?></td>
                    <td><?php echo $report['Fee']['created'];?></td>
                </tr>
                <?php } ?>
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
        location.href= '<?php echo getURL();?>admin/report/reportFees?d_from='+$('#d_from').val()+'&&d_to='+$('#d_to').val();     
    });
});
</script>