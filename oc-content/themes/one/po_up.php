<?php $i_image = ItemResource::newInstance()->getResource( osc_item_id() );?>
<script type="text/javascript">
	$(document).ready(function(){			
		var psync1 = $("#psync1");
		var psync2 = $("#psync2");
		
		psync1.owlCarousel({
			singleItem : true,
			slideSpeed : 1000,
			navigation: true,
			navigationText: [
			"<span class='left'></span>",
			"<span class='right'></span>"
			],
			pagination:false,
			afterAction : psyncPosition,
			responsiveRefreshRate : 200,
		});
		
		psync2.owlCarousel({
			items : '<?php echo osc_count_item_resources(); ?>',
			itemsDesktop      : [1199,10],
			itemsDesktopSmall     : [979,10],
			itemsTablet       : [768,8],
			itemsMobile       : [479,4],
			pagination:false,
			responsiveRefreshRate : 100,
			afterInit : function(el){
				el.find(".owl-item").eq(0).addClass("psynced");
			}
		});
		
		function psyncPosition(el){
			var current = this.currentItem;
			$("#psync2")
			.find(".owl-item")
			.removeClass("psynced")
			.eq(current)
			.addClass("psynced")
			if($("#psync2").data("owlCarousel") !== undefined){
				center(current)
			}
			
		}
		
		$("#psync2").on("click", ".owl-item", function(e){
			e.preventDefault();
			var number = $(this).data("owlItem");
			psync1.trigger("owl.goTo",number);			
		});
		
		function center(number){
			var psync2visible = psync2.data("owlCarousel").owl.visibleItems;
			
			var num = number;
			var found = false;
			for(var i in psync2visible){
				if(num === psync2visible[i]){
					var found = true;
				}
			}
			
			if(found===false){
				if(num>psync2visible[psync2visible.length-1]){
					psync2.trigger("owl.goTo", num - psync2visible.length+2)
					}else{
					if(num - 1 === -1){
						num = 0;
					}
					psync2.trigger("owl.goTo", num);
				}
				} else if(num === psync2visible[psync2visible.length-1]){
				psync2.trigger("owl.goTo", psync2visible[1])
				} else if(num === psync2visible[0]){
				psync2.trigger("owl.goTo", num-1)
			}
		}
		$("#psync1 .item img").css({'max-height':($(".pop_up_image").height()- '50'- $("#psync2").height()- $(".po_title").height() +'px')});
		//image height		
		$(window).resize(function(){	
			$("#psync1 .item img").css({'max-height':($(".pop_up_image").height()- '50'- $("#psync2").height()- $(".po_title").height() +'px')});
		});
		
		$('.po_open').click(function(){
			var image_id = $('#psync2 .owl-item.psynced div').attr('id');
			var image_extension = $('#psync2 .owl-item.psynced img').attr('class');
			var url_image = '<?php echo (string) osc_base_url().$i_image['s_path']; ?>' + image_id + '_original.' + image_extension; 
			window.open(url_image);
		});
		$('.po_close').click(function(){
			$('.pop_up_image').removeClass('active');
			$("body").css({'overflow':'auto'});
		});
		$("#sync1 .item img, .po_galery_up").hover(function(){
			$('.po_galery_up').show();
			},function(){
			$('.po_galery_up').hide();
		});
	});
</script>
<?php if(osc_count_item_resources() > 1) { ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#sync1 .item, .po_galery_up').click(function(){
				$('.pop_up_image').addClass('active');
				$("body").css({'overflow':'hidden'});
			});	
		});
	</script>
	<?php } else { ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#sync1 .item').click(function(){
				var imag_id = $(this).attr('id');
				var url_imag = '<?php echo (string) osc_base_url().$i_image['s_path']; ?>' + imag_id + '_original.<?php echo $i_image['s_extension']; ?>'; 
				window.open(url_imag);
			});	
		});
	</script>
<?php } ?>
<div class="po_close"></div>
<div class="po_title">
	<p><?php echo osc_item_title(); ?></p>
</div>
<div class="po_back">
	<div class="po_line_c">
		<div class="po_galery">
			<div class="po_open"></div>
			<?php if( osc_images_enabled_at_items() ) { 
				if( osc_count_item_resources() > 0 ) { ?>
				<div id="psync1" class="owl-carousel">				
					<?php for ( $i = 0; osc_has_item_resources(); $i++ ) { ?>
						<div class="item">
							<img src="<?php echo osc_resource_url(); ?>" />
						</div>						
					<?php } ?>					
					<?php View::newInstance()->_erase('resources'); ?>
				</div>
				<?php if( osc_count_item_resources() > 1 ) { ?>
					<div id="psync2" class="owl-carousel">
						<?php
							for ( $i = 0; osc_has_item_resources() ; $i++ ) { ?>
							<div id="<?php echo osc_resource_id(); ?>" class="item"><img class="<?php echo osc_resource_extension(); ?>" src="<?php echo osc_resource_thumbnail_url(); ?>" /></div>
						<?php } ?>	
						<?php View::newInstance()->_erase('resources'); ?>
					</div>
				<?php } ?>
			<?php } } ?>
		</div>
	</div>
</div>
<div class="po_info">
	<div class="po_line"></div>
	<?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { ?>
		<div class="po_price"><?php echo osc_item_formated_price(); ?></div> 
	<?php } ?>
	<?php if ( osc_item_city_area() != "" ) { ?>
		<div class="po_number"><?php echo osc_item_city_area(); ?></div>
	<?php } ?>
	<?php if(osc_item_address() != "" || osc_item_region() != "" || osc_item_country() != "") { ?>
		<div class="po_location">
			<?php if ( osc_item_address() != "" ) { ?><strong><?php echo osc_item_address(); ?>, </strong><?php } ?>
			<?php if ( osc_item_city() != "" ) { ?><strong><?php echo osc_item_city(); ?>, </strong><?php } ?>
			<?php if ( osc_item_region() != "" ) { ?><strong><?php echo osc_item_region(); ?>, </strong><?php } ?>
			<?php if ( osc_item_country() != "" ) { ?><strong><?php echo osc_item_country(); ?> </strong><?php } ?>
		</div>
	<?php } ?>
	<?php if( osc_item_user_id() != null ) { ?>
		<div class="po_name">
			<p><?php echo osc_item_contact_name(); ?></p>
			<?php if( osc_item_show_email() ) { ?>
				<p class="email"><?php _e('E-mail', 'one'); ?>: <?php echo osc_item_contact_email(); ?></p>
			<?php } ?>
			<a href="<?php echo osc_user_public_profile_url( osc_item_user_id() ); ?>" ><?php _e('Seller listings', 'one'); ?></a>
		</div>
		<?php } else { ?>
		<div class="po_name"><p><?php echo osc_item_contact_name(); ?></p>
			<?php if( osc_item_show_email() ) { ?>
				<p class="email"><?php _e('E-mail', 'one'); ?>: <?php echo osc_item_contact_email(); ?></p>
			<?php } ?>
		</div>
	<?php } ?>
	<div class="po_date">
		<p><?php if ( osc_item_pub_date() != '' ) echo __('Published date', 'one') . ': ' . osc_format_date( osc_item_pub_date() ); ?></p>
		<p><?php if ( osc_item_mod_date() != '' ) echo __('Modified date', 'one') . ': ' . osc_format_date( osc_item_mod_date() ); ?></p>
		<p>
			<?php _e('Views', 'one') ; ?>:
			<strong><?php echo ItemStats::newInstance()->getViews(osc_item_id()); ?></strong>
		</p>
	</div>	
</div>