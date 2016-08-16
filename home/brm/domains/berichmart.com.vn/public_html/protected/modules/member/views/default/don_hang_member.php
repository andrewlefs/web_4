<div class="cotmain">
    <div class="tieude">
            <h2>Danh sách đơn hàng của thành viên : <?php echo $member->fullname;?></h2>            
    </div>
        <div class="thongtin-ct">
            <table style="margin-top:0; border-collapse:collapse;" border="0" cellspacing="0" class ="detail_table">
                <thead>
                <tr>
                    <td>Mã đơn</td>
                    <td>Tổng điểm bán</td>
                    <td>Tổng điểm HT</td>
                    <td>Tổng điểm KM</td>
                    <td>Trạng thái</td>
                    <td>Ngày làm đơn</td>
                    <td>Chi tiết</td>
                </tr>
                </thead>
                <tbody class="text-center">
                    
                    <?php foreach($data as $item){                            
                            $products = !empty($item['products'])?unserialize($item['products']):''; // pr($products); die;
                            $sodiem=$sodiem_km=0;
                            foreach ($products as $pro){
                                $sodiem += $pro['sl']*$pro['sodiem'];
                                $sodiem_km += $pro['sl']*$pro['sodiem_km'];
                            }
                            ?>
                    <tr>
                        <td><?=$item->id;?></td>
                        <td><?php echo $item->total.' Điểm';?></td>
                        <td><?php echo $sodiem.' Điểm';?></td>
                        <td><?php echo $sodiem_km.' Điểm';?></td>
                        <td>
                            <?=($item->status==0)?'Chưa xử lý':'Đã xử lý';?>
                         </td>
                        <td><?php echo date('d/m/Y',  strtotime($item->created));?></td>
                        <td style="text-align: center;"><a href="<?php echo getURL().'member/default/viewDH/'.$item->id;?>">Chi tiết</a></td>
                    </tr>   
                    <?php }?>                    
                </tbody>                
            </table>
            </div>
    <div style=" padding-top: 18px;"></div>
    <div class="phantrang">
        <?php $this->widget("CLinkPager",array('pages'=>$pages,'nextPageLabel'=>'Sau','prevPageLabel'=>'Trước','firstPageLabel'=>"Đầu tiên",'lastPageLabel'=>'Cuối cùng','header'=>'','footer'=>''));?> 
    </div>
</div><!--ecotmain-->