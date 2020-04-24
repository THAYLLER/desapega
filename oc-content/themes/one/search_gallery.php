<?php
    /*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/ 
?>
<div class="area_gal">
	<?php  osc_get_premiums(osc_get_preference('premiumsearchgl', 'one'));
		if(osc_count_premiums() > 0) { ?>
		<div class="premiumtext"></div>
		<?php if(Params::getParam('OnlyPremium') == 0) { ?>
			<?php $class = "even"; ?>
			<?php while(osc_has_premiums()) { ?>
				<div class="premium <?php echo $class; ?>">
					<div class="icon_dpremium"></div>
					<?php if( osc_images_enabled_at_items() ) { ?>
						<div class="photo">
							<?php if(osc_count_premium_resources()) { ?>
								<a href="<?php echo osc_premium_url(); ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="210" height="150" title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>" /></a>
								<?php } else { ?>
								<img width="210" height="150" src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="" />
							<?php } ?>
						</div>
					<?php } ?>
					<div class="text">
						<h3>
							<a href="<?php echo osc_premium_url(); ?>"><span><?php echo osc_highlight( strip_tags( osc_premium_title() ),52 ); ?></span></a>
						</h3>
						<div class="gal_ctg">
							<strong><?php if( osc_price_enabled_at_items()  ) { ?><?php echo osc_premium_formated_price() ; ?><?php } ?><?php echo osc_premium_currency() ; ?></strong>
							<p>
								<?php echo osc_premium_category(); ?><?php if ( osc_premium_city() != "" ) { ?> >> <?php echo osc_premium_city(); ?><?php } ?><?php if ( osc_premium_region() != "" ) { ?>>> <?php echo osc_premium_region(); ?><?php } ?>
							</p>
						</div>
					</div>
				</div>
				<?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
			<?php } ?>
		<?php } ?>
	<?php } ?>
	<div class="gth">
		<?php if(Params::getParam('OnlyPremium') == 0) { ?>
			<div class="listingstext"><?php _e("Listings", "one"); ?></div>
		<?php } ?>
        <?php $class = "even"; ?>
        <?php while(osc_has_items()) { ?>
            <div class="normal <?php echo $class; ?>">
			<?php if(Params::getParam('OnlyPremium') == 1) { ?>
			<div class="icon_dpremium"></div>
			<?php } ?>
                <?php if( osc_images_enabled_at_items() ) { ?>
					<div class="photo">
						<?php if(osc_count_item_resources()) { ?>
							<a href="<?php echo osc_item_url(); ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="210" height="150" title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>" /></a>
							<?php } else { ?>
							<img width="210" height="150" src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="" />
						<?php } ?>
						</div>
				<?php } ?>
				<div class="text">
					<h3>
						<a href="<?php echo osc_item_url(); ?>"><span><?php echo osc_highlight( strip_tags( osc_item_title() ),45 ); ?></span></a>
					</h3>
					<div class="gal_ctg">
						<strong><?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { echo osc_item_formated_price(); ?><?php } ?></strong>
						<p>
							<?php echo osc_item_category(); ?><?php if ( osc_item_city() != "" ) { ?> >> <?php  echo osc_item_city(); ?><?php } ?><?php if ( osc_item_region() != "" ) { ?> >> <?php echo osc_item_region(); ?> <?php } ?>
						</p>
					</div>
				</div>
			</div>
            <?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
		<?php } ?>
		<?php osc_run_hook('search_ads_listing_medium_one'); ?>
	</div>
</div>