<script type="text/javascript">
	$(document).ready(function() {	      
		$('.m_first').live('click',function(){
			var name = $( this ).text();
			$('.m_back').text(name);
			$('.m_first').hide();
			$('.m_back').show();
			$(this).parents('.m_main').find('.m_subcategory').addClass("active");			
			
		});
		$('.m_back').live('click',function(){
			$('.m_subcategory').removeClass("active");
			$('.m_first').show();
			$('.m_back').hide();
		});
	});	
</script>
<div class="m_categories">	
	<div class="m_back"></div>
	<?php osc_goto_first_category(); ?>
	<?php while ( osc_has_categories() ) { ?>
		<div class="m_main">
			<div class="m_first" title="<?php echo osc_category_description() ; ?>" >
				<?php
					if(file_exists(osc_themes_path() . 'one/images/m_categ_image/' . osc_category_id() . '.png')) {
						$img = osc_base_url() . 'oc-content/themes/one/images/m_categ_image/' . osc_category_id() . '.png';
						} else {
						$img = osc_base_url() . 'oc-content/themes/one/images/none.png';
					}
				?> 
				<span class="m_image">
				<img src="<?php echo $img; ?>" alt="<?php echo osc_category_name() ; ?>"/></span>       
				<span class="m_text"><?php echo osc_highlight( strip_tags( osc_category_name() ),52 ); ?></span>
				<span class="m_next"></span>
			</div>
			<?php if ( osc_count_subcategories() > 0 ) { ?>
				<div class="m_subcategory"> 
					<ul>
						<?php while ( osc_has_subcategories() ) { ?>									
							<li><a class="m_category cat_<?php echo osc_category_id(); ?>" href="<?php echo osc_search_category_url(); ?>">
								<span class="m_text"><?php echo osc_category_name(); ?></span>
								<span class="m_next"></span>
								<span class="m_number"><?php echo osc_category_total_items(); ?></span>
							</a></li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</div>			