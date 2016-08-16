<style>
    .product li{
        float: left;
        list-style-type: none;
        margin-right: 20px;
    }
    .product li img{
        width: 200px;
        height: 180px;
    }
    .product li p{
        margin-top: 5px;
    }
    .product li .button{
        background-color: #FF6633;
        color: #008200;
        font-weight: bold;
        font-size: 13px;
        text-align: center;
        line-height: 20px;
    }
</style>
<div class="top-main"><p>Demo tinh loi nhuan tieu dung va hoa hong thu dong</p></div><!--.top-main--> 
<div class="middle-main">
<form method="post" id="frm">
    <div class="information" style="margin-top: 20px; margin-bottom: 20px;">
        <div id="flashMessage" class="message">
            Khi nhap ma thanh vien va click nut mua hang , loi nhuan tieu dung va hoa hong thu dong se duoc tinh cho cac cap phia tren tam thời la 10 cấp (còn 1 số dk chưa lam)            
        </div>
        
    </div>
    <p style=" margin-bottom: 20px;">nhập mã thành viên mua hàng : <input type="text" id="member_id"></p>
<ul class="product">
    <?php
    foreach($data as $pro){?>
    <li>
        <img src="<?php echo getURL().$pro->image;?>">
        <p class="title-pro">Gía : <?php echo $pro->price_sell;?></p>
        <p class="title-pro">Triết khấu : <?php echo $pro->bonus;?></p>
        <p class="title-pro"><?php echo $pro->title;?></p>
        <a href="<?php echo getURL().'members/profit/'.$pro->id;?>"><p class="button">đặt mua de test hoa hồng</p></a>
    </li>
    <?php } ?>
</ul>
 <?php $this->widget("CLinkPager",array('pages'=>$pages));?>
</form>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->
<script>
    $(function(){        
            $('.product li a').click(function(){ 
                $(this).attr('href', $(this).attr('href')+'/'+ $('#member_id').val());
            });
    });        
</script>