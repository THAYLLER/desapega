<?php 
	$result_country = osc_get_countries();
	if(count($result_country) > 1){ ?>
	<div class="regionss">
	<h3><?php _e('Most active Regions', 'one') ; ?></h3>
	<?php region_select_active(); ?>
	</div>
	<?php } else { ?>
	<?php if ( !View::newInstance()->_exists('list_contries') ) {
		View::newInstance()->_exportVariableToView('list_regions', Search::newInstance()->listRegions('%%%%', '>=', 'region_name ASC') ) ;
	}
	if( osc_count_list_regions() ) { ?>
	<div class="regionss">
		<h3><?php _e('Regions', 'one') ; ?></h3>
		<ul class="ul_reg">
			<?php while( osc_has_list_regions() ) { ?>
				<li>
					<a href="<?php echo osc_search_url( array( 'sRegion' => osc_list_region_id() ) ) ; ?>"><span><?php echo osc_list_region_name() ; ?></span></a>
				</li>
			<?php } ?>
		</ul>
	</div>
	<?php } ?>	
<?php } ?>