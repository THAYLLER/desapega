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
            <div id="main" class="modify_profile">
                <h2><?php _e('Change your password', 'one'); ?></h2>
                <form action="<?php echo osc_base_url(true); ?>" method="post">
                    <input type="hidden" name="page" value="user" />
                    <input type="hidden" name="action" value="change_password_post" />
                    <fieldset>
                        <p>
                            <label for="password"><?php _e('Current password', 'one'); ?> *</label>
                            <input type="password" name="password" id="password" value="" />
						</p>
                        <p>
                            <label for="new_password"><?php _e('New password', 'one'); ?> *</label>
                            <input type="password" name="new_password" id="new_password" value="" />
						</p>
                        <p>
                            <label for="new_password2"><?php _e('Repeat new password', 'one'); ?> *</label>
                            <input type="password" name="new_password2" id="new_password2" value="" />
						</p>
                        <div style="clear:both;"></div>
                        <button type="submit"><?php _e('Update', 'one'); ?></button>
					</fieldset>
				</form>
			</div>
		</div>
        <?php osc_current_web_theme_path('footer.php'); ?>
	</body>
</html>