<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
<table class="table-member style2" border="0" cellspacing="0" style="margin-top:0;">
        <thead>
        <tr>
                <td colspan="5">Danh sách thành viên giới thiệu trực tiếp</td>
        </tr>
    </thead>
    <tbody>
    <tr style="font-weight: bold; text-align: center;">
        <td>Số TT</td>
        <td>Họ tên</td>
        <td>Cấp</td>
        <td>Địa chỉ</td>
        <td>Ngày tham gia</td>
    </tr>  
    <?php $i=0; foreach ($listmember as $item){ ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $item->fullname;?></td>
        <td><?php echo ($item->level-$member->level);?></td>
        <td><?php echo $item->address;?></td>
        <td style="text-align: center;"><?php echo $item->created;?></td>
    </tr> 
    <?php }?>   
        </tbody>
</table>
</div>