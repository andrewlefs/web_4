$(document).ready(function(){

	// Menu hover
	var main_menu = 10;
	var main_menu_index = -1;
	var main_menu_start = 2;
	$('ul.main-menu > li > a').mouseover(function(){
		main_menu_index = $('ul.main-menu > li > a').index(this);
		main_menu = 8;
		main_menu_start = 0;
	}).mouseout(function(){
		main_menu_index = -1;
		main_menu_start = 2;
		$('ul.main-menu > li > a').css({'padding-right' : '10px'});
	});	
	
	// Menu hover
	$(function() {
		setInterval(function(){
			if(main_menu_start == 0){
				main_menu = main_menu + 2;
				$('ul.main-menu > li > a:eq('+main_menu_index+')').css({'padding-right' : main_menu+'px'});
				if(main_menu > 35) main_menu_start = 1;
			}
			if(main_menu_start == 1){
				main_menu = main_menu - 2;
				$('ul.main-menu > li > a:eq('+main_menu_index+')').css({'padding-right' : main_menu+'px'});
				if(main_menu == 10) main_menu_start = 2;
			}
		}, 5);
	});
	
	// Menu click
	$('ul.main-menu > li > a').click(function(){
		main_menu_index = $('ul.main-menu > li > a').index(this);
		main_menu = 8;
		main_menu_start = 0;	
		var i = $('ul.main-menu > li > a').index(this);
		if ($('ul.sub-menu:eq('+i+')').is(':hidden')){
			$('ul.sub-menu:not(:hidden)').slideUp('fast');
			$('ul.sub-menu:eq('+i+')').slideDown('fast');
		}		
		return false;
	});
	
	$('ul.sub-menu > li > a.selected').parent().parent().slideDown('fast');
	
	$('#frm tr:odd > td').addClass('odd');
        $('#frm tr:even > td').addClass('even');
        $('.frm tr:odd > td').addClass('odd');
        $('.frm tr:even > td').addClass('even');
});