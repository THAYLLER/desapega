<?php
    /*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
	</head>
    <body class="dash_b">
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="content user_account items">
            <h1>
                <strong><?php _e('User account manager', 'one'); ?></strong>
			</h1>
            <div id="sidebar">
                <?php echo osc_private_user_menu( get_user_menu() ); ?>
			</div>
            <div id="main">
                <h2><?php _e('Your listings', 'one'); ?> <a href="<?php echo osc_item_post_url(); ?>"><span>+ </span><?php _e('Post a new listing', 'one'); ?></a></h2>
                <?php if(osc_count_items() == 0) { ?>
                    <h3><?php _e("You don't have any listings yet", 'one'); ?></h3>
					<?php } else { ?>
                    <?php while(osc_has_items()) { ?>
						<div class="item" >
							<h3>
								<a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title(); ?></a>
								<?php if(osc_item_is_active()) { echo '<span class="user-listing-active">'.__('Active', 'one').'</span>'; } else { echo '<span class="user-listing-inactive">'.__('Inactive', 'one').'</span>'; }; ?>
								<?php if(osc_item_is_premium()) { echo '<span class="user-listing-premium">'.__('Premium', 'one').'</span>'; }; ?>
								<?php if(osc_item_is_spam()) { echo '<span class="user-listing-spam">'.__('Spam', 'one').'</span>'; }; ?>
							</h3>
							<p>
								<?php _e('Publication date', 'one'); ?>: <?php echo osc_format_date(osc_item_pub_date()); ?><br />
								<?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { _e('Price', 'one'); ?>: <strong><?php echo osc_format_price(osc_item_price()); } ?></strong>
							</p>
							<p class="options">
								<strong><a href="<?php echo osc_item_edit_url(); ?>"><?php _e('Edit', 'one'); ?></a></strong>
								<span>|</span>
								<a class="delete" onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can not be undone. Are you sure you want to continue?', 'one')); ?>')" href="<?php echo osc_item_delete_url();?>" ><?php _e('Delete', 'one'); ?></a>
								<?php if(osc_item_is_inactive()) {?>
									<span>|</span>
									<a href="<?php echo osc_item_activate_url();?>" ><?php _e('Activate', 'one'); ?></a>
								<?php } ?>
							</p>
							<br />
						</div>
					<?php } ?>
                    <br />
                    <div class="paginate" >
						<?php for($i = 0; $i < osc_list_total_pages(); $i++) {
							if($i == osc_list_page()) {
								printf('<a class="searchPaginationSelected" href="%s">%d</a>', osc_user_list_items_url($i+1), ($i + 1));
								} else {
								printf('<a class="searchPaginationNonSelected" href="%s">%d</a>', osc_user_list_items_url($i+1), ($i + 1));
							}
						} ?>
					</div>
				<?php } ?>
			</div>
		</div>
        <?php osc_current_web_theme_path('footer.php'); ?>
	</body>
</html>