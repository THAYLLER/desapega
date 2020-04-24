$( document ).ready(function(){
$(window).scroll(function(){
var $header = $(".control_div").height();
var $control_div = $header -40;
if($(this).scrollTop() > $control_div){
    $(".floating_bar").addClass('tpshow');
} else {
$(".floating_bar").removeClass('tpshow');
}
});
});

$(document).ready(function() {
    $(" .floating_bar .content_bar .first .show, .floating_bar .content_bar .menu ").hover(function() {
        $(" .floating_bar .content_bar .menu").stop(true, true).slideDown(200);
    }, function() {
        $(".floating_bar .content_bar .menu").stop(true, true).delay(1000).slideUp(200);
    });
});

$(document).ready(function() {//select categories top bar
 $('.top_mainctgg').live('click',function(){	//on click show subcategories
 $('.top_mainctgg').hide();
 $('.top_back').show(); 
 $('#top_show' + this.id).addClass('selected');
 $(this).parents('.top_categg').find('.top_subcategories').show();	
 });
 
 
 $('.top_subcategories span, .top_selected .main_categ_top').click(function(){//add the category in selector
    var subcatID = $(this).attr('id');   
    $('.hisss #sCategory').val($(this).attr('id'));
    $('.hisss #uniform-sCategory span').html($('.hisss #sCategory').find(':selected').text());
    $('.search_top .button ').click();	//aply search
  });
  
 $('.top_back').live('click',function(){
 $('.top_mainctgg').show();
 $('.top_back').hide(); 
 $('.top_selected span').removeClass('selected');
 $('.top_subcategories').hide();
  });
  
   $('.filter_bar .categ_selct .cat_bar').live('click',function(){
   $('.all_categ').show();
    });
	
	$('.all_categ .top_close ').click(function() { //hide selector for category
$('.all_categ').hide();
});
});