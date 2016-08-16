<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
    <table class="table-member" border="0" cellspacing="0" style="margin-top: 0px;">
        <thead>
        <tr><td colspan="7">Lịch sử hoa hồng</td></tr>
    </thead>
    <tbody class="text-center">
        <tr>
            <td colspan="2"><span id="in_excel" class="btnbutton">In ra Excel</span></td>
            <td colspan="5">
                <form method="post" name="frm_search">
                <span style="font-weight: bold; margin-right: 6px;">Tháng</span>
                <select name="month" id="month">
                    <?php for($i=1;$i<=12;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?>
                </select>
                <span style="font-weight: bold; margin-right: 6px;">Năm</span>
                <input type="text" name="year" id="year" style="margin-right: 6px;" value="<?php if(isset($year)) echo $year?>">
                <span class="btnbutton" onclick="document.frm_search.submit();">Xem hoa hồng</span>
                </form>
            </td>
        </tr>
        <?php if(isset($rosemonths)){?>
        <tr class="title">
            <td style="width:100px;">Ngày thanh toán</td>
            <td style="width:100px;">Hoa hồng tiêu dùng</td>
            <td style="width:100px;">Hoa hồng thụ động</td>
            <td style="width:100px;">Hoa hồng hỗ trợ phát triển hệ thống</td>
            <td style="width:100px;">Hoa hồng phát triển hệ thống</td>
            <td style="width:100px;">Tổng</td>
            <td>Chi tiết</td>
        </tr>   
        <?php foreach($rosemonths as $rose){
            $data = unserialize($rose->totalrose);
            ?>
        <tr class="title">
            <td><?php echo date('d-m-Y',  strtotime($rose->created));?></td>
            <td class="text-right"><?php echo $data['hoahongtieudung']; ?></td>
            <td class="text-right"><?php echo $data['buying']['total']['success'];?></td>
            <td class="text-right"><?php echo $data['offline']['total']['success'];?></td>
            <td class="text-right"><?php echo $data['online']['total']['success'];?></td>
            <td class="text-right"><?php echo $data['online']['total']['success']+$data['offline']['total']['success']+$data['buying']['total']['success']+$data['hoahongtieudung'];?></td>
            <td><a class="blue" style="text-decoration:underline;" href="<?php echo getURL().'member/default/detailHistory?member='.$member->id.'&&month='.$rose->month.'&&year='.$rose->year; ?>" target="_blank">Chi tiết</a></td>
        </tr>
        <?php }}?>
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
        location.href= '<?php echo getURL();?>admin/report/reportHistoryRose?month='+$('#month').val()+'&&year='+$('#year').val()+'&&member_id=<?php echo $this->member->id;?>';       
    });
});
</script>