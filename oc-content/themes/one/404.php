<?php
    /*
     *
     *                        Copyright (C) 2015 Puiu Calin
     *
     *       This program is a commercial software. Copying or distribution without a license is forbidden.
     *     
     */

    osc_enqueue_script('jquery-validate');
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
        <div class="content error">
            <h1><?php _e('Page not found', 'one'); ?></h1>
        </div>
        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>