<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
    <table class="table-member" border="0" cellspacing="0" style="margin-top: 0px;">
        <thead>
        <tr><td colspan="5">Nâng cấp lên thành viên chính thức</td></tr>
    </thead>
    <tbody>
        <tr class="title">
                <td>Thông báo</td>
                <td>Số tiền sẽ bị trừ trong tài khoản của quý khách là : <span style="color:red;"><?php echo number_format($money).' vnđ'; ?></span></td>
        </tr>
        <tr>
            <td>Xử lý</td>
            <td>
                <form method="post">
                    <input name="update" type="hidden" value="1">
                <input type="submit" value="Nâng cấp">
                </form>
            </td>
        </tr>
    </tbody>
    </table>
</div>