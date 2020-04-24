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
    <body>
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="content user_forms">
            <div class="inner">
                <h1><?php _e('Access to your account', 'one'); ?></h1>
                <form action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="login" />
                    <input type="hidden" name="action" value="login_post" />
                    <fieldset>
                        <label for="email"><?php _e('E-mail', 'one'); ?></label> <?php UserForm::email_login_text(); ?><br />
                        <label for="password"><?php _e('Password', 'one'); ?></label> <?php UserForm::password_login_text(); ?><br />
                        <p class="checkbox"><?php UserForm::rememberme_login_checkbox();?> <label for="remember"><?php _e('Remember me', 'one'); ?></label></p>
                        <button type="submit"><?php _e("Log in", 'one');?></button>
                        <div class="more-login">
                            <a href="<?php echo osc_register_account_url(); ?>"><span><?php _e("Register for a free account", 'one'); ?></span></a> · <a href="<?php echo osc_recover_user_password_url(); ?>"><span><?php _e("Forgot password?", 'one'); ?></span></a>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
        <?php osc_current_web_theme_path('footer.php'); ?>
	</body>
</html>