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
        <div class="content user_account">
            <h1>
                <strong><?php _e('User account manager', 'one'); ?></strong>	
			</h1>
			
            <div id="sidebar">
                <?php echo osc_private_user_menu( get_user_menu() ); ?>
			</div>
            <div id="main">
                <h2><?php echo sprintf(__('Listings from %s', 'one') ,osc_logged_user_name()); ?></h2>
                <?php if(osc_count_items() == 0) { ?>
                    <h3><?php _e('No listings have been added yet', 'one'); ?></h3>
					<?php } else { ?>
                    <?php while(osc_has_items()) { ?>
                        <div class="userItem" >
                            <div>
                                <a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title(); ?></a>
							</div>
                            <div class="userItemData" >
								<?php _e('Publication date', 'one'); ?>: <?php echo osc_format_date(osc_item_pub_date()); ?><br />
								<?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { _e('Price', 'one'); ?>: <?php echo osc_format_price(osc_item_price()); } ?>
								<p class="options">
									<strong><a href="<?php echo osc_item_url(); ?>"><?php _e('View listing', 'one'); ?></a></strong>
									<span>|</span>
									<a href="<?php echo osc_item_edit_url(); ?>"><?php _e('Edit', 'one'); ?></a>
									<?php if(osc_item_is_inactive()) {?>
                                        <span>|</span>
                                        <a href="<?php echo osc_item_activate_url();?>" ><?php _e('Activate', 'one'); ?></a>
									<?php } ?>
								</p>
								<br />
							</div>
						</div>
                        <br />
					<?php } ?>
				<?php } ?>
			</div>
		</div>
        <?php osc_current_web_theme_path('footer.php'); ?>
	</body>
</html>
