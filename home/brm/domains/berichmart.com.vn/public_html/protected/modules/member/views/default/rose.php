<?php echo $this->renderPartial('detail_member_rose',array('member'=>$member));?>
<div class="box-right box-common box-common-table nobdr">
    <table class="table-member" border="0" cellspacing="0">
        <thead>
        <tr><td colspan="5">Hoa hồng cơ bản</td></tr>
    </thead>
    <tbody class="text-center">
        <tr class="title">
                <td>Stt</td>
            <td>Loại hoa hồng</td>
            <td>Tổng hoa hồng (VNĐ)</td>
            <td>Hoa hồng thực lĩnh (VNĐ)</td>
            <td></td>
        </tr>
         <tr>
                <td>1</td>
            <td class="text-left">Hoa hồng tiêu dung</td>
            <td class="text-right"><?php echo number_format($data['hoahongtieudung']);?></td>
            <td class="red text-right"><?php echo number_format($data['hoahongtieudung']);?></td>
                <td></td>
        </tr>
        <tr>
                <td>2</td>
            <td class="text-left">Hoa hồng thụ động</td>
            <td class="text-right"><?php echo number_format($data['buying']['total']['totalrose']);?></td>
            <td class="red text-right"><?php echo number_format($data['buying']['total']['success']);?></td>
            <td><a href="<?php echo getURL().'member/default/roseBuying/'.$member->id;?>" style="text-decoration:underline;" class="blue">Xem chi tiết</a></td>
        </tr>
        <tr>
                <td>3</td>
            <td class="text-left">Hoa hồng hỗ trợ phát triển hệ thống</td>
            <td class="text-right"><?php echo number_format($data['offline']['total']['sum']);?></td>
            <td class="red text-right"><?php echo number_format($data['offline']['total']['success']);?></td>
                <td><a href="<?php echo getURL().'member/default/roseOffline/'.$member->id;?>" style="text-decoration:underline;" class="blue">Xem chi tiết</a></td>
        </tr>
        <tr>
                <td>4</td>
            <td class="text-left">Hoa hồng phát triển hệ thống</td>
            <td class="text-right"><?php echo number_format($data['online']['total']['sum']);?></td>
            <td class="red text-right"><?php echo number_format($data['online']['total']['success']);?></td>
                <td><a href="<?php echo getURL().'member/default/roseOnline/'.$member->id;?>" style="text-decoration:underline;" class="blue">Xem chi tiết</a></td>
        </tr>        
        <tr>
                <td colspan="2" align="right"><b>Tổng số:</b></td>
            <td class="text-right"><?php echo number_format(($data['buying']['total']['totalrose']+$data['offline']['total']['sum']+$data['online']['total']['sum']+$data['hoahongtieudung']));?></td>
            <td class="red text-right"><?php echo number_format(($data['buying']['total']['success']+$data['offline']['total']['success']+$data['online']['total']['success']+$data['hoahongtieudung']));?></td>
                <td></td>
        </tr>
        <tr>
            <td colspan="5"><input type="submit" value="Quay lại" onclick="window.history.back();"></td>
        </tr>
    </tbody>
    </table>
</div>