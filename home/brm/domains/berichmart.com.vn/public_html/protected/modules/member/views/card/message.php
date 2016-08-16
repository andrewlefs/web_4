<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
    <form action="<?php echo getURL().'member/card/getTag';?>" method="POST" name="PostForm" id="PostForm">		
    <table class="table-member" border="0" cellspacing="0" style="margin-top: 0px;">
        <thead>
        <tr><td colspan="2">Thông báo : Mua thẻ thành công</td></tr>
    </thead>
    <tbody>
        <tr class="title">
            <td>Mã thẻ</td>
            <td>Mệnh giá</td>
        </tr>
        <?php
        $key_u ="hQFc+3BHRTDqy1KoJOBgf51wrU2fyiZn";
        foreach ($cards as $card){            
        ?>
        <tr>
            <td valign="top"><?php echo decrypt2($card['pin_code'],$key_u);?></td>
            <td><?php echo $product->price.' VNĐ';?></td>
        </tr>   
        <?php } ?>
    </tbody>
    </table>  
    </form>
</div>