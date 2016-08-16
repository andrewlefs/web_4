<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
<table class="table-member style2" border="0" cellspacing="0" style="margin-top:0;">
    <thead>
        <tr>
                <td colspan="7">Danh sách đơn hàng</td>
        </tr>
    </thead>
    <tbody>
        <tr style="background: none;">
            <td colspan="2" align="center"><span id="in_excel" class="btnbutton">In ra Excel</span></td>
            <td colspan="5" align="center">
                <form method="post" name="frm_search">
                <span style="font-weight: bold; margin-right: 6px;">Từ ngày</span>
                <input type="text" name="d_from" id="d_from" style="margin-right: 6px;" value="<?php if(isset($from)) echo $from; else echo'dd/mm/yyyy';?>" onfocus="if(this.value=='dd/mm/yyyy') this.value='';">
                <span style="font-weight: bold; margin-right: 6px;">đến ngày</span>
                <input type="text" name="d_to" id="d_to" style="margin-right: 6px;" value="<?php if(isset($to)) echo $to; else echo'dd/mm/yyyy';?>" onfocus="if(this.value=='dd/mm/yyyy') this.value='';">
                <span class="btnbutton" onclick="document.frm_search.submit();">Xem báo cáo</span>
                </form>
            </td>
        </tr>        
        <tr style="text-align: center; font-weight: bold;">            
            <td>Mã đơn</td>
            <td>Ngày mua</td>
            <td>Thu ngân</td>
            <td>Tổng điểm</td> 
            <td>Tổng tiền</td>             
            <td>Hoa hồng tiêu thụ</td> 
            <td>Tổng tiền thực thanh toán</td>
            
            <td>Chi tiết</td>
        </tr> 
        <?php foreach($data as $item){
           // $personbuy = !empty($item['personbuy'])?unserialize($item['personbuy']):'';
           // $personget = !empty($item['personget'])?unserialize($item['personget']):'';
            ?>        
        <tr>
            <td ><?php echo $item->id;?></td>
            <td style="text-align: right;  padding-right: 10px;"><?php echo  $item->profit;?></td>
            <td style="text-align: center;"><?php echo date('d/m/Y',  strtotime($item->created));?></td>
            <td></td>
            <td style="text-align: right;  padding-right: 10px;"><?php echo number_format($item->total).' đ';?></td>
            <td style="text-align: right; padding-right: 10px;"><?php echo  number_format($item->money_off).' đ';?></td>
            <td style="text-align: right;padding-right: 10px;"><?php echo  number_format($item->total_off).' đ';?></td>
            
            <td style="text-align: center; text-decoration: underline;"><a class="detail" href="#" url="<?php echo getURL().'member/default/detailDonHang/'.$item->id;?>">Chi tiết</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<div class="paging">
    <!-- <a href="">Trước</a><a href="">1</a><a href="" class="current">2</a><a href="">3</a><a href="">4</a><a href="">5</a><a href="">6</a><a href="">7</a><a href="">8</a><a href="">9</a><a href="">10</a><a href="">Sau</a> -->
    <?php $this->widget("CLinkPager",array('pages'=>$pages,'nextPageLabel'=>'Sau','prevPageLabel'=>'Trước','firstPageLabel'=>"Đầu tiên",'lastPageLabel'=>'Cuối cùng','header'=>'','footer'=>''));?> 
</div><!--Paging-->
<div id="box">
    
</div>
<script>
$(function(){
    $('.detail').click(function(){
        url = $(this).attr('url');
        $.post(url, function(data){
            $('#box').html(data);
        })
    });
});
</script>