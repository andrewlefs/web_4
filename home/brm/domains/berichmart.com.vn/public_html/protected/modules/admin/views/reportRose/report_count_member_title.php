<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Báo cáo tổng số thành viên theo danh hiệu</p>
    
</div><!--.top-main-->
<div class="middle-main">
    <div class="form info_member report">        
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form" class="member-table">
            <!--
            <thead class="text-center">
                <tr style="background: none;">
                    <td colspan="2"><span id="in_excel" class="btnbutton">In ra Excel</span></td>
                    <td colspan="3">                        
                    </td>
                </tr>                
            </thead>
            -->
            <tbody class="text-center">
                <tr class="text-title">
                    <td>TVKN</td>                   
                    <td>TVCT</td>
                    <td >TVTC</td>
                    <td>Silver</td>
                    <td>Gold</td>
                    <td>Vip 1</td>
                    <td>Vip 2</td>
                    <td>Vip 3</td>
                    <td>Vip 4</td>
                    <td>Vip 5</td>
                    <td>Ngày giờ xem</td>
                </tr>
                <?php 
                if(isset($result)){?>
                <tr>  
                    <td><?php echo $result['count_tvkn'];?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo $result['count_tvct'];?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo $result['count_tvtc'];?></td>
                    <td><?php echo $result['count_tvsilver'];?></td>
                    <td><?php echo $result['count_tvgold'];?></td>
                    <td><?php echo $result['count_tvvip1'];?></td>
                    <td><?php echo $result['count_tvvip2'];?></td>
                    <td><?php echo $result['count_tvvip3'];?></td>
                    <td><?php echo $result['count_tvvip4'];?></td>
                    <td><?php echo $result['count_tvvip5'];?></td>
                    <td><?php echo date('d/m/Y H:i:s');?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table> 

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
    $('#in_excel').click(function(){
        location.href= '<?php echo getURL();?>admin/report/reportTransfer?d_from='+$('#d_from').val()+'&&d_to='+$('#d_to').val();     
    });
});
</script>