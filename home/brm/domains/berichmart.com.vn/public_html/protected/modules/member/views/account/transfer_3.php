<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
    <!-- .title -->
    <form action="" method="post" accept-charset="utf-8" id="myform" class="cssform">
    <input type="hidden" name="txtMa" value="135"  class="text"/>
    <table width="100%" border="0" style="margin-top:0;" cellspacing="1" cellpadding="0" class="table-form table-member style2">
        <thead>
            <tr>
                <td colspan="2">Chuyển khoản</td>
            </tr>
        </thead>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical" style="width:220px;">Tài khoản trích nợ:</td>
            <td align="left" valign="top">
                <?php echo $transfer['data']['account_send'];?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Số dư tài khoản trích nợ hiện tại:</td>
            <td align="left" valign="top">
                <?php echo number_format($transfer['account_send']['money']).' VNĐ';?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Tài khoản ghi nợ:</td>
            <td align="left" valign="top">
                <?php echo $transfer['data']['account_get'];?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Tên chủ tài khoản ghi nợ:</td>
            <td align="left" valign="top" style="text-transform: capitalize; color: red; font-weight: bold;">
                <?php                 
                echo $member_get->fullname;?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Số tiền chuyển khoản:</td>
            <td align="left" valign="top" style="color: red; font-weight: bold;">
                <?php echo $transfer['data']['money'].' VNĐ';?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Nội dung thanh toán:</td>
            <td align="left" valign="top">
                <?php echo $transfer['data']['information'];?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Phí:</td>
            <td align="left" valign="top">
                Phí người chuyển trả
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Số tiền phí:</td>
            <td align="left" valign="top">
                0 VNĐ
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="top" class="title-vertical">Số điện thoại nhận tin:</td>
            <td align="left" valign="top">
                <?php echo $transfer['account_send']['mobile'];?>
            </td>
        </tr>
        <tr class="tr">
            <td align="left" valign="middle" class="title-vertical">Mã giao dịch:</td>
            <td align="left" valign="top">
                <input type="text" name="security">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="font-weight: bold; color: red;"><?php echo Yii::app()->session['status'];?></td>
        </tr>
        <tr>        
            <td align="left" valign="top" colspan="2"><div class="input">
                <input type="submit" name="btnSubmit" value="Xác nhận" class="btnSubmit button-form">
                <input type="button" name="btnReset" value="Quay lại" class="btnReset" id="btnReset button-form" onclick="window.history.back();">
                </div></td>
        </tr>
    </table>
    </form>
</div>