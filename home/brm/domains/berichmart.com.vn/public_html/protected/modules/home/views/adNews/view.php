<style>
    ul.yiiPager li{
        width: auto !important;
        height: auto !important;
        margin: 0px !important;
        padding: 0px !important;
    }
    .list-tinraovat li .img-products img{
        max-width: 110px;
        max-height: 75px;
    }
</style>
<div class="title-news"><?php echo $news->title;?></div>
<div class="product-info">
    <div class="image"><img alt="" src="<?php echo getURl().$news->image;?>"></div>
    <table cellspacing="0" cellpadding="0" class="tbl-info-product">
    <tbody>
        <tr>
        <td class="title">Mã số:</td>
        <td><b>4190280</b></td>
        </tr>
        <tr>
        <td class="title">Giá:</td>
        <td><b style="font-size:16px;" class="red"><?php echo number_format($news->price);?>VND</b></td>
        </tr>
        <tr>
        <td class="title">Ngày đăng:</td>
        <td><?php echo $news->created;?></td>
        </tr>
        <tr>
        <td class="title">Update:</td>
        <td><?php echo $news->modified;?></td>
        </tr>
        <tr>
        <td class="title">Hết hạn:</td>
        <td><?php echo $news->expire;?></td>
        </tr>
        <tr>
        <td class="title">Nơi đăng:</td>
        <td><?php echo $news->City->name;?></td>
        </tr>
        <tr>
        <td class="title">Hình thức:</td>
        <td><?php switch($news->type){
            case 1:
                echo 'Cần mua';
                break;
            case 2:
                echo 'Cần bán';
                break;
            case 3:
                echo 'Cần thuê';
                break;
            case 4:
                echo 'Cho thuê';
                break;
            
        }
?></td>
        </tr>
        <tr>
        <td class="title">Tình trạng:</td>
        <td><?php echo $news->status2;?></td>
        </tr>
    </tbody>
    </table>
    <div class="tab">
    <ul>
        <li><a title="#tab1" class="titleTab tab1 selected" href="">Chi tiết sản phẩm</a></li>
        <li><a title="#tab3" class="titleTab tab3" href="">Ý kiến khách hàng</a></li>
    </ul>
    <div class="contentTab" id="tab1">
        <?php echo $news->content;?>    
    </div>
    <div class="contentTab" style="display:none;" id="tab3">
        <form name ="frm_comment" method="post" action="<?php echo getUrl().'home/adnews/addcomment';?>">
        <table class="tbl-comment">
        <tbody>
            <tr>
            <th>Nội dung</th>
            <td><textarea name="content"></textarea></td>
            </tr>
            <tr> </tr>
            <tr>
            <td></td>
            <td class="capcha">
                <?php $this->widget('CCaptcha', array(
                      'buttonLabel'=>'<img alt="" src="'.Yii::app()->controller->module->registerImage('refresh1.png').'" class="img_f5">',
                      'clickableImage'=>true,                      
                      'imageOptions'=>array('id'=>'captchaimg')
                      ));?> 
            </td>
            </tr>
            <tr>
            <th>Mã bảo mật</th>
            <td><input type="text" name="captcha">
                <input type="hidden" name="news_id" value="<?php echo $news->id;?>">
            </td>
            </tr>
            <tr>
            <td></td>
            <td><a class="post" href="" onclick =" document.frm_comment.submit(); return false;">Gửi ý kiến</a></td>
            </tr>
        </tbody>
        </table>
        </form>
        <br>
        <hr>
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
    </div><!--Tab--> 
    <div class="clear"></div>
    <div class="tinraokhac">
    <div class="title-box">Tin rao vặt khác</div>    
      <ul class="list-tinraovat">
       <?php foreach($other_news as $news)   {?>   
        <li>
            <a href="<?php echo getURL().'rao-vat-'.$news->id.'/'.$news->alias.'.html';?>" class="img-products"><img src="<?php echo getURL().$news->image;?>" alt="<?php echo $news->title;?>" alt="<?php echo $news->title;?>" /></a>
            <a href="" class="noidang">HN:</a>
            <a href="<?php echo getURL().'rao-vat-'.$news->id.'/'.$news->alias.'.html';?>" class="tieude"><?php echo $news->title;?></a>
            <div class="summary"><?php echo $news->introduction;?></div>
            <a href="" class="nguoidang"><?php echo $news['Member']['name'];?></a> <span class="ngaydang">1 phút trước trong</span> <a href="" class="mucdang"><?php echo $news['Category']['name'];?></a>
        </li>
        <?php }?> 
    </ul><!--List tin rao-->
    <!--
    <br style="clear:both;"/><br /><br />
    <div class="paging"><a href="">Trước</a><a href="">1</a><a href="" class="current">2</a><a href="">3</a><a href="">4</a><a href="">5</a><a href="">6</a><a href="">7</a><a href="">8</a><a href="">9</a><a href="">10</a><a href="">Sau</a></div>
    -->
</div><!--Tin rao khac-->
</div>
<script>
    $(function(){
        $('.list-tinraovat li:last').addClass('nobdr');
    });
</script>