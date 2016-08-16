<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Thay thế thành viên</p>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
        <form method="post" id="frm">
            <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
                <tr>
                    <td align="left" valign="top" style="width: 200px;">Thành viên bị thay thế</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[name_btt]" id="name_btt" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>   
                <tr>
                    <td align="left" valign="top">Thành viên thay thế</td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[name_tt]" id="name_tt" class='text-input' style="width: 200px;">                        
                    </td>
                </tr>                
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                            <input type="submit" value ="Thay thế"
                    </label></td>
                </tr>
            </table> 
        </form>

    </div><!-- form -->
    <!-- thong tin ca nhan -->
    <div class="info_member" id="mem_btt" style="margin-bottom: 40px;">
        
    </div>
    <div class="info_member" id="mem_tt">
        
    </div>
    <!-- end thong tin ca nhan -->
    
    <div class="cleare-fix"></div>    
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->

<script>    
$(function(){
   
        
    $('#name_btt').blur(function(){
            $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'name':this.value}, function(data){
                $('#mem_btt').html(data);
                text = $('#mem_btt thead td').text();
                $('#mem_btt thead td').text(text + ' bị thay thế');
            })
        });
        
    $('#name_tt').blur(function(){
        $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'name':this.value}, function(data){
            $('#mem_tt').html(data);
            text = $('#mem_tt thead td').text();
            $('#mem_tt thead td').text(text + ' thay thế');
        })
    });
    /*
    $('#numberaccount').blur(function(){
        $.post('<?php echo getURL().'admin/adminMembers/getMemberInfo';?>', {'numberaccount':this.value}, function(data){
            $('.info_member').html(data);
        })
    });
    */
});
</script>