<div class="space">
	<table border="0" cellspacing="0">
		<tbody>
			<?php $class = "even"; ?>
			<?php while(osc_has_items()) { ?>
				<tr class="<?php echo $class; ?>">
					<td class="date"><?php echo osc_format_date(osc_item_pub_date()); ?></td>
					<?php if( osc_images_enabled_at_items() ) { ?>				
						<td class="photo">
							<div class="alignimg">
								<?php if(osc_count_item_resources()) { ?>
									<a href="<?php echo osc_item_url(); ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="94" height="57"  title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>" /></a>
									<?php } else { ?>
									<img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="" width="94" height="57"  />
								<?php } ?>
							</div>
						</td>
					<?php } ?>
					<td class="text">
						<h3>
							<a href="<?php echo osc_item_url(); ?>"><span><?php echo osc_highlight( strip_tags( osc_item_title() ),50 ); ?></span></a>
						</h3>                   
						<span class="top"><?php echo osc_item_category();?><?php if( osc_price_enabled_at_items()  ) { ?><span class="price"><?php echo osc_item_formated_price() ; ?></span> <?php } ?>							 
						</span>		 
					</td>
				</tr>
				<?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
			<?php } ?>
		</tbody>
	</table>
</div>