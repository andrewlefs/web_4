$(document).ready(function(){
		$(".img:not(:first)").hide()
		$("#slide_bottom a").click(function(){
			var chuyen =$(this).attr("title")
			$("#slide_bottom a").removeClass("active")
			$(this).addClass("active")
			$(".img").hide()
			$(""+chuyen).show()
		})//silde//
		$(window).scroll(function(){
			if($(window).scrollTop()!=0)
				$("#top").fadeIn(3000)
			else
				$("#top").fadeOut()
		})
		$("#top").click(function(){
		$("html,body").animate({scrollTop:0},500)
		})//backtotop//
	})