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
        <script type="text/javascript">
            $(document).ready(function() {
                $('form#change-email').validate({
                    rules: {
                        new_email: {
                            required: true,
                            email: true
						}
					},
                    messages: {
                        new_email: {
                            required: '?php echo osc_esc_js(__("Email: this field is required", "one")); ?>.',
                            email: '<?php echo osc_esc_js(__("Invalid email address", "one")); ?>.'
						}
					},
                    errorLabelContainer: "#error_list",
                    wrapper: "li",
                    invalidHandler: function(form, validator) {
                        $('html,body').animate({ scrollTop: $('h1').offset().top }, { duration: 250, easing: 'swing'});
					},
                    submitHandler: function(form){
                        $('button[type=submit], input[type=submit]').attr('disabled', 'disabled');
                        form.submit();
					}
				});
			});
		</script>
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
                <h2><?php _e('Change your e-mail', 'one'); ?></h2>
                <ul id="error_list"></ul>
                <form id="change-email" action="<?php echo osc_base_url(true); ?>" method="post">
                    <input type="hidden" name="page" value="user" />
                    <input type="hidden" name="action" value="change_email_post" />
                    <fieldset>
                        <p>
                            <label for="email"><?php _e('Current e-mail', 'one'); ?></label>
                            <span><?php echo osc_logged_user_email(); ?></span>
						</p>
                        <p>
                            <label for="new_email"><?php _e('New e-mail', 'one'); ?> *</label>
                            <input type="text" name="new_email" id="new_email" value="" />
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