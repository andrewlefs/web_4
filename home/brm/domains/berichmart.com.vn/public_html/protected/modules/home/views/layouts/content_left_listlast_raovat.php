<?php
$parent_id = isset($this->cat)?$this->cat->parent_id:252;
$listid = Category::model()->getListId($parent_id);
$count=Yii::app()->db->createCommand('select count(*) as sum from ad_news where category_id in ('.  implode(',', $listid).')')->queryRow();
$listcat = Category::model()->findAll('parent_id = '.$parent_id);
?>
<div class="content-left"> 
<div class="filter-products">
        <div class="total-products">Có <span class="red"><?php echo number_format($count['sum']);?></span> tin rao</div>
    <div class="sub-cat">
        <?php foreach($listcat as $cat){?>
        <a href="<?php echo getURL().'rao-vat-cat'.'-'.$cat->id.'/'.$cat->alias.'.html';?>">
            <img src="<?php echo Yii::app()->controller->module->registerImage('listudv_arrow_current.gif')?>" alt="<?php echo $cat->name;?>" />
            <?php echo $cat->name;?>
        </a>        
        <?php } ?>
    </div>
    <div class="clear"></div>
    <div class="price-search">
        <form method="post" action="<?php echo getURL().'home/adnews/searchprice/'.(isset($this->cat)?$this->cat->id:252);?>">
        <table>
                <tr>
                <td colspan="2"><div class="title">Tìm theo khoảng giá (VNĐ)</div></td>
            </tr>
                <tr>
                <td>Từ:</td>
                <td><input type="text" name="m_from" /></td>
            </tr>
            <tr>
                <td>Đến:</td>
                <td><input type="text" name="m_to" /></td>
            </tr>
                <tr>
                <td></td>
                <td><input type="submit" name="" value="Tìm sản phẩm"/></td>
            </tr>
        </table>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".filter-products .readmore").click(function(){
                                        $(this).parent().children(".info .full-info").toggle();
                                        if($(this).parent().children(".info .full-info").is(":visible")){
                                                $(this).text("Rút gọn");
                                                $(this).append('&nbsp<img src="images/icon_sort_up.gif" alt="" />');
                                        }
                                        else{
                                                $(this).text("Xem thêm");
                                                $(this).append('&nbsp<img src="images/icon_arrow_down.gif" alt="" />');
                                                }
                                        return false;
                                        });
        });
    </script>
    <div class="common-search">
        <ul>
                <li>
                <div class="title">Theo Tỉnh/Thành Phố</div>
                <div class="info">
                        <ul>
                        <li><a href="">Hà Nội <span class="orange">(6466)</span></a></li>
                        <li><a href="">Hải Phòng <span class="orange">(64)</span></a></li>
                        <li><a href="">TP.HCM <span class="orange">(699)</span></a></li>
                        <li><a href="">Quảng Ngãi <span class="orange">(154)</span></a></li>
                    </ul>
                    <ul class="full-info" style="display:none;">
                        <li><a href="">Hà Nội <span class="orange">(6466)</span></a></li>
                        <li><a href="">Hải Phòng <span class="orange">(64)</span></a></li>
                        <li><a href="">TP.HCM <span class="orange">(699)</span></a></li>
                        <li><a href="">Quảng Ngãi <span class="orange">(154)</span></a></li>
                    </ul>
                    <a href="" class="readmore">Xem thêm&nbsp;<img src="images/icon_arrow_down.gif" alt="" /></a>
                </div>

            </li>
            <li>
                <div class="title">Hãng sản xuât</div>
                <div class="info">
                        <ul>
                        <li><a href="">Asus <span class="orange">(6466)</span></a></li>
                        <li><a href="">Acer <span class="orange">(64)</span></a></li>
                        <li><a href="">HP <span class="orange">(699)</span></a></li>
                        <li><a href="">Apple <span class="orange">(154)</span></a></li>
                        <li><a href="">Samsung <span class="orange">(154)</span></a></li>
                    </ul>
                    <ul class="full-info" style="display:none;">
                        <li><a href="">Asus <span class="orange">(6466)</span></a></li>
                        <li><a href="">Acer <span class="orange">(64)</span></a></li>
                        <li><a href="">HP <span class="orange">(699)</span></a></li>
                        <li><a href="">Apple <span class="orange">(154)</span></a></li>
                        <li><a href="">Samsung <span class="orange">(154)</span></a></li>
                    </ul>
                    <a href="" class="readmore">Xem thêm&nbsp;<img src="images/icon_arrow_down.gif" alt="" /></a>
                </div>

            </li>
            <li>
                <div class="title">Độ lớn màn hình</div>
                <div class="info">
                        <ul>
                        <li><a href="">>>15 inch <span class="orange">(6466)</span></a></li>
                        <li><a href="">>>16 inch <span class="orange">(64)</span></a></li>
                        <li><a href=""><<15 inch <span class="orange">(699)</span></a></li>
                        <li><a href=""><<14 inch <span class="orange">(154)</span></a></li>
                    </ul>
                    <a href="" class="readmore">Xem thêm&nbsp;<img src="images/icon_arrow_down.gif" alt="" /></a>
                </div>

            </li>
                <li>
                <div class="title">Loại CPU</div>
                <div class="info">
                        <ul>
                        <li><a href="">AMD <span class="orange">(6466)</span></a></li>
                        <li><a href="">Intel <span class="orange">(64)</span></a></li>
                    </ul>
                    <a href="" class="readmore">Xem thêm&nbsp;<img src="images/icon_arrow_down.gif" alt="" /></a>
                </div>
            </li>
        </ul>
    </div>
</div><!--Filter Products-->

</div><!--Content Left-->