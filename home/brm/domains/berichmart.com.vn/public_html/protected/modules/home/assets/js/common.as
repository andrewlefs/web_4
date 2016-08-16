
$(document).ready(function() {
	$(".cat-search ul").hide();
	$(".search-id").click(function(){
		$(".cat-search ul").toggle();
		});
	
	$(".cat-search ul li a").click(function(){
		$(".search-id").attr("value",$(this).text());
		$(".search-id-hidden").text($(this).attr("href"));
		$(".cat-search ul").hide();
		return false;
		});
});


$(document).ready(function(){
	var w_left  = $(".content-left").width();
	var w_page = $(window).width() -100;
	var w_slide = $(".content-right .slide").width();
	$(".wrap-content").css("width",w_page);
	$(".content-right").css("width", w_page - w_left-10);
	$(".hot-products").css("width", w_page - w_left -w_slide -20);
	$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
	$("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
	<!--Co giãn sp theo Resolution-->
	var w_contentRight = $(".content-right").width()-2;
	var w_sp = $(".content-right .box-right ul li").width()+30;
	var numberOfProducts = Math.floor(w_contentRight/w_sp);
	var w_space = w_contentRight - (w_sp*numberOfProducts);
	var w_paddingPlus = Math.floor(w_space /(numberOfProducts * 2));
	$(".content-right .box-right ul li").css("padding-left",15+w_paddingPlus);
	$(".content-right .box-right ul li").css("padding-right",15+ w_paddingPlus);
	<!--Co giãn sp theo Resolution end.-->
	<!--Co giãn sp Hot theo Resolution-->
	var w_contentHotProducts = $(".content .content-right .hot-products").width()-2;
	var w_spHot = $(".content .content-right .hot-products ul li").width()+30;
	var numberOfHotProducts = Math.floor(w_contentHotProducts/w_spHot);
	var w_spaceHotProducts = w_contentHotProducts - (w_spHot*numberOfHotProducts);
	var w_paddingPlusHotProducts = Math.floor(w_spaceHotProducts /(numberOfHotProducts * 2));
	$(".content .content-right .hot-products ul li").css("padding-left",15+w_paddingPlusHotProducts);
	$(".content .content-right .hot-products ul li").css("padding-right",15+ w_paddingPlusHotProducts);
	<!--Co giãn spHot theo Resolution end.-->


	$(window).resize(function() {
	w_page = $(window).width() -100;
	$(".wrap-content").css("width",w_page);
	wrap_left  = $(".left").width();
	$(".content-right").css("width", w_page - w_left-10);
	$(".hot-products").css("width", w_page - w_left -w_slide -20);
	$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
	$("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
	
	
	
	<!--Co giãn sp theo Resolution-->
	w_contentRight = $(".content-right").width()-2;
	w_sp = $(".content-right .box-right ul li").width()+30;
	numberOfProducts = Math.floor(w_contentRight/w_sp);
	w_space = w_contentRight - (w_sp*numberOfProducts);
	w_paddingPlus = Math.floor(w_space /(numberOfProducts * 2));
	$(".content-right .box-right ul li").css("padding-left",15+w_paddingPlus);
	$(".content-right .box-right ul li").css("padding-right",15+ w_paddingPlus);
	<!--Co giãn sp theo Resolution end.-->
	<!--Co giãn sp Hot theo Resolution-->
	var w_contentHotProducts = $(".content .content-right .hot-products").width()-2;
	var w_spHot = $(".content .content-right .hot-products ul li").width()+30;
	var numberOfHotProducts = Math.floor(w_contentHotProducts/w_spHot);
	var w_spaceHotProducts = w_contentHotProducts - (w_spHot*numberOfHotProducts);
	var w_paddingPlusHotProducts = Math.floor(w_spaceHotProducts /(numberOfHotProducts * 2));
	$(".content .content-right .hot-products ul li").css("padding-left",15+w_paddingPlusHotProducts);
	$(".content .content-right .hot-products ul li").css("padding-right",15+ w_paddingPlusHotProducts);
	<!--Co giãn spHot theo Resolution end.-->
	});
  
	
});
