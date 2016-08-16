<h3 class="title-products"><?php echo $product->title;?></h3>
<div class="imgProducts"> 
    <!--Image room-->
    <div class="imgLarge">
    <div class="clearfix"><a href="<?php echo getUrl().$product->image;?>" class="jqzoom" rel='gal1' title="Zoom in"><img src="<?php echo getUrl().$product->image;?>" alt=""></a></div>
    </div>
    <br/>
    <div class="clearfix" >
    <ul id="thumblist" class="clearfix imgThumb" >
        <li><a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo getUrl().$product->image;?>',largeimage: '<?php echo getUrl().$product->image;?>'}"><img src='<?php echo getUrl().$product->image;?>'></a></li>
        <li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo getUrl().$product->image1;?>',largeimage: '<?php echo getUrl().$product->image1;?>'}"><img src='<?php echo getUrl().$product->image1;?>'></a></li>
        <li><a  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo getUrl().$product->image2;?>',largeimage: '<?php echo getUrl().$product->image2;?>'}"><img src='<?php echo getUrl().$product->image2;?>'></a></li>
    </ul>
    </div>
    <!--Image room--> 
</div>
<div class="commonInfo">
    <div class="price">Giá: <?php echo number_format($product->price_sell);?> vnđ</div>
    <div class="point">Điểm: <?php echo $product->price_sell*$product->bonus/1000;?>đ</div>
    <div class="clear"></div>
    
    <table>
    <tr>
        <td class="title">Hãng sản xuất:</td>
        <td><?php echo $product['Producer']['name'];?></td>
    </tr>
    <tr>
        <td class="title">Màu sắc:</td>
        <td><?php echo $product->color;?></td>
    </tr>
    <tr>
        <td class="title">Chất lượng:</td>
        <td><?php echo $product->quality;?></td>
    </tr>
    <tr>
        <td class="title">Xuất xứ:</td>
        <td><?php echo $product->origin;?></td>
    </tr>
    
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2"><a href="<?php echo getURL().'add-'.$product->id.'/'.$product->alias.'.html'?>"><img src="<?php echo Yii::app()->controller->module->registerImage('btn_order_1_click.gif')?>" alt="" /></a></td>
    </tr>
    <tr>
        <td colspan="2">hoặc</td>
    </tr>
    <tr>
        <td colspan="2"><a href="<?php echo getURL().'add-'.$product->id.'/'.$product->alias.'.html'?>"><img src="<?php echo Yii::app()->controller->module->registerImage('btn_order.gif')?>" alt="" /></a></td>
    </tr>
    </table>
</div>
<div class="clear"></div>
<div class="detailInfo">
    <div class="tab">
    <ul>
        <li><a href="" class="titleTab tab1 selected" title="#tab1">Chi tiết sản phẩm</a></li>
        <li><a href="" class="titleTab tab2" title="#tab2">Thông số kỹ thuật</a></li>
        <li><a href="" class="titleTab tab3" title="#tab3">Ý kiến khách hàng</a></li>
    </ul>
    <div id="tab1" class="contentTab tiny"> 
        <?php echo $product->content;?>
    </div>
    <div id="tab2" style="display:none;"  class="contentTab">
        <table class ="data-table">
            <tr>
                <th>Xuất xứ</th>
                <td class="data"><?php echo $product->origin;?></td>
            </tr>            
            <tr>
                <th>Loại</th>
                <td class="data"><?php echo $product->type;?></td>
            </tr>
            <tr>
                <th>Màu sắc</th>
                <td class="data"><?php echo $product->color;?></td>
            </tr>
            <tr>
                <th>Chất liệu</th>
                <td class="data"><?php echo $product->material;?></td>
            </tr>
            <tr>
                <th>Hãng sản xuất</th>
                <td class="data"><?php echo $product['Producer']['name'];?></td>
            </tr>
            <?php $otherfields = unserialize($product['fields']); 
            foreach($fields as $key=>$value){
                $value2='';
                if(isset ($otherfields[$key]))
                    if($value['type']=='select')
                    {
                       $listvl= unserialize($value['value']);
                       if(isset($listvl[$otherfields[$key]]))
                           $value2 = $listvl[$otherfields[$key]];
                    }
                    else
                        $value2 =$otherfields[$key];
            ?>
            <tr>
                <th><?php echo $value['name'];?></th>
                <td class="data"><?php echo $value2;?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div id="tab3" style="display:none;" class="contentTab">
        <form name ="frm_comment" method="post" action="<?php echo getUrl().'home/products/addcomment';?>">
            <table class="tbl-comment">
            <tr>
                <th>Nội dung</th>
                <td>
                    <textarea name="content"></textarea>
                </td>
            <tr>
            <tr>
                <td></td>
                <td class="capcha">
                    <?php $this->widget('CCaptcha', array(
                      'buttonLabel'=>'<br/>Tạo captcha mới',
                      'clickableImage'=>true,                      
                      'imageOptions'=>array('id'=>'captchaimg')
                      ));?>                    
                    <!-- <a href=""><img class="img_f5" src="<?php echo Yii::app()->controller->module->registerImage('refresh1.png')?>" alt=""/></a></td> -->
            </tr>
            <tr>
                <th>Mã bảo mật</th>
                <td><input type="text" name="captcha" />
                    <input type="hidden" name="product_id" value="<?php echo $product->id;?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td><a href="" class="post" onclick =" document.frm_comment.submit(); return false;">Gửi ý kiến</a></td>
            </tr>
            </table>
        </form>
        <br />
        <hr />
        <div class="list-comment">
        <h3>Ý kiến khách hàng: <span>(<?php echo count($comments);?> ý kiến)</span></h3>
        <ul>
            <?php foreach($comments as $comment){?>
            <li> <img src="http://livefyre-avatar.s3.amazonaws.com/a/1/1d2d809b8c6fd1593054b91acc0b4eaa/50.jpg" alt="dfdf">
            <div class="user-name">toothmastr</div>
            <div class="time">( <?php echo $comment->created;?> )</div>
            <div class="comment-content"> <?php echo $comment->content;?> </div>
            </li>
            <?php } ?>
        </ul>
        </div>
        <!--List comment--> 
    </div>
    <!--Tab 3--> 
    </div>
    <!--Tab--> 
</div>
<!--DetailInfo-->