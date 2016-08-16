<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
    <table class="table-member table-member2" border="0" cellspacing="0" style="margin-top:0;">
        <thead>
        <tr>
                <td colspan="5">Chi tiết giao dịch</td>
        </tr>
    </thead>
        <tbody>
        <tr>
            <td colspan="5">
                <form method="post" id="frmsearch">
                    <span style="float:left;"><a href="" class="button-blue">In ra Exel</a></span>
                    <span style="float:right;">Từ ngày <input type="text" name="d_from" value="<?php echo (isset($from))?$from:date('d/m/Y'); ?>"/> đến ngày <input type="text" name="d_to" value="<?php echo (isset($to))?$to:date('d/m/Y'); ?>"/><a href=""  class="button-blue" style="margin-left:5px;" onclick="$('#frmsearch').submit(); return false;">Xem sao kê</a></span>
                </form>
            </td>
        </tr>
        <tr class="title text-center">
            <td style="width:100px;">Ngày giao dịch</td>
            <td style="width:100px;">Mã số giao dịch</td>
            <td style="width:100px;">Trạng thái (+/-)</td>
            <td style="width:130px;">Số tiền</td>
            <td>Mô tả</td>
        </tr>
        <?php foreach($transfers as $item){?>
        <tr class="text-center">
            <td><?php echo date('d/m/Y',  strtotime($item->created)); ?></td>
            <td><?php echo $item->id; ?></td>
            <td style="text-align:center;"><?php echo ($item->account_send==$member->CardAccount['numberaccount'])?'-':'+';?></td>
            <td class="text-right"><?php echo number_format($item->money);?> VNĐ</td>
            <td><?php echo $item->information;?></td>
        </tr>
        <?php }?>        
    </tbody>

    </table>

</div>