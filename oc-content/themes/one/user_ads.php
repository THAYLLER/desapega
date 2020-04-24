<div class="ads">         	
	<?php if( osc_count_items() == 0) { ?>
		<p class="empty"></p>
	    <?php } else { ?>
		<h2><?php _e('Anuncios do usuário', 'one'); ?> <span><?php echo osc_item_contact_name(); ?></span></h2>
		<table border="0" cellspacing="0">
		    <tbody>
				<?php $class = "even"; ?>
				<?php while ( osc_has_items() ) { ?>
					<tr class="pozz <?php echo $class. (osc_item_is_premium()?" premium":"") ; ?>">
						<?php if( osc_item_is_premium() ) { ?> <td class="icon_premium"></td><?php } ?>
						<td class="date">
							<p><?php echo osc_format_date(osc_item_pub_date()); ?></p>
						</td>
						<?php if( osc_images_enabled_at_items() ) { ?>
							<td class="photo">
								<?php if( osc_count_item_resources() ) { ?>
									<a href="<?php echo osc_item_url() ; ?>">
										<img src="<?php echo osc_resource_thumbnail_url() ; ?>" width="94px" height="57px" alt="<?php echo osc_item_title() ; ?>" />
									</a>
									<?php } else { ?>
									<img src="<?php echo osc_current_web_theme_url('images/no_photo.gif') ; ?>" alt="No image available" width="94px" height="57px" />
								<?php } ?>
							</td>
						<?php } ?>
						<td class="text">
							<h3>
								<a href="<?php echo osc_item_url(); ?>"><span><?php echo osc_highlight( strip_tags( osc_item_title() ),50 ); ?></span></a>
							</h3> 
							
							<span class="top"><?php echo osc_item_category();?><?php if( osc_price_enabled_at_items()  ) { ?><span class="price"><?php echo osc_item_formated_price() ; ?></span> <?php } ?>  </span>
						</td>                                       
					</tr>
					<?php $class = ($class == 'even') ? 'odd' : 'even' ; ?>
				<?php } ?>
			</tbody>
		</table>
	<?php } ?>		
</div>		

