<div class="latest_ads">
	<div class="sett">
		<h1><?php _e('Latest Listings', 'one'); ?></h1>
		<?php if( osc_count_latest_items() > 0) { ?>
			<?php if( osc_count_latest_items() == osc_max_latest_items() ) { ?>
				<p class='pagination'><?php echo osc_search_pagination(); ?></p>
				<p class="see_more_link"><a href="<?php echo osc_search_show_all_url();?>"><strong><?php _e("See all offers", 'one'); ?> &raquo;</strong></a></p>
			<?php } ?>
		<?php } ?>
	</div>
	<?php if( osc_count_latest_items() == 0) { ?>
		<p class="empty"><?php _e('No Latest Listings', 'one'); ?></p>
		<?php } else { ?>
		<table border="0" cellspacing="0">
			<tbody>
				<?php $class = "even"; ?>
				<?php while ( osc_has_latest_items() ) { ?>
					<tr class="<?php echo $class. (osc_item_is_premium()?" premium":""); ?>">
						<?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { ?> 
							<td class="price">
								<?php echo osc_item_formated_price(); ?>
								<div class="arrow-right"></div>
							</td>
						<?php } ?>
						<?php if( osc_images_enabled_at_items() ) { ?>
							<td class="photo">
								<?php if( osc_count_item_resources() ) { ?>
									<a href="<?php echo osc_item_url(); ?>">
										<img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" height="56""  title="<?php echo osc_highlight( strip_tags( osc_item_title() ),45 ); ?>" alt="<?php echo osc_item_title(); ?>" />
									</a>
									<?php } else { ?>
									<img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" alt="" title="" />
								<?php } ?>
							</td>
						<?php } ?>
						<td class="text">
							<h3><a href="<?php echo osc_item_url(); ?>"><span><?php echo osc_highlight( strip_tags( osc_item_title() ),45 ); ?></span></a></h3>
							<p>
								<?php if ( osc_item_city() != "" ) { ?><?php echo osc_item_city(); ?><?php } ?><?php if ( osc_item_region() != "" ) { ?>>> <?php echo osc_item_region(); ?><?php } ?>
							</p>
							<p class="date">
								<?php echo osc_format_date(osc_item_pub_date()); ?>
							</p>
						</td>
					</tr>
					<?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
				<?php } ?>
			</tbody>
		</table>
	<?php View::newInstance()->_erase('items'); } ?>
</div>