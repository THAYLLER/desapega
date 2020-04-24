<?php
	/*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/
	osc_get_premiums(osc_get_preference('premiumsearch', 'one'));
    if(osc_count_premiums() > 0) {
	?>
	<div class="premiumtext"></div>
	<?php if(Params::getParam('OnlyPremium') == 0) { ?>
		<div class="cont">
			<?php $class = "even"; ?>
			<?php while(osc_has_premiums()) { ?>
				<div id="tr" class="premium_<?php echo $class; ?>">
					<div class="icon_premium"></div>
					<div class="date"><?php echo osc_format_date(osc_premium_pub_date()); ?></div>			
					<?php if( osc_images_enabled_at_items() ) { ?>
						<div class="photo">
							<?php if(osc_count_premium_resources()) { ?>
								<a href="<?php echo osc_premium_url(); ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="90" height="70" title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>" /></a>
								<?php } else { ?>
								<img  width="90" height="70" src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="" />
							<?php } ?>
						</div>
					<?php } ?>
					<div class="text">
						<h3>
							<a href="<?php echo osc_premium_url(); ?>"><span><?php echo osc_highlight( strip_tags( osc_premium_title() ) ); ?></span></a>
						</h3>
						<p class="categ">
							<?php echo osc_premium_category(); ?>  
						</p>
						<p>
							<strong><?php if ( osc_premium_city() != "" ) { ?><?php echo osc_premium_city(); ?><?php } ?> <?php if( osc_premium_region()!='' ) { ?> <?php echo osc_premium_region(); ?><?php } ?></strong>
						</p>
					</div>
					<div class="price">
						<?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled(osc_premium_category_id()) ) { echo osc_premium_formated_price(); ?><?php echo osc_premium_currency() ; ?><?php } ?>
					</div>
				</div>
				<?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
			<?php } ?>
		</div>
	<?php } ?>
<?php } ?>
<?php if(Params::getParam('OnlyPremium') == 0) { ?>
	<div class="listingstext"><?php _e("Listings", "one"); ?></div>
<?php } ?>
<table border="0" cellspacing="0">
    <tbody>
        <?php $class = "even"; $i = 0; ?>
        <?php while(osc_has_items()) { $i++; ?>
            <tr class="<?php echo $class; ?>">
				<?php if(Params::getParam('OnlyPremium') == 1) { ?>
					<td class="icon_premium"></td>
				<?php } ?>
				<td class="date"><?php echo osc_format_date(osc_item_pub_date()); ?></td>
                <?php if( osc_images_enabled_at_items() ) { ?>
					<td class="photo">
						<?php if(osc_count_item_resources()) { ?>
							<a href="<?php echo osc_item_url(); ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="90" height="70" title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>" /></a>
							<?php } else { ?>
							<img width="90" height="70" src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="" />
						<?php } ?>
					</td>
				<?php } ?>
				<td class="text">
					<h3>
						<a href="<?php echo osc_item_url(); ?>"><span><?php echo osc_highlight( strip_tags( osc_item_title() ) ); ?></span></a>
					</h3>
					<p class="categ">
						<?php  
							$aCategory = osc_get_category('id', osc_item_category_id());
							$parentCategory = osc_get_category('id', $aCategory['fk_i_parent_id']);
							View::newInstance()->_erase('categories');
							View::newInstance()->_erase('subcategories');
							View::newInstance()->_exportVariableToView('category', $parentCategory);
						echo osc_category_name();  ?> >> <?php echo osc_item_category();?>
					</p>
					<p>
						<strong><?php if ( osc_item_city() != "" ) { ?><?php echo osc_item_city(); ?><?php } ?> <?php if ( osc_item_region() != "" ) { ?><?php echo osc_item_region(); ?> <?php } ?></strong>
					</p>                   
				</td>
				<td class="price">
					<?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { echo osc_item_formated_price(); ?> <?php } ?>
				</td>
			</tr>
            <?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
			<?php if( $i == 5 ) { ?>
			</tbody>
		</table>
		<?php osc_run_hook('search_ads_listing_medium_one'); ?>
		<table border="0" cellspacing="0">
			<tbody>
			<?php } ?>
		<?php } ?>
	</tbody>
</table>