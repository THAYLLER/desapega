$(document).ready(function(){ 	   
	$('#sClect span').click(function(){
		$('.sbctgg a').removeClass('if_you');
		$('.second_to_hide.if_you, .to_hide.if_you').show();
		$("#back_body").css({'height':($("html").height()+'px')});
        $('#back_body').show();    
	}); 
	$('.close, .sbctgg').click(function(){
        $('#back_body').hide(); 		
	});
});

$(document).ready(function() {	      
	$('.mainctgg').live('click',function(){	//on click show subcategories	  
		$('.mainctgg').hide();
		$('.ffft').hide();
		$('#first_back').show();
		$('.ssst').show();		
		$(this).parents('.categg').find('.subcategory').show();						
	});
	
	$('.first_sbctgg a').live('click',function(){ //on click show sub subcategories		  
		$('.to_hide').hide();
		$('#first_back').hide();
		$('#second_back').show();
		$(this).parents('.first_sbctgg').find('.second').show();
		$(this).show().addClass('if_you'); 			
	});
	
	$('.first_sbctgg').live('click',function(){//add id to find parent subcategory
		$('.first_sbctgg').attr("id","");
		$(this).attr("id","use");
	});
	
	$('.to_hide.if_you').live('click',function(){//if select a main subcategory hide window
		$('#back_body').hide();
	});
	
	$('.second_sbctgg a').live('click',function(){	//on click show final subcategories	  
		$('.second_to_hide').hide();
		$('#second_back').hide();
		$('#three_back').show();
		$(this).parents('.second_sbctgg').find('.second2, .second2 .second_to_hide').show();			
		$('.to_hide').removeClass('if_you');
		$(this).show().addClass('if_you');		
	});	
	
	$('.second_to_hide.if_you').live('click',function(){//if select a main subcategory hide window
		$('#back_body').hide();
	});
	
	$('#first_back').click(function(){//go back to categories
		$('.mainctgg').show();
		$('.subcategory').hide();
		$('.ssst').hide();
		$('#first_back').hide();
		$('.ffft').show();
	});
	
	$('#second_back').click(function(){//go back to first subcategories
		$('.second').hide();
		$('.to_hide').show();
		$('#second_back').hide();
		$('#first_back').show();
		$('.first_sbctgg a').removeClass('if_you');
	});
	
	$('#three_back').click(function(){//final back
		$('.second2, .second2 .second_to_hide').hide();
		$('.second_to_hide').show();
		$('#three_back').hide();
		$('#second_back').show();
		$('#use.first_sbctgg a.to_hide').addClass('if_you').show();
		$('.second_sbctgg a').removeClass('if_you');	
	});
	
	$('.sbctgg strong').click(function(){//add the last subcategories
		var useID = $(this).attr('class');   
		$('#catId').val(useID);
		$('#uniform-catId span').html($('#catId').find(':selected').text());	
	});
	
	$('.first_sbctgg strong').click(function(){//add all subcategories
		var useID = $(this).attr('class');   
		$('#catId').val(useID);
		$('#uniform-catId span').html($('#catId').find(':selected').text());	
	});
	
	$('#cityArea, #price').bind('keyup blur',function(){ 
		var node = $(this);
	node.val(node.val().replace(/[^0-9\.\-]/g,'') ); }
	);
});