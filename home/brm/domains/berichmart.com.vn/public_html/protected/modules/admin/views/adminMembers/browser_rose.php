<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Xét duyệt hoa hồng tháng <?php echo $month;?> năm <?php echo $year;?></p>
    <span id="in_excel" class="btnbutton" style="float: right; margin-top: -34px; margin-right: 10px;">In ra Excel</span>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form info_member report">        
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form" class="member-table">           
            <tbody class="text-center">
                <tr class="text-title">
                    <td style="width: 100px;">Tên đăng nhập</td> 
                    <td style="width: 120px;">Họ tên</td>
                    <td style="width: 120px;">HH thụ động</td>
                    <td style="width: 120px;">HH hỗ trợ PTHT</td>
                    <td style="width: 120px;">HH PTHT</td>
                    <td style="width: 120px;">HH TD</td>
                    <td style="width: 100px;">Thuế</td>
                    <td style="width: 120px;">Tổng HH</td>
                    <td style="width: 120px;">Tổng thực</td>
                </tr>
                <?php 
                $tongtien=0;
                if(isset($data))
                foreach($data as $item){
                    $report = $item['Rose'];
                    $member= $item['Member'];
                    $buying=$report['buying']['total']['success'];
                    $offline=$report['offline']['total']['success'];
                    $online=$report['online']['total']['success'];
                    $tax=0;
                    $total=$buying+$offline+$online + $report['hoahongtieudung'];
                    $realTotal =$total-$tax;  $tongtien +=  $realTotal;
                    if($realTotal>0){
                    ?>
                <tr>  
                    <td><?php echo $member->name;?></td>
                    <td><?php echo $member->fullname;?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($buying).' VNĐ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($offline).' VNĐ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($online).' VNĐ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($report['hoahongtieudung']).' VNĐ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo $tax;?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($total).' VNĐ';  ?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($realTotal).' VNĐ';  ?></td>
                </tr>
                <?php }} ?>
                <tr>
                    <td colspan="8">Tong tien</td>
                    <td><?php echo $tongtien.'VND';?></td>
                </tr>
            </tbody>
        </table> 

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
    $('#in_excel').click(function(){
        location.href= '<?php echo getURL();?>admin/report/reportBrowse';     
    });
});
</script>