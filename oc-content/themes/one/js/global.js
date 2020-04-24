$(document).ready(function(){
    // User_menu show/hide submenu
    $("#user_menu .with_sub").hover(function(){
        $(this).find("ul").show();
    },
    function(){
        $(this).find("ul").hide();
    });



    // Apply the UniForm plugin to pulldows and button
    $("input:file, textarea, select, button, .search select, .search button, .filters select, .filters button, #comments form button, #contact form button, .user_forms form button, .add_item form select, .add_item form button, .modify_profile select, .modify_profile button").uniform({fileDefaultText: fileDefaultText,fileBtnText: fileBtnText});

    // Show advanced search in internal pages
    $("#expand_advanced").click(function(e){
        e.preventDefault();
        $(".search .extras").slideToggle();
    });

    // Show/hide Report as
    $("#report").hover(function(){
        $(this).find("span").show();
    },
    function(){
        $(this).find("span").hide();
    });

    // Hide login box
    $('html').click(function() {
        $('#login').hide();
    });
    $('#login,#login_open').click(function(event){
        event.stopPropagation();
    });
	
});
$(document).ready(function() {
    $(" #header #user_menu .first .show, #user_menu .menu ").hover(function() {
        $(" #user_menu .menu").stop(true, true).slideDown(200);
    }, function() {
        $("#user_menu .menu").stop(true, true).delay(1000).slideUp(200);
    });
	
	//back top button 
	    
	$(window).scroll(function(){
if($(this).scrollTop() > 300){
    $(".backh_top").fadeIn('slow');;
} else {
$(".backh_top").fadeOut('slow');
}
});

	$('.backh_top').click(function(){
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
 });
	
});