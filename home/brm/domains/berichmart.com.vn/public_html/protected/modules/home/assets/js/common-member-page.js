
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
	$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
	$("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
	$(".member-page .member-tree").css("width", $(".wrap-content").width() - w_left -10 - $(".info-member").width()-10 - 20);
	


	$(window).resize(function() {
	var w_left  = $(".content-left").width();
	$("#nav .nav-center").css("width",$(".wrap-content").width()-10);
	$("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
	$(".member-page .member-tree").css("width", $(".wrap-content").width() - w_left -10 - $(".info-member").width()-10 - 20);
	

	});
  
	
});
