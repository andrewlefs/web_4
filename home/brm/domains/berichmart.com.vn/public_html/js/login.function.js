$(document).ready(function(){
	$('img#captcha-img').click(function() {
		var sure = confirm('Thay đổi mã xác nhận ?');	
		if (sure == true){
			var captchaImageDemoObj = $('img#captcha-img');
			var captchaImageDemoNewSRC = captchaImageDemoObj.attr('src') + '?' + Math.floor(Math.random()*11);
			captchaImageDemoObj.attr('src', captchaImageDemoNewSRC);
		}
		else{
			return false;
		}
	});
	
	$("#frm-login").validate({
		rules: {
			username: "required",
			password: "required",
			email: "required",
			captcha: "required"
		},
		messages: {
			username: "Mời bạn nhập thông tin !",
			password: "Mời bạn nhập thông tin !",
			email: "Mời bạn nhập thông tin !",
			captcha: "Mời bạn nhập thông tin !"
		}
	});
	
});