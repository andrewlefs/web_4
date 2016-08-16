<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Chuyển nhượng tiền</p>
    
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
        <form method="post" id="frm">
            <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
                <tr>
                    <td align="left" valign="top">Tài khoản trích nợ:</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[account_send]" id="account_send" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Tài khoản ghi nợ:</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[account_get]" id="account_get" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="width:150px;">Số tiền:</td>
                    <td align="left" valign="top">
                        <label> 
                            <input id="moneyformat" type="text" name="data[money]" class='text-input' style='width:200px;'>
                        </label>
                    </td>
                </tr>  
                <tr>
                    <td align="left" valign="top">Nội dung thanh toán:</td>
                    <td align="left" valign="top">                    
                        <input type="text" id="info" name="data[information]" class='text-input' style="width: 600px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                            <input type="submit" value ="Chuyển nhượng"
                    </label></td>
                </tr>
            </table> 
        </form>

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
    $('#moneyformat').keyup(function(){
            if($(this).val().length>3){
                $.post('<?php echo getURL().'admin/adminMembers/createNumber';?>',{'number':this.value}, function(data){                    
                   $('#moneyformat').val(data);
                });
            }
        });
        
    $('#account_get').blur(function(){
        $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'numberaccount':this.value}, function(data){
            $('.info_member_get').css({'margin-top':'30px'});
            $('.info_member_get').html(data);
            $('.info_member_get thead td').text('Thông tin thành viên ghi nợ');
        })
    });
    $('#account_send').blur(function(){
        $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'numberaccount':this.value}, function(data){            
            $('.info_member_send').html(data);
            $('.info_member_send thead td').text('Thông tin thành viên trích nợ');
        })
    });
});
</script>