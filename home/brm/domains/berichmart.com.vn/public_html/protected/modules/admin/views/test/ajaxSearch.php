<style>
    .product{
        float:left;
    }
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
<div class="information" style="margin-top: 20px; margin-bottom: 20px;"><div id="flashMessage" class="message">Ket qua tim kiem</div></div>
<ul class="product">
    <?php
    foreach($data as $pro){?>
    <li>
        <img src="<?php echo getURL().$pro->image;?>">
        <p class="title-pro"><?php echo $pro->title;?></p>
        <a href="<?php echo getURL().'test/addshopingcart/'.$pro->id;?>"><p class="button">dat mua</p></a>
    </li>
    <?php } ?>
</ul>
<?php $this->widget("CLinkPager",array('pages'=>$pages));?>      
