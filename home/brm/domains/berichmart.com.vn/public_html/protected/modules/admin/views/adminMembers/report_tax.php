<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Báo cáo thuế
</div><!--.top-main-->
<div class="middle-main">
    <div class="form info_member report">        
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form" class="member-table">
            <thead class="text-center">
                <tr style="background: none;">
                    <td colspan="2"><span id="in_excel" class="btnbutton">In ra Excel</span></td>
                    <td colspan="5">
                        <form method="post" name="frm_search">
                        <span style="font-weight: bold; margin-right: 6px;">Tháng</span>
                        <input type="text" name="month" id="month" style="margin-right: 6px;" value="<?php if(isset($month)) echo $month;?>" >
                        <span style="font-weight: bold; margin-right: 6px;">Năm</span>
                        <input type="text" name="year" id="year" style="margin-right: 6px;" value="<?php if(isset($year)) echo $year;?>" >
                        <span class="btnbutton" onclick="document.frm_search.submit();">Xem báo cáo</span>
                        </form>
                    </td>
                </tr>                
            </thead>
            <tbody class="text-center">
                <tr class="text-title">
                    <td style="width: 100px;">Tên đăng nhập</td>                   
                    <td style="width: 120px;">Họ tên</td>
                    <td style="width: 120px;">CMTND</td>
                    <td style="width: 120px;">Số tiền đóng thuế</td>
                    <td style="width: 120px;">Ngày đóng</td>                    
                </tr>
                <?php 
                if(isset($reports))
                foreach($reports as $report){                    
                    ?>
                <tr>  
                    <td><?php echo $report['Member']['name'];?></td>
                    <td style="text-align:left; padding-left: 10px;"><?php echo $report['Member']['fullname'];?></td>
                    <td style="text-align:left; padding-left: 10px;"><?php echo $report['Member']['cmnd'];?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($report['Tax']['money']).' VNĐ';?></td>                    
                    <td><?php echo date('d/m/Y',  strtotime($report['Tax']['created']));?></td>
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
        location.href= '<?php echo getURL();?>admin/report/reportTax?month='+$('#month').val()+'&&year='+$('#year').val();     
    });
});
</script>