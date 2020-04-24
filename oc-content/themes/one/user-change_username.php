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
                $('form#change-username').validate({
                    rules: {
                        s_username: {
                            required: true
						}
					},
                    messages: {
                        s_username: {
                            required: '<?php echo osc_esc_js(__("Username: this field is required", "one")); ?>.'
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
				
                var cInterval;
                $("#s_username").keydown(function(event) {
                    if($("#s_username").attr("value")!='') {
                        clearInterval(cInterval);
                        cInterval = setInterval(function(){
                            $.getJSON(
							"<?php echo osc_base_url(true); ?>?page=ajax&action=check_username_availability",
							{"s_username": $("#s_username").attr("value")},
							function(data){
								clearInterval(cInterval);
								if(data.exists==0) {
									$("#available").text('<?php echo osc_esc_js(__("The username is available", "one")); ?>');
                                    } else {
									$("#available").text('<?php echo osc_esc_js(__("The username is NOT available", "one")); ?>');
								}
							}
                            );
						}, 1000);
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
                <h2><?php _e('Change your username', 'one'); ?></h2>
                <ul id="error_list"></ul>
                <form id="change-username" action="<?php echo osc_base_url(true); ?>" method="post">
                    <input type="hidden" name="page" value="user" />
                    <input type="hidden" name="action" value="change_username_post" />
                    <fieldset>
                        <p>
                            <label for="s_username"><?php _e('Username', 'one'); ?></label>
                            <input type="text" name="s_username" id="s_username" value="" />
						</p>
                        <p class="m_username" style="float:left;margin-left:150px;">
                            <span class="help-box" ><?php _e('WARNING: Once set, you will not be able to change your username again. Choose wisely.', 'one'); ?></span>
						</p>
                        <div style="clear:both;"></div>
                        <div id="available"></div>
                        <div style="clear:both;"></div>
                        <button type="submit"><?php _e('Update', 'one'); ?></button>
					</fieldset>
				</form>
			</div>
		</div>
        <?php osc_current_web_theme_path('footer.php'); ?>
	</body>
</html>