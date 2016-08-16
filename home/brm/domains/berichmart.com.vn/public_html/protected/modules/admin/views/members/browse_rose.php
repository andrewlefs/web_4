<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Duyệt hoa hông thành viên tháng <?php echo date('m/Y');?></p>
    
</div><!--.top-main-->
<div class="middle-main">
    <div class="form info_member report">        
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form" class="member-table">            
            <tbody class="text-center">
                <tr class="text-title">
                    <td style="width: 140px;">Tên đăng nhập</td>                   
                    <td >Họ tên</td>
                    <td style="width: 140px;">Điểm HT</td>
                    <td style="width: 140px;">Điểm tích lũy</td>
                    <td style="width: 140px;">Điểm khuyễn mãi</td>
                </tr>
                <?php 
                if(isset($data))
                foreach($data as $item){?>
                <tr>  
                    <td><?php echo $item['Member']->name;?></td>
                    <td style="text-align:left; padding-left: 10px;"><?php echo $item['Member']->fullname;?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($item['HoaHong']['diemthanhvien']).' điểm';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo $item['Member']->money.' điểm';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo number_format($item['HoaHong']['my_km']).' điểm';?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table> 

    </div><!-- form -->    
    
    
    <div class="cleare-fix"></div>    
</div><!--.middle-main-->
