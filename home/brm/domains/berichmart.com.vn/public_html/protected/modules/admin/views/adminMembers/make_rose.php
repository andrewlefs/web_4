<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Lập lệnh thanh toán tiền hoa hồng cho thành viên</p>    
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
        <form method="post" id="frm">
            <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">                
                 <tr>
                    <td align="left" valign="top">Hoa hồng tháng</td>
                    <td align="left" valign="top">                    
                        <span>Tháng : </span> 
                        <input type="text" name="data[month]" id="month" class='text-input' value="<?php echo isset($month)?$month:'';?>" style="width: 60px;">                        
                        <span>Năm : </span><input type="text" name="data[year]" id="year" value="<?php echo isset($year)?$year:'';?>" class='text-input' style="width: 60px;">     
                    </td>
                </tr> 
                <tr>
                    <td align="left" valign="top">Tổng tiền cần thanh toán</td>
                    <td align="left" valign="top">                    
                        <input type="text" disabled="disabled" value="<?php echo number_format($total);?>" >                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Đồng ý thanh toán</td>
                    <td align="left" valign="top">                    
                        <input type="checkbox" id="allow" name="data[give]" >                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                            <input type="submit" value ="Thanh toán"
                    </label></td>
                </tr>
            </table> 
        </form>

    </div><!-- form -->
    <!-- thong tin ca nhan -->
    <div class="info_member">
        
    </div>
    <!-- end thong tin ca nhan -->
    
    <div class="cleare-fix"></div>    
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->

<script>
$(function(){
    $('#frm').submit(function(){        
        if($('#month').val()==''){
            alert('Chưa chọn tháng');
             $('#month').focus();
            return false;
        }
        if($('#year').val()==''){
            alert('Chưa nhập năm');
            $('#year').focus();
            return false;
        }
        if(!$('#allow').attr('checked')){ // tra ve gia tri true/false 
            alert('Chưa check nút đồng ý thanh toan');
            return false;
        }
    });
});
</script>