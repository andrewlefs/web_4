<style>
    .detail_table tbody tr td{text-align: center !important;}
</style>
<div class="cotmain">
    <div class="tieude">
            <h2>Thành viên <span style="color:red;"><?php echo $member->fullname.'</span> '.$data['thang'].'/'.$data['nam'];?></h2>            
    </div>
        <div class="thongtin-ct">
            <table style="margin-top:0; border-collapse:collapse;" border="0" cellspacing="0" class ="detail_table">
                <thead>
                <tr>
                    <td>Số lượng</td>
                    <td>Tổng điểm khuyễn mại</td>
                    <td>Tổng điểm sản phẩm</td>
                </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td><?php echo $data['my_product_count'];?></td>
                        <td ><?php echo $data['my_km'];?></td>
                        <td ><?php echo $data['my_product_diem'];?></td>
                    </tr>        
                                    
                </tbody>                
            </table>
            </div>
</div><!--ecotmain-->