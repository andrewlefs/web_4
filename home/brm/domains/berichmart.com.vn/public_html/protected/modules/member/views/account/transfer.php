<div class="box-right box-common box-common-table" style="max-height:none;">
    <div class="title-box">Chuyển khoản</div>
    <!-- .title -->
    <form action="" method="post" accept-charset="utf-8" id="myform" class="cssform">
    <input type="hidden" name="txtMa" value="135"  class="text"/>
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table-form">
    <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtMatKhauCu">Tài khoản trích nợ:</label></td>
        <td align="left" valign="top">
            <select class="text droplist" name="data[account_send]">
                <?php foreach($account as $account){?>    
                <option value="<?php echo $account->numberaccount; ?>"><?php echo createNumberCard($account->numberaccount); ?></option>
                <?php } ?>
            </select>
        </td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtMatKhauCu">Tài khoản ghi nợ:</label></td>
        <td align="left" valign="top">
            <select class="text droplist" name="data[account_get]">
                <?php foreach($others as $other){?>    
                <option value="<?php echo $other->numberaccount; ?>"><?php echo createNumberCard($other->numberaccount); ?></option>
                <?php } ?>
            </select>
        </td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtXacNhanMatKhau">Số tiền:</label></td>
        <td align="left" valign="top"><div class="input">
            <input id="moneyformat" type="text" name="data[money]" value="" autocomplete="off" class="text" id="txtXacNhanMatKhau"  />
            </div></td>
        </tr>
        <tr class="tr">
        <td align="left" valign="top" class="title"><label for="txtXacNhanMatKhau">Nội dung thanh toán:</label></td>
        <td align="left" valign="top"><div class="input">
            <input type="text" name="data[information]" value="" autocomplete="off" class="text" id="infomation"  />
            </div></td>
        </tr>
        <tr>
        <td></td>
        <td align="left" valign="top"><div class="input">
            <input type="submit" name="btnSubmit" value="Xác nhận" class="btnSubmit button-form">
            <input type="reset" name="btnReset" value="Quay lại" class="btnReset" id="btnReset button-form">
            </div></td>
        </tr>
    </table>
    </form>
</div>
<script>
    $(function(){
        $('#moneyformat').keyup(function(){
            if($(this).val().length>3){
                $.post('<?php echo getURL().'member/account/createNumber';?>',{'number':this.value}, function(data){                    
                   $('#moneyformat').val(data);
                });
            }
        });
        
        $('#myform').submit(function(){
            if($('#moneyformat').val()=='')
             {
                 alert('Chưa nhập số tiền');
                 return false;
             }
             if($('#infomation').val()=='')
             {
                 alert('Chưa nhập nội đung thanh toán');
                 return false;
             }
             
             return true;
        });
    });
</script>