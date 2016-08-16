<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Thừa kế</p>
    
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
        <form method="post" id="frm">
            <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
                <tr>
                    <td align="left" valign="top">Tên đăng nhập (người cho kế thừa)</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[peron_give]" id="peron_give" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Người kế thừa đã tham gia hệ thống</td>
                    <td align="left" valign="top">                    
                        <input type="checkbox" name="data[join]" id="join">                        
                    </td>
                </tr> 
                <tr id="member_get" style="display: none;">
                    <td align="left" valign="top">Tên đăng nhập (người kế thừa)</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[peron_get]" id="peron_get" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr class="notjoin">
                    <td align="left" valign="top">Email người kế thừa</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[email]" id="email" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>
                <tr class="notjoin">
                    <td align="left" valign="top">CMTND người kế thừa</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[cmnd]" id="cmnd" class='text-input' style="width: 200px;">                        
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
    $('#peron_give').blur(function(){
        $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'name':this.value}, function(data){
            $('.info_member_get').css({'margin-top':'30px'});
            $('.info_member_get').html(data);
            $('.info_member_get thead td').text('Thông tin thành viên ghi nợ');
        })
    });
    $('#peron_get').blur(function(){
        $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'name':this.value}, function(data){            
            $('.info_member_send').html(data);
            $('.info_member_send thead td').text('Thông tin thành viên trích nợ');
        })
    });
    
    $('#frm').click(function(){
        if($('#join').attr('checked')==true){
            $('#member_get').show();
             $('.notjoin').hide();
        }
        else{
            $('#member_get').hide();
            $('.notjoin').show();
        }
    });
});
</script>