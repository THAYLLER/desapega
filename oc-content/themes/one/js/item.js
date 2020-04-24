$(document).ready(function(){		
	$(window).scroll(function(){
		$sd_h =  $(".sidebar_price").height();//height of price
		$("#sidebar").css({'height':($("#main .one").height()+$(".second_sidebar").height()- $sd_h +'px')}); //height of sidebar for floating
		var $head = $(".control_div").height();
		var $widget_bear = $(".control_2").height();//calculete the height if massege display
		if($(".floating_bar.tpshow").length > 0){
			var $top_bar_height = 44;		
			} else {
			var $top_bar_height = 0;
		}
        var $contro = $head + $widget_bear - $top_bar_height ;
		var $one = $(".one").height();
		var $calculate = $one + $head + $widget_bear - $sd_h - $top_bar_height;
		if ($(this).scrollTop() > $contro ) {
			$('.second_sidebar').addClass('fixed');
			$('#sidebar').addClass('fixed');
			} else {
			$('.second_sidebar').removeClass('fixed');		
		}
		if($(window).scrollTop() > $calculate - 0) {
		
			$('.second_sidebar').removeClass('fixed');
			$('#sidebar').removeClass('fixed');
			$('.second_sidebar').addClass('red');
			
			
		}
		if($(window).scrollTop() < $calculate - 0) {     
			$('.second_sidebar').removeClass('red');
		}		
	});
	
	$(".navigateone_next").hover(function() {
		$('.hover_next_img ').addClass("exist");
		}, function() {
		$('.hover_next_img ').removeClass("exist");
	});
});
$( document ).ready(function() {
	$('.item #contact .show').click(function() {
		$(".item #description .hide_map").addClass('show');
	});
	$('.item #description .hide_map .xhide').click(function() {
		$(".item #description .hide_map").removeClass('show');
	});
});	
$( document ).ready(function() {
	$('.item #sidebar .send_msg .msg').click(function() {
		$(".item .contact_field ").show();
	});
	$('.item .contact_field h2 span').click(function() {
		$(".item .contact_field ").hide();
	});
	
	$('.item .rap .raport').click(function() {
		$(".item .backk").show();
	});
	$('.item .backk .inter .strong span, .item .backk .inter #mark a').click(function() {
		$(".item .backk").hide();
	});
});
