<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh sách thành viên đạt sao</p>
    <!--
    <span id="in_excel" class="btnbutton" style="float: right; margin-top: -34px; margin-right: 10px;">In ra Excel</span>
    -->
</div><!--.top-main-->
<div class="middle-main">
    <div class="form info_member report">        
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form" class="member-table">     
            <thead class="text-center">
                <tr style="background: none;">
                    <td colspan="6">
                        <form method="post" name="frm_search">
                        <span style="font-weight: bold; margin-right: 6px;">Tháng</span>
                        <input type="text" name="month" id="month" style="margin-right: 6px;" value="<?php if(isset($month)) echo $month;?>" >
                        <span style="font-weight: bold; margin-right: 6px;">Năm</span>
                        <input type="text" name="year" id="year" style="margin-right: 6px;" value="<?php if(isset($year)) echo $year;?>" >
                        <span class="btnbutton" onclick="document.frm_search.submit();">Xem báo cáo</span>
                        </form>
                    </td>
                </tr>                
            </thead>
            <tbody class="text-center">
                <tr class="text-title">
                    <td style="width: 50px;">Số sao</td>
                    <td style="width: 100px;">Tên đăng nhập</td>                   
                    <td style="width: 120px;">Họ tên</td> 
                    <td style="width: 60px;">Giới tính</td>
                    <td style="width: 100px;">Số CMND</td>
                    <td style="width: 200px;">Địa chỉ</td>
                </tr>
                <?php 
                $i=1;
                if(isset($vip))
                foreach($vip as $key=>$level){ 
                    $n = count($level);
                    ?>
                <tr>                     
                    <td style="text-align:right; padding-right: 10px;" rowspan="<?php echo $n;?>"><?php echo $key;?></td>
                    <?php if(isset($level[0])){?>
                        <td><?php echo $level[0]->name;?></td>                    
                        <td style=" text-align: left; padding-left: 10px;"><?php echo $level[0]->fullname;?></td>
                        <td style=" text-align: left; padding-left: 10px;"><?php echo ($level[0]->sex==1)?'Nam':'Nữ';?></td>
                        <td style="text-align:right; padding-right: 10px;"><?php echo $level[0]->cmnd;?></td>
                        <td style=" text-align: left; padding-left: 10px;"><?php echo $level[0]->address;?></td>
                    <?php }?>
                </tr>
                <?php if($n>1){
                    for($j=1;$j<$n;$j++){
                    ?>
                <tr> 
                    <td><?php echo $level[$j]->name;?></td>                    
                    <td style=" text-align: left; padding-left: 10px;"><?php echo $level[$j]->fullname;?></td>
                    <td style=" text-align: left; padding-left: 10px;"><?php echo ($level[$j]->sex==1)?'Nam':'Nữ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo $level[$j]->cmnd;?></td>
                    <td style=" text-align: left; padding-left: 10px;"><?php echo $level[$j]->address;?></td>
                </tr>
                <?php }}?>
                <?php } ?>
            </tbody>
        </table> 

    </div><!-- form -->
    
    <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->