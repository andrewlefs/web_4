<!-- main content -->
<div id="ad_maincontent">
<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Hoa hồng
</div><!--.top-main-->
<div class="middle-main">
    <div class="form info_member report">        
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form" class="member-table">
            <thead class="text-center">
                <tr style="background: none;">
                    <td colspan="1"><span id="in_excel" class="btnbutton">In ra Excel</span></td>
                    <td colspan="3">
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
                <tr>
                    <td colspan="4" style="text-align: center; font-weight: bold; color: red;">Tổng các loại hoa hồng</td>
                </tr>
                <tr class="text-title">
                    <td style="width: 100px;">Tổng hoa hồng</td>                   
                    <td style="width: 120px;">Số tiền thanh toán</td>
                    <td style="width: 120px;">Số tiền thuế</td>
                    <td style="width: 120px;">Số tiền còn lại</td>                                       
                </tr>
                <?php 
                if(isset($total))
               { ?>
                <tr>  
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['full']['tong_hoa_hong']).' vnđ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['full']['so_tien_thanh_toan']).' vnđ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['full']['thue']).' vnđ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['full']['so_tien_con_lai']).' vnđ';?></td>                    
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
</div>
<!-- end main content -->

<!-- main content -->
<div id="ad_maincontent">
<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Chi tiết hoa hồng
</div><!--.top-main-->
<div class="middle-main">
    <div class="form info_member report">        
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form" class="member-table">            
            <tbody class="text-center">                
                <tr>
                    <td colspan="3" style="text-align: center; font-weight: bold; color: red;">Hoa hồng thụ động</td>
                </tr>
                <tr class="text-title">
                    <td style="width: 100px;">Tổng hoa hồng thụ động</td>                   
                    <td style="width: 120px;">Số tiền thanh toán</td>
                    <td style="width: 120px;">Số tiền còn lại</td>                                       
                </tr>
                <?php 
                if(isset($total))
               { ?>
                <tr>  
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['hhthudong']['tong_hoa_hong']).' vnđ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['hhthudong']['so_tien_thanh_toan']).' vnđ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['hhthudong']['so_tien_con_lai']).' vnđ';?></td>                    
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" style="text-align: center; font-weight: bold; color: red;">Hoa hồng hỗ trợ phát triển hệ thống</td>
                </tr>
                <tr class="text-title">
                    <td style="width: 100px;">Tổng hoa hồng hỗ trợ PTHT</td>                   
                    <td style="width: 120px;">Số tiền thanh toán</td>
                    <td style="width: 120px;">Số tiền còn lại</td>                                       
                </tr>
                <?php 
                if(isset($total))
               { ?>
                <tr>  
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['hhhotroptht']['tong_hoa_hong']).' vnđ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['hhhotroptht']['so_tien_thanh_toan']).' vnđ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['hhhotroptht']['so_tien_con_lai']).' vnđ';?></td>                    
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" style="text-align: center; font-weight: bold; color: red;">Hoa hồng phát triển hệ thống</td>
                </tr>
                <tr class="text-title">
                    <td style="width: 100px;">Tổng hoa hồng PTHT</td>                   
                    <td style="width: 120px;">Số tiền thanh toán</td>
                    <td style="width: 120px;">Số tiền còn lại</td>                                       
                </tr>
                <?php 
                if(isset($total))
               { ?>
                <tr>  
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['hhptht']['tong_hoa_hong']).' vnđ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['hhptht']['so_tien_thanh_toan']).' vnđ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total['hhptht']['so_tien_con_lai']).' vnđ';?></td>                    
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

<div class="bottom-main" style="margin-bottom: 20px;"></div><!--.middle-main-->
</div>
<!-- end main content -->


<script>
$(function(){
    $('#in_excel').click(function(){
      //  location.href= '<?php echo getURL();?>admin/report/reportTax?month='+$('#month').val()+'&&year='+$('#year').val();     
    });
});
</script>