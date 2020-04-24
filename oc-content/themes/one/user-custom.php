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
                <strong><?php //_e('', 'one'); ?></strong>
			</h1>
            <div id="sidebar">
                <?php echo osc_private_user_menu( get_user_menu() ); ?>
			</div>
            <div id="main">
                <?php osc_render_file(); ?>
			</div>
		</div>
        <?php osc_current_web_theme_path('footer.php'); ?>
	</body>
</html>