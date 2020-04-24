<?php 
	$category_name = "";
	$city_name = "";
	$region_name = "";
	$premium = false;
	$number_item = "12";
	$random = "0";
	if(osc_get_preference('category_custom', 'one') !=''){
		$category_name = osc_get_preference('category_custom', 'one');
	}
	if(osc_get_preference('city_custom', 'one') !=''){
		$city_name = osc_get_preference('city_custom', 'one');
	}
	if(osc_get_preference('region_custom', 'one') !=''){
		$region_name = osc_get_preference('region_custom', 'one');
	}
	if(osc_get_preference('premium_custom', 'one') == 1){
		$premium = true;
	}
	if(osc_get_preference('number_custom', 'one') !=''){
		$number_item = osc_get_preference('number_custom', 'one');
	}
	if(osc_get_preference('random_custom', 'one') == 1){
		$random = rand(0, 1);
	}
	osc_query_item(array(
	"category_name" => $category_name,
	"city_name" => $city_name,
	"region_name" => $region_name,
	"premium" => $premium,
	"results_per_page" => $number_item,
	"offset" => $random
	));
	if( osc_count_custom_items() > 0) { ?>
	<link href="<?php echo osc_current_web_theme_js_url('owl.carousel.css') ; ?>" rel="stylesheet">
	<link href="<?php echo osc_current_web_theme_js_url('owl.theme.css') ; ?>" rel="stylesheet">
	<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('owl.carousel.js') ; ?>"></script>
	<div class="latest_ads carousel_area">
		<h1><?php if(osc_get_preference('name_custom', 'one') !=''){ ?><?php echo osc_get_preference('name_custom', 'one'); ?><?php } else { ?> <?php _e('Premium Listings', 'one'); ?><?php } ?></h1>
		<div id="owl-demo" class="owl-carousel">
			<?php while ( osc_has_custom_items() ) { ?>				
				<div class="item">
					<?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { ?> 
						<div class="price">
							<?php echo osc_item_formated_price(); ?>
							<div class="arrow-right"></div>
						</div>
					<?php } ?>
					<?php if( osc_images_enabled_at_items() ) { ?>	
						<div class="photo">
							<?php if( osc_count_item_resources() ) { ?>
								<a href="<?php echo osc_item_url(); ?>">
									<img src="<?php echo osc_resource_thumbnail_url(); ?>"  title="<?php echo osc_highlight( strip_tags( osc_item_title() ),45 ); ?>" alt="<?php echo osc_item_title(); ?>" />
								</a>
								<?php } else { ?>
								<img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" alt="" title="" />
							<?php } ?>
						</div>
					<?php } ?>
					<div class="text">
						<h3><a href="<?php echo osc_item_url(); ?>"><span><?php echo osc_highlight( strip_tags( osc_item_title() ),45 ); ?></span></a></h3>
						<p>
							<?php if ( osc_item_city() != "" ) { ?><?php echo osc_item_city(); ?><?php } ?><?php if ( osc_item_region() != "" ) { ?>>> <?php echo osc_item_region(); ?><?php } ?>
						</p>
						<p class="date">
							<?php echo osc_format_date(osc_item_pub_date()); ?>
						</p>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php View::newInstance()->_erase('items'); } ?>
<script type="text/javascript">
    $(document).ready(function() {     
		$("#owl-demo").owlCarousel({   
			autoPlay: 3000, //Set AutoPlay to 3 seconds    
			items : 4,
			itemsDesktop : [1000,4], //5 items between 1000px and 901px
			itemsDesktopSmall : [900,4], // betweem 900px and 601px
			itemsTablet: [600,4], //2 items between 600 and 0
			
		});    
	});
</script>	