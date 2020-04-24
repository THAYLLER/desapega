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
        <div class="content user_forms">
            <div class="inner">
                <h1><?php _e('Contact us', 'one'); ?></h1>
                <ul id="error_list"></ul>
                <form action="<?php echo osc_base_url(true); ?>" method="post" name="contact_form" id="contact">
                    <input type="hidden" name="page" value="contact" />
                    <input type="hidden" name="action" value="contact_post" />
                    <fieldset>
                        <label for="subject"><?php _e('Subject', 'one'); ?> (<?php _e('optional', 'one'); ?>)</label> <?php ContactForm::the_subject(); ?><br />
                        <label for="message"><?php _e('Message', 'one'); ?></label> <?php ContactForm::your_message(); ?><br />
                        <label for="yourName"><?php _e('Your name', 'one'); ?> (<?php _e('optional', 'one'); ?>)</label> <?php ContactForm::your_name(); ?><br />
                        <label for="yourEmail"><?php _e('Your e-mail address', 'one'); ?></label> <?php ContactForm::your_email(); ?><br />
                        <?php osc_run_hook('contact_form'); ?>
                        <?php osc_show_recaptcha(); ?>
                        <button type="submit"><?php _e('Send', 'one'); ?></button>
                        <?php osc_run_hook('admin_contact_form'); ?>
                    </fieldset>
                </form>
            </div>
        </div>
        <?php ContactForm::js_validation(); ?>
        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>