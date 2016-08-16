<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Rút tiền khỏi tài khoản</p>
    <a href="#" class="edit" onclick="$('#frm').submit(); return false;">
    <span ></span>
    Rút tiền
    </a>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
        <form method="post" id="frm">
            <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
                <tr>
                    <td align="left" valign="top">Tên đăng nhập</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[name]" id="name_mem" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Số CMTND</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[cmnd]" id="cmnd" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Số tài khoản</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[numberaccount]" id="numberaccount" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="width:150px;">Số tiền</td>
                    <td align="left" valign="top">
                        <label> 
                            <input id="moneyformat" type="text" name="data[money]" class='text-input' style='width:200px;'>
                        </label>
                    </td>
                </tr>  
                <tr>
                    <td align="left" valign="top">Diễn giải</td>
                    <td align="left" valign="top">                    
                        <input type="text" id="info" name="data[information]" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                            <input type="submit" value ="Rút tiền"
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
    $('#moneyformat').keyup(function(){
            if($(this).val().length>3){
                $.post('<?php echo getURL().'admin/adminMembers/createNumber';?>',{'number':this.value}, function(data){                    
                   $('#moneyformat').val(data);
                });
            }
        });
        
    $('#name_mem').blur(function(){
            $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'name':this.value}, function(data){
                $('.info_member').html(data);
            })
        });
        
    $('#cmnd').blur(function(){
        $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'cmnd':this.value}, function(data){
            $('.info_member').html(data);
        })
    });
    $('#numberaccount').blur(function(){
        $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'numberaccount':this.value}, function(data){
            $('.info_member').html(data);
        })
    });
});
</script>