<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
    <form action="<?php echo getURL().'member/card/getTag';?>" method="POST" name="PostForm" id="PostForm">		
    <table class="table-member" border="0" cellspacing="0" style="margin-top: 0px;">
        <thead>
        <tr><td colspan="2">Thông báo lỗi</td></tr>
    </thead>
    <tbody>
        <tr>            
            <td><?php echo $result['message'];?></td>
        </tr> 
    </tbody>
    </table>  
    </form>
</div>