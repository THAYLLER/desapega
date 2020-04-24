<?php
	/*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/
    osc_show_widgets('footer');
    $sQuery = osc_esc_js(osc_get_preference('keyword_placeholder', 'one'));
?>
<!-- footer -->
<div id="footer">  
    <div class="inner">
		<div class="footer_logos">
			<a href="<?php echo osc_base_url(); ?>">
				<?php echo logo_footer(); ?>
			</a>
		</div>
		<div class="first_cat">
			<span><?php _e('Categorias mais vistos', 'one'); ?></span>
			<?php most_active_categoryes(); ?>
		</div>
		<div class="pages">
			<span><?php _e('Paginas', 'one'); ?></span>
			<a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'one'); ?></a>
			<?php osc_reset_static_pages(); ?>
			<?php while( osc_has_static_pages() ) { ?>
				<a href="<?php echo osc_static_page_url(); ?>"><?php echo osc_static_page_title(); ?></a>
			<?php } ?>
		</div>  
		<div class="social">
			<?php echo osc_get_preference('social_widget', 'one'); ?>
		</div>   
	</div>
</div>
<div class="autorr">
	<?php echo osc_get_preference('autor', 'one'); ?>
</div>
<div class="container_lang">
	<ul class="lang">
		<?php if ( osc_count_web_enabled_locales() > 1) { ?>
            <?php osc_goto_first_locale(); ?>
			<?php $i = 0;  ?>
			<?php while ( osc_has_web_enabled_locales() ) { ?>
				<li <?php if( $i == 0 ) { echo "class='first'"; } ?>><a id="<?php echo osc_locale_code(); ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ); ?>"><span><?php echo osc_locale_name(); ?></span></a></li>
				<?php $i++; ?>
			<?php } ?>
		<?php } ?>
	</ul>
</div>
<div class="pages_second_one">
	<a href="<?php echo osc_contact_url(); ?>"><span><?php _e('Contact', 'one'); ?></span></a>
	<?php osc_reset_static_pages(); ?>
	<?php while( osc_has_static_pages() ) { ?>
		<a href="<?php echo osc_static_page_url(); ?>"><span><?php echo osc_static_page_title(); ?></span></a>
	<?php } ?>
</div>
<!-- /footer -->
<div class="backh_top" title="<?php _e('Back to top', 'one'); ?>"></div>
</div>
<!-- /container -->
<?php osc_run_hook('footer'); ?>