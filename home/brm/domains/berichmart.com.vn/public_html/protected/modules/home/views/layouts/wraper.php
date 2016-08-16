<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo getURl().'images/logo.png';?>"/>
<?php echo Yii::app()->controller->module->registerCss('style.css');
if($layout=='detail'||$layout=='list'||$layout=='detail_rao_vat'||(isset($layout2)&&$layout2=='listlastraovat'))
    echo Yii::app()->controller->module->registerCss('detail-product-page.css');
if($layout=='detail_rao_vat')
   echo Yii::app()->controller->module->registerCss('chitietraovat.css'); 
?>
<link rel="stylesheet" href="<?php echo getURL().'tiny/tiny_mce/css/content_1.css';?>"/>
<!--[if IE]>
<style>.left-cat .category-detail{border:solid 1px #ccc;}</style>
<![endif]-->
<?php echo Yii::app()->controller->module->registerJs('jquery-1.6.js')?>
<?php if($layout=='detail' || $layout=='listproduct' || ( isset($layout2)&&$layout2=='detail_rao_vat')){?>
<script type="text/javascript">
	$(document).ready(function() {
        $(".tab a.titleTab").click(function(){
			var nameTab = $(this).attr("title");
			$(".contentTab").hide();
			$(nameTab).show();
			$(".tab a.titleTab").removeClass("selected");
			$(this).addClass("selected");
			return false;
		});
		
		$(".move-link a").click(function(){
			var heightMove = $(".detailInfo .tab").offset().top;
			$('html, body').animate({scrollTop:heightMove}, 'slow');
			return false;
    	});
		$(".move-link a.chitiet").click(function(){
			$(".contentTab").hide();
			$("#tab1").show();
			$(".tab a.titleTab").removeClass("selected");
			$(".tab1").addClass("selected");
			return false;
		});
		$(".move-link a.thongso").click(function(){
			$(".contentTab").hide();
			$("#tab2").show();
			$(".tab a.titleTab").removeClass("selected");
			$(".tab2").addClass("selected");
			return false;
		});
		$(".move-link a.ykien").click(function(){
			$(".contentTab").hide();
			$("#tab3").show();
			$(".tab a.titleTab").removeClass("selected");
			$(".tab3").addClass("selected");
			return false;
		});
	});
</script>

<?php } ?>

<script type="text/javascript">
	$(document).ready(function() { 
		$("li.root").mouseover(function(){
                $(this).children(".sub-category").show();
                $(this).children(".cat-name").addClass("orange");
                });
		$("li.root").mouseout(function(){
                $(this).children(".sub-category").hide();
                $(this).children(".cat-name").removeClass("orange");
                });
		});
</script>

<script type="text/javascript">
	$(document).ready(function(e) {
        $(".left-cat ul.lv1 li.lv1").mouseover(function(){
                $(this).addClass("selected");
                $(this).children(".category-detail").show();
                });
		$(".left-cat ul.lv1 li.lv1").mouseout(function(){
                $(this).removeClass("selected");
                $(this).children(".category-detail").hide();
                });
	
		$("#nav .main-cat .title a").click(function(){
                $(".cat-full").slideToggle("fast");
                return false;
                });
			
		$("body").click(function(){
                $(".cat-full").hide();
                });	
		
		$('.ontop').click(function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		return false;
		});
    });
</script>

 <script type="text/javascript">
        $(document).ready(function() {
                $(".cat-search ul").hide();
                $(".search-id").click(function(){
                $(".cat-search ul").toggle();
                });
			
                $(".cat-search ul li a").click(function(){
                $(".search-id").attr("value",$(this).text());
                $(".search-id-hidden").attr("value",$(this).attr("href"));
                $(".cat-search ul").hide();
                return false;
                });
        });
        </script>
<?php if($layout=='home'){?>
<script type="text/javascript">
	$(document).ready(function(){
		var w_left  = $(".content-left").width();
		var w_page = $(window).width() -100;
		var w_slide = $(".content-right .slide").width();
		$(".wrap-content").css("width",w_page);
		$(".content-right").css("width", w_page - w_left-10);
		$(".hot-products").css("width", w_page - w_left -w_slide -20);
		$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
                $("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);

		var w_contentRight = $(".content-right").width()-2;
		var w_sp = $(".content-right .box-right ul li").width()+30;
		var numberOfProducts = Math.floor(w_contentRight/w_sp);
		var w_space = w_contentRight - (w_sp*numberOfProducts);
		var w_paddingPlus = Math.floor(w_space /(numberOfProducts * 2));
		$(".content-right .box-right ul li").css("padding-left",15+w_paddingPlus);
		$(".content-right .box-right ul li").css("padding-right",15+ w_paddingPlus);

		var w_contentHotProducts = $(".content .content-right .hot-products").width()-2;
		var w_spHot = $(".content .content-right .hot-products ul li").width()+30;
		var numberOfHotProducts = Math.floor(w_contentHotProducts/w_spHot);
		var w_spaceHotProducts = w_contentHotProducts - (w_spHot*numberOfHotProducts);
		var w_paddingPlusHotProducts = Math.floor(w_spaceHotProducts /(numberOfHotProducts * 2));
		$(".content .content-right .hot-products ul li").css("padding-left",15+w_paddingPlusHotProducts);
		$(".content .content-right .hot-products ul li").css("padding-right",15+ w_paddingPlusHotProducts);

		$(window).resize(function() {
		w_page = $(window).width() -100;
		$(".wrap-content").css("width",w_page);
		wrap_left  = $(".left").width();
		$(".content-right").css("width", w_page - w_left-10);
		$(".hot-products").css("width", w_page - w_left -w_slide -20);
		$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
		$("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
		
		w_contentRight = $(".content-right").width()-2;
		w_sp = $(".content-right .box-right ul li").width()+30;
		numberOfProducts = Math.floor(w_contentRight/w_sp);
		w_space = w_contentRight - (w_sp*numberOfProducts);
		w_paddingPlus = Math.floor(w_space /(numberOfProducts * 2));
		$(".content-right .box-right ul li").css("padding-left",15+w_paddingPlus);
		$(".content-right .box-right ul li").css("padding-right",15+ w_paddingPlus);
		var w_contentHotProducts = $(".content .content-right .hot-products").width()-2;
		var w_spHot = $(".content .content-right .hot-products ul li").width()+30;
		var numberOfHotProducts = Math.floor(w_contentHotProducts/w_spHot);
		var w_spaceHotProducts = w_contentHotProducts - (w_spHot*numberOfHotProducts);
		var w_paddingPlusHotProducts = Math.floor(w_spaceHotProducts /(numberOfHotProducts * 2));
		$(".content .content-right .hot-products ul li").css("padding-left",15+w_paddingPlusHotProducts);
		$(".content .content-right .hot-products ul li").css("padding-right",15+ w_paddingPlusHotProducts);

		});
      
		
    });
</script>
<?php }else if($layout=='detail'){ ?>
<script type="text/javascript">
	$(document).ready(function(){
		var w_left  = $(".content-left").width();
		var w_page = $(window).width() -100;
		var w_slide = $(".content-right .slide").width();
		$(".wrap-content").css("width",w_page);
		$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
        $("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
		$(".wrap-content .content-left").css("width", $(".wrap-content").width() - $(".wrap-content .content-right").width() - 10); 
		$(".detailProductPage .commonInfo").css("width",$(".wrap-content .content-left").width() - $(".imgProducts").width() - 40);
		


		$(window).resize(function() {
		w_page = $(window).width() -100;
		$(".wrap-content").css("width",w_page);
		$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
		$("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
		$(".wrap-content .content-left").css("width", $(".wrap-content").width() - $(".wrap-content .content-right").width() - 10); 
		$(".detailProductPage .commonInfo").css("width",$(".wrap-content .content-left").width() - $(".imgProducts").width() - 40);
		});
      
		
    });
</script>
<?php } else if($layout == 'list'){?>
    <script type="text/javascript"> 
            $(document).ready(function(){
                    var w_left  = $(".content-left").width();
                    var w_page = $(window).width() -100;
                    var w_slide = $(".content-right .slide").width();
                    $(".wrap-content").css("width",w_page);
                    $("#nav .nav-center").css("width",$(".wrap-content").width()-10);
                    $("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
                    $(".wrap-content .content-left").css("width", $(".wrap-content").width() - $(".wrap-content .content-right").width() - 10); 

                    var w_listProducts = $(".content-left").width()-2;
                    var w_sp = $(".content-left .list-products ul li").width()+30;
                    var numberOfProductsList = Math.floor(w_listProducts/w_sp);
                    var w_spaceProductsList = w_listProducts - (w_sp*numberOfProductsList);
                    var w_paddingPlusList = Math.floor(w_spaceProductsList /(numberOfProductsList * 2));
                    $(".content-left .list-products ul li").css("padding-left",15+w_paddingPlusList);
                    $(".content-left .list-products ul li").css("padding-right",15+ w_paddingPlusList);
                    $(window).resize(function() {
                    w_page = $(window).width() -100;
                    $(".wrap-content").css("width",w_page);
                    $("#nav .nav-center").css("width",$(".wrap-content").width()-10);
                    $("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
                    $(".wrap-content .content-left").css("width", $(".wrap-content").width() - $(".wrap-content .content-right").width() - 10); 

                    var w_listProducts = $(".content-left").width()-2;
                    var w_sp = $(".content-left .list-products ul li").width()+30;
                    var numberOfProductsList = Math.floor(w_listProducts/w_sp);
                    var w_spaceProductsList = w_listProducts - (w_sp*numberOfProductsList);
                    var w_paddingPlusList = Math.floor(w_spaceProductsList /(numberOfProductsList * 2));
                    $(".content-left .list-products ul li").css("padding-left",15+w_paddingPlusList);
                    $(".content-left .list-products ul li").css("padding-right",15+ w_paddingPlusList);
                    });


        });
    </script>
<?php } else if($layout =='listproduct'){?>
<script type="text/javascript">
	$(document).ready(function(){
		var w_left  = $(".content-left").width();
		var w_page = $(window).width() -100;
		var w_slide = $(".content-right .slide").width();
		$(".wrap-content").css("width",w_page);
		$(".content-right").css("width", w_page - w_left-10);
		$(".hot-products").css("width", w_page - w_left -w_slide -20);
		$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
        $("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
	
		var w_contentRight = $(".content-right").width()-2;
		var w_sp = $(".content-right .box-right ul li").width()+30;
		var numberOfProducts = Math.floor(w_contentRight/w_sp);
		var w_space = w_contentRight - (w_sp*numberOfProducts);
		var w_paddingPlus = Math.floor(w_space /(numberOfProducts * 2));
		$(".content-right .box-right ul li").css("padding-left",15+w_paddingPlus);
		$(".content-right .box-right ul li").css("padding-right",15+ w_paddingPlus);

		var w_contentHotProducts = $(".content .content-right .hot-products").width()-2;
		var w_spHot = $(".content .content-right .hot-products ul li").width()+30;
		var numberOfHotProducts = Math.floor(w_contentHotProducts/w_spHot);
		var w_spaceHotProducts = w_contentHotProducts - (w_spHot*numberOfHotProducts);
		var w_paddingPlusHotProducts = Math.floor(w_spaceHotProducts /(numberOfHotProducts * 2));
		$(".content .content-right .hot-products ul li").css("padding-left",15+w_paddingPlusHotProducts);
		$(".content .content-right .hot-products ul li").css("padding-right",15+ w_paddingPlusHotProducts);


		$(window).resize(function() {
		w_page = $(window).width() -100;
		$(".wrap-content").css("width",w_page);
		wrap_left  = $(".left").width();
		$(".content-right").css("width", w_page - w_left-10);
		$(".hot-products").css("width", w_page - w_left -w_slide -20);
		$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
		$("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);

		w_contentRight = $(".content-right").width()-2;
		w_sp = $(".content-right .box-right ul li").width()+30;
		numberOfProducts = Math.floor(w_contentRight/w_sp);
		w_space = w_contentRight - (w_sp*numberOfProducts);
		w_paddingPlus = Math.floor(w_space /(numberOfProducts * 2));
		$(".content-right .box-right ul li").css("padding-left",15+w_paddingPlus);
		$(".content-right .box-right ul li").css("padding-right",15+ w_paddingPlus);
	
		var w_contentHotProducts = $(".content .content-right .hot-products").width()-2;
		var w_spHot = $(".content .content-right .hot-products ul li").width()+30;
		var numberOfHotProducts = Math.floor(w_contentHotProducts/w_spHot);
		var w_spaceHotProducts = w_contentHotProducts - (w_spHot*numberOfHotProducts);
		var w_paddingPlusHotProducts = Math.floor(w_spaceHotProducts /(numberOfHotProducts * 2));
		$(".content .content-right .hot-products ul li").css("padding-left",15+w_paddingPlusHotProducts);
		$(".content .content-right .hot-products ul li").css("padding-right",15+ w_paddingPlusHotProducts);
	
		});
      
		
    });
</script>
<?php } else if(!isset($layout2)||$layout2!='detail_rao_vat'){ ?>
<script type="text/javascript">
	$(document).ready(function(){
		var w_left  = 210;
		var w_page = $(window).width() -100;
		$(".wrap-content").css("width",w_page);
		$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
        $("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
		$(".regiter-page #formdangky").css("width", $(".wrap-content").width() - $(".regiter-page .adv-right").width() - 40);

		$(window).resize(function() {
		w_page = $(window).width() -100;
		$(".wrap-content").css("width",w_page);
		$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
        $("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
		$(".regiter-page #formdangky").css("width", $(".wrap-content").width() - $(".regiter-page .adv-right").width() - 40);
		
		});
      
		
    });
</script>
<?php } else {?>
<script type="text/javascript">
	$(document).ready(function(){
		var w_left  = $(".content-left").width();
		var w_page = $(window).width() -100;
		var w_slide = $(".content-right .slide").width();
		$(".wrap-content").css("width",w_page);
		$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
        $("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
		$(".wrap-content .content-left").css("width", $(".wrap-content").width() - $(".wrap-content .content-right").width() - 10); 
		$(".chitiet-raovat .product-info .tab").css("width", $(".wrap-content .content-left").width());
		$(".chitiet-raovat .product-info").css("width", $(".wrap-content .content-left").width());
		
		
		$(window).resize(function() {
		w_page = $(window).width() -100;
		$(".wrap-content").css("width",w_page);
		$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
		$("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
		$(".wrap-content .content-left").css("width", $(".wrap-content").width() - $(".wrap-content .content-right").width() - 10); 
		$(".chitiet-raovat .product-info .tab").css("width", $(".wrap-content .content-left").width());
		$(".chitiet-raovat .product-info").css("width", $(".wrap-content .content-left").width());
		});
      
		
    });
</script>
<?php } ?>
<?php if($layout=='detail'){?>
    <?php 
    echo Yii::app()->controller->module->registerJs('jquery.jqzoom-core.js');  
    echo Yii::app()->controller->module->registerCss('jquery.jqzoom.css');    
    ?>    
    <script type="text/javascript">
    $(document).ready(function() {
            $('.jqzoom').jqzoom({
                zoomType: 'standard',
                lens:true,
                preloadImages: false,
                alwaysOn:false
            });
            });
    </script>
<?php } ?>
<title>::BeRichMart::</title>
<?php echo Yii::app()->controller->module->registerJs('jquery.jcarousel.min.js')?>
<?php echo Yii::app()->controller->module->registerJs('interface.js')?>
<?php 
    echo Yii::app()->controller->module->registerCss('skin.css');
    echo Yii::app()->controller->module->registerCss('skin-km.css');
    echo Yii::app()->controller->module->registerCss('skin-slide-logo.css');
?>
<script type="text/javascript">
function mycarousel_initCallback(carousel){
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};

<?php if($layout!='home'){?>
jQuery(document).ready(function() {
    jQuery('#home-manufacturers').jcarousel({
        auto: 2,
        wrap: 'last',
        initCallback: mycarousel_initCallback
    });
});
<?php } else{ ?>
jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
        auto: 2,
        wrap: 'last',
        initCallback: mycarousel_initCallback
    }); 
});

jQuery(document).ready(function() {
    jQuery('#mycarousel-km').jcarousel({
        wrap: 'last',
        initCallback: mycarousel_initCallback
    });
});   
<?php } ?>

</script>

</head>
<body>
<div id="wrap">
  <?php
  $this->renderPartial('/layouts/menutop');
  $this->renderPartial('/layouts/header');
  if(Yii::app()->controller->id != 'news')
  	$this->renderPartial('/layouts/navi');
  ?> 
  <?php echo $content;?>
  <?php
  $this->renderPartial('/layouts/footer');
  ?>
</div>
<?php if($layout=='home'){?>
<script type="text/javascript">
	var currentImage;
    var currentIndex = -1;
    var interval;
    function showImage(index){
        if(index < $('#bigPic img').length){
        	var indexImage = $('#bigPic img')[index]
            if(currentImage){   
            	if(currentImage != indexImage ){
                    $(currentImage).css('z-index',2);
                    clearTimeout(myTimer);
                    $(currentImage).fadeOut(1000, function() {
                    myTimer = setTimeout("showNext()", 3000);
                    $(this).css({'display':'none','z-index':1})
                });
                }
            }
            $(indexImage).css({'display':'block', 'opacity':1});
            currentImage = indexImage;
            currentIndex = index;
            $('#thumbs li').removeClass('active');
            $($('#thumbs li')[index]).addClass('active');
        }
    }
    
    function showNext(){
        var len = $('#bigPic img').length;
        var next = currentIndex < (len-1) ? currentIndex + 1 : 0;
        showImage(next);
    }
    
    var myTimer;
    
    $(document).ready(function() {
	    myTimer = setTimeout("showNext()", 3000);
		showNext(); 
        $('#thumbs li').bind('click',function(e){
        	var count = $(this).attr('rel');
        	showImage(parseInt(count)-1);
        });
	});
    
	
	</script>
   <?php } ?>
 
    <script type="text/javascript">

            $(document).ready( function(){
                <?php if(Yii::app()->controller->id=='news'){?>
                $('.wrap-content').css({'width':'960px','margin':'0 auto','min-width':'960px','max-width':'960px'}); 
                 $('#footer').css({'width':'960px','margin':'0 auto','min-width':'960px'});
                 $('#footer > div > div').css({'padding-left':'10px'});
                 $('#footer .ontop').css({'margin-right':'10px'});
                <?php }?>
            });

    </script>
</body>
</html>
