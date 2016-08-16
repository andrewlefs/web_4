<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
<div class="title-box">Danh sách thẻ</div>
<table class="table-member table-member2" border="0" cellspacing="0">
    <thead>
    <tr><td colspan="3">Thông tin thẻ</td></tr>
</thead>
<tbody>
    <tr class="title">
            <td>Tên thẻ</td>
        <td>Số thẻ</td>
        <td>Số tài khoản thẻ</td>
    </tr>
    <tr style="color: #0073AE;">
            <td style="text-transform:uppercase"><?php echo $member->fullname;?></td>
        <td><?php echo createNumberCard($member->CardAccount['numbercard']);?></td>
        <td><?php echo createNumberCard($member->CardAccount['numberaccount']);?></td>
    </tr>
</tbody>
</table>

</div>