<!-- main content -->
<div id="ad_maincontent">
<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Tổng tiền thành viên nâng cấp</div><!--.top-main-->
<div class="middle-main">
    <div class="form info_member report">        
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form" class="member-table">
            <thead class="text-center">
                <tr style="background: none;">
                    <td >
                        <form method="post" name="frm_search">
                        <span style="font-weight: bold; margin-right: 6px;">Ngày</span>
                        <input type="text" name="day" id="month" style="margin-right: 6px;" value="<?php if(isset($day)) echo $day;?>" >
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
                    <td style="text-align: center; font-weight: bold;">Tổng tiền thành viên nâng cấp : <?php echo '<span style="color:red;" >'.number_format($totalmoney,0,'.',',').'</span> vnđ';?></td>
                </tr> 
            </tbody>
        </table> 

    </div><!-- form -->   
    
    
    <div class="cleare-fix"></div>    
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->
</div>
<!-- end main content -->

<script>
$(function(){
    $('#in_excel').click(function(){
      //  location.href= '<?php echo getURL();?>admin/report/reportTax?month='+$('#month').val()+'&&year='+$('#year').val();     
    });
});
</script>