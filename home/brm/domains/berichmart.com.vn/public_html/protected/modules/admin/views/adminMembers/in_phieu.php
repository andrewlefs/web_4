<div id="noidung"> 
    <div class="congtyinfo">
        <P><?php echo $setting->name;?></p>
        <p>Địa chỉ : <?php echo $setting->address;?></p>
        <p>Điện thoại : <?php echo $setting->phone;?></p>
        <p>Fax : <?php echo $setting->fax;?></p>
    </div> 
    <div class="title"><?php echo Yii::app()->session['updateMoney']['title'];?></div>
    <div id="content">
        <table class="ndcontent">
            <tr>
                <td width="140">Mã phiếu :</td>
                <td><?php echo $update['id'];?></td>
            </tr>
            <tr>
                <td><?php echo (Yii::app()->session['updateMoney']['action']==1)?'Người nộp':'Người rút';?> :</td>
                <td><?php echo $member->fullname;?></td>
            </tr>
            <tr>
                <td>Tên đăng nhập :</td>
                <td><?php echo $member->name;?></td>
            </tr>
            <tr>
                <td>Số CMTND :</td>
                <td><?php echo $member->cmnd;?></td>
            </tr>
            <tr>
                <td>Số tài khoản :</td>
                <td><?php echo createNumberCard($update['numberaccount']);?></td>
            </tr>
            <tr>
                <td>Số tiền :</td>
                <td><?php echo number_format($update['money']).'VNĐ';?> <br>
                    <span style="font-style: italic; text-transform:capitalize;"><?php  echo doiSoThanhChu($update['money']);?></span>
                </td>
            </tr>
            <tr>
                <td>Mô tả :</td>
                <td><?php echo $update['information'];?></td>
            </tr>
        </table>
        <p class="ngay">Ngày lập phiếu : <?php echo date('d/m/Y H:i:s',  strtotime($update['created']));?></p>
        <ul class="ky">
            <?php if(Yii::app()->session['updateMoney']['action']==1){?>
                <li>Người nộp ký</li>
                <li>Người thu ký</li>
            <?php } else {?>
                <li>Người rút ký</li>
                <li>Người chi ký</li>
            <?php }?>
            <li>Kế toán ký</li>
        </ul>        
    </div>
</div>