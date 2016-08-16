<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Danh sách thành viên bị phong tỏa số dư tài khoản</p>
    <!--
    <span id="in_excel" class="btnbutton" style="float: right; margin-top: -34px; margin-right: 10px;">In ra Excel</span>
    -->
</div><!--.top-main-->
<div class="middle-main">
    <div class="form info_member report">        
        <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form" class="member-table">           
            <tbody class="text-center">
                <tr class="text-title">
                    <td style="width: 50px;">Số TT</td>
                    <td style="width: 100px;">Tên đăng nhập</td>                   
                    <td style="width: 120px;">Họ tên</td>
                    <td style="width: 100px;">Số tài khoản</td> 
                    <td style="width: 60px;">Giới tính</td>
                    <td style="width: 100px;">Số CMND</td>
                    <td style="width: 200px;">Địa chỉ</td>
                </tr>
                <?php 
                $i=1;
                if(isset($card_acounts))
                foreach($card_acounts as $account){    
                    ?>
                <tr> 
                    
                    <td style="text-align:right; padding-right: 10px;"><?php echo $i; $i++;  ?></td>
                    <td><?php echo $account->Member['name'];?></td>                    
                    <td style=" text-align: left; padding-left: 10px;"><?php echo $account->Member['fullname'];?></td>
                    <td><?php echo $account->numberaccount;?></td>
                    <td style=" text-align: left; padding-left: 10px;"><?php echo ($account->Member['sex']==1)?'Nam':'Nữ';?></td>
                    <td style="text-align:right; padding-right: 10px;"><?php echo$account->Member['cmnd'];?></td>
                    <td style=" text-align: left; padding-left: 10px;"><?php echo $account->Member['address'];?></td>
                </tr>
                <?php } ?>
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