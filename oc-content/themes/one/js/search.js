$(document).ready(function() {	
	$(".hisss  .show").click(function(){
	$(this).addClass('active')
      $(".subscribe").show();
	  $(".hisss   .search_w").show();
      });
	  $(".subscribe .close").click(function(){	  
      $(".subscribe").hide();
	  $(".hisss  .search_w").hide();
      });
     });	 
		
	$(document).ready(function() {
var source = ['1', '10', '100', '1000', '10000', '100000', '1000000'];
var firstVal = source[0];
$("input#priceMin").autocomplete({
    minLength: 0,
    source: source,
}).focus(function() {
    $(this).autocomplete("search", "");
});
 });	
	
	$(document).ready(function() {
var source = [ '10', '100', '1000', '10000', '100000', '1000000'];
var firstVal = source[0];
$("input#priceMax").autocomplete({
    minLength: 0,
    source: source,
}).focus(function() {
    $(this).autocomplete("search", "");
});
 });	
	
	$( document ).ready(function() {		
	$(".reset").hide();
	  $('input#query,input#query, select#sRegion,select#sCity, select#sCategory, input#priceMin, input#priceMax ').click(function() {
	  $(".reset").show();
      });
    });
	$( document ).ready(function() {
	  $('.reset').click(function() {
	  $("input#query").val('');
	  $("select#sRegion").val('');
      $("select#sCity").val('');
	   $("select#sCategory").val('');
	  $("input#priceMin").val('');
	  $("input#priceMax").val('');
	  $(".search_top .button").click();
      });
    });	
$(function() { 
  $('.see_by .box_select').click( function(event){
        event.stopPropagation();
        $('.see_by .drop').toggle();
    });
    $(document).click( function(){
        $('.see_by .drop').hide();
    });
});
$( document ).ready(function() {
	 if($('.premiumtext').is(':visible')) {
	 $('.show_thext').show();
    $('.listingstext').show();
	$('.promote_text').hide();
} else {
$('.promote_text').show();
}
});	