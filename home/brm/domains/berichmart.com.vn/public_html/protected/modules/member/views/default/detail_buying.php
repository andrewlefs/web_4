<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
    <?php echo $this->renderPartial('detail_member_rose',array('member'=>$member));?>
    <table class="table-member" border="0" cellspacing="0">
        <thead>
        <tr><td colspan="5">Doanh số tiêu dùng</td></tr>
    </thead>
    <tbody class="text-center">
        <tr>
            <td><span id="in_excel" class="btnbutton">In ra Excel</span></td>
            <td colspan="4">
                <form method="post" name="frm_search">
                <span style="font-weight: bold; margin-right: 6px;">Tháng</span>                
                <select name="month" id="month">
                    <?php for($i=1;$i<=12;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?>
                </select>
                <span style="font-weight: bold; margin-right: 6px;">Năm</span>
                <input type="text" name="year" id="year" style="margin-right: 6px;" value="<?php if(isset($year)) echo $year?>" >
                <span class="btnbutton" onclick="document.frm_search.submit();">Xem hoa hồng</span>
                </form>
            </td>
        </tr>
        <tr class="title">
            <td style="width:130px;">Ngày giao dich</td>
            <td style="width:130px;">Số hóa đơn</td>
            <td style="width:130px;">Số tiền (VND)</td>
            <td style="width:130px;">Điểm</td>
            <td>Mô tả</td> 
        </tr>
         <?php foreach($productBuying as $order){?>
        <tr>
            <td class="text-left"><?php echo date('d/m/Y', strtotime($order->created));?></td>
            <td><?php echo $order->id;?></td>               
            <td class="text-right"><?php echo number_format($order->total); ?></td>            
            <td class="text-right"><?php echo $order->profit;?></td>
            <td><?php ?></td>
        </tr>
        <?php }?> 
        <tr>
            <td colspan="5"><input type="submit" value="Quay lại" onclick="window.history.back();"></td>
        </tr>
    </tbody>
    </table>
</div>
<script>
    $(function(){
        $('#month option').each(function(){
            if(this.value=='<?php echo $month;?>')
            $(this).attr('selected', 'selected');
        });
    });    
</script>
<script>
$(function(){
    $('#in_excel').click(function(){
        location.href= '<?php echo getURL();?>admin/report/reportBuying?month='+$('#month').val()+'&&year='+$('#year').val()+'&&member_id=<?php echo $this->member->id;?>';       
    });
});
</script>