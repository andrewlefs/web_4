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
<style>
    .list-tinrao {
    padding-top: 0px !important;
}
.paging {
    margin-bottom: 0px !important;
}
</style>
<div class="content-right">
<div class="list-tinrao">
    <div class="paging">
        <?php $this->widget("CLinkPager",array('pages'=>$pages,'nextPageLabel'=>'Sau','prevPageLabel'=>'Trước','firstPageLabel'=>"Đầu tiên",'lastPageLabel'=>'Cuối cùng','header'=>'','footer'=>''));?> 
    </div>
    <div class="total-news" style="margin-bottom:10px;">Có tổng số <span class="red"><?php echo $countnews;?></span> tin rao vặt trên toàn quốc</div>
    <div class="filter-products-list">
    <div class="nhucau"><span style="float:left;">Nhu cầu: &nbsp;&nbsp;</span><a href="<?php echo getURL().'rao-vat-cat'.'-'.$this->cat->id.'/'.$this->cat->alias;?>" class="current">Tất cả</a><a href="<?php echo getURL().'rao-vat-search'.'-'.$this->cat->id.'/'.$this->cat->alias;?>?type=1">Cần mua</a><a href="<?php echo getURL().'rao-vat-search'.'-'.$this->cat->id.'/'.$this->cat->alias;?>?type=2">Cần bán</a><a href="<?php echo getURL().'rao-vat-search'.'-'.$this->cat->id.'/'.$this->cat->alias;?>?type=3">Cần thuê</a><a href="<?php echo getURL().'rao-vat-search'.'-'.$this->cat->id.'/'.$this->cat->alias;?>?type=4">Cho thuê</a></div>
    <div class="location">
    <select id="city_s" class="form_control" onchange="window.location='<?php echo getURL().'rao-vat-search'.'-'.$this->cat->id.'/'.$this->cat->alias;?>?city_id='+this.value;">
        <option title="Toàn quốc" value="">Toàn quốc</option>
        <?php foreach($cities as $city){?>
        <option title="<?php echo $city->name;?>" value="<?php echo $city->id;?>"><?php echo $city->name;?></option>
        <?php }?>
    </select>
    </div><!--Location-->
    </div><!--Filter Products-->
    <ul class="list-tinraovat">
        <?php
         $current =mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));   
        foreach($adnews as $news)   {
            $created= mktime(date('H',strtotime($news->created)),date('i',strtotime($news->created)),date('s',strtotime($news->created)),date('m',strtotime($news->created)),date('d',strtotime($news->created)),date('Y',strtotime($news->created)));
            $time = $current-$created; 
            ?>
        <li>
            <a href="<?php echo getURL().'rao-vat-'.$news->id.'/'.$news->alias.'.html';?>" class="img-products"><img src="<?php echo getURL().$news->image;?>" alt="<?php echo $news->title;?>" /></a>
            <a href="" class="noidang">HN:</a>
            <a href="<?php echo getURL().'rao-vat-'.$news->id.'/'.$news->alias.'.html';?>" class="tieude"><?php echo $news->title;?></a>
            <div class="summary"><?php echo $news->introduction;?></div>
            <a href="<?php echo getURL().'rao-vat-member-'.$news->member_id;?>?cat=<?php echo $this->cat->id;?>" class="nguoidang"><?php echo $news['Member']['name'];?></a> <span class="ngaydang"><?php echo getTimeAgo($time);?>trước trong</span> <a href="" class="mucdang"><?php echo $news['Category']['name'];?></a>
        </li>
        <?php }?> 
    </ul>
    <br style="clear:both;"/><br /><br />
    <div class="paging">
        <?php $this->widget("CLinkPager",array('pages'=>$pages,'nextPageLabel'=>'Sau','prevPageLabel'=>'Trước','firstPageLabel'=>"Đầu tiên",'lastPageLabel'=>'Cuối cùng','header'=>'','footer'=>''));?> 
    </div>
</div><!--List tin rao-->
</div><!--content right-->
<script>
    $(function(){
        $('.list-tinraovat li:last').addClass('nobdr');
        <?php if(isset($_GET['city_id'])) {?>      
        $('#city_s option').each(function(){
            if($(this).val()=='<?php echo $_GET['city_id'];?>')
                $(this).attr('selected','selected');
        });
        <?php } ?>
        <?php if(isset($_GET['type'])) {?> 
            $('.nhucau a').removeClass('current');
            switch('<?php echo $_GET['type'];?>'){
                case '1':
                    $('.nhucau a:eq(1)').addClass('current');
                    break;
                case '2':
                    $('.nhucau a:eq(2)').addClass('current');
                    break;
                case '3':
                    $('.nhucau a:eq(3)').addClass('current');
                    break;
                case '4':
                    $('.nhucau a:eq(4)').addClass('current');
                    break;
            }
        <?php }?>
    });
</script>